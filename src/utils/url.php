<?php

function getURL ($path) {

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
    $host = $_SERVER['SERVER_NAME'];
    $uri = getURI($path);

    return $protocol . '://' . $host . $uri;
}

function getURI ($path) {

    $uri = $path;
    if (str_starts_with($_SERVER['REQUEST_URI'], '/' . APP_NAME)) $uri = '/'.APP_NAME . $uri;

    return $uri;
}

function sanitizeWampURL ($url) {

    if (str_starts_with($url, '/' . APP_NAME)) $url = str_replace('/' . APP_NAME, '', $url);
    return $url;
}

function separateParamsAndBaseURL ($url) {

    $separatedParamsAndBaseURL = explode('?', $url);
    return [
        array_slice(
            explode('/', filter_var(rtrim($separatedParamsAndBaseURL[0], '/'), FILTER_SANITIZE_URL)),
            1
        ),
        isset($separatedParamsAndBaseURL[1]) ? explode('&', $separatedParamsAndBaseURL[1]) : []
    ];
}

function formatParams ($params) {

    $formatedParams = [];
    foreach ($params as $param) {
        $temp = explode('=', $param);
        if (isset($temp[1])) $formatedParams = array_merge($formatedParams, [ $temp[0] => $temp[1] ]);
    }

    return $formatedParams;
}

function getViewCSSPathPrefix ($view) {

    $validator = str_contains(
        $_SERVER['REQUEST_URI'],
        explode('/', $view)[0] . '/'
    );
    return $validator ? '../' : '' ;
}