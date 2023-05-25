<?php require_once ('header.php');?>
<?php include ('connection.php');?>
<br><br><br><br><br><br><br>

  
<style>
body
{
    background-image:URL('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfKEp8mc1c9E4C4BX7--u8O09DFlgx-kXDBg&usqp=CAU');
    background-repeat:none;
    background-size:100%;
}
   
.image,img
{
    height:400px;
  width:100%;
}


.button
{
    margin:45px;
}
.btn:hover
{
    background:gray;
    opacity:0.6px;
}
</style>

<div class="container">
<?php
extract($_POST);

$id=$_GET['id'];
$sql="SELECT * FROM product_table where id=$id";
$res=mysqli_query($con,$sql);
?>


<div class="row">
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
         <div class="col-md-4">
    <div class="image">    
    <img src="http://localhost/resturant/admin/images/<?php echo $row['img1'];?>" class="menu-img" alt="">

    </div>
   <div class="button">
    <span>
       
         <button class="btn btn-warning" data-id="<?=$row['id']?>" data-image="<?=$row['img1']?>"data-p_name="<?=$row['p_name']?>" 
         data-price="<?=$row['price']?>"data-offer_price="<?=$row['offer_price']?>" data-discription="<?=$row['discription']?>"
         onclick="checkOut(this)" name="add" style="width:160px;"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>  ADD TO CART</button>
         <span><a href="bynow.php"class="btn btn-success" style="width:150px;"><i class="fa fa-bolt" aria-hidden="true"></i>  BUY Now</a></span>
        </span>
     </div>
</div>
    <div class="col-md-8">
        <div class="message"> 
            <h1><?php echo $row['p_name'];?></h1>
            <span style="font-size:20px; word-spacing:15px">
                <span id="price"><?php echo $row['price'];?>₹</span> 
                  <?php echo $row['offer_price'];?>₹
            </span> 
            <p><?php echo $row['discription'];?></p>  
             <h3>Available offers</h3>
             <ul>
                <li><i class="fa fa-tag" aria-hidden="true" style="color:green"></i> Bank OfferExtra 2% off on UPI transactions<a href="#">T&C</a></li>
                         
                <li><i class="fa fa-tag" aria-hidden="true" style="color:green"></i> Bank Offer5% Cashback on Flipkart Axis Bank Card<a href="#">T&C</a></li>
                <li><i class="fa fa-tag" aria-hidden="true" style="color:green"></i> Partner OfferGet GST Invoice Available & Save up to 28% for Business purchases on Electronics <a href="#">Know More</a></li>
                 <li><i class="fa fa-tag" aria-hidden="true" style="color:green"></i> Partner OfferBuy this product and get upto ₹500 off on Flipkart Furniture <a href="#">Know More</a></p>
             </ul>
        </div>
        <?php
    }
   
    ?>
    </div>   
    </div>
</div>   
</div>

<?php include_once 'footer.php'?>
<script>
    function checkOut(e) {
       const id = $(e).data('id');
       const p_image = $(e).data('image');
      //alert(p_image);
        const p_name = $(e).data('p_name');       
        const price = $(e).data('price');
       const offer_price = $(e).data('offer_price');
       const discription = $(e).data('discription');
       let data ='p_id='+id+'&image='+p_image+'&p_name='+p_name+'&price='+price+'&offer_price='+offer_price+'&discription='+discription;
       $.ajax({
        type:"POST",
        cache:false,
        url:"cartprocess.php",
        data:data,    // multiple data sent using ajax
        success: function (data) {
            const obj = JSON.parse(data);
            alert(obj.msg);
          $('#add').val('data sent sent');
          $('#msg').html(html);
        }
      });
    }
</script>