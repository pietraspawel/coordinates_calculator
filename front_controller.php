<?php

/**
 * Front controller file.
 */

namespace pietras;

$application->setController("Home");
$controllerName = basic\Controller::findControllerByUrl($application, $application->getUrlParam(1));
if ($controllerName !== null) {
    $application->setController($controllerName);
}

$application->getController()->handle();
