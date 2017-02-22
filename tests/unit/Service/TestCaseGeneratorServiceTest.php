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
    public function shouldGeneratedSimpleClassCodeExtendsPhpUnitFramework()
    {

        $this->fixture->setOriginalClass(
            new \ReflectionClass(\MySecondPool::class)
        );

        $classCode = $this->fixture->generate();

        $this->assertContains('extends PHPUnit_Framework_TestCase', $classCode);
    }

    /**
     * @test
     */
    public function shouldGenerateSetUpWithOrigClass() {

        $this->fixture->setOriginalClass(
            new \ReflectionClass(\MyVendor\MyName\MyPool::class)
        );

        $classCode = $this->fixture->generate();

        $expectedCode = 'new \MyVendor\MyName\MyPool';
        $this->assertContains($expectedCode, $classCode);

        $expectedCode = '@var \MyVendor\MyName\MyPool';
        $this->assertContains($expectedCode, $classCode);

    }

    /**
     * @test
     */
    public function shouldGeneratedCodeWithClassAndNamespace()
    {
        $this->fixture->setOriginalClass(
            new \ReflectionClass(\MyVendor\MyName\MyPool::class)
        );

        $classCode = $this->fixture->generate();

        $this->assertContains('class MyPoolTest', $classCode);
        $this->assertContains('namespace MyVendor\Tests\MyName;', $classCode);
    }

    /**
     * @test
     */
    public function shouldGeneratedCodeWithClassAndWithoutNamespace()
    {
        $this->fixture->setOriginalClass(
            new \ReflectionClass(\MySecondPool::class)
        );

        $classCode = $this->fixture->generate();

        $this->assertContains('class MySecondPoolTest', $classCode);
        $this->assertNotContains('namespace', $classCode);
        $this->assertNotContains('namespace MyVendor\Tests\MyName;', $classCode);
    }
}
