<?php
require_once("initialize.php");
require_once("config.php");

class MySQLDatabase{
  
private $connection;
public $last_query;
private $magic_quotes_active;
private $real_escape_string_exists;

function __construct() {
	$this->open_connection();
	$this->magic_quotes_active = get_magic_quotes_gpc();
	$this->real_escape_string_exists=function_exists("mysql_real_escape_string"); 
}

public function open_connection(){
$this->connection= mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (!$this->connection){
$ioutput="<div style='margin: auto; margin-top: 60px; width: 900px; border: 1px solid #ddf; background: #eef; min-height: 550px;'>";
$ioutput .="<div style='font-size: 14px; background: #2A5779; color: #ffffff; font-size:20px; width: 900px; height: 20px; padding: 6px;'> Connection fail</div>";
//$ioutput .="".mysql_error()."<br/><br/>";
$ioutput .="<p style='font-size: 12px; padding:10px;'>Please try again later.</p></div>";
die($ioutput);
}
else{
$db_select= mysqli_select_db($this->connection, DB_NAME);
if(!$db_select){
$ioutput="<div style='margin: auto; margin-top: 60px; width: 900px; border: 1px solid #ddf; background: #eef; min-height: 550px;'>";
$ioutput .="<div style='font-size: 14px; background: #2A5779; color: #ffffff; font-size:20px; width: 900px; height: 20px; padding: 6px;'> Connection fail</div>";
//$ioutput .="".mysql_error()."<br/><br/>";
$ioutput .="<p style='font-size: 12px; padding:10px;'>Please try again later.</p></div>";
die($ioutput);
}
}
}

public function close_connection(){
if (!isset($this->connection)){
mysqli_close($this->connection);
unset($this->connection);
}
}

public function query($sql){
$this->last_query=$sql;
$result = mysqli_query($this->connection,$sql);
//$result .=mysql_error();
$this->confirm_query($result);
return $result;
}

public function escape_value($value){
if ($this->real_escape_string_exists){

if ($this->magic_quotes_active){
$value=stripslashes($value);
}
$value=mysqli_real_escape_string($this->connection,$value);
}
else{
if (!$this->magic_quotes_active){
$value=addslashes($value);
}
}
return $value;
}

public function insert_id(){
//get the last id inserted over the current db connection
return mysqli_insert_id($this->connection);
}

public function affected_rows(){
return mysqli_affected_rows($this->connection);
}

public function fetch_array($result_set){
return mysqli_fetch_array($result_set);
}

public function num_rows($result_set){
return mysqli_num_rows($result_set);
}

private function confirm_query($result){
if (!$result){
$ioutput="<div style='margin: auto; margin-top: 60px; width: 900px; border: 1px solid #ddf; background: #eef; min-height: 550px;'>";
$ioutput .="<div style='font-size: 14px; background: #2A5779; color: #ffffff; font-size:20px; width: 900px; height: 20px; padding: 6px;'> Connection fail</div>";
//$ioutput .="".mysql_error()."<br/><br/>";
$ioutput .="<p style='font-size: 12px; padding:10px;'>Please try again later.</p></div>";
//$ioutput .="Last SQL query: " .$this->last_query;//remember to comment this out
die($ioutput);
}
}

}
$database= new MySQLDatabase();
$db=&$database;
?>