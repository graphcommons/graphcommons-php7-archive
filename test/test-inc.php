<?php
header('content-type: text/plain; charset=utf-8');

// dump functions
function pre($input, $exit = false){
    if ($input === null) {
        printf("NULL\n");
    } else {
        $input = print_r($input, true);
        $input = preg_replace('~\[(\w+):GraphCommons(\\\\?.*?):private\]~sm', '[\\1:private]', $input);
        printf("%s\n", $input);
    }
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
function prj($input, $exit = false) {
    if (is_string($input)) {
        $input = json_decode($input);
    }
    $input = json_encode($input, JSON_PRETTY_PRINT);
    pre($input, $exit);
}
