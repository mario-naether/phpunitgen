<?php
namespace PhpUnitGen\Tests\Service;

use PhpUnitGen\Service\TestCaseGeneratorService;

class TestCaseGeneratorServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestCaseGeneratorService
     */
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = new TestCaseGeneratorService();
    }

    protected function tearDown()
    {
    }

    /**
     * @test
     */
    public function shouldGeneratedCodeExtendsPhpUnitFramework()
    {

        $this->fixture->setOriginalClass(
            new \ReflectionClass(\MyVendor\MyName\MyPool::class)
        );

        $classCode = $this->fixture->generate();

        $this->assertContains('extends PHPUnit_Framework_TestCase', $classCode);
    }

    /**
     * @test
     */
    public function shouldGeneratedWithClassAndNamespace()
    {

        $this->markTestIncomplete('Reflection not working now');

        $this->fixture->setOriginalClass(
            new \ReflectionClass(\MyVendor\MyName\MyPool::class)
        );

        $classCode = $this->fixture->generate();

        $this->assertContains('class MyPoolTest', $classCode);
        $this->assertContains('namespace MyVendor\Tests\Service;', $classCode);
    }
}
