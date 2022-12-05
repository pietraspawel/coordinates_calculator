<?php

/**
 * Initialize variables.
 */

namespace pietras;

use pietras\basic\Application;
use Symfony\Component\Yaml\Yaml;

$application = new Application();
$database = $application->getDatabase();
$application->addCss("css/bootstrap.min.css");
$application->addCss("css/style.css");