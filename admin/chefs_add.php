
 <?php 
require_once('header.php');         
require_once('navbar.php');  

$table='chefs';

if(isset($_GET['id']) and $_GET['id']!='')
{
	$res2 = get_data($table,$_GET['id']);
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
       <h1>  ➕ ADD EVENT</h1>   
        <form action="master_process.php ? task=chefs_update" method="post" enctype="multipart/form-data">
              <div class="mb-3">    
               <input type="text" class="form-control" id="name" value="<?= $id?>" name="id" >
              </div> 
            <div class="mb-3">
               <label for="name" class="form-label">Chefs Name</label>
               <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>"  placeholder="Chefs Name...."required>
             </div>
             <div class="mb-3">
               <label for="price" class="form-label">Email ID</label>       
               <input type="email"class="form-control" id="email" value="<?= $email_id?>"  name="email_id" placeholder="Enter Email ID...." required >
             </div>
             <div class="mb-3">
               <label for="price" class="form-label">Mobile Number</label>       
               <input type="phone"class="form-control" id="mobile" value="<?= $mobile_no?>"  name="mobile_no" placeholder="Enter Mobile Number...." required >
             </div>
           
             <div class="mb-3">
               <label for="textarea" class="form-label">Work </label>
               <textarea rows="2" class="form-control" id="textarea" cols="22"  name="work_name"placeholder="Enter Work Name...." required ><?= $work_name ?></textarea>

             </div>
             <div class="mb-3">
             
               <label for="image" class="form-label">Chefs Image</label><br>
               <img src="images/<?= $image?> "height="200px" width="300px"/>
               <input type="file" class="form-control" id="img1"name="image" >
            
             </div>
             <button type="submit"   class="btn btn-primary">Submit</button>
           </form>
</div>
    </main>
    </div>

<?php require_once ('footer.php');?>
