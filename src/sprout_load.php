<?php
use Sprout\Helpers\Register;


Register::frontEndController('SproutModules\\Demo\\Controllers\\DemoController', 'Demo');

Register::cronJob('demo', 'SproutModules\\Demo\Controllers\\DemoController', 'cronDemo');