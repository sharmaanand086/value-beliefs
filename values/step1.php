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
$sql = "SELECT * FROM word";
$result = $conn->query($sql);
//print_r($_SESSION);
$name= $_SESSION["name"] ;
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>values</title>
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- <div>-->
	<!--	<span id="countid">0</span>/24-->
	<!--</div>-->
	<div class="header-sec">
		<div class="container-fluid">
			<div class="header">
				<p>Coach to a Fortune  |  Discover your inner DNA</p>
				<p><?php echo $name ?></p>
			</div>
		</div>
		<div class="step">
			<div class="container-fluid step_arg">
				<div class="step_no">
					<p>step <span>1</span></p>
				</div>
				<div class="step_desc">
					<p>Below, you will see all the baselines, all possible values a human could have. Go through them and select the ones that you think are most important to you. You must select at least 24 values to proceed ahead.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		
	</div>
		<div class="main-sec">
			<div class="examples">
				<div class="container-fluid">
				<ul class="box">
				    <?php
						while($row = $result->fetch_assoc()) {
						?>
				     <li  style="color:#8f8f8f;"><p class="wordclass" title="<?php echo $row["meaning"]; ?>"><?php echo $row["word"]; ?></p></li>
    				<?php
    				}
    				?>
			</ul>
			</div>
			</div>
		</div>
			<div class="footer">
					<form action="groupword.php" method="post" id="subscription_order_form">
						<input type="hidden" name="userid" value="<?php echo $_SESSION['logged_in']; ?>">
						<input type="hidden" id="setvalue" name="setvalue" />
					</form>
					<button id="submit_word" class="submit" value="Next" >Next</button>
				</div>
		<!--<input class="submit" type="button" value="Next" onclick="msg()">-->
</body>
<script>
		var values = [];
		var count = 0;
$( function() {
  $('li').click( function() {
     var text_style=$(this).css("color");
   // alert(text_style);
    if(text_style == 'rgb(143, 143, 143)')
    {
     values.push($(this).children('.wordclass').text());
     count++;
    }
    else{
    	values = values.filter(x => x != $(this).children('.wordclass').text());
    	count--;
    }
   $(this).toggleClass("red-cell");
    $(this).children().toggleClass("red-cell");
    document.getElementById("setvalue").value = values;
  } );
} );

$( "#submit_word" ).click(function() {
	if(count > 	25){
	  //alert('You have selected more than 25 words');
		$('#subscription_order_form')[0].submit();
	}else{
		alert('select 24 atleast');
	}
  
});

$(function(){
    $('#logout').click(function(){
       // alert('jljasdf');
       window.location="logout.php";
    });
});
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