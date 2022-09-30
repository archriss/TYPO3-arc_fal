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
        'tx_arcfal_force_image_render' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.tx_arcfal_force_image_render',
            'description' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.tx_arcfal_force_image_render.description',
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
        '--linebreak--,tx_arcfal_loop,tx_arcfal_muted'
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'videoOverlayPalette',
        '--linebreak--,tx_arcfal_loop,tx_arcfal_muted,--linebreak--,tx_arcfal_force_image_render'
    );
});
