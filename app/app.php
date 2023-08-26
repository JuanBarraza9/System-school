<?php

namespace App;
use Model\ActiveRecord;

require 'helpers.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos

ActiveRecord::setDB($db);