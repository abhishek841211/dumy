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

body {
	background: #eee !important;	
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
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);  
  }
  img
  {
    width:100px;
    height:100px;
  }
 
</style>
</head>
<body>
<div class="wrapper">
    <form class="form-signin" action="forgetsearch1page.php" method="post" enctype="multipart/form-data">       
      <center><img src="https://tse1.mm.bing.net/th?id=OIP.Z1bbnX3-kQnRKMy1GwhQ_QHaHa&pid=Api&rs=1&c=1&qlt=95&w=120&h=120" ></center>
    <h2 class="form-signin-heading">Forget Password</h2>
      <input type="text" class="form-control" name="username" placeholder="Full Name...." required="" autofocus="" /><br>
      <input type="text" class="form-control" name="email_id" placeholder="email id..." required=""/> <br>     
      <input type="number" class="form-control" name="mobile_number" placeholder="mobile number..." required=""/> <br>     

      <label class="checkbox" onclick="mybut()">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe" > Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" name="submit" id="submit" type="submit" disabled >Submit</button>   
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