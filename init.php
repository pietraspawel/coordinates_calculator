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
$application->addCss("assets/bootstrap-icons-1.10.2/bootstrap-icons.css");
$application->addJsScript("js/main.js");
$application->addJsScript("js/Coordinates.js");