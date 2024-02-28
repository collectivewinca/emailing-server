<?php
ob_start();
ini_set('max_execution_time',0);
ini_set("memory_limit","-1");
error_reporting(0);
header("Access-Control-Allow-Origin: *");
include_once($_SERVER['DOCUMENT_ROOT']."/functions.php");
//echo "hello";die;
//print_r($_POST);die;
$error =false;

$urloutput=array();

$tstid=explode(",",$_POST['etest']);



if($_POST['negativehtml']){
	if(trim($_POST['hidetype'])=="style")
	{
		$negativebody='<style>'.trim($_POST['negativehtml']).'</style>';	
	}else if(trim($_POST['hidetype'])=="title")
	{
		$negativebody='<title>'.trim($_POST['negativehtml']).'</title>';
	}else if(trim($_POST['hidetype'])=="object"){
		$negativebody='<object>'.trim($_POST['negativehtml']).'</object>';
	}else if(trim($_POST['hidetype'])=="script"){
		$negativebody='<script>'.trim($_POST['negativehtml']).'</script>';
	}
}


$sendarray =array();

$explodeips =explode(",",$_POST['serverips']);
$cnt =(count($explodeips)-1);
//echo $cnt;

$contarray=array();

if(!$error){
	//print_r($_POST);die;
	if(trim($_POST['etest']))
	{		 
		for($lp=0;$lp<=$cnt;$lp++)
		{  	
	//echo trim($fileexp[$flp])."<br><br>";
	if($explodeips[$lp]){
		 $ipexptype=explode("|",$explodeips[$lp]);
	//echo "hello"; 	
		$result=mysqli_query($conn,"SELECT si.domain,s.server_name FROM servers_ips si,mailservers s where (si.mailserverid=s.id) AND (si.ipadd ='".trim($ipexptype[0])."') AND (s.status=1)");	
		$row = mysqli_fetch_assoc($result);
		//$result=mysqli_query($conn,"SELECT si.domain,s.server_name FROM servers_ips si,mailservers s where (si.mailserverid=s.id) AND (si.ipadd ='".trim($ipexptype[0])."') AND (((s.status=1) OR (s.status=4) OR (s.status=6)) AND (s.visibility_status=1))");	
		//$row = mysqli_fetch_assoc($result);
		//if($row['server_name']){
		$sendarray['AUTHORIZED_KEY']=my_simple_crypt("DIPAKAUTHORIZEDKEY",'e');
		$sendarray['jobid'] =trim($_COOKIE['affuserid'])."|test|test|test|test|test";
		$sendarray['returnpath'] =trim($_POST['returnpath']);
		$sendarray['heloip'] ="127.0.0.1";
		//$sendarray['esubject'] =trim($_POST['esubject']);
		$subject=trim($_POST['esubject']);
		
		$sendarray['static_domain'] ="NA"; 
		
		if(trim($_POST['encodingtype'])=="base64")
		{
			$subject="=?utf-8?b?".base64_encode($subject)."?=";
		}else if(trim($_POST['encodingtype'])=="quoted"){				
				$subject="=?utf-8?q?".str_replace(" ","_",$subject)."?=";
		}else if(trim($_POST['encodingtype'])=="plain"){
				$subject=$subject;  
		}else if(trim($_POST['encodingtype'])=="hex"){
			$subject=str_split($subject);
			$nsubject='';
			foreach($subject as $substring){
				$nsubject.="=".bin2hex($substring);		
			}
			$subject="=?utf-8?q?".$nsubject."?=";
		}
		
		$sendarray['esubject'] =str_replace('__neg',$negativebody,$subject);
		$sendarray['efrom'] =trim($_POST['efrom']);
		//$sendarray['etest'] =trim($_POST['etest']);
		$sendarray['etest'] =trim($_POST['etest']);
		$sendarray['servername'] =trim($row['server_name']);
		$sendarray['xdelay'] =trim($_POST['xdelay']);	
		$sendarray['show_ip_server'] ="1";	
		$sendarray['domainsen'] =trim($_POST['domainsen']);	
		$body=trim($_POST['htmlcode']);
		$sendarray['headerstext'] =str_replace('__neg',$negativebody,trim($_POST['headerstext']));;
		if(strpos(str_replace('__neg',$negativebody,trim($_POST['headerstext'])),"quoted-printable")!== false){
			$body=quoted_printable_encode(trim($_POST['htmlcode']));
		}
		$sendarray['htmlcode'] =str_replace('__neg',$negativebody,$body); 
		$sendarray['domain'] =trim($row['domain']); 
		 
		$sendarray['ip'] =trim($ipexptype[0]); 
		$sendarray['iptype']=trim($ipexptype[1]);
		 
		$POST_DATA = $sendarray;
		$curl = curl_init();
		//echo 'https://'.trim($explodeips[$lp]).'/testmailipwisev2.php';die;
		//$out=array();
		//echo 'http://'.trim($ipexptype[0]).'/testmailipwisev2.php';die;
		curl_setopt($curl, CURLOPT_URL, 'http://'.trim($ipexptype[0]).'/testmailipwisev2.php');	
		curl_setopt($curl, CURLOPT_TIMEOUT, 100);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA); 
		$response = curl_exec($curl);
	//print_r($response);die;
		$contarray[$ipexptype[0]][trim($row['server_name'])]=$response;
		curl_close ($curl);	
		}	
	} 
	//}	 
	}
	//die;
	//print_r($contarray);die;
	//echo "hello";die;
	if(!empty($contarray)){
		$retresult='SUCCESS~';
		$retresult.=' <table class="table table-bordered"><thead><tr><th>Server Name</th><th>IP</th><th>Total Sent</th></tr></thead><tbody>';
		foreach($contarray as $key=>$vl)
		{
			//print_r($vl)."<br>";
			foreach($vl as $v2=>$jk){
			$retresult.=' <tr><td>'.$v2.'</td><td>'.$key.'</td><td>'.($vl[$v2]).'</td></tr>';
			}
		}
		$retresult.=' </tbody></table>';
		echo $retresult;
	}
}else{
	echo $error;
}
//print_r($contarray);
?>