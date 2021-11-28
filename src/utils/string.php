<?php

function str_starts_with ($string, $query) {
    return substr($string, 0, strlen($query)) == $query;
}

function str_contains ($string, $query) {
    return strpos($string, $query) !== false;
}

function checkStringIntegrity ($string) {

    if ($string == '') return NULL;
    else return trim($string);
}