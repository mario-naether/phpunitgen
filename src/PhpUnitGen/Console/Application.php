<?php
namespace PhpUnitGen\Console;

use PhpUnitGen\Console\Command\GeneratorCommand;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const NAME    = 'PhpUnit Test Generator Application';
    const VERSION = '0.0.1';

    public function __construct()
    {
        parent::__construct(static::NAME, static::VERSION);
        $this->add(new GeneratorCommand());
    }
}
