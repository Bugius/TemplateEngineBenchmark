<?php

    define('BASE_DIR', dirname(__FILE__));

    require_once(BASE_DIR . "/Benchmark.php");

    require(BASE_DIR . "/../Scenarios/SmartyRunner.php");
    require(BASE_DIR . "/../Scenarios/TwigRunner.php");
    require(BASE_DIR . "/../Scenarios/PearRunner.php");


//    $scenario = new SmartyRunner();
//    $scenario = new TwigRunner();
    $scenario = new PearRunner();

    $b = new Benchmark;

    $results = array();

    $maxRuns = 20;

    for($i = 0; $i < $maxRuns; $i++) {

        $b->startBenchmark();

        $scenario->runTest();

        $results[] = $b->stopBenchmark();
    }

    $maxMemory = 0;
    $minMemory = 0;
    $avgMemory = 0;

    $maxTime = 0;
    $minTime = 0;
    $avgTime = 0;


    // calculate statistical values

    $resultCount = count($results);

    print_r($results);

    for($i = 0; $i < $resultCount; $i++) {

        $r = $results[$i];



        if($i == 0) {

            $maxMemory = $minMemory = $r['memory_usage'];
            $maxTime = $minTime = $r['time_elapsed'];


        } else {

            if($r['memory_usage'] > $maxMemory)
                $maxMemory = $r['memory_usage'];
            if($r['memory_usage'] < $minMemory)
                $minMemory = $r['memory_usage'];

            if($r['time_elapsed'] > $maxTime)
                $maxTime = $r['time_elapsed'];
            if($r['time_elapsed'] < $minTime);
                $minTime = $r['time_elapsed'];

        }

        $avgTime += $r['time_elapsed'];
        $avgMemory += $r['memory_usage'];

    }

    $avgTime /= $resultCount;
    $avgMemory /= $resultCount;

    // print results
    echo "\n## Results ## \n";
    echo "Memory usage: $minMemory, $avgMemory, $maxMemory\n";
    echo "Time elapsed: ". round($minTime*1000, 3) . ", ". round($avgTime*1000, 3) . ", " . round($maxTime*1000, 3)."\n";



