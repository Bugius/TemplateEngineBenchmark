<?php

define('BASE_DIR', dirname(__FILE__));

require_once(BASE_DIR . '/RunnerInterface.php');
require_once(BASE_DIR . '/../Libs/Twig-1.15.1/lib/Twig/Autoloader.php');

class TwigRunner implements RunnerInterface {

    public function runTest() {

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(BASE_DIR . "/../Templates");
        $twig = new Twig_Environment($loader, array(
            'cache' => BASE_DIR . "/../Templates/templates_c",
            'auto_reload' => true
        ));

        // prepare data
        $rows = 5000;
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        // load and display template

        $template = $twig->loadTemplate('twigTemplate.html');
        $template->render(array(
            'number' => $rows,
            'title' => "Twig scenario $rows",
            'table' => $data
        ));


    }




}