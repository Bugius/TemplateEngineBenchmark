<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/../Libs/Smarty-3.1.17/libs/Smarty.class.php');


class SmartyRunner implements RunnerInterface {

    protected $params;

    public function __construct($params = null) {

        if(is_null($params))
            $this->params = array();
        else
            $this->params = $params;

    }

    public function runTest() {

        $smarty = new Smarty;
        $smarty->caching = false;

        $smarty->setTemplateDir(FILE_DIR . '/../Templates');
        $smarty->setCompileDir(FILE_DIR . '/../Templates/templates_c');
        $smarty->setCacheDir(FILE_DIR . '/../Templates/cache');
        $smarty->setConfigDir(FILE_DIR . '/../Templates/config');

        $rows = 1000;
        if(array_key_exists('rows', $this->params))
            $rows = $this->params['rows'];
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        $smarty->assign('table', $data);
        $smarty->assign('number', $rows);
        $smarty->assign('title', "Smarty Test");


        $smarty->display('smartyTemplate.tpl');





    }

}
