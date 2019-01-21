<?php
session_start();
if (!empty($_SESSION['logged_in']))
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
$aword = explode(",",$word);
$inserturl='http://www.arfeenkhan.com/incredibleyou/values/mobile/step2.php';
$insert1 = "UPDATE `vmb_lastlogin` SET `url`='$inserturl' WHERE userid='$userid'";
 $conn->query($insert1);
 $inserturl2='http://www.arfeenkhan.com/incredibleyou/values/step2.php';
$insert2 = "UPDATE `v_lastlogin` SET `url`='$inserturl2' WHERE userid='$userid'";
 $conn->query($insert2);
//var_dump(array_count_values($aword));
foreach ($aword as $key) {
//var_dump($key);
	$sql = "SELECT * FROM word WHERE word LIKE '%$key%'";
	$result = $conn->query($sql);
	//var_dump($result);
	while($row = $result->fetch_assoc()) {
      $insert_userword = "INSERT INTO `userwordmain`(`id`, `meaning`, `useid`, `word`, `sameid`) VALUES ('','".$row["meaning"]."','".$userid."','".$row["word"]."','".$row["sameid"]."')";
      $conn->query($insert_userword);
	}
}
//echo  "insert done";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="step2.php" id="grupsubmit" method="POST">
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
else
{
    ?> 
    <script>
    window.location="index.php";
    </script>
    <?php
    
}

?>