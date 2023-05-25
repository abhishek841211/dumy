<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restaurantly Bootstrap Template - Index</title>  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

*, body {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;  
  margin: 0;
  padding: 0;
 
  
}

html, body {
    height: 100%;
    background: rgba(206,188,155,1);
    overflow: hidden;
}


form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      min-height: 100vh;
}


form input[type=text], form input[type=number],form input[type=file],form textarea
{
    width: 100%;
    padding: 9px 20px;
    text-align: left;
    border: 0;
    outline: 0;
    border-radius: 6px;
    background-color: #fff;
    font-size: 15px;
    font-weight: 300;
    color: #8D8D8D;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    margin-top: 16px;
    
}
form input:hover
{
    background:silver;
    color:blue;
    font-weight:bold;
}

form textarea:hover
{
    background:silver;
    color:blue;
    font-weight:bold;
}

.btn-primary{
    background-color: #6C757D;
    outline: none;
    border: 0px;
     box-shadow: none;
    margin:20px;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active{
    background-color: #495056;
    outline: none !important;
    border: none !important;
     box-shadow: none;
}
.btn-success{
    background-color: #6C757D;
    outline: none;
    border: 0px;
     box-shadow: none;  
   margin:20px;
}

.btn-success:hover, .btn-success:focus, .btn-success:active{
    background-color: #495056;
    outline: none !important;
    border: none !important;
     box-shadow: none;
}
.container
{
    background: rgba(206,188,155,5);
    border:2px solid White;
    box-shadow:10px 10px 10px black ;   
}

</style>
<body>
    <form action="event_process.php" method="post" enctype="multipart/form-data"> 
     
        <div class="container">
        <h3 id="text3d">Event Details</h3>   
            <div class="row">           
                <div class="col-md-12">
                  <input type="text" name="event_name" placeholder="Event Name..." required />
                </div>
                <div class="col-md-12">
                  <input type="number" name="price" placeholder="Cost of Event..." required />
                </div>
               
                <div class="col-md-12">
                 <textarea rows="4" cols="50" name="discription" placeholder="Input Discription....." required ></textarea>
                </div> 
                <div class="col-md-12">
                  <input type="file" name="image" placeholder="Upload Image..." required />
                </div> 
                <input type="submit" class="btn  btn-primary" name="submit" value="Save">                                   
                <div class="btn btn-success" name="submit">view</div>                                
            </div>
        </div>
    </form>
</body>
<html>