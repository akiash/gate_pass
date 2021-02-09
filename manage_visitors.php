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
							  <label for="exampleInputEmail3">Mobile</label>
							  <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required value="<?php echo $mobile?>"/><br/>
							  <button type="button" class="fv-btn mobile_sent_otp " onclick="mobile_sent_otp()">Send OTP</button>
									
							  <input type="text" id="mobile_otp" placeholder="OTP" style="width:45%" class="mobile_verify_otp">
							
							  <button type="button" class="fv-btn mobile_verify_otp" onclick="mobile_verify_otp()">Verify OTP</button>
							
							  <span class="text-capitalize text-danger mt-3" style="font-size: 16px; margin-top: 20px" id="mobile_otp_result"></span>
							  <span class="field_error" id="mobile_error"></span>
							</div>

							<div class="form-group">
							  <label for="exampleInputEmail3">Address</label>
							  <input type="textbox" class="form-control" name="address" id="" placeholder="Enter Address" required value="<?php echo $address?>"/>
							</div>
							<div class="form-group">
							  <label for="exampleInputEmail3">In Time</label>
							  <input type="date" class="form-control" name="in_time" id="" placeholder="" required value="<?php echo $in_time?>"/>
							</div>
							<button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
							
						  </form>
						</div>
					  </div>
					</div>
            
		        </div>
				<script>
					function mobile_sent_otp(){
						jQuery('#mobile_error').html('');
						var mobile=jQuery('#mobile').val();
						if(mobile==''){
							jQuery('#mobile_error').html('Please enter mobile number');
						}else{
							jQuery('.mobile_sent_otp').html('Please wait..');
							jQuery('.mobile_sent_otp').attr('disabled',true);
							jQuery('.mobile_sent_otp');
							jQuery.ajax({
								url:'send_email_mobile_otp.php',
								type:'post',
								data:'mobile='+mobile+'&type=mobile',
								success:function(result){
									if(result=='done'){
										jQuery('#mobile').attr('disabled',true);
										jQuery('.mobile_verify_otp').show();
										jQuery('.mobile_sent_otp').hide();
										
									}else if(result=='mobile present'){
										jQuery('.mobile_sent_otp').html('Send OTP');
										jQuery('.mobile_sent_otp').attr('disabled',false);
										jQuery('#mobile_error').html('Mobile number is already present try with another one...');
										
									}else{
										jQuery('.mobile_sent_result').html('');
										jQuery('#mobile_error').html('Please try later on');
									}
								}`
							});
						}
				    }
					
					function mobile_verify_otp(){
						jQuery('#mobile_error').html('');
						var mobile_otp=jQuery('#mobile_otp').val();
						if(mobile_otp==''){
							jQuery('#mobile_error').html('Please enter OTP');
						}else{
							jQuery.ajax({
								url:'check_otp.php',
								type:'post',
								data:'otp='+mobile_otp+'&type=mobile',
								success:function(result){
									if(result=='done'){
										jQuery('.mobile_verify_otp').hide();
										jQuery('#mobile_otp_result').html('Mobile number verified');
										jQuery('#is_mobile_verified').val('1');
									}else{
										jQuery('#mobile_error').html('Please enter valid OTP');
									}
								}
							});
						}
					}
				</script>
<?php include('footer.php');?>