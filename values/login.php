<html>
<head>
		<title>value</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		 <link rel="stylesheet" href="css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
	<!-- <div class="login-container">
		<div class="image-container">
		</div>
		<div class="login">
	</div> -->

	<div class="formbox">
	<div class="img_sec">
    	 <img src="images/1.jpg">
	</div>
	<div class="login-sec">
    <div class="login-form">
        <div class="login1">
           <p class="login">LOGIN</p>
            <div class="id-pass">
                    <input type="text"   name="email" id="email" placeholder="Username" class="username"  >
                    <input type="password" id="password" name="password" id="password" placeholder="Password" class="password" >
                    <input type="submit" class="start-button"   name ="submit" id="submit" value="START">
                    <div class="error" id="ack"></div> 
                    <div class="bottom-sec">
	                    <label class="comment">
	                        <input class="check" type="checkbox" checked="checked" name="remember">keep me signed in
	                    </label>
	                    <div class="forgot" data-toggle="modal" data-target="#myModal"> Forgot Password </div>
	                </div>
            </div>
        </div>
    </div>
	</div>
</div>
</div>
</body>
<script>

$("#submit").click(function()  
 {
  //alert('sfaf');
  $("#ack").css('display', 'none', 'important');
  var email= document.getElementById('email').value;
  var pass = document.getElementById('password').value;
// alert(pass );
 if(email=='' || pass=='')
          {
            $("#ack").css('display','inline','important');
            $("#ack").css("color", "red");
            $("#ack").html("Please enter your Correct username and password!");
          }
         else
          {
      $.ajax({  
        url : "getpass.php",
        data : {email:email,pass:pass},
        type : "POST",           
        beforeSend: function(){
                    $("#ack").css('display', 'inline', 'important');
                    $("#ack").html("Loading...");
                },      
        success : function(data) 
        {
        console.log(data);
        //alert(data);
                    if(data=='1'){
                        $("#ack").css('display', 'inline', 'important');
                        $("#ack").html("<font color='green'>log in</font>");
                        window.location="checkpage.php";
                    }
                    if(data=='0'){
                        $("#ack").css('display', 'inline', 'important');
                        $("#ack").html("<font color='red'>Wrong username or password!</font>");                         
                    }
                
        },
        error : function()
         {
          
        }
    });

}
  return false;
});

 
</script>

</html>
