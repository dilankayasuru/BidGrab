<?php
// Include the configuration file
require_once "../app/config/config.php";

// Include the core application file
require_once "../app/core/App.php";

// Start a new session or resume the existing session
session_start();

// Create a new instance of the App class
$app = new App();