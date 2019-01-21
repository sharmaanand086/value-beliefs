<?php
 set_time_limit(0);
if(isset($_POST['tagname']))
{
 $servername = "localhost";
$username = "xxxxxxxxxx";
$password = "xxxxxxxxx";
$dbname = "worldsuc_incredibleyouvalue";
// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
 	include("isdk.php");
	//include('adler32.php');	 
         $email1= filter_input(INPUT_POST, 'tagname', FILTER_SANITIZE_STRING); 
        $pass= $_POST['pass'];
       // var_dump($email);    
 		$app = new iSDK;
		if ($app->cfgCon("connectionName")) 
		{         
        $email1;
        if(is_string($email1))
        {
        // var_dump($email);
        $contactId1= $email1;					 
        $returnFields=array('Id','FirstName','Email','Phone1');
        $contacts = $app->dsFind("Contact",1000,0,'Email',$contactId1, $returnFields);
        
        $contactId=$contacts[0]['Id'];
        $email=$contacts[0]['Email'];
        if($email==$email1){
            	echo '1';
            	$conID = $app->addWithDupCheck(array('Password' => $pass,'Email' => $email), 'Email');
             	$contactId = $conID;
        	 $inserturl='http://www.arfeenkhan.com/incredibleyou/beliefs/loggedin.php';
             $insert = "INSERT INTO `lastlogin`(`id`, `userid`, `url`) VALUES ('','$contactId','$inserturl')";
             $conn->query($insert);
        	}else{
            echo "0";
            } 			
        } 
			       
				
				 
		}
	}

?>