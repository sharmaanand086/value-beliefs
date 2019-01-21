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
    	<div>
		<span id="countid">0</span>/6
	</div>
	<div class="header-sec">
		<div class="container-fluid">
			<div class="header">
				<p>Coach to a Fortune  |  Discover your inner DNA </p>
				<p><?php $name= $_SESSION["name"] ;  echo $name ?></p>
			</div>
		</div>
		<div class="step">
			<div class="container-fluid step_arg">
				<div class="step_no">
					<p>step <span>3</span></p>
				</div>
				<div class="step_desc">
					<p>Your selected values are grouped together below based on their meanings. So all the words that fall under a same fundamental meaning, are arranged in one group. Go ahead and select another values from the groups below. </p>
				</div>
			</div>
		</div>
	</div>
	<div class="second-sec">
	  <?php
		$sql = "SELECT * FROM userwordsub WHERE userid='".$userid."'";
		$result = $conn->query($sql);
		//var_dump($result);
		?>
		<div class="groups" style="text-align: center;">
		 	<?php
		while($row = $result->fetch_assoc()) {
						?>
			<ul class="box" style="width: 20%;">
			     
				<li style="color:#8f8f8f;"><p class="wordclass"    title="<?php echo  $row["meaning"]; ?> "><?php echo  $row["word"]; ?></p></li>
				 
			</ul>
							
						<?php
		} 
		?>
		</div>
		
 
</div>
  <div class="footer">
<form action="wordthird.php" method="post" id="subscription_order_form">
<input type="hidden" name="userid" value="<?php echo $userid; ?>">
<input type="hidden" id="setvalue" name="setvalue" />
</form>
<button class="submit"  value="Next" id="submit_word"> Next</button>
</div>
 
</body>
</html>
<script >
 	var values = [];
    var count = 0;
$( function() {
  $('li').click( function() {
      if(count == 6){
         var text_style=$(this).css("color");
          //alert(text_style);
         if(text_style == 'rgb(143, 143, 143)')
            {
             values = values.filter(x => x != $(this).children('.wordclass').text());
          	//count--;
          	//$(this).children().toggleClass("red-cell");
          	 $(this).toggleClass("red-cell");
              document.getElementById("setvalue").value = values;
             $("#countid").html(count);
            } 
      }else{
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
     $("#countid").html(count);  
    }
  } );
} );


$( "#submit_word" ).click(function() {
	if(count ==  6){
		$('#subscription_order_form')[0].submit();
	}else{
		alert('select Only 6 Word');
	}
  
});

$(function(){
    $('#logout').click(function(){
       // alert('jljasdf');
       window.location="logout.php";
    });
});
</script>

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