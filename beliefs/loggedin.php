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
$sql = "SELECT * FROM b_words";
$result = $conn->query($sql);
//print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Incredible you</title>
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
</style>
</head>
<body>
   	<div>
		<span id="countid">0</span>/24
	</div>
	<div class="main-section">
	     <a herf="http://www.arfeenkhan.com/incredibleyou/beliefs/logout.php" id="logout" style="float:right;font-size:20px;font-color:#fff;margin:10px;text-decoration:none">logout</a>
		<div class="row" style="margin:0px;">
			<div class="container">
				<div class="section1">
					<ul>
						<?php
						while($row = $result->fetch_assoc()) {
						?>
						<li style="cursor:pointer;" ><p class="wordclass"><?php echo $row["word"]; ?></p></li>
						<?php
						}
						?>
					</ul>

				</div>
				<div class="footer">
					<form action="b_groupword1.php" method="post" id="subscription_order_form">
						<input type="hidden" name="userid" value="<?php echo $_SESSION['logged_in']; ?>">
						<input type="hidden" id="setvalue" name="setvalue" />
					</form>
					<button id="submit_word" >submit</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		var values = [];
		var count = 0;
$( function() {
  $('li').click( function() {
      if(count == 24){
           var text_style=$(this).css("color");
          
         if(text_style == 'rgb(255, 0, 0)')
            {
                
             values = values.filter(x => x != $(this).children('.wordclass').text());
          	count--;
          	$(this).toggleClass("red-cell");
             document.getElementById("setvalue").value = values;
             $("#countid").html(count);
            } 
          
      }else{
          
            $(this).toggleClass("red-cell");
            var text_style=$(this).css("color");
            if(text_style == 'rgb(255, 0, 0)')
            {
             values.push($(this).children('.wordclass').text());
             count++;
            }
            else{
            	values = values.filter(x => x != $(this).children('.wordclass').text());
            	count--;
            }
            document.getElementById("setvalue").value = values;
             $("#countid").html(count);
           //alert(values);
      }
    
  } );
} );

$( "#submit_word" ).click(function() {
	if(count == 24 ){
		$('#subscription_order_form')[0].submit();
	}else{
		alert('select 24 ');
	}
  
});

$(function(){
    $('#logout').click(function(){
       // alert('jljasdf');
       window.location="logout.php";
    });
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