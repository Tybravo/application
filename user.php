<?php
// if it's goin to need the database, then its
// probably smart to require it before we start.

require_once(LIB_PATH.DS.'database.php');
class User extends DatabaseObject{

protected static $table_name= "users";
protected static $db_fields= array('id','firstname','lastname','maidenname','phone_digit','email','password','user_type','s_token','created','s_day','s_month','s_year','level_access','verify_string','siteinfo_id','Active','verify_email','Active_client');
public $id;
public $firstname;
public $lastname;
public $maidenname;
public $phone_digit;
public $email;
public $password;
public $user_type;
public $s_token;
public $created;
public $s_day;
public $s_month;
public $s_year;
public $level_access;
public $verify_string;
public $siteinfo_id;
public $Active;
public $verify_email;
public $Active_client;


//common database method

public static function find_all(){
return self::find_by_sql("SELECT * FROM ".self::$table_name);
}

public static function createusers($firstname="", $lastname="", $maidenname="", $phone_digit="", $email="", $password="", $user_type="", $s_token="", $created="", $s_day="", $s_month="", $s_year="", $level_access="", $verify_string="", $siteinfo_id="", $Active="", $verify_email="", $Active_client=""){
if(!empty($firstname) && !empty($lastname)){

$bookses= new User();
$bookses->firstname= (string)$firstname;
$bookses->lastname= (string)$lastname;
$bookses->maidenname= (string)$maidenname;
$bookses->phone_digit= (string)$phone_digit;
$bookses->email= (string)$email;
$bookses->password= (string)$password;
$bookses->user_type= (string)$user_type;
$bookses->s_token= (string)$s_token;
$bookses->created= strftime("%Y-%m-%d %H:%M:%S", time());
$bookses->s_day= strftime("%d", time());
$bookses->s_month= strftime("%m", time());
$bookses->s_year= strftime("%Y", time());
$bookses->level_access= (int)$level_access;
$bookses->verify_string= (string)$verify_string;
$bookses->siteinfo_id= (int)$siteinfo_id;
$bookses->Active= (int)$Active;
$bookses->verify_email= (int)$verify_email;
$bookses->Active_client= (int)$Active_client;

return $bookses;
}
else{
return false;
}
}



public static function find_by_vstring($vstring=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE verify_string='{$vstring}'");
return !empty($result_array)? array_shift($result_array):false;
}

public static function find_by_token($s_token=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE s_token='{$s_token}'");
return !empty($result_array)? array_shift($result_array):false;
}

public static function update_token($s_token, $email){
global $database;
$sql = "UPDATE ". self::$table_name;
$sql .= " SET s_token='".$s_token."'";
$sql .= " WHERE email='".$email."'";
return $database->query($sql);
}


// AUTHENTICATE PIN TO LOGIN
public static function authenticate_token($a_token=""){
global $database;
$a_token=$database->escape_value($a_token);
$sql = "SELECT * FROM users";
$sql .= " WHERE s_token='{$a_token}'";
$sql .= " LIMIT 1";
$result_array = self::find_by_sql($sql);
return !empty($result_array)? array_shift($result_array):false;
}

// AUTHENTICATE EMAIL TO LOGIN
public static function authenticate_email($email="", $password=""){
global $database;
$email=$database->escape_value($email);
$password=$database->escape_value($password);
$sql = "SELECT * FROM users";
$sql .= " WHERE email='{$email}'";
$sql .= " AND password= '{$password}'";
$sql .= " LIMIT 1";
$result_array = self::find_by_sql($sql);
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY APPLICANT KEY IDENTITY 
public static function find_by_atoken($a_token=""){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE s_token='{$a_token}' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//CHECK IF EMAIL ALREADY EXIST
public static function find_by_newuser_email($email=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' ");
return !empty($result_array)? array_shift($result_array):false;
}


			//ACCOUNT VIEWING

//FIND BY USER EMAIL AND IDENTITY (ADMIN) TO VIEW USER REGISTRATION DATE OF ACCOUNT SIGN UP
public static function find_by_user_email($email="",$user_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' AND id='".$user_id."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY USER TYPE TO VIEW USER (REGISTRAR) REGISTRATION DATE OF ACCOUNT SIGN UP THROUGH ADMIN
public static function find_by_user_type_registrar($siteinfo_id=0,$user_type=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' AND user_type='".$user_type."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY USER EMAIL AND IDENTITY TO VIEW USER ACCOUNT SIGN UP DETAILS
public static function find_by_users_idemail($email="",$user_id=0){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' AND id='".$user_id."' ");
}

//FIND BY USER EMAIL AND IDENTITY (REGISTRAR) TO VIEW USER REGISTRATION DATE OF ACCOUNT SIGN UP
public static function find_by_registrar_user_email($email="",$user_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' AND id='".$user_id."' ");
return !empty($result_array)? array_shift($result_array):false;
}


			//ACCOUNT EDITING AND PASSWORD CONFIRMING

//AUTHENTICATE USER PASSWORD TO ENABLE ACCOUNT EDITTING
public static function find_by_mypassword($id=0, $get_password=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$id."' AND password='".$get_password."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY USER IDENTITY TO EDIT USER (ADMIN) ACCOUNT
public static function find_toedit_my_account($id=0, $get_password=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$id."' AND password='".$get_password."' ");
}

//FIND IF EXIST USER (ADMIN) ACCOUNT TO UPDATE ACCOUNT
public static function find_exist_myaccount($email="", $id=0){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE email='".$email."' AND id='".$id."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//UPDATE USER (ADMIN) ACCOUNT
public static function Update_my_account($id=0, $firstname="", $lastname="", $maidenname="", $phone_digit="", $created=""){
global $database;
$sql = "UPDATE ".self::$table_name;
$sql .= " SET firstname='".$firstname;
$sql .="', lastname='".$lastname;
$sql .="', maidenname='".$maidenname;
$sql .="', phone_digit='".$phone_digit;
$sql .="', created='".$created;
$sql .="'  WHERE id ='".$database->escape_value($id)."' ";
return $database->query($sql);
}


//FIND BY USER IDENTITY TO EDIT USER (REGISTRAR) ACCOUNT THROUGH ADMIN
public static function find_toedit_registrar_account($siteinfo_id=0,$user_type=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' AND user_type='".$user_type."' ");
}

//FIND BY USER IDENTITY TO FETCH USER (REGISTRAR) ACCOUNT THROUGH ADMIN FOR DELETING
public static function find_tofetch_registrar_account($siteinfo_id=0,$user_type=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' AND user_type='".$user_type."' ");
}

//FIND IF EXIST USER (REGISTRAR) ACCOUNT TO UPDATE ACCOUNT
public static function find_exist_registrar_account($emailregistrar="",$userregistrar_id=0){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE email='".$emailregistrar."' AND id='".$userregistrar_id."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//UPDATE (REGISTRAR) USER ACCOUNT
public static function Update_registrar_account($userregistrar_id=0, $firstname="", $lastname="", $maidenname="", $phone_digit="", $created=""){
global $database;
$sql = "UPDATE ".self::$table_name;
$sql .= " SET firstname='".$firstname;
$sql .="', lastname='".$lastname;
$sql .="', maidenname='".$maidenname;
$sql .="', phone_digit='".$phone_digit;
$sql .="', created='".$created;
$sql .="'  WHERE id ='".$database->escape_value($userregistrar_id)."' ";
return $database->query($sql);
}



			//ACCOUNT STATUS EDITING

//FIND BY EMAIL AND ID TO CHECK FOR ACCOUNT STATUS
public static function find_by_user_email_and_id($email="",$id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' AND id='".$id."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//AUTHENTICATE USER PASSWORD TO ENABLE ACCOUNT EDITTING
public static function find_by_mypassword_status($id=0, $get_password=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$id."' AND password='".$get_password."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY USER EMAIL AND IDENTITY (REGISTRAR) TO SET REGISTRAR STATUS
public static function find_by_userid_email_editstatus($email="",$user_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' AND id='".$user_id."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND IF EXIST USER (REGISTRAR) ACCOUNT TO UPDATE ACCOUNT STATUS
public static function find_exist_myaccount_status($registrar_id){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$registrar_id."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//UPDATE USER ACCOUNT STATUS
public static function Update_my_account_status($registrar_id=0, $account_status=0, $created=""){
global $database;
$sql = "UPDATE ".self::$table_name;
$sql .= " SET Active='".$account_status;
$sql .="', created='".$created."' ";
$sql .= " WHERE id='".$registrar_id."' ";
return $database->query($sql);
}


//GET SITE INFO ID AS SCHOOLID FOR ALL SCHOOL TABLES IN DB
public static function find_by_user_id_toget_siteinfo($user_id=0){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$user_id."' LIMIT 1 ");
}

//GET VERIFY STRING AS SCHOOLID
public static function find_by_siteinfo_id_toget_schoolid($siteinfo_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//GET REGISTRAR ACTIVE MODE FOR GUARDIAN TO VIEW STUDENT RESULT INFORMATION
public static function find_by_schoolid_usertype($user_type="",$schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE user_type='".$user_type."' AND verify_string='".$schoolid."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND SCHOOLID FOR GUARDIAN TO FETCH SCHOOL SESSION TO VIEW STUDENT RESULT INFORMATION
public static function find_by_schoolid($schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE verify_string='".$schoolid."' LIMIT 1 ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY USER EMAIL TO RESET PASSWORD
public static function find_by_emailuser($email=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//GET VERIFY STRING FOR RESULTANT
public static function find_by_client_siteinfoid_toget_schoolid($siteinfo_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' ");
return !empty($result_array)? array_shift($result_array):false;
}


			//SET CLIENT USER STATUS BY RESULTANT

//FIND CLIENT SITE INFO ID TO SET CLIENT USER STATUS
public static function find_by_siteinfoid_toset_client_userstatus($siteinfo_id=0){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND IF EXIST CLIENT TO UPDATE USER STATUS 
public static function find_exist_clientuser_status($siteinfo_id=0, $schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE siteinfo_id='".$siteinfo_id."' AND verify_string='".$schoolid."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//UPDATE CLIENT USER STATUS
public static function Update_client_user_status($siteinfo_id=0, $account_status=0, $created=""){
global $database;
$sql = "UPDATE ".self::$table_name;
$sql .= " SET Active_client='".$account_status;
$sql .="', created='".$created;
$sql .="'  WHERE  siteinfo_id ='".$database->escape_value($siteinfo_id)."' ";
return $database->query($sql);
}



			//SEND QUICK NOTE TO RESULTANT ADMINISTRATOR EMAIL

//FIND USER EMAIL AND IDENTITY TO SEND QUICK MESSAGE TO RESULTANT
public static function find_by_users_email_identity($email="",$user_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' AND id='".$user_id."' ");
return !empty($result_array)? array_shift($result_array):false;
}











public static function find_by_email($id=""){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE email='{$id}' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

public static function find_by_id($id=0){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

public static function find_by_sql($sql=""){
global $database;
$result_set = $database->query($sql);
$object_array=array();
while ($row =$database->fetch_array($result_set)){
$object_array[]=self::instantiate($row);
}
return $object_array;
}

public static function count_all(){
global $database;
$sql= "SELECT COUNT(*) FROM ".self::$table_name;
$result_set = $database->query($sql);
$row = $database->fetch_array($result_set);
return array_shift($row);
}



private static function instantiate($record){
$object = new self;
//$object->id 		= $record['id'];
//$object->username 	= $record['username'];
//$object->password 	= $record['password'];
//$object->first_name 	= $record['first_name'];
//$object->last_name 	= $record['last_name'];

foreach($record as $attribute=>$value){
if($object->has_attribute($attribute)){
$object->$attribute=$value;
}
}

return $object;
}

private function has_attribute($attribute){
//get_object_vars returns an associative array with all attributes
$object_vars = $this->attributes();

return array_key_exists($attribute, $object_vars);

}


protected function attributes() {

//return an array of attribute keys and their values

$attributes = array();
foreach(self::$db_fields as $field){
if(property_exists($this, $field)){
 $attributes[$field]=$this->$field;
}
}
return $attributes;

}


protected function sanitized_attributes() {
global $database;
$clean_attributes=array();
//sanitize the values before submitting
//Note: does not alter the actual value of each attribute
foreach($this->attributes() as $key=>$value){
 $clean_attributes[$key] = $database->escape_value($value);
}
return $clean_attributes;
}

public function create(){
global $database;
//dont forget SQL syntax and good habits;
//INSERT INTO table (key,key) VALUES('value', value)
//single quotes around all values
//escape all values to prevent SQL injection
$attributes=$this->sanitized_attributes();
$sql= "INSERT INTO ".self::$table_name." (";
$sql .= join(", ", array_keys($attributes));
$sql .= ") VALUES('";
$sql .= join("', '", array_values($attributes));
$sql .= "')";

if($database->query($sql)){
 $this->id=$database->insert_id();
 return true;
}
else{
 return false;
}

}


public function save(){
// A new record won't have an id
return isset($this->id)? $this->update() : $this->create();
}


public function update(){

global $database;
//dont forget SQL syntax and good habits;
//UPDATE table SET key='value' WHERE condition
//single quotes around all values
//escape all values to prevent SQL injection
$attributes=$this->sanitized_attributes();
$attribute_pairs=array();
foreach($attributes as $key=>$value){
 $attribute_pairs[]="{$key}='{$value}'";
}

$sql = "UPDATE ".self::$table_name." SET ";
$sql .= join(", ", $attribute_pairs);
$sql .= " WHERE id='".$database->escape_value($this->id)."'";
$database->query($sql);
return ($database->affected_rows()==1)? true : false;
}

public function delete(){
global $database;
//dont forget SQL syntax and good habits;
//DELETE FROM table WHERE condition LIMIT 1
//single quotes around all values
//escape all values to prevent SQL injection
// Use LIMIT 1
$sql ="DELETE FROM ".self::$table_name;
$sql .=" WHERE id=" .$database->escape_value($this->id);
$sql .=" LIMIT 1";
$database->query($sql);
return ($database->affected_rows()==1)? true : false;
}
}
?>