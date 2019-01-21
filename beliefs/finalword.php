<?php
session_start();
if (! empty($_SESSION['logged_in']))
{
$servername = "localhost";
$username = "root";
$password = "xxxxxxxxx";
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

$sql = 'SELECT * FROM `b_words` WHERE word="'.$word.'"';
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
	    $woords = addslashes($row['word']);
      $insert_userword = "INSERT INTO `b_finalword`(`id`, `userid`, `word`)  VALUES ('','".$userid."','".$woords."')";
      $conn->query($insert_userword);
     
	}
$sql1 ='DELETE FROM `b_userwordsub` WHERE word="'.$word.'"  AND `userid`="'.$userid.'"';
$conn->query($sql1);

$sql2 = 'SELECT * FROM `b_userwordsub` WHERE  `userid`="'.$userid.'"';
$result2 = $conn->query($sql2);
$rowcount=mysqli_num_rows($result2);
var_dump($rowcount);
    
if ($rowcount == 1) {
     $inserturl='http://www.arfeenkhan.com/incredibleyou/beliefs/wordvalue.php';
 
     $insert1 = "UPDATE `lastlogin` SET `url`='$inserturl' WHERE userid='$userid'";
     $conn->query($insert1);
	while($row2 = $result2->fetch_assoc()) {
	  $woords2 = addslashes($row2['word']);
      $insert_userword = "INSERT INTO `b_finalword`(`id`, `userid`, `word`)  VALUES ('','".$userid."','".$woords2."')";
      $conn->query($insert_userword);
      $lastword = $row2["word"];
      $sql3 ='DELETE FROM `b_userwordsub` WHERE word="'.$lastword.'"  AND `userid`="'.$userid.'"';
      $conn->query($sql3);
         
?>
 
    
 <!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="wordvalue.php" id="grupsubmit1" method="POST">
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
<form action="6wordshow.php" id="grupsubmit" method="POST">
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