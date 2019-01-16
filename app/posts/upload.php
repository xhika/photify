<?php
declare(strict_types=1);
require __DIR__.'/../../views/upload-view.php';
include_once __DIR__.'/../autoload.php';

// Here we upload filepath to db.
uploadImage($pdo);

