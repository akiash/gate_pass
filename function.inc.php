<?php
	function pr($arr){
		echo '<pre>';
		print_r($arr);
	}
	
	function prx($arr){
		echo '<pre>';
		print_r($arr);
		die();
	}
	
	function get_safe_value($conn,$str){
		if($str!==''){
			$str = trim($str); //at the time of getting data its remove spaces
			return strip_tags(mysqli_real_escape_string($conn,$str));
		}	
	}
	
	function redirect($link){
		?>
		<script>
			window.location.href='<?php echo $link; ?>';
		</script>
		<?php
		die();
	}
?>