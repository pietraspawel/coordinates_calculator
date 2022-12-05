<?php

namespace pietras\Controller;

use pietras\basic\Controller;

class Home extends Controller
{
    public function handle()
    {
        echo $this->application->render("home.html.twig");
    }
}
