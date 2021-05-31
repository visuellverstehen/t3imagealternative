<?php

defined('TYPO3_MODE') or die();


$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\VV\T3imagealternative\Evaluation\ImageAlternative::class]
    = '';

(\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class))
    ->loadRequireJsModule('TYPO3/CMS/T3imagealternative/ImageAlternative');
