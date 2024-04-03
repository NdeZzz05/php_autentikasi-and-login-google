<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

$access_token = $_SESSION['access_token'];

// inisiasi google client
$client = new Google_client();

$client->revokeToken($access_token);

session_destroy();
header("Location: login.php");
