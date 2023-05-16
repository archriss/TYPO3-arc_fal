<?php

namespace Archriss\ArcFal\Utility;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;

class TagRenderUtility implements SingletonInterface
{
    public static function imageTagBuild(TagBuilder &$tag, FileInterface $image, $width, $height, ?string $fileExtension, array $options = [])
    {
        $cropString = $options['crop'];
        if ($cropString === null && $image->hasProperty('crop') && $image->getProperty('crop')) {
            $cropString = $image->getProperty('crop');
        }
        $cropVariantCollection = CropVariantCollection::create((string)$cropString);
        $cropVariant = $options['cropVariant'] ?: 'default';
        $cropArea = $cropVariantCollection->getCropArea($cropVariant);
        $processingInstructions = [
            'width' => $width,
            'height' => $height,
            'minWidth' => $options['minWidth'],
            'minHeight' => $options['minHeight'],
            'maxWidth' => $options['maxWidth'],
            'maxHeight' => $options['maxHeight'],
            'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($image),
        ];
        if (!empty($fileExtension)) {
            $processingInstructions['fileExtension'] = $fileExtension;
        }
        $imageService = self::getImageService();
        $processedImage = $imageService->applyProcessingInstructions($image, $processingInstructions);
        $imageUri = $imageService->getImageUri($processedImage, $options['absolute']);

        if (!$tag->hasAttribute('data-focus-area')) {
            $focusArea = $cropVariantCollection->getFocusArea($cropVariant);
            if (!$focusArea->isEmpty()) {
                $tag->addAttribute('data-focus-area', $focusArea->makeAbsoluteBasedOnFile($image));
            }
        }
        $tag->addAttribute('src', $imageUri);

        // The alt-attribute is mandatory to have valid html-code, therefore add it even if it is empty
        if (empty($options['alt'])) {
            $tag->addAttribute('alt', $image->hasProperty('alternative') ? $image->getProperty('alternative') : '');
        }
        $title = $image->hasProperty('title') ? $image->getProperty('title') : '';
        if (empty($options['title']) && $title !== '') {
            $tag->addAttribute('title', $title);
        } elseif (empty($options['title'])) {
            $tag->removeAttribute('title');
        }
    }

    /**
     * Return an instance of ImageService
     *
     * @return ImageService
     */
    protected static function getImageService()
    {
        return GeneralUtility::makeInstance(ImageService::class);
    }
}