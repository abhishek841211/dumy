<?php
  require_once ('function.php');
  $table ='registration1';
?>
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
.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}
.card-registration .select-arrow {
top: 13px;
}
label
{
  color:darkblue;
  font-weight:bold;
}
</style>
</head>
<body>
<section class="h-100 bg-dark">
  <form action="master_process.php ? task=registration" method="post"  enctype="multipart/form-data">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block">
              <img src="https://images.pexels.com/photos/3887985/pexels-photo-3887985.jpeg?auto=compress&cs=tinysrgb&w=600"
                alt="Sample photo" class="img-fluid mt-5 ml-3"
                style="border-top-left-radius: .125rem; border-bottom-left-radius: .25rem;height:600px;width:100%" />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
                <center><h3 class="mb-5 text-uppercase">Registration Form</h3>

                <div class="row">
                  <div class="col-md-12 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1m" placeholder="Your Name..." required name="full_name" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m">Full Name</label>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <div class="form-outline">
                      <input type="phone" id="form3Example1m"placeholder="Your Mobile No..." required name="mobile_number" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m">Mobile No </label>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <div class="form-outline">
                      <input type="email" id="form3Example1m"placeholder="Your Email ID..." required name="email_id" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m">Email ID </label>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <div class="form-outline">
                      <input type="password" id="form3Example1m"placeholder="Input Password... (max-length 8 charactor)" maxlength="9" required name="password" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m">Password </label>
                    </div>
                  </div>
               
               

                <div class="row">              
                <div class="d-flex justify-content-end ">
                <button type="submit" class="btn btn-warning btn-lg ms-2 mt-5 ml-5 ">Submit form</button>
                <a href="login.php"><button type="button" class="btn btn-warning btn-lg ms-2 mt-5 ml-5">
                  Sing Up</button></a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</section>

</body>
</html>