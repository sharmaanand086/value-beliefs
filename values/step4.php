<?php
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
session_start();
if (! empty($_SESSION['logged_in']))
{
 $userid = $_SESSION['logged_in'];
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<title>value</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		 <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="header-sec">
		<div class="container-fluid">
			<div class="header">
				<p>Coach to a Fortune  |  Discover your inner DNA</p>
				<p><?php $name= $_SESSION["name"] ;  echo $name ?></p>
			</div>
		</div>
		<div class="step">
			<div class="container-fluid step_arg">
				<!-- <div class="step_no">
					<p>step <span>2</span></p>
				</div> -->
				<div class="step_desc">
					<p>If you had to kept just one value and give up the rest, which one would you keep?</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid final_step">
		<div class="row">
		     <?php
		$sql = "SELECT * FROM `userlastsub` WHERE userid='".$userid."'";
		$result = $conn->query($sql);
		//var_dump($result);
		 	while($row = $result->fetch_assoc())
			{
			
			?>
			<div class="col-md-4 final" > <p class="wordclass" title="<?php echo  $row["meaning"]; ?> "><?php echo  $row["word"]; ?></p>	</div>
			<?php
    		} 
    		?>
			 
		</div>

	</div>
		<div class="footer">
				<form action="finalword.php" method="post" id="subscription_order_form">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <input type="hidden" id="setvalue" name="setvalue" />
                </form>
                <button style="display:none" id="submit_word" >submit</button>
				</div>
</body>
<script>
		$( function() {
		$('.final').click( function() {
		    //alert('dasf');
           	$(".wordclass").css("color","black");
			$(this).children('.wordclass').css("color","red");
			values = $(this).children('.wordclass').text();
			//alert(values);
		  	document.getElementById("setvalue").value = values;
			 var count = document.getElementById("setvalue").value;
			  
			  
	if(count ==	""){
		alert('SELECT any one');
	}else{
		$('#subscription_order_form')[0].submit();
	}
		  } );
} ); 
</script>
</html>


 <?php
}
else
{
    ?> 
    <script>
   window.location="login.php";
    </script>
    <?php
    
}

?>