<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata'); 
//Modified by dipak on 19 july 
//shortcodes updations
//echo $_POST['returnpath']."<br>";
//print_r($_POST);die;
//--------------------function --------------------------------

function encryptlink($text)
{
	return  base64_encode($text);
}

function CheckSystemsDate($stringfun){  
    $digs = "0";
    while($digs!=""){
    	$digs = findcode($stringfun,'__sysdate[',']'); 
        if($digs == ''){
            break;
        }     
        $alphatext=date($digs);
        $shortcode = "__sysdate[".$digs."]";
		//$stringfun = date("y-m-d");
        $stringfun = str_replace($shortcode,$alphatext,$stringfun);
    }
    return $stringfun;    
}

function findcode($string,$start,$end){
	$string = " ".$string;
    $ini = strpos($string,$start);
    if($ini == 0){
    	return "";
    }else{
        $ini += strlen($start);
        $len = strpos($string,$end,$ini)-$ini;
        return substr($string, $ini, $len);
    }
}

function cleaninput($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
    	$str = stripslashes($str);
    }
    $str=htmlentities($str);
    return mysql_real_escape_string($str);
}

function converttostr($str1){
	$str_arr = explode(PHP_EOL,$str1);
    $i = 0;
    $str = '';
    foreach($str_arr as $item){
    	if($i == 0){
        	$str = $item;
        }else{
            $str .= '|'.$item;
        }
        $i++;
    }
    return $str;
}

function convertallalpha($stringfun){

    $digs = "0";
	while($digs!=""){
    	$digs = findcode($stringfun,'__alpha[',']');
        if($digs == ''){
        	break;
        }
        $alphatext = getrandom($digs);
        $shortcode = "__alpha[".$digs."]";
        $stringfun = str_replace($shortcode,$alphatext,$stringfun);
    }
    return $stringfun;
}


function convertallnum($stringfun){

        $digs = "0";

        while($digs!=""){
                $digs = findcode($stringfun,'__num[',']');
                        if($digs == ''){
                                break;
                        }
                $alphatext = getrandomnum($digs);
                $shortcode = "__num[".$digs."]";
                $stringfun = str_replace($shortcode,$alphatext,$stringfun);
        }
        return $stringfun;
}
function convertallmix($stringfun){

        $digs = "0";

        while($digs!=""){
                $digs = findcode($stringfun,'__mix[',']');
                        if($digs == ''){
                                break;
                        }
                $alphatext = getrandommix($digs);
                $shortcode = "__mix[".$digs."]";
                $stringfun = str_replace($shortcode,$alphatext,$stringfun);
        }
        return $stringfun;
}

function getrandommix($num){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
         $stringrand = '';
         for ($i = 0; $i < $num; $i++) {
                  $stringrand .= $characters[rand(0, strlen($characters) - 1)];
         }
         return  $stringrand;
}

function convertallalpha_uppercase($stringfun){

	$digs = "0";

	while($digs!=""){
                $digs = findcode($stringfun,'__alpha_upp[',']');
                        if($digs == ''){
                                break;
                        }
                $alphatext = strtoupper(getrandom($digs));
                $shortcode = "__alpha_upp[".$digs."]";
                $stringfun = str_replace($shortcode,$alphatext,$stringfun);
        }
        
	return $stringfun;
}


function getrandommix2($num){
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $stringrand = '';
         for ($i = 0; $i < $num; $i++) {
                  $stringrand .= $characters[rand(0, strlen($characters) - 1)];
         }
         return  $stringrand;
}
function ReturnStaticMix($num)
{
	$characters = 'abcdefghij0123456789ABCDEklmnopqrstuvwxyzFGHIJKLMNOPQRSTUVWXYZ';
    $stringrand = '';
    for ($i = 0; $i < $num; $i++) {
        $stringrand .= $characters[rand(0, strlen($characters) - 1)];
    }
    return  $stringrand;
	
}


function GetstaticMixReturnValue($stringfun)
{
	$digs = "0";
	while($digs!=""){
    	$digs = findcode($stringfun,'__staticMix[',']');
        if($digs == ''){
        	break;
        }
        $alphatext = ReturnStaticMix($digs);
        $shortcode = "__staticMix[".$digs."]";
        $stringfun = str_replace($shortcode,$alphatext,$stringfun);
	}
    return $stringfun;
}




