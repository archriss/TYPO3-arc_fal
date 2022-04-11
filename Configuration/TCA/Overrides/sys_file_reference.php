<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    $fields = [
        'tx_arcfal_loop' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.tx_arcfal_loop',
            'exclude' => 1,
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ],
                ],
            ],
        ],
        'tx_arcfal_muted' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.tx_arcfal_muted',
            'exclude' => 1,
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ],
                ],
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TCA']['sys_file_reference']['columns'], $fields);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'audioOverlayPalette',
        '--linebreak--,' . implode(',', array_keys($fields))
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'videoOverlayPalette',
        '--linebreak--,' . implode(',', array_keys($fields))
    );
});
