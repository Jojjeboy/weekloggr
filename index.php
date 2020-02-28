<?php
require 'flight/Flight.php';
Flight::set('base_url', 'http://' . Flight::request()->host);
require 'logic/common.php';

// ROUTES
require 'logic/route.settings.php';
require 'logic/route.todo.php';
require 'logic/route.done.php';

Flight::start();
