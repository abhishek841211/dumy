
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> 
   <style>
@import "bourbon";

body
{
    background-image:url('img1.jpg');
    background-repeat:no-repeat;
    background-size:100%;
}
h2{
    font-size:25px;
    color:green;
    font-family:Calibri;
    font-weight:bold;
}
.wrapper {	
	margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-image: linear-gradient(to right, rgba(255,0,0,0.4),rgb(100,149,237));
  
  /* border: 1px solid rgba(0,0,0,0.1);   */
  }
  img
  {
    width:100px;
    height:100px;
    border-radius:50%;
    opacity:0.8;
  }
 
</style>
</head>
<body>
<div class="wrapper">
    <form class="form-signin" action="loginprocess.php" method="post" enctype="multipart/form-data">       
      <center><img src="https://tse3.mm.bing.net/th?id=OIP.mrfb_atnkblnmsDiAbLNKwHaHa&pid=Api&P=0" ></center>
    <h2 class="form-signin-heading">Please login</h2>
      <input type="number" class="form-control" name="username" placeholder="User ID....(Mobile Number..)" required="" autofocus="" /><br>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/> <br>     
      <label class="checkbox" onclick="mybut()">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe" > Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" name="submit" id="submit" type="submit" disabled >Login</button>   
      <p style="font-weight:bold">Don't have an account yet? <a href="registration.php">Create New Account</a></p>
      <p style="float:right"><a href="forgetsearch1form.php">Forget Password</a></p>
    </form>
  </div>

   <script>
        function mybut()
        {
          
          if(document.getElementById("rememberMe").checked)
          {
            document.getElementById("submit").disabled =false;
          }
          else{
            document.getElementById("submit").disabled =true; 
          }
        } 
    </script>
</body>
</html>