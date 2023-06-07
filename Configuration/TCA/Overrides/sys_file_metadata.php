<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_metadata', [
        'tx_arcfal_transcript' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_metadata.tx_arcfal_transcript',
            'description' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_metadata.tx_arcfal_transcript.description',
            'exclude' => 1,
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'blindLinkOptions' => 'page,folder,url,mail,telephone',
                            'blindLinkFields' => 'target, title, class, params',
                            'allowedExtensions' => 'txt',
                        ],
                    ],
                ],
            ],
        ],
        'tx_arcfal_transcript_rte' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_metadata.tx_arcfal_transcript_rte',
            'exclude' => 1,
            'config' => [
                'type' => 'text',
                'cols' => 80,
                'rows' => 15,
            ],
        ],
    ]);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'sys_file_metadata',
        'tx_arcfal_transcript, tx_arcfal_transcript_rte',
        '3,4',
        'after:duration'
    );
    foreach ([3,4] as $type) {
        \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
            $GLOBALS['TCA']['sys_file_metadata']['types'][$type],
            [
                'columnsOverrides' => [
                    'tx_arcfal_transcript_rte' => [
                        'config' => [
                            'enableRichtext' => 1,
                            'richtextConfiguration' => 'default',
                        ],
                    ],
                ],
            ]
        );
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_metadata', [
        'tx_arcfal_flipbook_url' => [
            'label' => 'LLL:EXT:arc_fal/Resources/Private/Language/locallang_tca.xlf:sys_file_metadata.tx_arcfal_flipbook_url',
            'exclude' => 1,
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'blindLinkOptions' => 'page,file,folder,mail,telephone',
                            'blindLinkFields' => 'target, title, class, params',
                        ],
                    ],
                ],
            ],
        ],
    ]);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'sys_file_metadata',
        'tx_arcfal_flipbook_url',
        '5',
        'after:description'
    );
});