function GetMixALLReturnValue($stringfun,$ifretval,$numcnt)
{
	
	$digs = "0";
	while($digs!=""){
    	$digs = findcode($stringfun,'mixall(',')');
        if($digs == ''){
        	break;
        }
		//echo "numcnt - ".$numcnt." Dig - ".$digs."<br><br>\n";
		if($numcnt!=$digs)
		{
        	$alphatext = ReturnStaticMix($digs);
		}else{
			$alphatext = $ifretval;
		}
        $shortcode = "mixall(".$digs.")";
        $stringfun = str_replace($shortcode,$alphatext,$stringfun);
	}
    return $stringfun;
}


function GetstaticMixReturnValue2($stringfun,$ifretval,$numcnt)
{
	
	$digs = "0";
	while($digs!=""){
    	$digs = findcode($stringfun,'__staticMix[',']');
        if($digs == ''){
        	break;
        }
		//echo "numcnt - ".$numcnt." Dig - ".$digs."<br><br>\n";
		if($numcnt!=$digs)
		{
        	$alphatext = ReturnStaticMix($digs);
		}else{
			$alphatext = $ifretval;
		}
        $shortcode = "__staticMix[".$digs."]";
        $stringfun = str_replace($shortcode,$alphatext,$stringfun);
	}
    return $stringfun;
}


function getrandomnum($num){
        $characters = '0123456789';
         $stringrand = '';
         for ($i = 0; $i < $num; $i++) {
                  $stringrand .= $characters[rand(0, strlen($characters) - 1)];
         }
         return  $stringrand;
}
function getrandom($num){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $stringrand = '';
         for ($i = 0; $i < $num; $i++) {
                  $stringrand .= $characters[rand(0, strlen($characters) - 1)];
         }
         return  $stringrand;
}

function ConvertAllAlphaRandom($stringfun){

//__alnm_random
	$digs = "0";
	while($digs!=""){
		$digs = findcode($stringfun,'__alnm_random[',']');
			if($digs == ''){
				break;
			}
			//echo $digs;die;
			$explodedigs=explode(",",$digs);
			if($explodedigs[1]=="u")
			{
				$alphatext = strtoupper(getrandommix($digs));
				
			}else{
				$alphatext = strtolower(getrandommix($digs));
			}
		//$alphatext = getrandommix($digs);
		$shortcode = "__alnm_random[".$digs."]";
		$stringfun = str_replace($shortcode,$alphatext,$stringfun);
	}
	return $stringfun;
}


function UniqueID($stringfun,$uniqueid){  
	return str_replace("__uniqueid",$uniqueid,$stringfun);
} 

function GetRFCDate($string)
{
	return str_replace("__rfcdate",date('D, d M Y H:i:s O T'),$string);	
}



function ConvertAllOnlyAlpha($stringfun){

//__alnm_random
	$digs = "0";
	while($digs!=""){
		$digs = findcode($stringfun,'__al_random[',']');
			if($digs == ''){
				break;
			}
			//echo $digs;die;
			$explodedigs=explode(",",$digs);
			if($explodedigs[1]=="u")
			{
				$alphatext = strtoupper(getrandom($digs));
				
			}else{
				$alphatext = strtolower(getrandom($digs));
			}
		//$alphatext = getrandommix($digs);
		$shortcode = "__al_random[".$digs."]";
		$stringfun = str_replace($shortcode,$alphatext,$stringfun);
	}
	return $stringfun;
}


function getContents($str, $startDelimiter, $endDelimiter) {
  $contents = array();
  $startDelimiterLength = strlen($startDelimiter);
  $endDelimiterLength = strlen($endDelimiter);
  $startFrom = $contentStart = $contentEnd = 0;
  while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
    $contentStart += $startDelimiterLength;
    $contentEnd = strpos($str, $endDelimiter, $contentStart);
    if (false === $contentEnd) {
      break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + $endDelimiterLength;
  }

  return $contents;
}


function deletedatafromdatafile($totalcountfordelete , $dataoffile1,$dataurl1){

        for($i = 0; $i<$totalcountfordelete; $i++){
                $li1 = strpos($dataoffile1,PHP_EOL);
                $dataoffile1 = substr($dataoffile1,$li1+1);
        }
        file_put_contents($dataurl1, $dataoffile1);
}

function getfnamefromemail($email_adds){
        $email_adds_1 = explode("@",$email_adds);
        return $email_adds_1[0];
}

function getlnamefromemail($email_adds){
        $email_adds_1 = explode("@",$email_adds);
        return $email_adds_1[1];
}


function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'DIPAKADV2023';
    $secret_iv = 'DIPAK2023';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

