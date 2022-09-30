<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Register global fluid namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['arcFal'][] = 'Archriss\\ArcFal\\ViewHelpers';

// Add Custom Image Renderer
\TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance()
    ->registerRendererClass(\Archriss\ArcFal\Resource\Rendering\ImageRenderer::class);
