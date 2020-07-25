<?php
function strip_zeros_from_date($marked_string=""){
 //remove the mark zeros
$no_zeros= str_replace('*0','',$marked_string);
//remove any remaining marks
$cleaned_string=str_replace('*','',$no_zeros);
return $cleaned_string;
}

function redirect_to($location=NULL){
if ($location!=NULL){
header("Location:{$location}");
exit;
}
}

function price_to_pin($productprice="", $purchasepin="")
{
$validation = false;
$sql = "SELECT * FROM pins WHERE pin='".$purchasepin."' AND product_value <='".$productprice."';" ;
$catres = mysql_query($sql);
$numrows = mysql_num_rows($catres);
if($numrows == 0) {
echo "Please purchase the standard pin for your product, <br/>your product price is greater than the pin category";
$validation = false;
} 
else{
echo "Your pin is valid for the product";
$validation = true;
}

return $validation;
}



function output_message($message=""){
if (!empty($message)){
return "<p align='center'><div style='border:1px solid #ede; border-color: #6db42e; background-color: #cfc; width:auto; min-height:25px;'><p class=\"message\">{$message}</p></div></p>";
}
else{
return "";
}
}

function output_album_id($album_id=""){
if (!empty($album_id)){
return "<p class=\"album_id\">{$album_id}</p>";
}
else{
return "";
}
}

function __autoload($class_name){
$class_name=strtolower($class_name);
$path=LIB_PATH.DS."{$class_name}.php";
if(file_exists($path)){
require_once($path);
}
else{
die("The file{$class_name}.php could not be found.");
}
}

function include_layout_template($template=""){
include(SITE_ROOT.DS.'public_html'.DS.'layouts'.DS.$template);
}



function log_action($action, $message=""){
$logfile=SITE_ROOT.DS.'logs'.DS.'log.txt';
$new=file_exists($logfile)? false : true;
if($handle=fopen($logfile,'a')){//append
$timestamp=strtime("%Y-%m-%d %H:%M:%S", time());
$content= "{$timestamp} | {$action}: {$message}\n";
fwrite($handle, $content);
fclose($handle);
if($new){ chmod($logfile, 0755);}
}
else{
echo "Could not open log file for writing";

}

}
function datetime_to_text($datetime=""){
$unixdatetime=strtotime($datetime);
return strftime("%B %d, %Y at %I:%M:%S %p", $unixdatetime);
}

function datetime_reformat($datetime=""){
$unixdatetime=strtotime($datetime);
return strftime("%B %d, %Y at %I:%M:%S %p", $unixdatetime);
}

function cloxtext($name,$updatename){

$mytext= trim("<input name='".$updatename."' style='width:100%; border: 1px solid #3b5998;' class='inputbox'  autocomplete='off' placeholder='".$name."' onfocus='return wait_for_load(this, event, function() {;JSCC.get('j4f1212ee8b8378a9907060019').init([&quot;chatTypeahead&quot;,&quot;buildBestAvailableNames&quot;,&quot;showLoadingIndicator&quot;]);;});' spellcheck='false' value='".$name."' title='".$name."' type='text'>");

return $mytext;
}


function cloxtextarea($name,$updatename){

$mytextarea= trim("<textarea name='".$updatename."' style='width:100%; border: 1px solid #3b5998;' class='inputbox'  autocomplete='off' placeholder='".$name."' onfocus='return wait_for_load(this, event, function() {;JSCC.get('j4f1212ee8b8378a9907060019').init([&quot;chatTypeahead&quot;,&quot;buildBestAvailableNames&quot;,&quot;showLoadingIndicator&quot;]);;});' spellcheck='false' value='".$name."' title='".$name."'></textarea>");

return $mytextarea;
}


 function time_stamp($time_ago)
{
$cur_time=time();
$time_elapsed = $cur_time - $time_ago;
$seconds = $time_elapsed;
$minutes = round($time_elapsed / 60 );
$hours = round($time_elapsed / 3600);
$days = round($time_elapsed / 86400 );
$weeks = round($time_elapsed / 604800);
$months = round($time_elapsed / 2600640 );
$years = round($time_elapsed / 31207680 );

$uresult="";
if($seconds <= 60)
{
$uresult= "$seconds secs ago";
}
else if($minutes <=60)
{
if($minutes==1)
{
$uresult= "one min ago";
}
else
{
$uresult= "$minutes mins ago";
}
}
else if($hours <=24)
{
if($hours==1)
{
$uresult= "an hr ago";
}
else
{
$uresult= "$hours hrs ago";
}
}
else if($days <= 7)
{
if($days==1)
{
$uresult= "yesterday";
}
else
{
$uresult= "$days days ago";
}
}
else if($weeks <= 4.3)
{
if($weeks==1)
{
$uresult= "a week ago";
}
else
{
$uresult= "$weeks weeks ago";
}
}
else if($months <=12)
{
if($months==1)
{
$uresult= "a month ago";
}
else
{
$uresult= "$months months ago";
}
}
else
{
if($years==1)
{
$uresult= "one year ago";
}
else
{
$uresult= "$years years ago";
}
}
return $uresult;
}