//-------------------------------------------------------------------------------------------
//$AUTHORIZED_KEY = decrypt($_POST['AUTHORIZED_KEY']);
//echo $AUTHORIZED_KEY;die;
if($_POST['AUTHORIZED_KEY']){
$passkey = (my_simple_crypt($_POST['AUTHORIZED_KEY'],'d'));
//echo $passkey;die;
if($passkey=="DIPAKAUTHORIZEDKEY"){
	
	//print_r($_POST);die;
	
$ip = trim($_POST['ipaddress']);
$returnpath = $_POST['returnpath'];
$heloip = trim($_POST['heloip']);

$sub=$_POST['esubject'];
//echo $sub;die;
$from=$_POST['efrom'];
$testmail=$_POST['etest'];
$domain=$_POST['domain'];
$sendip=trim($_POST['ip']);


$iptype=trim($_POST['iptype']);

//echo $domain."<br>";
//print_r($_POST);
//dir;
$oip= file_get_contents('/etc/pmta/vmta');
//print_r($oip);die;

$newarray=array();


if($iptype=="vmta"){
	
	$vmta=getContents($oip,'vmta_','domain-key');
	$nvmta=array();
	foreach($vmta as $v){
		$vexp=explode("smtp-source-host ",$v);
		$dex=explode(" ",trim($vexp[1]));
		
		$nvmta[]=trim($dex[1]);	
	}
	if(in_array($domain,$nvmta)){
		$domain=$domain;
	}
	
}

//echo $domain;die;

//print_r($ncm);die; 

$jobid=trim($_POST['jobid']);
$testmail = explode(",",$testmail);


$uniqueid=getrandommix2(32);
//print_r($_POST);die;

$count='1';
$period='';


$wait=$_POST['waitp'];
if($wait==''){
        $wait = '0';
        $wait = intval($wait);
}

$xdelay = $_POST['xdelay'];
$xdelay = intval($xdelay);
//$server = trim($_POST['server']);
$servername = trim($_POST['servername']);
//$server = explode('|',$server);
$server .=$servername;

if(isset($_POST['show_ip_server'])){
    $show_ip = $_POST['show_ip_server'];
}else{
    $show_ip = '0';
}

// 1000000 means 1 second for xdelay

$domainsentered = $_POST['domainsen'];
$domainsentered = explode("\n",$domainsentered);
//print_r($domainsentered);die;
$headersentered = $_POST['headerstext'];
$headersentered = explode(PHP_EOL,$headersentered); 
$headerstoreplace = "";
for($i=0; $i<count($headersentered); $i++){
$headerstoreplace.=$headersentered[$i];
}


if(empty($period) || !isset($period) || $period==NULL || $period==""){
        $period=$count;
}

$body=$_POST['htmlcode'];
//$userid=$_SESSION['allow'];

$domainflagmain="data present";
while($domainflagmain != ""){
	$domainflagmain = findcode($body,'[*','*]');
	//$domainflagmain = $body;
	if($domainflagmain == ""){
		break;
	}
	$domainflag = explode("==",$domainflagmain);
	$ckdomain = $domainflag[0];
	$linktype = $domainflag[1];		
	if($ckdomain == 'domain'){
		$targeturl=$_SERVER['SERVER_NAME']."/r1.php?id1=[[$linktype]]";
	}else{
		$targeturl=$ckdomain."/r1.php?id1=[[$linktype]]";
	}
	$shortcode="[*".$domainflagmain."*]";
	$body = str_replace($shortcode,$targeturl,$body);
}


$body1 = $body;



$domaintoreplace = "[domain]";

 //print_r($ip);die;
// echo $sendip;die;
$ipaddress = trim($sendip);
$hostnameofip = trim($domain);

//print_r($ipaddress);die;
$ret=0;

if($ipaddress && $hostnameofip)
{
	
	//if($show_ip == '1' || $show_ip == 1){
		
		//$subject =$sub.'  '.$server.'  '.$ipaddress;
		$subject =$sub;
		
	//}
	if(count($domainsentered)>0 && $domainsentered[0]!=''){
		for($k=0; $k<count($domainsentered); $k++){
			for($j=1; $j<=$count; $j++){
				$domaintoreplace = str_replace("\n",'',$domainsentered[$k]);
				foreach($testmail as $testmailval)
				{
					if($testmailval)
					{
						//echo "hello";
						$emailid = "00000000";
						$isp = "testemail";
						$listname = "testemail";
						$emailid_add =  $testmailval.'**'.$emailid;
						$idbunch_r=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||r"."||".$testmailval;
						$idbunch_o=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||o";
						$idbunch_u=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||u";
						$idbunch_i=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||i";
						
						$idbunch4r=encryptlink($idbunch_r,$salt);
						$idbunch4o=encryptlink($idbunch_o,$salt);
						$idbunch4u=encryptlink($idbunch_u,$salt);
						$idbunch4i=encryptlink($idbunch_i,$salt);
																
						$dirty = array("+", "/", "="," ","0");
						$clean = array("_PLUS_", "_SLASH_", "_EQUALS_","_SPACE_","_ZERO_");
															
						$idbunch4r=str_replace($dirty, $clean, $idbunch4r);
						$idbunch4o=str_replace($dirty, $clean, $idbunch4o);
						$idbunch4u=str_replace($dirty, $clean, $idbunch4u);
						$idbunch4i=str_replace($dirty, $clean, $idbunch4i);
						

						$body = str_replace('[[r]]',$idbunch4r,$body1);
						$body = str_replace('[[o]]',$idbunch4o,$body);
						$body = str_replace('[[u]]',$idbunch4u,$body);
						$body = str_replace('[[i]]',$idbunch4i,$body);
																				
						$body = str_replace('__fname',getfnamefromemail($testmailval),$body);
						//echo $body;die;
						// converting returnpaths shordcodes

						
					$ret +=sendemails($testmailval,$from,$ipaddress,$subject,$body,$headerstoreplace,$hostnameofip,trim($domaintoreplace),$returnpath,$uniqueid,$jobid,$server);
					
					}
				}
		   }
		   //echo $ret;
		}// for loop of count end here
		sleep($wait);
	}else{
		//$ret=0;
       	for($j=1; $j<=$count; $j++){
           	foreach($testmail as $testmailval)
            {
              	if($testmailval)
                {
					$emailid = "00000000";
						$isp = "testemail";
						$listname = "testemail";
						$emailid_add =  $testmailval.'**'.$emailid;
						$idbunch_r=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||r"."||".$testmailval;
						$idbunch_o=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||o";
						$idbunch_u=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||u";
						$idbunch_i=$emailid_add."||".$userid."||".$offerid."||".$isp."||".$listname."||i";
																
						$idbunch4r=encryptlink($idbunch_r,$salt);
						$idbunch4o=encryptlink($idbunch_o,$salt);
						$idbunch4u=encryptlink($idbunch_u,$salt);
						$idbunch4i=encryptlink($idbunch_i,$salt);
																
						$dirty = array("+", "/", "="," ","0");
						$clean = array("_PLUS_", "_SLASH_", "_EQUALS_","_SPACE_","_ZERO_");
															
						$idbunch4r=str_replace($dirty, $clean, $idbunch4r);
						$idbunch4o=str_replace($dirty, $clean, $idbunch4o);
						$idbunch4u=str_replace($dirty, $clean, $idbunch4u);
						$idbunch4i=str_replace($dirty, $clean, $idbunch4i);
						
						$body = str_replace('[[r]]',$idbunch4r,$body1);
						$body = str_replace('[[o]]',$idbunch4o,$body);
						$body = str_replace('[[u]]',$idbunch4u,$body);
						$body = str_replace('[[i]]',$idbunch4i,$body);
																				
						$body = str_replace('__fname',getfnamefromemail($testmailval),$body);
						//echo $body;die;
						// converting returnpaths shordcodes
						//echo $subject;die;
                  	$ret += sendemails($testmailval,$from,$ipaddress,$subject,$body,$headerstoreplace,$hostnameofip,trim($domaintoreplace),$returnpath,$uniqueid,$jobid,$server);
					//echo $ret;
                }
            }
			//echo $ret."<br>";; 
			
          	usleep($xdelay);
        }// for loop of count end here
    }
}
}
}
echo $ret;
//}

