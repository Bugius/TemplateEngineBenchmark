<?php

define('BASE_DIR', dirname(__FILE__));

require_once(BASE_DIR . '/RunnerInterface.php');
require_once(BASE_DIR . '/../Libs/HTML_Template_IT-1.3.0/HTML/Template/IT.php');

class PearRunner implements  RunnerInterface {


    public function runTest() {

        $engine = new HTML_Template_IT(BASE_DIR . "/../Templates");

        $engine->loadTemplatefile('pearTemplate.tpl');


        $rows = 5000;
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        $engine->setVariable('TITLE', "PEAR Test $rows");
        $engine->setVariable('NUMBER', $rows);

        foreach($data as $value) {

            foreach($value as $cell) {
                $engine->setCurrentBlock('cell');
                $engine->setVariable('ENTRY', $cell);
                $engine->parseCurrentBlock();
            }

            $engine->setCurrentBlock('row');
            $engine->parseCurrentBlock();
        }

        $engine->show();







    }



}