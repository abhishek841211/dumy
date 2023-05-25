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
                               <b> Retrive Chefs Table</b>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                     <tr>
                                        <th> Sr No.</th>
                                        <th> ID </th>
                                        <th>Chefs  Name </th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>                                      
                                        <th>Work Name</th>
                                        <th>Image.</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                        <tr>
                                    </thead>
                                   

                                    <tbody>
                                        <?php
                                        
                                         $sql="SELECT * FROM chefs";
                                         $display=mysqli_query($con,$sql);
                                        ?>
                                        <?php
                                        
                                          if($display)
                                          {
                                              $i=1;
                                              while($var=mysqli_fetch_assoc($display))
                                              {  
                                                $id= $var['id'];
                                                $chefs_name = get_data('chefs',$var['id'],'name')['data'];

                                                  $image= $var['image'];
                                                  echo "<tr>";
                                                  echo "<td>".$i."</td>";
                                                  echo "<td>".$var['id']."</td>";
                                                  echo "<td>".$var['name']."</td>";
                                                  echo "<td>".$var['email_id']."</td>";
                                                  echo "<td>".$var['mobile_no']."</td>";                                                     
                                                  echo "<td>".$var['work_name']."</td>";
                                                  echo "<td> <img src='images/$image'></td>";
                                                  echo "<td>".$var['status']."</td>";
                                                  echo "<td>".$var['created_at']."</td>";
                                                  echo "<td>".$var['updated_at']."</td>";
                                                  ?>

                                                <td><a href='master_process.php?task=delete_chefs&id= <?= $var['id'];?>'><button type='button'>
                                                  <i class='fa fa-trash' aria-hidden='true'></i>
                                                  </button></a>
                                                  
                                                  <a href="chefs_add.php?id=<?= $var['id'];?>"><button type='button' name='update'>
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