//---- function send emails ---------------------------------------------------------------------------------

function sendemails($to,$from,$host,$subject,$message1,$headers,$hostnameofip,$domaintoreplace,$returnpath,$uniqueid,$jobid,$servern)
{
//echo  "hello".$to." - ".$from." - ".$host." - ".$subject." - ".$message1." - ".$headers." - ".$hostnameofip." - ".$domaintoreplace." - ".$returnpath;die;
//echo $hostnameofip;die;
 
$to = trim($to);
$from = trim($from);
$host = trim($host);
$subject = trim($subject);
$message1 = trim($message1);
//$domaintoreplace = trim($domaintoreplace); 
$returnpath = trim($returnpath);
$hostnameofip = trim($hostnameofip);

        $hname = gethostbyaddr($host);  //here is your hostname use $hname

if($returnpath=="" || $returnpath==NULL || empty($returnpath)){
$returnpath = "contact@".$hostnameofip;
}
//returnpath variable transplant---------------------------------------------------------------
$returnpath =str_replace("__domain",$domaintoreplace,$returnpath);
//echo $returnpath;die;
$returnpath =str_replace("__host",$hostnameofip,$returnpath);
$returnpath=str_replace("__to",$to,$returnpath);
$returnpath = str_replace("__server",$servern,$returnpath);
$returnpath=ConvertAllAlphaRandom($returnpath);
$returnpath = convertallalpha($returnpath);
$returnpath = convertallmix($returnpath);
$returnpath = convertallnum($returnpath);
$returnpath = convertallalpha_uppercase($returnpath);
//echo $returnpath;die;

$returnpath=str_replace("__fname",getfnamefromemail($to),$returnpath);
$returnpath=str_replace("__Fname",ucwords(getfnamefromemail($to)),$returnpath);
$returnpath=str_replace("__Lname",ucwords(getlnamefromemail($to)),$returnpath);
$returnpath=str_replace("__FNAME",strtoupper(getfnamefromemail($to)),$returnpath);
$returnpath=str_replace("__LNAME",strtoupper(getlnamefromemail($to)),$returnpath);


//---------------------------------------------------------------------------------------------

//headers transplant---------------------------------------------------------------------------

$headers=str_replace("__from",$from,$headers);
$headers=str_replace("__to",$to,$headers);
//echo $subject;die;
$headers=str_replace("__subject",$subject,$headers);
$headers=str_replace("__domain",$domaintoreplace,$headers);
$headers=str_replace("__ip",$host,$headers);
$headers=str_replace("__host",$hostnameofip,$headers);
$headers = str_replace("__server",$servern,$headers);
//echo $headers;die;

$headers=str_replace("__fname",getfnamefromemail($to),$headers);
$headers=str_replace("__Fname",ucwords(getfnamefromemail($to)),$headers);
$headers=str_replace("__Lname",ucwords(getlnamefromemail($to)),$headers);
$headers=str_replace("__FNAME",strtoupper(getfnamefromemail($to)),$headers);
$headers=str_replace("__LNAME",strtoupper(getlnamefromemail($to)),$headers);


$headers = convertallalpha($headers);
$headers = convertallmix($headers);
$headers = convertallnum($headers);
$headers=CheckSystemsDate($headers);
$headers = convertallalpha_uppercase($headers);

$headers=GetRFCDate($headers);
//$headers=GetstaticMixReturnValue($headers);
$headers=UniqueID($headers,$uniqueid);
$headers=ConvertAllOnlyAlpha($headers);  
$headers=ConvertAllAlphaRandom($headers);


//echo $headers;die;

$subject=str_replace("__fname",getfnamefromemail($to),$subject);
$subject=str_replace("__Fname",ucwords(getfnamefromemail($to)),$subject);
$subject=str_replace("__Lname",ucwords(getlnamefromemail($to)),$subject);
$subject=str_replace("__FNAME",strtoupper(getfnamefromemail($to)),$subject);
$subject=str_replace("__LNAME",strtoupper(getlnamefromemail($to)),$subject);
$subject = str_replace("__server",$servern,$subject);
$subject=str_replace("__to",$to,$subject);
$subject=str_replace("__domain",$domaintoreplace,$subject);
//--------------------------------------------------------------------------------------------
$message = $message1;
		//$message=str_replace("__fname",getfnamefromemail($to),$message);
		//$message=str_replace("__domain",$domaintoreplace,$message);
//echo $hostnameofip;die; 



$message =str_replace("__host",$hostnameofip,$message);
$message=str_replace("__to",$to,$message);
$message=str_replace("__domain",$domaintoreplace,$message);
		//echo $hostnameofip;die;
		
$message=str_replace("__Fname",ucwords(getfnamefromemail($to)),$message);
$message=str_replace("__Lname",ucwords(getlnamefromemail($to)),$message);
$message=str_replace("__FNAME",strtoupper(getfnamefromemail($to)),$message);
$message=str_replace("__LNAME",strtoupper(getlnamefromemail($to)),$message);
$message = str_replace("__server",$servern,$message);
		
		
$digs = "0";
$digs2 = "0";
$digs3 = "0";
$digs00 = "0";
	while(($digs!="")){
    	$digs = findcode($headers,'__staticMix[',']');
		$digs2 = findcode($message,'__staticMix[',']');
		$digs3 = findcode($returnpath,'__staticMix[',']');
		$digs00 = findcode($subject,'__staticMix[',']');
		
        if(($digs != '') || ($digs2 != '') || ($digs3 != '') || ($digs00 != '')){
			$alphatext = ReturnStaticMix($digs);
			$alphatext2 = ReturnStaticMix($digs2);
			$alphatext3 = ReturnStaticMix($digs3);
			$alphatext00 = ReturnStaticMix($digs00);
			
			$subject=GetstaticMixReturnValue2($subject,$alphatext00,$digs00);
			$returnpath=GetstaticMixReturnValue2($returnpath,$alphatext3,$digs3);
        	$headers=GetstaticMixReturnValue2($headers,$alphatext,$digs);
			$message=GetstaticMixReturnValue2($message,$alphatext2,$digs2);
        }
	}

$digs4 = "0";
$digs5 = "0";
$digs6 = "0";
$digs7 = "0";
	while(($digs4!="")){
    	$digs4 = findcode($headers,'mixall(',')');
		$digs5 = findcode($message,'mixall(',')');
		$digs6 = findcode($returnpath,'mixall(',')');
		$digs7 = findcode($subject,'mixall(',')');
		
        if(($digs4 != '') || ($digs5 != '') || ($digs6 != '')){
			$alphatext4 = ReturnStaticMix($digs4);
			$alphatext5 = ReturnStaticMix($digs5);
			$alphatext6 = ReturnStaticMix($digs6);
			$alphatext7 = ReturnStaticMix($digs7);
			// echo $digs." - ".$digs2."<br><br>\n";
			$subject=GetMixALLReturnValue($subject,$alphatext7,$digs7);
			$returnpath=GetMixALLReturnValue($returnpath,$alphatext6,$digs6);
        	$headers=GetMixALLReturnValue($headers,$alphatext4,$digs4);
			$message=GetMixALLReturnValue($message,$alphatext5,$digs5);
        }
	}
//echo $alphatext;
		
$headersn = findcode($headers,'__[["','"]]__');

	
$headers=str_replace("boundary",$headersn,$headers);
$message=str_replace("boundary",$headersn,$message);
//echo $headers;die;		
$message = convertallalpha($message);
$message = convertallmix($message);
$message = convertallnum($message);
		
$message=CheckSystemsDate($message);


$message=GetRFCDate($message);
$message=UniqueID($message,$uniqueid);
$message=ConvertAllOnlyAlpha($message);
$message=ConvertAllAlphaRandom($message);
$message = convertallalpha_uppercase($message);
		$message =str_replace("__domain",$domaintoreplace,$message);
		$message=str_replace("__host",$hostnameofip,$message);

		//echo "Header -".$headers."<br>\n";
//echo "Body -".$message;
		//die; 
		//echo $hostnameofip;die;
        if($smtp = fsockopen("127.0.0.1",2525))
	{
		//fputs($smtp,"helo  \r\n");
				$setheloip=$GLOBALS['heloip'];
				$setheloip=str_replace("__ip",$host,$setheloip);
				fputs($smtp,"helo ".$setheloip." \r\n");
				//fputs($smtp,"helo ".$GLOBALS['heloip']." \r\n");
                $line = fgets($smtp, 1024);
                fputs($smtp,"mail from: $returnpath\r\n"); //return path if blank contact@__host
                $line = fgets($smtp, 1024);
                fputs($smtp,"rcpt to: $to\r\n");
                $line = fgets($smtp, 1024);
                fputs($smtp,"data\r\n");
                $line = fgets($smtp, 1024);

                fputs($smtp,"X-virtual-MTA: ".$GLOBALS['iptype']."_$host\r\n");
				//echo $jobid;die;
				fputs($smtp,"x-job: $jobid\r\n");
                fputs($smtp,"$headers\r\n"); 
                fputs($smtp,"$message\r\n");
                fputs($smtp,".\r\n");

                $line = fgets($smtp, 1024);
                fputs($smtp, "QUIT\r\n");
                fclose($smtp);  
                return 1;    
        }
        else{
                //echo "!! Error, can't connect to the server $host";
                //$errcount++;
                return 0;
        }

		
		//return 1;
		//echo $domaintoreplace."<br><br>"; 
}

?>
