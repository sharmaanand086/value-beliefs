<html>
<title></title>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

</head>
<body>
<div class="container">
  <h1>Login  </h1>
   	 
        <div class="form-group">
		<label for="exampleInputEmail1">Email and contactid :</label>
		<input type="text" class="form-control"   placeholder="Enter Contactid No" name="email" id="email" value="" >		
             <label for="name">Password:</label>
		<input type="password"  class="form-control"   placeholder="Password" name="password" id="password" > 
		 
		<br>
		<button class="btn btn-primary" type ="submit" name ="submit" id="submit" >Submit</button> 
		<div id="ack"></div>
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
 //alert(pass );
 if(email=='' || pass=='')
           {
            $("#ack").css('display','inline','important');
            $("#ack").html("Please enter your username and password!");
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
