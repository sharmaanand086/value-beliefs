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
//$userid=89697;
$userid=$_SESSION['logged_in'];
$word=$_POST['setvalue'];
$aword = explode(",",$word);
$inserturl='http://www.arfeenkhan.com/incredibleyou/values/mobile/step3.php';
$insert1 = "UPDATE `vmb_lastlogin` SET `url`='$inserturl' WHERE userid='$userid'";
 $conn->query($insert1);
 $inserturl2='http://www.arfeenkhan.com/incredibleyou/values/step3.php';
$insert2 = "UPDATE `v_lastlogin` SET `url`='$inserturl2' WHERE userid='$userid'";
 $conn->query($insert2);
foreach ($aword as $key) {
	//var_dump($key);
	$sql = "SELECT * FROM word WHERE word LIKE '%$key%'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		//var_dump($row["word"]);
      $insert_userword = "INSERT INTO `userwordsub`(`id`, `userid`, `word`, `meaning`, `sameid`) VALUES ('','".$userid."','".$row["word"]."','".$row["meaning"]."','".$row["sameid"]."')";
      $conn->query($insert_userword);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="step3.php" id="grupsubmit" method="POST">
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