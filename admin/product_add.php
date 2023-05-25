<?php 
require_once('header.php');         
require_once('navbar.php');  

$table='product_table';

if(isset($_GET['id']) and $_GET['id']!='')
{
	$res2 = get_data($table, $_GET['id']);
}

else{
	$res  = insert_row($table);
	$res2  = get_data($table, $res['id']);
}

if($res2['count']>0)
{
extract($res2['data']);
}

?>
<style>
h1{
    color:blue;
    padding:10px;
}
</style>
 <div id="layoutSidenav_content">
     <main>
        <div class="container-fluid px-4">
       <h1>  ➕ ADD PRODUCT</h1>   
        <form action="master_process.php ? task=product_update" method="post" enctype="multipart/form-data">
              <div class="mb-3">
               
               <input type="hidden" class="form-control" id="name"name="id" value="<?= $id ?>">
              </div> 
            <div class="mb-3">
               <label for="name" class="form-label">Name</label>
               <input type="text" class="form-control" id="name"name="p_name" value="<?= $p_name ?>" placeholder="Product Name...."required>
             </div>
             <div class="mb-3">
               <label for="price" class="form-label">Price</label>       
               <input type="number"class="form-control" id="price" name="price"value="<?= $price ?>" placeholder="Product Price...." required >
             </div>
             <div class="mb-3">
               <label for="offer_price" class="form-label">Offer Price</label>
               <input type="number"class="form-control" id="offer_price" name="offer_price"value="<?= $offer_price ?>" placeholder="Offer Price...." required >
             </div>
             <div class="mb-3">
               <label for="quentity" class="form-label">Quentity</label>
               <input type="number"  class="form-control" id="quentity"name="quentity"value="<?= $quentity ?>" placeholder="Product Quentity...." required >
             </div>
             <div class="mb-3">
               <label for="textarea" class="form-label">Discription</label>
               <textarea rows="2" class="form-control" id="textarea" cols="22" name="discription"placeholder="Discription...." required ><?= $discription ?>"</textarea>

             </div>
             <div class="mb-3">
             
               <label for="image" class="form-label">Product Image</label><br>
               <img src='images/<?= $img1?>' width='200px' height='150px'><br>
               <input type="file" class="form-control" id="img1"name="img1" >
            
             </div>
             <button type="submit"name="submit"  class="btn btn-primary">Submit</button>
           </form>
</div>
    </main>
    </div>
