<?php

const APP_NAME = 'byecine';

// auth
const NAME_VALIDATION = "/^[a-zA-Z0-9]*$/";

const PASSWORD_VALIDATION = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
const PASSWORD_MIN_LENGTH = 3;
const PASSWORD_MAX_LENGTH = 32;

const UPLOAD_DIR = 'public/assets/films/';