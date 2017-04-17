<?php

require "../vendor/autoload.php";
require "../core/bootstrap.php";

use core\AppKernel;

$app_kernel = new AppKernel();
$app_kernel->handle();
$app_kernel->send();