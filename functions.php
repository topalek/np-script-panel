<?php

function getTaskFiles($dir){
    $taskFiles = scandir($dir);
    array_shift($taskFiles);
    array_shift($taskFiles);
    return $taskFiles;
}
function getTasks($dir){
    $taskFiles = getTaskFiles($dir);
    $task = [];
    if (!empty($taskFiles)){
        foreach ($taskFiles as $taskFile) {
            $taskKey = array_shift(explode('.', $taskFile));
            try {
                $task[$taskKey] = json_decode(file_get_contents($dir.$taskFile),true);
            }catch (Exception $e){
                $task[$taskKey] = [];
            }
        }
    }
    return $task;
}
function saveTask($dir,$task){
    $fileName = substr(md5(microtime()),0,6).'.task';
    if (!file_exists($dir) && !is_dir($dir)){
        mkdir($dir);
    }
    file_put_contents($dir.$fileName, json_encode($task));
    return $fileName;
}