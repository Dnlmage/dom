<?php

require_once 'vendor/autoload.php';

$request = new engldom\Request\Request();
$application = new engldom\Application($request, ['responceType' => 'json']);

$application->run();


