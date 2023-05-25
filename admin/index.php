<?php 
require_once('header.php');         
require_once('navbar.php');    
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Customers

                                    <br>
                                    <h2>10</h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="test.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Product

                                    <br>
                                    <h2>105</h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               <b> Book Table </b>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                   
                                        <tr>
                                        <th>ID</th>
                                            <th>Name</th>
                                            <th>Email-ID</th>
                                            <th>Mobile No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>People</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                            <th>Name</th>
                                            <th>Email-ID</th>
                                            <th>Mobile No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>People</th>
                                            <th>Message</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php
                                          $sql="SELECT * FROM book_table";
                                          $res=mysqli_query($con,$sql);
                                          $check_booktable=mysqli_num_rows($res)>0;
                                        ?>
                                        <?php
                                        if($check_booktable)
                                        {
                                            while($row=mysqli_fetch_array($res))
                                            {
                                                ?>
                                            <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo $row['c_name'];?></td>
                                            <td><?php echo $row['email_id'];?></td>
                                            <td><?php echo $row['mobile_no'];?></td>
                                            <td><?php echo $row['c_date'];?></td>
                                            <td><?php echo $row['time'];?></td>
                                            <td><?php echo $row['people'];?></td>
                                            <td><?php echo $row['message'];?></td>
                                            </tr>

                                            <?php

                                            }
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