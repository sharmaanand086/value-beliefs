<?php
 set_time_limit(0);

if(isset($_POST['email']))
{
    session_start();
	include("isdk.php");	 	 
    	  $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); 
          $pass=  $_POST['pass'];        
        //echo$email;echo$pass;
 		$app = new iSDK;
		if ($app->cfgCon("connectionName")) 
		{                  
                                   $email;
                                 if(is_string($email))
                                {
                                //echo$email;                                 
                                $contactId1= $email;					 
                				$returnFields=array('Id','Email','Password');
                				$contacts = $app->dsFind("Contact",1000,0,'Email',$contactId1, $returnFields);
                				
                				$contactId=$contacts[0]['Id'];				 
                				$email2=$contacts[0]['Email'];
                				$pass2=$contacts[0]['Password'];
                				$_SESSION["logged_in"] = $contactId;
                				if($pass==$pass2){
                				$_SESSION["logged_in"] = $contactId;
                				echo '1';
                				}else{
                                echo "0";
                                } 			
                				//$myObj->pass= $pass;
                                               // $myObj->email= $email2;
                                                //$myObj->Password= $pass2;
                                                //$myJSON = json_encode($myObj);
                                 //echo $myJSON;
                               }
                                  
			              
				
				 
		}
	}


 
?>