<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    $columns = [
        'media' => [
            'config' => [
                'overrideChildTca' => [
                    'types' => [
                        0 => ['showitem' => '--palette--;;imageoverlayPalette, --palette--;;filePalette'],
                        1 => ['showitem' => '--palette--;;imageoverlayPalette, --palette--;;filePalette'],
                        2 => ['showitem' => '--palette--;;imageoverlayPalette, --palette--;;filePalette'],
                        3 => ['showitem' => '--palette--;;audioOverlayPalette, --palette--;;filePalette'],
                        4 => ['showitem' => '--palette--;;videoOverlayPalette, --palette--;;filePalette'],
                        5 => ['showitem' => '--palette--;;imageoverlayPalette, --palette--;;filePalette'],
                    ],
                ],
            ],
        ],
    ];

    // Merge informations
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content']['columns'],
        $columns
    );
});