<?php

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
session_start();
if (! empty($_SESSION['logged_in']))
{
    $user = $_SESSION['logged_in'];
   // echo $user;
$query = "SELECT * FROM `lastlogin` WHERE userid='$user'";
$result = $conn->query($query);

   if ($result->num_rows > 0) {
       // echo "hello";
     while($row = $result->fetch_assoc()){
               //echo "hello";
              $geturl =  $row['url'];
              // var_dump($geturl);
        
    }
   }
    ?>

<script>
    window.location="<?php echo $geturl; ?>";
 </script>
 <?php
}
else
{
    
   // echo "login";
  
    ?> 
    <script>
    window.location="index.php";
    </script>
    <?php
    
}

?>