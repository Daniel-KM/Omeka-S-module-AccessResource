<?php
namespace AccessResource\Mvc\Controller\Plugin;

use Omeka\Api\Representation\MediaRepresentation;
use Omeka\Mvc\Exception\RuntimeException;
use Omeka\Stdlib\Message;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class MediaFilesize extends AbstractPlugin
{
    /**
     * @var string
     */
    protected $basePath;

    /**
     * @param string $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the file size of a media.
     *
     * @param MediaRepresentation $media
     * @param string $type
     * @throws RuntimeException
     * @return int|null
     */
    public function __invoke(MediaRepresentation $media, $type = 'original')
    {
        if ($type === 'original' && $mediaSize = $media->size()) {
            return $mediaSize;
        }

        // The storage adapter should be checked for external storage.
        $storagePath = $type == 'original'
            ? $this->getStoragePath($type, $media->filename())
            : $this->getStoragePath($type, $media->storageId(), 'jpg');
        $filepath = $this->basePath . DIRECTORY_SEPARATOR . $storagePath;

        return file_exists($filepath)
            ? filesize($filepath)
            : null;
    }

    /**
     * Get a storage path.
     *
     * @param string $prefix The storage prefix
     * @param string $name The file name, or basename if extension is passed
     * @param null|string $extension The file extension
     * @return string
     */
    protected function getStoragePath($prefix, $name, $extension = '')
    {
        return sprintf('%s/%s%s', $prefix, $name, strlen($extension) ? '.' . $extension : '');
    }
}