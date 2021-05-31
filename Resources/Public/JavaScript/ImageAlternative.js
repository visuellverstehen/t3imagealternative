/**
 * Module: TYPO3/CMS/T3imagealternative/ImageAlternative
 */
define([
    'jquery',
    'TYPO3/CMS/Backend/FormEngineValidation'
], function($, FormEngineValidation) {
    var ImageAlternative = {};

    ImageAlternative.initialize = function() {
        $(document).find(FormEngineValidation.inputSelector).each(function() {
            if($(this).attr('data-formengine-validation-rules').indexOf('ImageAlternative') > -1) {
                ImageAlternative.initializeInput(this);

                $(document).on('change', FormEngineValidation.rulesSelector, function() {
                    ImageAlternative.initializeInput(this);
                });
            }
        });
    };

    ImageAlternative.initializeInput = function($element) {
        var markParent = false;

        // Here we could do an actualy check for the sys_file_metadata table
        // like in the evaluation class
        if ($element.placeholder === '' && $element.value === '') {
            var markParent = true;
        }

        // Inspired by FormEngineValidation
        const isValid = !markParent;
        $element.closest(FormEngineValidation.markerSelector).classList.toggle(FormEngineValidation.errorClass, !isValid);
        FormEngineValidation.markParentTab($($element), isValid);

        $(document).trigger('t3-formengine-postfieldvalidation');
    };

    ImageAlternative.initialize();

    return ImageAlternative;
});
