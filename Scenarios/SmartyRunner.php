<?php

define('BASE_DIR', dirname(__FILE__));

require_once(BASE_DIR . '/RunnerInterface.php');
require_once(BASE_DIR . '/../Libs/Smarty-3.1.17/libs/Smarty.class.php');


class SmartyRunner implements RunnerInterface {

    public function runTest() {

        $smarty = new Smarty;
        $smarty->caching = false;

        $smarty->setTemplateDir(BASE_DIR . '/../Templates');
        $smarty->setCompileDir(BASE_DIR . '/../Templates/templates_c');
        $smarty->setCacheDir(BASE_DIR . '/../Templates/cache');
        $smarty->setConfigDir(BASE_DIR . '/../Templates/config');

        $rows = 5000;
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        $smarty->assign('table', $data);
        $smarty->assign('number', $rows);
        $smarty->assign('title', "Smarty Test $rows");


        $smarty->display('smartyTemplate.tpl');





    }

}
