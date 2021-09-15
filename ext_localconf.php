<?php

defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\VV\T3imagealternative\Evaluation\ImageAlternative::class]
    = '';

// Maybe use the $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['RequireJS']['postInitializationModules']
// See PageRenderer->computeRequireJsConfig
(\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class))
    ->addInlineSettingArray(
        'RequireJS.PostInitializationModules',
        [
            'TYPO3/CMS/Backend/FormEngine' => [
                'TYPO3/CMS/T3imagealternative/ImageAlternative'
            ]
        ]
    );

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
    TCEFORM.sys_file_reference.alternative.disabled = 0
');
