<?php 
	include('header.php');
	
	if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
		$type=get_safe_value($conn,$_GET['type']);
		$id=get_safe_value($conn,$_GET['id']);
		if($type=='delete'){
			mysqli_query($conn,"delete from visitors where id='$id'");
			redirect('visitors.php');
		}
		
	}
	
	$sql = "select * from visitors";
	$res = mysqli_query($conn,$sql);
?>
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Visitors Master</h4>
			  <a href="manage_visitors.php" style="font-size: 26px; margin-top:15px">Add Visitor</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Visitors Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row = mysqli_fetch_assoc($res)){
						?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['mobile']?></td>
                            <td><?php echo $row['address']?></td>
                            <td><?php echo $row['in_time']?></td>
                            <td><?php echo $row['out_time']?></td>
                            <td>
                              <a href="update.php?id=<?php echo $row['id']?>"><label class="badge badge-success">Edit</label></a>
							  
                              <a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger">Delete</label></a>
							  
							  <a href="print.php?id=<?php echo $row['id']?>"><label class="badge badge-dark">View</label></a>
                            </td>
                            
                        </tr>
						<?php
						$i++;
						}}else{ ?>
						<tr>
							<td colspan="5"> No Data Found</td>
						</tr>
						<?php } ?>

                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
        </div>
<?php include('footer.php');?>