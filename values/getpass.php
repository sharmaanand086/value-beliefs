<?php
 if(isset($_POST['email']))
{ 
    session_start();
	include("isdk.php");
	$servername = "localhost";
    $username = "worldsuc_assign";
    $password = "asdf1234";
    $dbname = "worldsuc_incredibleyouvalue";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    	  $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); 
           $pass=  $_POST['pass'];       
           $email = $_POST['email'];
 		$app = new iSDK;
		if ($app->cfgCon("connectionName")) 
		{                  
                                   $email;
                                //echo$email;                                 
                                $tagnumber= 10009;					 
                				$returnFields=array('Id','Email','Password','FirstName');
                				$contacts = $app->dsFind("Contact",1000,0,'Groups',$tagnumber, $returnFields);
                				//var_dump($contacts);
                				$a=0;
                				while($a < 3){
                				$contactId=$contacts[$a]['Id'];	
                				$email2=$contacts[$a]['Email'];
                			    $pass2=$contacts[$a]['Password'];
                			    $name = $contacts[$a]['FirstName'];
                			    if($pass==$pass2 && $email==$email2){
                				$_SESSION["logged_in"] = $contactId;
                				$_SESSION["name"] = $name;
                				echo '1';
                				$query = "SELECT * FROM `v_lastlogin` WHERE userid='$contactId'";
                				$result = $conn->query($query);
                				$rowcount=mysqli_num_rows($result);
                				$query2 = "SELECT * FROM `vmb_lastlogin` WHERE userid='$contactId'";
                			 	$result2 = $conn->query($query2);
                			 	$rowcount2=mysqli_num_rows($result2);
                                //var_dump($rowcount);
                               // var_dump($rowcount2);
                                 if($rowcount2==0 && $rowcount ==0)
                                 {
                                     $inserturl='http://www.arfeenkhan.com/incredibleyou/values/mobile/step1.php';
                                     $insert1 = "INSERT INTO `vmb_lastlogin`(`id`, `userid`, `url`) VALUES ('','$contactId','$inserturl')";
                                     $conn->query($insert1);
                                     $inserturl2='http://www.arfeenkhan.com/incredibleyou/values/step1.php';
                                     $insert2 = "INSERT INTO `v_lastlogin`(`id`, `userid`, `url`) VALUES ('','$contactId','$inserturl2')";
                                     $conn->query($insert2);
                                 }
                				}else{
                                
                                } 
                                
                				$a++;
                				}
                				
                					
                			 
                               
		}
		
}		
	 
?>