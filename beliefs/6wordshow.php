<?php
session_start();
if (! empty($_SESSION['logged_in']))
{
$userid=$_SESSION['logged_in'];
$servername = "localhost";
$username = "xxxxxxxxxx";
$password = "xxxxxxxx";
$dbname = "worldsuc_incredibleyouvalue";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//var_dump($userid);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">
	<style>
	.box{
		width:100%;
		border:1px solid #000;
		/*display:inline-block;*/
	}
	.one{
    width: 100%;
    display: inline-block;
}
	.wordclass {
       margin: 1%;
    float: left;
    text-align: center;
    cursor: pointer;
}
.one li.red-cell {
    color: #F00; /* Or some other color */
}
li{
	list-style: none;
}
</style>
<script>$(function(){
    $('#logout').click(function(){
       // alert('jljasdf');
       window.location="logout.php";
    });
});</script>
</head>
<body>
	<div>
		<span id="countid">0</span>/6
	</div>
 
    
	<div class="main-section">
	     <a herf="http://www.arfeenkhan.com/incredibleyou/beliefs/logout.php" id="logout" style="float:right;font-size:20px;font-color:#fff;margin:10px;text-decoration:none">logout</a>
		<div class="row" style="margin:0px;">
			<div class="container">
				<div class="section1">
					<ul>
						<?php
						$sql = "SELECT * FROM b_userwordsub WHERE  userid='".$userid."'";
                        $result = $conn->query($sql);
						while($row = $result->fetch_assoc()) {
						?>
						<li style="cursor:pointer;" ><p class="wordclass" ><?php echo $row["word"]; ?></p></li>
						<?php
						}
						?>
					</ul>

				</div>
				<div class="footer">
				<form action="finalword.php" method="post" id="subscription_order_form">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <input type="hidden" id="setvalue" name="setvalue" />
                </form>
                <button style="display:none" id="submit_word" >submit</button>
				</div>
			</div>
		</div>
	</div>
 
 
<script type="text/javascript">
	$( function() {
		$('li').click( function() {
			$(".wordclass").css("color","black");
			$(this).children('.wordclass').css("color","red");
			values = $(this).children('.wordclass').text();
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