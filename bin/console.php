<!--#!/usr/bin/env php-->
<?php

use core\database\generate\ModelGenerator;

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/core/bootstrap.php';

$model_generated = new ModelGenerator();
$model_generated->generate_models();