<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    $fields = [
        'tx_arcfal_transcript' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_metadata.tx_arcfal_transcript',
            'exclude' => 1,
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 15,
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TCA']['sys_file_metadata']['columns'], $fields);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'sys_file_metadata',
        implode(',', array_keys($fields)),
        '3,4',
        'after:duration'
    );
    foreach (array_keys($GLOBALS['TCA']['sys_file_metadata']['types']) as $type) {
        \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
            $GLOBALS['TCA']['sys_file_metadata']['types'][$type],
            [
                'columnsOverrides' => [
                    'tx_arcfal_transcript' => [
                        'config' => [
                            'enableRichtext' => 1,
                            'richtextConfiguration' => 'default',
                        ],
                    ],
                ],
            ]
        );
    }
});
