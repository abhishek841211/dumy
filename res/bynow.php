<?php
require_once 'header.php';
?>
<style>
@import url(https://fonts.googleapis.com/css?family=Calibri:400,300,700);
    
.card{
    margin:auto;
   
    max-width:450px;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
@media(max-width:768px){
    .card{
        width: 90%;
    
    }
}
.upper{
    padding: 6vh 6vh 3vh 6vh;  
}
.lower{
    padding: 4vh 0 6vh;
    text-align: center;
}
h5{
    color:blue;
    font-weight:bold;
    font-size:20px;
    font-family:arial;

}

input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 0.75rem;
    outline: none;
    width: 100%;
    min-width: unset;
    background-color: transparent;
}
#input-header
{
    color:black;
    font-weight:bold;
    font-family:arial;
}
hr{
    margin: 0;
    border-top: 2px solid rgba( 0, 0, 0, .1);
}

.btn{
    width: 50%;
    background-color: rgb(255, 38, 0);
    border-color: rgb(255, 38, 0);
    color: white;
    padding: 1.5vh 0;
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none; 
}
.btn:hover{
    color: white;
}

</style>

<div class="card">
            <div class="upper">
                <div class="row">
                    <div class="col-8 heading">
                        <h5><b>LOGIN OR SIGNUP</b></h5>
                    </div>
                    <div class="col-4">
                        <img class="img-fluid" src="https://i.imgur.com/Rzjor3M.png">
                    </div>
                </div>
                <form action="bynowprocess.php" method="post">
                    <div class="form-element">
                        <span id="input-header">Mobile No./Email ID</span>
                        <input type="text" name="mobile" id="order_id" placeholder="mobile no/email Id.....">
                    </div>
                    
                        </div>
                    </div>
                    <div class="lower">
                <button class="btn" name="submit">CONTINUE</button>
            </div>
                </form>                
            </div>       
                           
        </div>


<?php
require_once 'footer.php';
?>