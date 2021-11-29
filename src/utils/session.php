<?php

session_start();

function isLoggedIn () {
    return isset($_SESSION['user']['id']);
}

function isAdmin () {
    return isLoggedIn() && $_SESSION['user']['admin'] == 1;
}