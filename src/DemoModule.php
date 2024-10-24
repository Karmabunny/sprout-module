<?php

namespace SproutModules\Demo;

use Sprout\Helpers\Module;
use Sprout\Helpers\Sprout;

/**
 * Demo module.
 */
class DemoModule extends Module
{

    /** @inheritdoc */
    public function getVersion(): string
    {
        return Sprout::getInstalledVersion('karmabunny/sprout-module');
    }
}