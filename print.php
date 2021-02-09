<?php
include('header.php');
	
		$msg="";
	$name="";
	$mobile="";
	$address="";
	$in_time="";
	$out_time="";
	
	if(isset($_GET['id']) && $_GET['id']>0){
		$id=get_safe_value($conn,$_GET['id']);
		$row=mysqli_fetch_assoc(mysqli_query($conn,"select * from visitors where id='$id'"));
		$name=$row['name'];
		$mobile=$row['mobile'];
		$address=$row['address'];
		$in_time=$row['in_time'];
		$out_time=$row['out_time'];
	}
?>
	
	<style>
	table, th, td {
	  border: 1px solid black;
	  border-collapse: collapse;
	}
	th, td {
	  padding: 5px;
	  text-align: left;    
	}
	</style>
			
			<div class="row" style="margin-top:100px">
				<div class="col-md-4" style=" height:400px">
					<!--<div class="col-sm-12" style="text-align:-webkit-left; margin-left:191px; margin-top:79px">
						<span><img src="img/no-image-found.jpg" class="img-responsive" style="width:151px; height:150px;" id="output_image2"/></span>
						<button class="btn btn-primary">click</button>
					</div>-->
				</div>
				
				<div class="col-md-6" style="background-color:; height:auto">
					<div class="Wnr_party" class="height:400px"> 
						<h1 class="text-danger text-center" style="margin-right:220px">Visitors</h1><br/>
						<div class="row">
							
							<table class="table table-bordered" >
								<tr>
									<th>Name</th>
									<td><?php echo $name?></td>
								</tr>
								<tr>
									<th>Mobile</th>
									<td><?php echo $mobile?></td>
								</tr>
								<tr>
									<th>Address</th>
									<td><?php echo $address?></td>
								</tr>
								<tr>
									<th>In Time</th>
									<td><?php echo $in_time?></td>
								</tr>
								<tr>
									<th>Out Time</th>
									<td><?php echo $out_time?></td>
								</tr>
							</table>
							<div class="text-align">
								<button onclick="window.print();" class="btn btn-primary" id="print">Print</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="; height:400px">
					
				</div>
				
			</div>
			
		
			
				
				
			
			
				
