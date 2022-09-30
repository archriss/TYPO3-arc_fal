<?php

namespace Archriss\ArcFal\Resource\Rendering;

use Archriss\ArcFal\Utility\TagRenderUtility;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\Rendering\FileRendererInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;

class ImageRenderer implements FileRendererInterface
{

    /**
     * @var string
     */
    protected $tagName = 'img';

    /**
     * static tag attributes
     */
    protected static $tagAttributes = [
        'class',
        'dir',
        'id',
        'lang',
        'style',
        'title',
        'accesskey',
        'tabindex',
        'onclick',
        'alt',
        'ismap',
        'longdesc',
        'usemap',
    ];

    /**
     * Returns the priority of the renderer
     * This way it is possible to define/overrule a renderer
     * for a specific file type/context.
     * For example create a video renderer for a certain storage/driver type.
     * Should be between 1 and 100, 100 is more important than 1
     */
    public function getPriority(): int
    {
        return 100;
    }

    /**
     * Check if given File(Reference) can be rendered
     */
    public function canRender(FileInterface $file)
    {
        return $file->hasProperty('tx_arcfal_force_image_render') && (bool)$file->getProperty('tx_arcfal_force_image_render') === true;
    }

    /**
     * Render for given File(Reference) html output
     *
     * @param FileInterface $file
     * @param int|string $width TYPO3 known format; examples: 220, 200m or 200c
     * @param int|string $height TYPO3 known format; examples: 220, 200m or 200c
     * @param array $options
     * @param bool $usedPathsRelativeToCurrentScript See $file->getPublicUrl()
     * @return string
     */
    public function render(FileInterface $image, $width, $height, array $options = [], $usedPathsRelativeToCurrentScript = false)
    {
        $tag = $this->initializeTag($options);
        try {
            TagRenderUtility::imageTagBuild($tag, $image, $width, $height, $options);
        } catch (\UnexpectedValueException $e) {
            // thrown if a file has been replaced with a folder
            throw new Exception($e->getMessage(), 1509741912, $e);
        } catch (\RuntimeException $e) {
            // RuntimeException thrown if a file is outside of a storage
            throw new Exception($e->getMessage(), 1509741913, $e);
        } catch (\InvalidArgumentException $e) {
            // thrown if file storage does not exist
            throw new Exception($e->getMessage(), 1509741914, $e);
        }
        return $tag->render();
    }

    /**
     * Initialize the tag with all regular attributes from image VH
     */
    protected function initializeTag(array $arguments = []): TagBuilder
    {
        $tag = GeneralUtility::makeInstance(TagBuilder::class, $this->tagName);;
        $tag->reset();
        $tag->setTagName($this->tagName);

        if (array_key_exists('data', $arguments) && is_array($arguments['data'])) {
            foreach ($arguments['data'] as $dataAttributeKey => $dataAttributeValue) {
                $tag->addAttribute('data-' . $dataAttributeKey, $dataAttributeValue);
            }
        }

        if (array_key_exists('aria', $arguments) && is_array($arguments['aria'])) {
            foreach ($arguments['aria'] as $ariaAttributeKey => $ariaAttributeValue) {
                $tag->addAttribute('aria-' . $ariaAttributeKey, $ariaAttributeValue);
            }
        }

        if (self::$tagAttributes) {
            foreach (self::$tagAttributes as $attributeName) {
                if (array_key_exists($attributeName, $arguments) && !is_null($arguments[$attributeName]) && $arguments[$attributeName] !== '') {
                    $tag->addAttribute($attributeName, $arguments[$attributeName]);
                }
            }
        }
        
        return $tag;
    }
}