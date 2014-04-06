<?php

    define('BASE_DIR', dirname(__FILE__));

    require_once(BASE_DIR . "/Benchmark.php");

    require(BASE_DIR . "/../Scenarios/SmartyRunner.php");

    $scenario = new SmartyRunner();

    $b = new Benchmark;

    $results = array();

    $maxRuns = 10;

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

    for($i = 0; $i < $resultCount; $i++) {

        $r = $results[$i];

        print_r($r);

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
    echo "Time elapsed: $minTime, $avgTime, $maxTime\n";



