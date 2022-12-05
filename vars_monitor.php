<?php

/**
 * Display variables values.
 */

namespace pietras;

$database = $application->getDatabase()->setDebug(true);

?>

<div>
    <?= var_dump($application->getUser()) ?>
    <?= var_dump($database) ?>
</div>
