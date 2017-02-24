<?php
namespace PhpUnitGen\Tests\Service;

use PhpUnitGen\Service\FileCollectionService;

/**
 * Class FileCollectionServiceTest
 */
class FileCollectionServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FileCollectionService
     */
    protected $fixture;

    public function setUp()
    {
       # $this->fixture = new FileCollectionService();
    }

    /**
     * @test
     */
    public function shouldGetAListOfFiles() {
        $this->fixture = new FileCollectionService('tests/_data/Fixture/Classes');
        $files = $this->fixture->getFiles();

        $this->assertCount(2, $files);
        $this->assertFileExists($files[0]);
        $this->assertContains('MySecondPool.php', $files[0]);

        $this->assertFileExists($files[1]);
        $this->assertContains('MyPool.php', $files[1]);
        $this->assertContains('MyVendor', $files[1]);
        $this->assertContains('MyName', $files[1]);
    }

    /**
     * @test
     */
    public function shouldGetAListWithOneFile() {
        $this->fixture = new FileCollectionService('tests/_data/Fixture/Classes/MySecondPool.php');
        $files = $this->fixture->getFiles();

        $this->assertCount(1, $files);
        $this->assertFileExists($files[0]);
        $this->assertContains('MySecondPool.php', $files[0]);
    }

    /**
     * @test
     */
    public function shouldGetAEmptyListByDumpSql() {
        $this->markTestIncomplete('not working for not php files');
        $this->fixture = new FileCollectionService('tests/_data/dump.sql');
        $files = $this->fixture->getFiles();

        $this->assertCount(0, $files);
    }

    /**
     * @test
     */
    public function shouldGetAEmptyListByNotPhpFolder() {
        $this->fixture = new FileCollectionService('tests/_output');
        $files = $this->fixture->getFiles();

        $this->assertCount(0, $files);
    }
}