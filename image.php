<?php

define('WORKING_DIR', __DIR__ . '/images/');

require __DIR__ . '/vendor/autoload.php';

use App\Image;

//header('Content-type: image/jpeg');
Image::load(WORKING_DIR . $_GET['image'])->resizeImg(200, 200)->render();
