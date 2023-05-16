<?php

namespace Archriss\ArcFal\ViewHelpers;

use Archriss\ArcFal\Utility\TagRenderUtility;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Fluid\ViewHelpers\MediaViewHelper as CoreMediaViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;

class MediaViewHelper extends CoreMediaViewHelper
{

    /**
     * @var \TYPO3\CMS\Extbase\Service\ImageService
     */
    protected $imageService;

    /**
     * @param \TYPO3\CMS\Extbase\Service\ImageService $imageService
     */
    public function injectImageService(\TYPO3\CMS\Extbase\Service\ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerTagAttribute('ismap', 'string', 'Specifies an image as a server-side image-map. Rarely used. Look at usemap instead', false);
        $this->registerTagAttribute('longdesc', 'string', 'Specifies the URL to a document that contains a long description of an image', false);
        $this->registerTagAttribute('usemap', 'string', 'Specifies an image as a client-side image-map', false);
        
        $this->registerArgument('crop', 'string|bool', 'overrule cropping of image (setting to FALSE disables the cropping set in FileReference)');

        $this->registerArgument('minWidth', 'int', 'minimum width of the image');
        $this->registerArgument('minHeight', 'int', 'minimum height of the image');
        $this->registerArgument('maxWidth', 'int', 'maximum width of the image');
        $this->registerArgument('maxHeight', 'int', 'maximum height of the image');
        $this->registerArgument('absolute', 'bool', 'Force absolute URL', false, false);
    }

    /**
     * Render img tag
     *
     * @param FileInterface $image
     * @param string $width
     * @param string $height
     * @param string|null $fileExtension
     * @return string Rendered img tag
     */
    protected function renderImage(FileInterface $image, $width, $height, ?string $fileExtension)
    {
        try {
            TagRenderUtility::imageTagBuild($this->tag, $image, $width, $height, $fileExtension, $this->arguments);
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
        return $this->tag->render();
    }
}