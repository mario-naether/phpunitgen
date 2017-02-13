<?php
namespace PhpUnitGen\Console\Command;

use PhpUnitGen\Service\TestCaseGeneratorService;
use PhpUnitGen\Utility\ClassNameUtility;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratorCommand
 * @package PhpunitGen\Console\Command
 */
class GeneratorCommand extends Command
{

    protected function configure()
    {
        $this->setName('gen')
            ->addArgument('src', InputArgument::REQUIRED, 'The PHP src file/folder')
            ->addArgument('tests', InputArgument::REQUIRED, 'The PHP Unit tests file/folder');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        $src = $input->getArgument('src');
        var_dump($src);
        if (is_file($input->getArgument('src'))) {

            //new FileCollectionService();

            $srcFile = $src;
            $className = ClassNameUtility::getClassNameFromFile($srcFile);

            $testCaseGen = new TestCaseGeneratorService();
            $testCaseGen->setOriginalClass(new \ReflectionClass($className));
            echo $testCaseGen->generate();

            //StoreCodeService::saveFile
        }

    }
}