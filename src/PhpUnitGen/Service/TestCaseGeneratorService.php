<?php
namespace PhpUnitGen\Service;

use PhpUnitGen\Configuration;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TestCaseGeneratorService
{
    const TEST_CLASS_NAME      = '%sTest';
    const TEST_CLASS_NAMESPACE = '%s\Tests%s';

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

    public function generate()
    {
        $loader = new Twig_Loader_Filesystem(Configuration::TEMPLATE_FOLDER);
        $twig   = new Twig_Environment($loader, [
            // 'cache' => '/path/to/compilation_cache',
        ]);

        $string = $twig->render(Configuration::TEMPLATE_CLASS, [
            'originalClass' => $this->getOriginalClassParameter(),
            'class'         => $this->getTestClassParameter(),
        ]);

        return $string;
    }

    /**
     * @return \ReflectionClass
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

    /**
     * Get parameter name and namespace from original class.
     *
     * @return array
     */
    protected function getOriginalClassParameter()
    {
        return [
            'name'      => $this->getOriginalClass()->getName(),
            'namespace' => $this->getOriginalClass()->getNamespaceName(),
        ];
    }

    /**
     * Get parameter name and namespaces for Testcase class.
     *
     * @return array
     */
    protected function getTestClassParameter()
    {
        $testClassName      = sprintf(self::TEST_CLASS_NAME, $this->getOriginalClass()->getShortName());
        $testClassNamespace = null;

        if ($this->getOriginalClass()->inNamespace()) {
            $ns                 = $this->getOriginalClass()->getNamespaceName();
            $strPos             = strpos($ns, '\\');
            $part1              = substr($ns, 0, $strPos);
            $part2              = substr($ns, $strPos);
            $testClassNamespace = sprintf(self::TEST_CLASS_NAMESPACE, $part1, $part2);
        }

        $methods = [];

        return [
            'name'      => $testClassName,
            'namespace' => $testClassNamespace,
            'methods'   => $methods,
        ];
    }
}
