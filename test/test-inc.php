<?php
header('content-type: text/plain; charset=utf-8');

// dump functions
function pre($input, $exit = false){
    printf("%s\n", print_r($input, true));
    if ($exit) {
        exit;
    }
}
function prd($input, $exit = false){
    var_dump($input);
    if ($exit) {
        exit;
    }
}
