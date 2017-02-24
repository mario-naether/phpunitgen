<?php
namespace PhpUnitGen\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class FileCollectionService
 * @package PhpUnitGen\Service
 */
class FileCollectionService
{
    protected $files;

    /**
     * FileCollectionService constructor.
     * @param $source
     */
    public function __construct($source)
    {

        $this->files = new \ArrayObject();
        $fs = new Filesystem();

        if ($fs->exists($source)) {
            $finder = new Finder();
            $finder->files()->ignoreDotFiles(true)->ignoreVCS(true)->sortByName();
            if (is_file($source)) {
                $finder->name(basename($source));
                $source = dirname($source);
            } else {
                $finder->name('*.php');
            }

            $finder->in($source);
            foreach ($finder as $file) {
                $this->files->append($file->getPathname());
            }
        }

    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }
}