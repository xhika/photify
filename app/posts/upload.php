<?php
declare(strict_types=1);
require PHOTOIFY_PATH.'/views/upload-view.php';
include_once __DIR__.'/../autoload.php';

// Here we upload filepath to db.
uploadImage($pdo);

