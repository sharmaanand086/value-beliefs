<?php
session_start();
if (!empty($_SESSION['logged_in']))
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
//$userid=89697;
$userid=$_SESSION['logged_in'];
$word=$_POST['setvalue'];
$awords = explode(",",$word);
$inserturl='http://www.arfeenkhan.com/incredibleyou/beliefs/6wordshow.php';
 
 $insert1 = "UPDATE `lastlogin` SET `url`='$inserturl' WHERE userid='$userid'";
 $conn->query($insert1);
$selected = $awords;
 //var_dump($selected);
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
              //var_dump($convert);
              if ( is_string($convert) ) {
                  var_dump($convert);
                  
                    $insert = "INSERT INTO `b_userwordsub`(`id`, `userid`, `word`) VALUES ('','$userid','$convert')";
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
else
{
    ?> 
    <script>
    window.location="index.php";
    </script>
    <?php
    
}

?>
