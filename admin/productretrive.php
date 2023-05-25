<?php 
require_once('header.php');         
require_once('navbar.php');    
?>
<style>
img
{
    width:100px;
    height:100px;
    border-radius:10px 10px 10px 10px;
}
</style>
            <div id="layoutSidenav_content">
                <main>
               
                    <div class="container-fluid px-4">
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               <b> Retrive Product Table</b>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                     <tr>
                                        <th> Sr No.</th>
                                        <th> ID </th>
                                        <th> Name </th>
                                        <th> Price</th>
                                        <th> Offer Price</th>
                                        <th> Quentity</th>
                                        <th> Discription</th>
                                        <th>Image.</th>
                                        <th>Status</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                        <tr>
                                    </thead>
                                   

                                    <tbody>
                                        <?php
                                        
                                         $sql="SELECT * FROM product_table";
                                         $display=mysqli_query($con,$sql);
                                        ?>
                                        <?php
                                        
                                          if($display)
                                          {
                                              $i=1;
                                              while($var=mysqli_fetch_assoc($display))
                                              {  
                                                $id= $var['id'];
                                                $p_name = get_data('product_table',$var['id'],'p_name')['data'];

                                                  $image= $var['img1'];
                                                  echo "<tr>";
                                                  echo "<td>".$i."</td>";
                                                  echo "<td>".$var['id']."</td>";
                                                  echo "<td>".$var['p_name']."</td>";
                                                  echo "<td>".$var['price']."</td>";
                                                  echo "<td>".$var['offer_price']."</td>";
                                                  echo "<td>".$var['quentity']."</td>";       
                                                  echo "<td>".$var['discription']."</td>";
                                                  echo "<td> <img src='images/$image'></td>";
                                                  echo "<td>".$var['Status']."</td>";
                                                  echo "<td>".$var['created_at']."</td>";
                                                  ?>

                                                <td><a href='master_process.php?task=delete_product&id= <?= $var['id'];?>'><button type='button'>
                                                  <i class='fa fa-trash' aria-hidden='true'></i>
                                                  </button></a>
                                                  
                                                  <a href="product_add.php?id=<?= $var['id'];?>"><button type='button' name='update'>
                                                  <i class='fa fa-pencil-square' aria-hidden='true'></i>
                                                  </button></a>
                                                  </td>                                            
                                               </tr>
                                                  <?php
                                                  $i++;
                                              }
                                          }
                                          else {
                                            echo  mysqli_error($con);
                                         }
                                         ?>                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </main>
<?php
require_once('footer.php');  

?>