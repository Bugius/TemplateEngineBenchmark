<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/../Libs/HTML_Template_IT-1.3.0/HTML/Template/IT.php');

class PearRunner implements  RunnerInterface {


    protected $params;

    public function __construct($params = null) {

        if(is_null($params))
            $this->params = array();
        else
            $this->params = $params;

    }

    public function runTest() {

        $engine = new HTML_Template_IT(FILE_DIR . "/../Templates");

        $engine->loadTemplatefile('pearTemplate.tpl');


        $rows = 1000;
        if(array_key_exists('rows', $this->params))
            $rows = $this->params['rows'];
        $data = array();

        for($i=0; $i < $rows; $i ++) {

            $data[] = array('id' => $i, 'name' => "name ($i)");
        }

        $engine->setVariable('TITLE', "PEAR Test");
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