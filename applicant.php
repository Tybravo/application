<?php
// if it's goin to need the database, then its
// probably smart to require it before we start.

require_once(LIB_PATH.DS.'database.php');
class Applicant extends DatabaseObject{

protected static $table_name= "applicant";
protected static $db_fields= array('id','email','firstname','lastname','contact_address','marital_status','edu_background','best_subject','religion','state_of_origin','s_token','date_of_birth','image_string','image_response','user_type','access_data','verify_string','created','s_day','s_month','s_year','time_current');
public $id;
public $email;
public $firstname;
public $lastname;
public $contact_address;
public $marital_status;
public $edu_background;
public $best_subject;
public $religion;
public $state_of_origin;
public $s_token;
public $date_of_birth;
public $image_string;
public $image_response;
public $user_type;
public $access_data;
public $verify_string;
public $created;
public $s_day;
public $s_month;
public $s_year;
public $time_current;


//common database method

public static function find_all(){
return self::find_by_sql("SELECT * FROM ".self::$table_name);
}

public static function create_applicant($email="", $firstname="", $lastname="", $contact_address="", $marital_status="", $edu_background="", $best_subject="", $religion="", $state_of_origin="", $s_token="", $date_of_birth="", $image_string="", $image_response="", $user_type="", $access_data="", $verify_string="", $time_current=""){
if(!empty($email) && !empty($firstname)){

$bookses= new Applicant();
$bookses->email= (string)$email;
$bookses->firstname= (string)$firstname;
$bookses->lastname= (string)$lastname;
$bookses->contact_address= (string)$contact_address;
$bookses->marital_status= (string)$marital_status;
$bookses->edu_background= (string)$edu_background;
$bookses->best_subject= (string)$best_subject;
$bookses->religion= (string)$religion;
$bookses->state_of_origin= (string)$state_of_origin;
$bookses->s_token= (string)$s_token;
$bookses->date_of_birth= (string)$date_of_birth;
$bookses->image_string= (string)$image_string;
$bookses->image_response= (int)$image_response;
$bookses->user_type= (string)$user_type;
$bookses->access_data= (int)$access_data;
$bookses->verify_string= (string)$verify_string;
$bookses->created= strftime("%Y-%m-%d %H:%M:%S", time());
$bookses->s_day=strftime("%d", time());
$bookses->s_month=strftime("%m", time());
$bookses->s_year=strftime("%Y", time());
$bookses->time_current= (string)$time_current;

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




//AUTHENTICATE PIN TO LOGIN
public static function authenticate_token($s_token=""){
global $database;
$s_token=$database->escape_value($s_token);
$sql = "SELECT * FROM guardian";
$sql .= " WHERE s_token='{$s_token}'";
$sql .= " LIMIT 1";
$result_array = self::find_by_sql($sql);
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY SURNAME & OTHERNAME IN GUARDIAN CLASS TO AVOID DOUBLE REGISTRATION
public static function find_if_already_registered($surname="",$othername="",$schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE surname='{$surname}' AND othername='{$othername}' AND schoolid='{$schoolid}' ORDER BY ID DESC LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN TOKEN FOR CHECKING BY REGISTRAR IF ALREADY REGISTERED
public static function find_by_schoolid_fortoken_ifalready_reg($s_token="",$schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE s_token='".$s_token."' AND schoolid='".$schoolid."' ");
}

//CHECK IF EMAIL ALREADY EXIST
public static function find_by_newuser_email($email=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE email='".$email."' ");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY APPLICANT KEY IDENTITY 
public static function find_by_atoken($a_token=""){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE s_token='{$a_token}' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY APPLICANT KEY IDENTITY TO RESTRICT DOUBLE REGISTRATION
public static function find_by_usertoken($a_token=""){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE s_token='{$a_token}' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//FIND BY APPLICANT KEY IDENTITY TO GET INFO
public static function find_by_userinfo($a_token=""){
global $database;
$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE s_token='{$a_token}' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN NAMES FOR REGISTRAR TO SELECT OPTIONS
public static function find_by_schoolid_session_toselect_guardianinfo($schoolid=0,$s_session="",$term=0){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."' AND s_session='".$s_session."' AND term='".$term."' ");
}



		//SET GUARDIAN STATUS BY ADMIN

//GET GUARDIAN NAMES FOR ADMIN TO SELECT AND SET STATUS
public static function find_by_schoolid_session_toselect_setstatus_guardianinfo($schoolid=0,$s_session=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."' AND s_session='".$s_session."' ");
}

//GET GUARDIAN INFOMATION TO EDIT STATUS
public static function find_by_guardian_id_toedit_status($guardian_id=0, $schoolid="",$s_session=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."'  AND s_session='".$s_session."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN INFOMATION TO FETCH ALL AND EDIT STATUS
public static function find_by_schoolid_fetchall_guardian_toedit_status($schoolid="",$s_session=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."'  AND s_session='".$s_session."' ");
}

//FIND IF EXIST GUARDIAN TO UPDATE ACCOUNT STATUS
public static function find_exist_guardianaccount_status($guardian_id=0, $schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//UPDATE GUARDIAN ACCOUNT STATUS
public static function Update_guardian_account_status($guardian_id=0, $account_status=0, $created=""){
global $database;
$sql = "UPDATE ".self::$table_name;
$sql .= " SET setstatus='".$account_status;
$sql .="', created='".$created;
$sql .="'  WHERE  id ='".$database->escape_value($guardian_id)."' ";
return $database->query($sql);
}

//GET GUARDIAN INFOMATION TO FETCH ALL AND GENERATE PIN
public static function find_by_schoolid_fetchall_guardian_togenerate_token($schoolid="",$s_session=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."'  AND s_session='".$s_session."' ");
}

//GET GUARDIAN INFOMATION TO FETCH ALL AND SET VALIDITY OF PIN
public static function find_by_schoolid_fetchall_guardian_tosetvalidity_token($schoolid="",$s_session=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."'  AND s_session='".$s_session."' ");
}



		//VIEW AND EDIT GUARDIAN INFORMATION

//GET GUARDIAN INFOMATION FOR REGISTRAR TO VIEW
public static function find_by_schoolid_session_toview_guardianinfo($guardian_id=0,$schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1 ");
}

//GET GUARDIAN INFOMATION FOR REGISTRAR TO EDIT
public static function find_by_schoolid_session_toedit_guardianinfo($guardian_id=0,$schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1 ");
}

//FIND IF EXIST GUARDIAN INFO TO UPDATE GUARDIAN
public static function find_exist_guardian_info($guardian_id=0, $schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//UPDATE GUARDIAN INFO
public static function Update_guardian_info($guardian_id=0, $schoolid="", $title="", $surname="", $othername="", $email_address="", $contact_address="", $postal_address="", $phone_digit="", $location="", $nextofkin="", $nextofkin_phone="", $created="", $s_day=0, $s_month=0, $s_year=0){
global $database;
$sql = "UPDATE ".self::$table_name;
$sql .= " SET title='".$title;
$sql .="', surname='".$surname;
$sql .="', othername='".$othername;
$sql .="', email_address='".$email_address;
$sql .="', contact_address='".mysql_real_escape_string($contact_address);
$sql .="', postal_address='".$postal_address;
$sql .="', phone_digit='".$phone_digit;
$sql .="', location='".$location;
$sql .="', nextofkin='".$nextofkin;
$sql .="', nextofkin_phone='".$nextofkin_phone;
$sql .="', created='".$created;
$sql .="', s_day='".$s_day;
$sql .="', s_month='".$s_month;
$sql .="', s_year='".$s_year;
$sql .="'  WHERE  id ='".$database->escape_value($guardian_id);
$sql .="' AND schoolid='".$schoolid."' ";
return $database->query($sql);
}


//GET GUARDIAN TO SELECT SESSION FOR REGISTRAR TO DELETE
public static function find_by_schoolid_session_select_toclear_guardianinfo($schoolid=0,$s_session="",$term=0){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."' AND s_session='".$s_session."' AND term='".$term."' ");
}

//GET GUARDIAN TO FETCH INFOMATION FOR REGISTRAR TO DELETE
public static function find_by_schoolid_session_fetch_toclear_guardianinfo($guardian_id=0,$schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1 ");
}


//GET GUARDIAN REGISTRATION MOMENT
public static function find_by_guardian_id_toview_regmoment($guardian_id=0, $schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN TO FETCH INFOMATION FOR VIEWING
public static function find_by_guardian_id_toview_personalinfo($guardian_id=0,$schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1 ");
}

//GET GUARDIAN INFOMATION FOR REGISTRAR TO SELECT GUARDIAN NAMES
public static function find_by_siteinfo_id_tosearch_guardiannames($schoolid="",$searchtext=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."' AND surname LIKE '%".$searchtext."%' GROUP BY surname, othername");
}

//GET GUARDIAN IDENTITY TO INCLUDE IN STUDENT INFO VIEWING
public static function find_by_schoolid_guardian_id($guardian_id=0, $schoolid=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' AND schoolid='".$schoolid."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN IDENTITY TO INCLUDE IN STUDENT INFO EDITING
public static function find_by_schoolid_toedit_studentguardian($schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."' ");
}



		//VIEW STUDENT RESULTS BY GUARDIAN

//PICK GUARDIAN TOKEN
public static function find_by_guardian_token($current_token=""){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE s_token='".$current_token."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN INFO IDENTITY
public static function find_by_guardian_user_phone($guardian_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN INFOMATION FOR RESULTANT TO VIEW
public static function find_by_schoolid_toview_guardian_info($schoolid=""){
global $database;
return self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE schoolid='".$schoolid."' ");
}

//GET AND COUNT SPECIFICALLY GUARDIANS FOR RESULTANT TO VIEW GUARDIAN INFO
public static function find_by_schoolid_guardians($schoolid="",$pull_accessdata=0){
global $database;
return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE schoolid='".$schoolid."' AND access_data='".$pull_accessdata."' ");
}

//GET GUARDIAN VALIDITY PIN DATE TO FRONT END TO PROCEED TO EDIT PIN VALIDITY DATE 
public static function find_by_guardian_id_toedit_guardian_pinvalidity($guardian_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' LIMIT 1");
return !empty($result_array)? array_shift($result_array):false;
}

//GET GUARDIAN NAMES TO NOTIFY GUARDIAN PIN BY ADMINISTRATOR 
public static function find_by_guardian_id_tonotify_guardian_pin($guardian_id=0){
global $database;
$result_array = self::find_by_sql("SELECT  *  FROM  ".self::$table_name." WHERE id='".$guardian_id."' LIMIT 1");
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
