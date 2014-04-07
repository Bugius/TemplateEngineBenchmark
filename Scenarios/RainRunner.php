<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/../Libs/raintpl3-3.1.0/library/Rain/autoload.php');

use Rain\Tpl;

class RainRunner implements RunnerInterface {

    protected $params;

    public function __construct($params = null) {

        if(is_null($params))
            $this->params = array();
        else
            $this->params = $params;

    }
    public function runTest()
    {


        $config = array(
            "tpl_dir"       => FILE_DIR . "/../Templates/",
            "cache_dir"     => FILE_DIR . "/../Templates/cache/",
            "debug"         => false
        );

        Tpl::configure($config);
        Tpl::registerPlugin( new Tpl\Plugin\PathReplace(), "path_replace");

        $tpl = new Tpl;

        $rows = 1000;
        if(array_key_exists('rows', $this->params))
            $rows = $this->params['rows'];
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        $tpl->assign('title', "RainTpl Test");
        $tpl->assign('number', $rows);
        $tpl->assign('table', $data);

        $tpl->draw("RainTemplate");

        Tpl::removePlugin("path_replace");

    }
}