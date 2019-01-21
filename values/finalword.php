<?php
session_start();
if (! empty($_SESSION['logged_in']))
{
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
$cart = array();
$userid=$_SESSION['logged_in'];
$word=$_POST['setvalue'];

$sql = 'SELECT * FROM `word` WHERE word="'.$word.'"';
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
	    $woords = addslashes($row['word']);
	    $sameid = $row['sameid'];
	    $meaning = $row['meaning'];
      $insert_userword = "INSERT INTO `finalword`(`id`, `meaning`, `userid`, `word`, `sameid`) VALUES ('','".$meaning."','".$userid."','".$woords."','".$sameid."')";
      $conn->query($insert_userword);
     
	}
$sql1 ='DELETE FROM `userlastsub` WHERE word="'.$word.'"  AND `userid`="'.$userid.'"';
$conn->query($sql1);

$sql2 = 'SELECT * FROM `userlastsub` WHERE  `userid`="'.$userid.'"';
$result2 = $conn->query($sql2);
$rowcount=mysqli_num_rows($result2);
//var_dump($rowcount);
    
if ($rowcount == 1) {
$inserturl='http://www.arfeenkhan.com/incredibleyou/values/mobile/final.php';
$insert1 = "UPDATE `vmb_lastlogin` SET `url`='$inserturl' WHERE userid='$userid'";
 $conn->query($insert1);
 $inserturl2='http://www.arfeenkhan.com/incredibleyou/values/final.php';
$insert2 = "UPDATE `v_lastlogin` SET `url`='$inserturl2' WHERE userid='$userid'";
 $conn->query($insert2);
	while($row2 = $result2->fetch_assoc()) {
	  $woords2 = addslashes($row2['word']);
      $insert_userword = "INSERT INTO `finalword`(`id`, `meaning`, `userid`, `word`, `sameid`) VALUES ('','".$meaning."','".$userid."','".$woords."','".$sameid."')";
      $conn->query($insert_userword);
      $lastword = $row2["word"];
      $sql3 ='DELETE FROM `userlastsub` WHERE word="'.$lastword.'"  AND `userid`="'.$userid.'"';
      $conn->query($sql3);
         
?>
 
    
 <!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="final.php" id="grupsubmit1" method="POST">
	<input type="hidden" name="userid" value="<?php echo $userid; ?>">
</form>
<script type="text/javascript">
	$( document ).ready(function() {
		$('#grupsubmit1')[0].submit();
		
});
</script>
</body>
</html>

 
<?php
} 
    
   
}
else
{

?>
	<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="step4.php" id="grupsubmit" method="POST">
	<input type="hidden" name="userid" value="<?php echo $userid; ?>">
</form>
<script type="text/javascript">
	$( document ).ready(function() {
		$('#grupsubmit')[0].submit();
});
</script>
</body>
</html>
	<?php
}
  
}
else
{
    ?> 
    <script>
    window.location="index.php";
    </script>
    <?php
    
}

?>