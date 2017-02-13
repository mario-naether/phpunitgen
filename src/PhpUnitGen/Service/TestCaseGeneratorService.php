<?php
namespace PhpUnitGen\Service;

use PhpUnitGen\Configuration;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TestCaseGeneratorService {

    /**
     * @var \ReflectionClass
     */
    protected $originalClass;

    /**
     * @var string
     */
    protected $testClassContent;



    public function __construct()
    {
    }

    public function generate() {
        $loader = new Twig_Loader_Filesystem(Configuration::TEMPLATE_FOLDER);
        $twig = new Twig_Environment($loader, array(
            # 'cache' => '/path/to/compilation_cache',
        ));



        $string = $twig->render(Configuration::TEMPLATE_CLASS, [
            'originalClass' => $this->getOriginalClassParameter(),
            'class' => $this->getTestClassParameter(),

        ]);

        return $string;
    }

    protected function getOriginalClassParameter() {
        return [
            'name' => 'MyPool',
            'namespace' => 'MyVendor\Service',
        ];
    }

    protected function getTestClassParameter() {
        $methods = [];
        return [
            'name' => 'MyPoolTest',
            'namespace' => 'MyVendor\Tests\Service',
            'methods' => $methods
        ];
    }

    /**
     * @return mixed
     */
    public function getOriginalClass()
    {
        return $this->originalClass;
    }

    /**
     * @param \ReflectionClass $originalClass
     */
    public function setOriginalClass(\ReflectionClass $originalClass)
    {
        $this->originalClass = $originalClass;
    }


}