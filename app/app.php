<?php

use Models\ActiveRecord;

require 'helpers.php';
require_once __DIR__ . './../database/connect.php';
require_once __DIR__ . './../vendor/autoload.php';

// Conectarnos a la base de datos

ActiveRecord::setDB($db);