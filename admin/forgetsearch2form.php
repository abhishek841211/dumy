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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    *
    {
        margin:0px;
        padding:0px;
    }
.gradient-custom-3 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
}
section
{
    background-repeat: no-repeat;
    background-size:100%;
}
    </style>
</head>
<body>
<form action="forgetsearch2update.php" method="post">
<section class="vh-100 bg-image"style="background-image: url('https://images.pexels.com/photos/33041/antelope-canyon-lower-canyon-arizona.jpg?auto=compress&cs=tinysrgb&w=600');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Update Password</h2>

              <form>

                <div class="form-outline mb-4">
                  <input type="tel" id="form3Example1cg" name="mobile_number" class="form-control form-control-lg" placeholder="User ID(mobile Number...)" />
                  <label class="form-label" for="form3Example1cg">User ID</label>
                </div>


                <div class="form-outline mb-4">
                  <input type="password" id="user_password" name="password"  placeholder="password...." class="form-control form-control-lg" />
                  <label class="form-label" for="user_password">Password</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="confirm_password" placeholder="Confirm password...." class="form-control form-control-lg" />
                  <label class="form-label" for="confirm_password">Repeat your password</label>
                </div>

                <div class="form-checkjustify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="check" onclick="mybut()" />
                  <label class="form-check-label" for="check">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>

                <input type="submit" name="submit" id="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Save" disabled>

               
                <!-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>

<script>
        function mybut()
        {
          
          if(document.getElementById("check").checked)
          {
            document.getElementById("submit").disabled =false;
          }
          else{
            document.getElementById("submit").disabled =true; 
          }
        } 
    </script>

<script>
    $("#confirm_password").on("blur",function(){
        var cn_pass=$("#confirm_password").val();
        var pass=$("#user_password").val();
        if(cn_pass!=pass)
        {
          swal("Passwords do not match. plz re-enter Password....");        

        }
      
    });
</script>

</body>
</html>