<?php
namespace PhpUnitGen\Console\Command;

use PhpUnitGen\Service\PhpUnitGeneratorService;
use PhpUnitGen\Service\TestCaseGeneratorService;
use PhpUnitGen\Utility\ClassNameUtility;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratorCommand.
 */
class GeneratorCommand extends Command
{
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $src = $input->getArgument('src');
        $testsFolder = $input->getArgument('tests');

        $service = new PhpUnitGeneratorService($src, $testsFolder);
        $service->execute();


    }

    protected function configure()
    {
        $this->setName('gen')
            ->addArgument('src', InputArgument::REQUIRED, 'The PHP src file/folder')
            ->addArgument('tests', InputArgument::REQUIRED, 'The PHP Unit tests file/folder');
    }
}
