<?php
class Session{

private $logged_in=false;
public $user_id;
public $user;
public $fullname;
public $verifystring;
public $message;
public $album_id;

function __construct(){

//session_start();
$this->check_login();
$this->check_message();
$this->check_album_id();
$this->check_user();
$this->check_full_name();
$this->check_verify_string();
if($this->logged_in){

}
else{

}

}

public function is_logged_in(){
return $this->logged_in;
}

public function login($user){
if($user){
$this->user_id= $_SESSION['user_id']=$user->id;
$this->user= $_SESSION['user']=$user->email;
$this->user= $_SESSION['verifystring']=$user->verify_string;
$this->fullname= $_SESSION['fullname']=$user->first_name ." ".$user->last_name;
$this->logged_in=true;
}
}

public function logout(){
unset($_SESSION['user_id']);
unset($this->user_id);
unset($_SESSION['user']);
unset($this->user);
unset($_SESSION['fullname']);
unset($this->fullname);
unset($_SESSION['verifystring']);
unset($this->verify_string);
$this->logged_in=false;
}


public function message($msg=""){
//is there a message stored in the session?
if(!empty($msg)){
//then this is "set message"
//make sure you understand why $this->message=$msg wouldn't work
$_SESSION['message']=$msg;
}
else{
// Then this is "get message"
return $this->message;
}

}


public function album_id($id=0){
//is there a message stored in the session?
if(!empty($id)){
//then this is "set message"
//make sure you understand why $this->album_id=$id wouldn't work
$_SESSION['album_id']=$id;
}
else{
// Then this is "get message"
return $this->album_id;
}

}

public function look_album_id(){
return $_SESSION['album_id'];
}

private function check_login(){
if(isset($_SESSION['user_id'])){
$this->user_id=$_SESSION['user_id'];
$this->logged_in=true;
}
else{
unset($this->user_id);
$this->logged_in=false;
}
}


private function check_user(){
if(isset($_SESSION['user'])){
$this->user=$_SESSION['user'];
}
else{
unset($this->user);
}
}

private function check_full_name(){
if(isset($_SESSION['fullname'])){
$this->fullname=$_SESSION['fullname'];
}
else{
unset($this->fullname);
}
}

private function check_verify_string(){
if(isset($_SESSION['verifystring'])){
$this->verifystring=$_SESSION['verifystring'];
}
else{
unset($this->verifystring);
}
}


private function check_message(){
//is there a message stored in the session?
if(isset($_SESSION['message'])){
//Add it as an attribute and erase the stored version
$this->message=$_SESSION['message'];
unset($_SESSION['message']);
}
else{
$this->message="";
}

}


private function check_album_id(){
//is there a message stored in the session?
if(isset($_SESSION['album_id'])){
//Add it as an attribute and erase the stored version
$this->album_id=$_SESSION['album_id'];
unset($_SESSION['album_id']);
}
else{
$this->album_id="";
}

}


}
$session = new Session();
$message=$session->message;
$album_id=$session->album_id;
?>