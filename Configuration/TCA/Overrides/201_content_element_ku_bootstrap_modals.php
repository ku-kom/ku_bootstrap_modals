<?php

/*
 * This file is part of the package UniversityOfCopenhagen\KuBootstrapModals.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');
call_user_func(function () {
    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types']['ku_bootstrap_modals'] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types']['ku_bootstrap_modals'] = [];
    }

    // Add content element PageTSConfig
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'ku_bootstrap_modals',
        'Configuration/TsConfig/Page/ku_bootstrap_modals.tsconfig',
        'LLL:EXT:ku_bootstrap_modals/Resources/Private/Language/locallang_be.xlf:modal_title'
    );

    // Add content element to selector list
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:ku_bootstrap_modals/Resources/Private/Language/locallang_be.xlf:modal_title',
            'ku_bootstrap_modals',
            'ku-bootstrap-modals-icon',
            'ku_bootstrap_modals'
        ]
    );

    // Assign Icon
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['ku_bootstrap_modals'] = 'ku-bootstrap-modals-icon';

    // New palette button
    $GLOBALS['TCA']['tt_content']['palettes']['modals_button_button'] = array(
        'showitem' => 'tx_ku_bootstrap_modals_button_label, tx_ku_bootstrap_modals_type, --linebreak--, tx_ku_bootstrap_modals_modal_title, --linebreak--, ku_bootstrap_modals_source, --linebreak--, bodytext, tx_ku_bootstrap_modals_content_elements','canNotCollapse' => 1
    );

    // New palette header
	$GLOBALS['TCA']['tt_content']['palettes']['modals_button_header'] = array(
		'showitem' => 'header,header_layout,--linebreak--,--linebreak--,subheader,header_position,date','canNotCollapse' => 1
	);

    // Configure element type
    $GLOBALS['TCA']['tt_content']['types']['ku_bootstrap_modals'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types']['ku_bootstrap_modals'],
        [
            'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                --palette--;Header;modals_button_header,
                --palette--;Button;modals_button_button,
            --div--;LLL:EXT:ku_bootstrap_modals/Resources/Private/Language/locallang_be.xlf:settings,
                pi_flexform;LLL:EXT:ku_bootstrap_modals/Resources/Private/Language/locallang_be.xlf:settings,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
        'tx_ku_bootstrap_modals_button_label' => [
            'label' => 'Button label',
            'config' => [
                'type' => 'input',
            ],
        ],
        'tx_ku_bootstrap_modals_source' => [
            'displayCond' =>'FIELD:tx_ku_bootstrap_modals_type:=:iframe',
            'label' => 'Source',
            'config' => [
                'type' => 'input',
            ],
        ],
        'tx_ku_bootstrap_modals_modal_title' => [
            'label' => 'Modal title',
            'config' => [
                'type' => 'input',
            ],
        ],
        'tx_ku_bootstrap_modals_type' => [
            'label' => 'Modal type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Default','default'],
                    /*
                    ['HTML','html'],
                    ['Content Element','content'],
                    ['Target Container','target'],
                    ['URL in iFrame','iframe'],
                    */
                ],
            ],
        ],
        'tx_ku_bootstrap_modals_content_elements' => [
             'displayCond' =>'FIELD:tx_ku_bootstrap_modals_type:=:content',
             'exclude' => 1,
             'label' => 'Content Elements',
             'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tt_content',
                'maxitems' => 10,
                'minitems' => 1,
                'size' => 5,
                'default' => 0,
                'suggestOptions' => [
                   'default' => [
                      'additionalSearchFields' => 'header, subheader'
                   ],
                ],
         ],
      ],
    ]);
});
