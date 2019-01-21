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
		<span id="countid">0</span>/24
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
					<p>step <span>2</span></p>
				</div>
				<div class="step_desc">
					<p>Your selected values are grouped together below based on their meanings. So all the words that fall under a same fundamental meaning, are arranged in one group. Go ahead and select another values from the groups below. </p>
				</div>
			</div>
		</div>
	</div>
	<div class="second-sec">
	    	<?php
	$a=0;
	$count=0;
	$b=0;
	$query = "SELECT * FROM word WHERE sameid='".$a."'";
	$result1 = $conn->query($query);
	$rowcount1=mysqli_num_rows($result1);
	while ($a <= 34)
	{
		$a++;
		$sql = "SELECT * FROM userwordmain WHERE useid='".$userid."' AND sameid='".$a."'";
		$result = $conn->query($sql);
		$rowcount=mysqli_num_rows($result);
		?>
		<div class="groups" id="groupid<?php echo $a; ?>">
			<?php
			if ($rowcount == 1 && $rowcount1 ==0) {
			//$b++;
			?>
			 
		   <p class="group_name" style="text-align:center; display:none;">Values Group <span>  </span></p>
			
		     <?php
		
			}elseif($rowcount == 0 && $rowcount1 ==0){
			?>
		     <script>
						    $( document ).ready(function() {
                               var id="<?php echo $a; ?>";
                               var displaynone = "#groupid"+id;
                               $(displaynone).hide();
                            });
						</script>
			<p class="group_name" style="text-align:center; display:none;border:">Values Group <span> <?php echo $b; ?></span></p>
			
			<?php
			}else{
			$b++;
			?>
		 
			<p class="group_name" >Values Group <span> <?php echo $b; ?></span></p>
			
			    
		<?php	} ?>
		
			<ul class="box">
			    	<?php
	 
		while($row = $result->fetch_assoc()) {
			if ($row["sameid"] == $a) {
				if($rowcount == 1){
						?>
				<li style="color:#8f8f8f;"><p class="wordclass" style="color:red;display:none;"  title="<?php echo  $row["meaning"]; ?>"><?php echo  $row["word"]; ?></p></li>
					<?php
						}
				else{
					?>
							<li style="color:#8f8f8f;"><p class="wordclass" title="<?php echo  $row["meaning"]; ?>"><?php echo  $row["word"]; ?></p></li>
						<?php
				}
			} 

		} 
		?>
			</ul>
		</div>
		
			<?php
	}
?>
<div  class="groups">
    <p class="group_name" >Values Group <span><?php echo $b+1; ?></span></p>
    	 	<ul class="box">
    		<?php
    		$b=0;
    	while($b<34){
    	$b++;
    	$sql2 = "SELECT * FROM userwordmain WHERE useid='".$userid."' AND sameid='".$b."'";
		$result2 = $conn->query($sql2);
		$rowcount2=mysqli_num_rows($result2);
		while($row2 = $result2->fetch_assoc()) {
			if ($row2["sameid"] == $b) {
				if($rowcount2 == 1){
						?>
						<script>
						    $( document ).ready(function() {
                               var id="<?php echo $row2["sameid"]; ?>";
                               var displaynone = "#groupid"+id;
                               $(displaynone).hide();
                            });
						</script>
							<li style="color:#8f8f8f;"><p class="wordclass" id="" title="<?php echo  $row2["meaning"]; ?>"   ><?php echo  $row2["word"]; ?></p></li>
						
						<?php
						}
			 
			} 

		} 
    }
		?>
		</ul>
    	
</div>
</div>
 <div class="footer">
        <form action="wordsecond.php" method="post" id="subscription_order_form">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        <input type="hidden" id="setvalue" name="setvalue" />
        </form>
        <button class="submit" id="submit_word" type="button" value="Next" >Next</button>
        </div>
	 <!--<input class="submit" type="button" value="Next" onclick="msg()">-->
    

<script>
 

</script>
</body>
</html>
<script >
 var values = [];
 var count = 0;
$( function() {
  $('li').click( function() {
      //var text_style=$(this).css("color");
     // alert(text_style);
      if(count == 24)
      {
          
          var text_style=$(this).css("color");
          //alert(text_style);
         if(text_style == 'rgb(143, 143, 143)')
            {
                
             values = values.filter(x => x != $(this).children('.wordclass').text());
          //	count--;
          //	alert(values);
          	 //$(this).children().toggleClass("red-cell");
          	 $(this).toggleClass("red-cell");
             document.getElementById("setvalue").value = values;
             $("#countid").html(count);
            } 
      }
      else
      {
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
	if(count == 24 ){
		$('#subscription_order_form')[0].submit();
	}else{
		alert('select atleast 24 words');
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