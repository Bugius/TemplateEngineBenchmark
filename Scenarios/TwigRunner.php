<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/../Libs/Twig-1.15.1/lib/Twig/Autoloader.php');

class TwigRunner implements RunnerInterface {

    protected $params;

    public function __construct($params = null) {

        if(is_null($params))
            $this->params = array();
        else
            $this->params = $params;

    }

    public function runTest() {

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(FILE_DIR . "/../Templates");
        $twig = new Twig_Environment($loader, array(
            'cache' => FILE_DIR . "/../Templates/templates_c",
            'auto_reload' => true
        ));

        $rows = 1000;
        if(array_key_exists('rows', $this->params))
            $rows = $this->params['rows'];
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        // load and display template

        $template = $twig->loadTemplate('twigTemplate.html');
        echo $template->render(array(
            'number' => $rows,
            'title' => "Twig scenario",
            'table' => $data
        ));


    }




}