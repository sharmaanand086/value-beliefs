<!DOCTYPE html>
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
  <h1>Register with your existing email with us </h1>
    
        <div class="form-group">
		<label for="exampleInputEmail1">Enter your Email Id:</label>
		<input type="text" class="form-control" autocomplete = "off" placeholder="Enter Contactid No" name="tag" id="tag" value="" >
		
             <label for="name">Password :</label>
		<input type="password"  class="form-control" autocomplete = "off" placeholder="Password" name="password" id="password" ></br>
                   
		<button class="btn btn-primary" type ="submit" id="submit" name ="submit">Submit</button>
		<div id="ack" style="color:red"></div><br>
		</section>
        </div>
	 
 </div>
</body>
<script>

$("#submit").click(function()  
 {
  //alert('sfaf');
    $("#ack").css('display', 'none', 'important');
  var tagname = document.getElementById('tag').value;
  var pass = document.getElementById('password').value;
  //alert(tagname);
  if(tagname==''||pass=='')
           {
            $("#ack").css('display','inline','important');
            $("#ack").html("Please enter your Register Email!");
          }
         else
          {
    $.ajax({  
        url : "ajaxregister.php",
        data : {tagname: tagname,pass:pass},
        type : "POST",
        dataType: 'json',
        success : function(data) {
                  if(data=='1'){
                        $("#ack").css('display', 'inline', 'important');
                         $("#ack").html("<font color='green'>Email Found ! Now you can Login with your email and password</font>");
                         window.location='index.php';
                    }
                    if(data=='0'){
                        $("#ack").css('display', 'inline', 'important');
                        $("#ack").html("<font color='red'>Email doesn't Register!</font>");                         
                    }
                          
        },
        error : function() {
        }
    });
}

});

 
 
</script>

</html>
