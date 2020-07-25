<?php

//database Constants
defined('DB_SERVER')	? null:define("DB_SERVER", "localhost");
defined('DB_USER')	? null:define("DB_USER", "root");
defined('DB_PASS')	? null:define("DB_PASS", "");
defined('DB_NAME')	? null:define("DB_NAME", "application");
defined('SITE_NAME')	? null:define("SITE_NAME", "phpminiapp");
defined('FOOTER_CONTENT')	? null:define("FOOTER_CONTENT", "Legion for Discoveries");

// database connection settings
$a_db = array(
  "db_server" => "localhost",
  "db_name" => "application",
  "db_user" => "root",
  "db_passwd" => "",
);

$connection= mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

