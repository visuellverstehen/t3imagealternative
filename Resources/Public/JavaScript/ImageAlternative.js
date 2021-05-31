/**
 * Module: TYPO3/CMS/Hafenk/ImageAlternative
 */
define([
    'jquery',
    'TYPO3/CMS/Backend/FormEngineValidation'
], function($, FormEngineValidation) {
    var ImageAlternative = {
        foo: 'bar'
    };

    ImageAlternative.initialize = function() {
        $(document).find(FormEngineValidation.inputSelector).each(function() {
            if($(this).attr('data-formengine-validation-rules').indexOf('ImageAlternative') > -1) {
                ImageAlternative.initializeInput(this);
            }

            $(document).on('change', FormEngineValidation.rulesSelector, function() {
                ImageAlternative.initializeInput(this);
            });
        });
    };

    ImageAlternative.initializeInput = function($element) {
        if ($element.placeholder === '' && $element.value === '') {
            $element.closest(FormEngineValidation.markerSelector).classList.toggle(FormEngineValidation.errorClass, true);
            FormEngineValidation.markParentTab($($element), isValid);

            $(document).trigger('t3-formengine-postfieldvalidation');
        }
    };

    ImageAlternative.initialize();

    return ImageAlternative;
});
