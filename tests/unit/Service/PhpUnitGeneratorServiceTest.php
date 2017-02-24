<?php
namespace PhpUnitGen\Tests\Service;


use PhpUnitGen\Service\PhpUnitGeneratorService;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Filesystem\Filesystem;

class PhpUnitGeneratorServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PhpUnitGeneratorService
     */
    protected $fixture;

    protected function setUp()
    {
        #$this->fixture = new PhpUnitGeneratorService();
    }

    /**
     * @test
     */
    public function shouleGenerateTestFiles() {

        $this->markTestIncomplete('Generator Service dosn"t work');
        $generator = $this->fixture = new PhpUnitGeneratorService(
            'tests/_data/Fixture/Classes',
            'tests/_data/Fixture/Tests',
            new ConsoleOutput()
        );

        $generator->execute();

        $this->assertFileExists('tests/_data/Fixture/Tests/MySecondPoolTest.php');
        $this->assertFileExists('tests/_data/Fixture/Tests/MyVendor/MyName/MyPoolTest.php');

    }
}