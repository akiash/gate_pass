<?php 
	include('header.php');
	date_default_timezone_set('Asia/Kolkata');
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
		//$mobile=$row['mobile'];
		//$address=$row['address'];
		//$in_time=$row['in_time'];
		$out_time=$row['out_time'];
	}
	
	if(isset($_POST['submit'])){
		$name=get_safe_value($conn,$_REQUEST['name']);
		$mobile=get_safe_value($conn,$_REQUEST['mobile']);
		$address=get_safe_value($conn,$_REQUEST['address']);
		$in_time=date('Y-m-d h:i:s');
		$out_time=date('Y-m-d h:i:s');
		
		if($id==''){
		$sql="select * from visitors where mobile='$mobile'";
		}else{
			$sql="select * from visitors where mobile='$mobile' and id!='$id'";
		}	
		if(mysqli_num_rows(mysqli_query($conn,"select * from visitors where mobile='$mobile'"))>0){
			$msg = "Mobile Number is already in Use";
		}else{
			if($id==''){
				mysqli_query($conn,"insert into visitors(name,mobile,address,in_time,out_time) values ('$name','$mobile','$address','$in_time','$out_time')");
			}else{
				mysqli_query($conn,"update visitors set out_time='$out_time' where id='$id'");
			}
			redirect('visitors.php');
		}
	}
	
	
?>
                  <div class="row">
					<h1 class="card-title ml10" style="margin-left:15px">Manage Visitor</h1>
					<div class="col-12 grid-margin stretch-card">
					  <div class="card">
						<div class="card-body">
						  <form class="forms-sample" method="post">
							<div class="form-group">
							  <label for="exampleInputName1">Visitor Name</label>
							  <input type="text" class="form-control" name="name" id="" placeholder="Name" required value="<?php echo $name?>"/>
							  <div class="text-danger"><?php echo $msg?></div>
							</div>
							<div class="form-group">
							  <label for="exampleInputEmail3">Out Time</label>
							  <input type="date" class="form-control" name="out_time" id="" placeholder="" required value="<?php echo $out_time?>"/>
							</div>
							<button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
							
						  </form>
						</div>
					  </div>
					</div>
            
		        </div>
<?php include('footer.php');?>