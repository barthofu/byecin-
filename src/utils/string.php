<?php

function str_starts_with ($string, $query) {
    return substr($string, 0, strlen($query)) == $query;
}