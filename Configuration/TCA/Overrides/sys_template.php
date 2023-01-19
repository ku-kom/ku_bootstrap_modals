<?php

defined('TYPO3') or die('Access denied.');

call_user_func(function () {
    /**
     * Temporary variables
     */
    $extensionKey = 'ku_bootstrap_modals';

    /**
     * Default TypoScript for ku_bootstrap_modals
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript',
        'LLL:EXT:ku_bootstrap_modals/Resources/Private/Language/locallang_be.xlf:modal_title'
    );
});
