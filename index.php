<?php

/**
 * Index file.
 */

namespace pietras;

require_once __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/init.php";
include __DIR__ . "/front_controller.php";
if ($application->getMode() == "dev") {
    include "vars_monitor.php";
}
