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

</head>
<style>
    body
    {
        background-color:lightgray;
        margin:0px;
        padding:0px;
      
    }
   
.container
{
    width:30%;
    border:3px dotted silver;
    margin-top:100px;
    border-radius:10px 10px 10px 10px;
    text-align:center;
    background:white;
   
}
input 
{
    font-weight:bold;
    color:blue;
    background:white;
}
select option
{
    font-weight:bold;
    color:blue;
 }
#sub
{
    background-color:red;
    color:white;
    width:80px;
    border-radius: 25px;

}
#sub:hover
{
    border-radius:20px 0px 20px 0px;
    background-color:black;
    color:white;
}
img
{
    width:100%;
    height:170px;
}
</style>

<?php
<body>
    <form action="deliveryprocess.php" method="post">
        <div class="container">
         <img src="https://tse1.mm.bing.net/th?id=OIP.Qk3mpGVVtRSdMgdcxPVypAHaEO&pid=Api&P=0">
         
          <input type="text" name="full_name" placeholder="Full Name...."><br><br>
          <input type="number" name="mobile1" placeholder="Mobile Number...."><br><br>
          <input type="number" name="mobile2" placeholder="Alternet Mobile Number...."><br><br>
          <input type="number" name="pin_code" placeholder="Pine Code(ZIP Code)...."><br><br>
          <select name="state">
            <option value="state">State</option>
            <option value="bihar">Bihar</option>
            <option value="haryana">Haryana</option>
            <option value="chandigar">Chandigar</option>
            <option value="himachal pradesh">Himachal Pradesh</option>
          </select>

          <select name="city">
            <option value="city">City</option>
            <option value="chapra">Chapra</option>
            <option value="swian">Swian</option>
            <option value="sonpur">Sonpur</option>
            <option value="hajipur">Hajipur</option>
          </select><br><br>
          <input type="number" name="house_no" placeholder="House Number...."><br><br>
          <input type="text" name="road_name" placeholder="Road Name....."><br><br>
          <input type="submit"id="sub" name="submit" value="Save"><br><br>
     <a href="deliveryretrive.php">View</a>
     
          
        </div>
     </form>
</body>
</html>