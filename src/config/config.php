<?php

const APP_NAME = 'byecine';

// auth
const NAME_VALIDATION = "/^[a-zA-Z0-9]*$/";

const PASSWORD_VALIDATION = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
const PASSWORD_MIN_LENGTH = 3;
const PASSWORD_MAX_LENGTH = 32;

const DEFAULT_USER_AVATAR = "_defaultAvatar.png";

// directories
const UPLOAD_DIR = 'public/assets/';
const FILMS_UPLOAD_DIR = UPLOAD_DIR . 'films/';
const AVATARS_UPLOAD_DIR = UPLOAD_DIR . 'avatars/';