<?php
namespace PhpUnitGen\Service;


use PhpUnitGen\Utility\ClassNameUtility;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PhpUnitGeneratorService
 */
class PhpUnitGeneratorService
{

    protected $source = [];
    protected $testsFolder;
    protected $output;

    public function __construct($src, $testsFolder, OutputInterface $output)
    {
        $this->source = $src;
        $this->testsFolder = $testsFolder;
        $this->output = $output;
    }

    public function execute() {
        var_dump($this->source);
        if (is_file($this->source)) {
            //new FileCollectionService();

            $srcFile   = $this->source;
            $className = ClassNameUtility::getClassNameFromFile($srcFile);

            $testCaseGen = new TestCaseGeneratorService();
            $testCaseGen->setOriginalClass(new \ReflectionClass($className));
            echo $testCaseGen->generate();

            //StoreCodeService::saveFile
        }
    }
}
