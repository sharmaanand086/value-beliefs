<?php
session_start();
if (!empty($_SESSION['logged_in']))
{
 //print_r($_SESSION);
$servername = "localhost";
$username = "root";
$password = "xxxxxxxxx";
$dbname = "worldsuc_incredibleyouvalue";
                      
// Create connection
//$con=mysqli_connect($servername, $username, $password, $dbname);
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$userid=$_SESSION['logged_in'];
$word=$_POST['setvalue'];
$inserturl='http://www.arfeenkhan.com/incredibleyou/beliefs/b_groupwordshow.php';
//var_dump($url);
$awords = explode(",",$word);
$selected = $awords;
 //var_dump($selected);
 
 $insert1 = "UPDATE `lastlogin` SET `url`='$inserturl' WHERE userid='$userid'";
 $conn->query($insert1);
                      
 foreach($selected as $key=>$value){
        //var_dump($value);
      $sql = 'SELECT * FROM `b_words` WHERE word="'.$value.'"';
	  $result = $conn->query($sql);
	   if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
               // echo  "" . $row["word"]. "  <br>";
              $words =  $row["word"];
              $convert =addslashes($words);
              if ( is_string($convert) ) {
                  //var_dump($convert);
                      $insert = "INSERT INTO `b_userwordmain`(`id`, `userid`, `word`) VALUES ('','$userid','$convert')";
                      $conn->query($insert);
                } else {
                    echo 'not a string';
                }
               
        }
    }   
  }
  echo"inserted";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<form action="b_groupwordshow.php" id="grupsubmit" method="POST">
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