function Send_dynamic_mail($Yourmail="",$YourPics="",$YourMessage="",$Footermessage="",$sendername="",$mysubject="",$MTopic){
$mmsg="<table><tr><td><img src='http://www.ibrilliants.com/profilepics/twohundred/".$YourPics."' /></td><td align='center'>".$YourMessage." </td></tr></table>";
$email=$Yourmail;
$messageb='
<html>
<head>
<title>ibrilliants</title>
</head>
<body>
<table style="-moz-box-shadow:inset 0px 1px 0px 0px #ffffff; -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff; box-shadow:inset 0px 1px 0px 0px #ffffff; background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6)); background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%); background:linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%); background-color:#ffffff; color:#333333; border:1px solid #dcdcdc;">
<tr style="-moz-box-shadow:inset 0px 1px 0px 0px #54a3f7; -webkit-box-shadow:inset 0px 1px 0px 0px #54a3f7; box-shadow:inset 0px 1px 0px 0px #54a3f7; background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #007dc1), color-stop(1, #0061a7)); background:-moz-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:-webkit-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:-o-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:-ms-linear-gradient(top, #007dc1 5%, #0061a7 100%); background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%); background-color:#007dc1;border:1px solid #124d77; cursor:pointer; color:#ffffff; font-family:arial; font-size:18px; padding:12px; text-decoration:none; text-align:center; text-shadow:0px 1px 0px #154682; height:40px; display: block;">
<td>'.$MTopic.'</td>
</tr>
<tr>
<td style="text-align:left; padding:20px;">'.$mmsg.'</td></tr><tr>
<td style="background-color:#f9f9f9; padding-top: 30px; padding-bottom: 30px; border:none; border-top:1px solid #dcdcdc; border-bottom:1px solid #dcdcdc; text-align:center; color: #555555; font-size:12px;"><img src="http://www.ibrilliants.com/images/gppmail.jpg" /><br>'.$Footermessage.'</td></tr></table></body>
</html>'; 

				$myname= $sendername;

				//// Mail posting part starts here ///////// 
				/* To send HTML mail, you can set the Content-type header. */
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				/* additional headers */
				//$headers = "Content-Type: text/html; charset=iso-8859-1n".$headers; 
				// Un comment the above line to send mail in html format 

				$headers .= 	'From: iBrilliants <educationnetwork@ibrilliants.com>' . "\r\n" .
	    					'Reply-To: educationnetwork@ibrilliants.com' . "\r\n" .
	    					'X-Mailer: PHP/' . phpversion();
				$subject = " {$myname} {$mysubject}";
				$Mmessage = $messageb;
				if(mail($email, $subject, $Mmessage, $headers))
				{//we show the good guy only in one case and the bad one for the rest.
					$outmessage = 'Mail was sent to your friend successfuly.';
				}
				else {
					$error = 'failed sending email. Please check your internet connection';
				}
}

function beep_go($int_beeps = 1) {
$string_beeps = "\x07";
for ($i = 0; $i < $int_beeps; $i++): 
$string_beeps .= "\x07"; 
endfor;
return isset ($_SERVER['SERVER_PROTOCOL']) ? false : print $string_beeps;
}

