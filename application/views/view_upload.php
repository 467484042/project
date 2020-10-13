<html>
<head>

	<!-- Dropzone CSS & JS -->
	<link href='<?php echo base_url().'project/resources/dropzone.css';?>' type='text/css' rel='stylesheet'>
	<script src='<?php echo base_url().'project/resources/dropzone.js';?>' type='text/javascript'></script>

</head>


<body>
<a href="<?php echo base_url().'project/index.php/home'?>"><h1>Home</h1></a>
<form action="<?php echo base_url().'project/index.php/FileUpload/multi_upload'?>" method="post" enctype="multipart/form-data">
	Select files: <input type='file' name='img[]' multiple>
	<input type="submit">
</form>
<p>Try selecting more than one file when browsing for files.</p>
<?php if(sizeof($_FILES)>=1):?>
	<?php
	if(sizeof($file_array)>=1){
		foreach ($file_array as $x_key => $x_value){
			if($x_value==0){
				echo '<img src="../uploads/'.$x_key.'">';
				echo '	   ';
			}else if($x_value){
				echo '<video width="320" height="240" controls>';
				echo '<source src="../uploads/'.$x_key.'" type="video/mp4" style="width:320px;height:300px;">';
				echo '	</video>';
				echo '	   ';
			}
		}
	}
	?>
<?php endif;?>


<div class="content">
	<form action="<?php echo base_url().'project/index.php/FileUpload/autoLoad'?>" class="dropzone"  >
	</form>
</div>


</body>
</html>