function domain_exists($email,$record = 'MX')
{
list($user,$domain) = split('@',$email);
return checkdnsrr($domain,$record);
}

function random_string($type = 'alnum', $len = 8)
{					
	switch($type)
	{
		case 'alnum'	:
		case 'al'	:
		case 'numeric'	:
		case 'nozero'	:
		
				switch ($type)
				{
					case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'al'	:	$pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric'	:	$pool = '0123456789';
						break;
					case 'nozero'	:	$pool = '123456789';
						break;
				}

				$str = '';
				for ($i=0; $i < $len; $i++)
				{
					$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
				}
				return $str;
		  break;
		case 'unique' : return md5(uniqid(mt_rand()));
		  break;
	}
}
function valid_email($str)
{
return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function checkUnique($table, $field, $compared)
{
	$query = mysql_query('SELECT  '.mysql_real_escape_string($field).' FROM '.mysql_real_escape_string($table).' WHERE "'.mysql_real_escape_string($field).'" = "'.mysql_real_escape_string($compared).'"');
	if(mysql_num_rows($query)==0)
	{
		return TRUE;
	}
	else {
		return FALSE;
	}
}


function currentDayIsInInterval($begin = '',$end = '')
{
        $preg_exp = '"[0-9][0-9][0-9][0-9]/[0-9][0-9]/[0-9][0-9]"';
        $preg_error = 'Wrong parameter passed to function '.__FUNCTION__.' : Invalide date
format. Please use YYYY/mm/dd.';
        $interval_error = 'First parameter in '.__FUNCTION__.' should be smaller than
second.';
        if(empty($begin))
        {
                $begin = 0;
        }
        else
        {
                if(preg_match($preg_exp,$begin))
                {
                        $begin = (int)str_replace('/','',$begin);
                }
                else
                {
                        trigger_error($preg_error,E_USER_ERROR);
                }
        }
        if(empty($end))
        {
                $end = 99999999;
        }
        else
        {
                if(preg_match($preg_exp,$end))
                {
                        $end = (int)str_replace('/','',$end);
                }
                else
                {
                        trigger_error($preg_error,E_USER_ERROR);
                }
        }
        if($end < $begin)
        {
                trigger_error($interval_error,E_USER_WARNING);
        }
        $time = time();
        $now = (int)(date('Y',$time).date('m',$time).date('j',$time));
        if($now > $end or $now < $begin)
        {
                return false;
        }
        return true;
}

function currenttimline_month($datetime)
{
$from_date=date("YYYY/mm/dd", strtotime($datetime));
$to_date=date("YYYY/mm/dd", time());
$f_m_ddate=date("F/Y", strtotime($datetime));
$f_unixdatetime=strtotime($f_m_ddate);

$t_m_ddate=date("F/Y", strtotime(time()));
$t_unixdatetime=strtotime($t_m_ddate);

$return_string=array();
if(var_dump(currentDayIsInInterval($from_date))==true)
{
	for($i=f_unixdatetime;$i<=$t_unixdatetime;$i++)
	{
		$return_string[]='
		<div class="itimeline" id="'.date("F/Y", strtotime(time())).'">Jan</div>
		';
	}
	}
	return join('',$return_string);
}


// Fix for removed Session functions
function fix_session_register(){
    function session_register(){
        $args = func_get_args();
        foreach ($args as $key){
            $_SESSION[$key]=$GLOBALS[$key];
        }
    }
    function session_is_registered($key){
        return isset($_SESSION[$key]);
    }
    function session_unregister($key){
        unset($_SESSION[$key]);
    }
}
if (!function_exists('session_register')) fix_session_register(); 



function  weeksago($datetime){
$thisyear= date("o", strtotime(time()));
$thisweek= date("W", strtotime(time()));
$postyear=date("o", strtotime($datetime));
$postweek=date("W", strtotime($datetime));

$report="";
$weekdif=0;

if($thisyear == $postyear){
if($thisweek == $postweek){
$report ="This week";
}
elseif($thisweek < $postweek){

$weekdif=$postweek - $thisweek;
$report = $weekdif." weeks from now";
}

elseif($thisweek > $postweek){

$weekdif= $thisweek - $postweek;
$report = $weekdif." weeks ago";
}
}
return $report;
}

?>