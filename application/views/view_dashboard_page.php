<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pilipili</title>


	<!--[if lt IE 9]>
	<script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
	<![endif]-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href='<?php echo base_url().'project/resources/dropzone.css';?>' type='text/css' rel='stylesheet'>
	<script src='<?php echo base_url().'project/resources/dropzone.js';?>' type='text/javascript'></script>

	<style type="text/css">

		.circular--square {
			border-radius: 50%;
			border-style: solid;
			border-width: 1px;
			border-color: black;
		}
		.result li {
			list-style-type: none;
		}

		.myvideo button{
			margin-left: 40%;
		}



	</style>
</head>
<body>
<div class="form-gap"></div>
<div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url().'project/index.php/home';?>">pilipili</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_url().'project/index.php/home';?>">Home</a></li>
					<li><a href="<?php echo base_url().'project/index.php/home';?>">Videos</a></li>
					<li><a href="">Pilipilier</a></li>
					<li><a href="">Community</a></li>

				</ul>
				<form class="navbar-form navbar-left">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>

					<button type="submit" class="btn btn-default">Search</button>

				</form>
				<?php if(!$this->session->userdata('logged_in')) : ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url().'project/index.php/login';?>">Login</a></li>
						<li><a href="<?php echo base_url().'project/index.php/signup';?>">Signup</a></li>
					</ul>
				<?php endif;?>

				<?php if($this->session->userdata('logged_in')) : ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url().'project/index.php/dashboard';?>">Hi! <?php echo $_SESSION["username"];?></a></li>
						<li><a href="<?php echo base_url().'project/index.php/dashboard';?>">Profile</a></li>
						<li><a href="<?php echo base_url().'project/index.php/home/sessionDestory';?>">Logout</a></li>
					</ul>
				<?php endif;?>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="result" style="background-color: #8ba8af; border-radius:3px;">
	</div>

	<div class="container-fluid" style="padding-left: 0px;">
		<div class="row">
			<div class="col-md-3 ">
				<div class="list-group ">
					<a ID="dashboard" class="list-group-item list-group-item-action active">Dashboard</a>
					<a ID="profile" class="list-group-item list-group-item-action">Profile</a>
					<a ID="update" class="list-group-item list-group-item-action">Update Profile</a>
					<a ID="avatar" class="list-group-item list-group-item-action">Avatar</a>
					<a ID="myvideos" class="list-group-item list-group-item-action">My Videos</a>
					<a ID="likes" class="list-group-item list-group-item-action">Likes</a>
					<a ID="upload" class="list-group-item list-group-item-action">Upload</a>
					<a ID="map" class="list-group-item list-group-item-action">Map</a>
					<a ID="statistic" class="list-group-item list-group-item-action">Statistic</a>
					<a href="#" class="list-group-item list-group-item-action">Appearance</a>
					<a href="#" class="list-group-item list-group-item-action">Bug Report</a>
					<a href="#" class="list-group-item list-group-item-action">Settings</a>
				</div>
			</div>
			<div class="col-md-9" style="border: 0.5px solid black; border-radius: 4px;">
				<div class="card" style="margin: 10px;">
					<div class="card-body">
						<div class="update" style="display: none;">
							<div class="row">
								<div class="col-md-12">
									<h4>Your Profile</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form action="<?php echo base_url()."project/index.php/dashboard/update"?>" method="post">
										<div class="row">
											<label for="username" class="col-4 col-form-label">User Name</label>
											<div class="col-8">
												<input id="username" name="username" placeholder="Username" class="here" required="required" type="text">
											</div>
										</div>


										<div class="row">
											<label for="email" class="col-4 col-form-label">Email</label>
											<div class="col-8">
												<input id="email" name="email" placeholder="Email" class="here" type="text">
											</div>
										</div>

										<div class="row">
											<label for="email" class="col-4 col-form-label">Phone</label>
											<div class="col-8">
												<input id="phone" name="phone" placeholder="New Phone" class="here" type="text">
											</div>
										</div>

										<div class="row">
											<label for="newpass" class="col-4 col-form-label">New Password</label>
											<div class="col-8">
												<input id="newpass" name="newpass" placeholder="New Password" class="here" type="text">
											</div>
										</div>

										<div class="row" style="margin-top: 20px;">
											<div class="offset-4 col-8">
												<button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>


						<div class="profile" >
							<div class="row">
								<div class="col-md-12">
									<h4>Your Current Information</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form style="text-align: center;">

										<div class="row form-group">
											<label for="id" class="col-4 col-form-label">User ID: <?php echo $user['id'];?></label>
										</div>
										<div class="row form-group">
											<label for="username" class="col-4 col-form-label">User Name: <?php echo $user['name'];?></label>
										</div>

										<div class="form-group row">
											<label for="email" class="col-4 col-form-label">Password :<?php echo $user['password'];?></label>
										</div>

										<div class="form-group row">
											<label for="email" class="col-4 col-form-label">Email :<?php echo $user['email'];?></label>
										</div>

										<div class="form-group row">
											<label for="publicinfo" class="col-4 col-form-label">User level: 1</label>
										</div>
										<div class="form-group row">
											<div class="offset-4 col-8">
												<button name="submit" type="submit" class="btn btn-primary">Edit My Profile</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>




						<div class="avatar" style="display: none;">
							<div class="row">
								<div class="col-md-12">
									<h4>You Can Upload And Edit Your Avator</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Drag Drop To Upload</h4>
									<div class="avatar_picture" style="text-align: center">
										<img src="../temp/user.png" alt="Avatar" style="width:200px; border: solid 1px black;border-radius: 50%;">
										<br>
										<button name="submit" type="button" class="btn btn-info" id="avatarResizeBtn" style="margin-top: 10px;">Resize</button>
										<button name="submit" type="button" class="btn btn-info" id="avatarRoateBtn" style="margin-top: 10px;">Roate</button>
										<button name="submit" type="button" class="btn btn-info" id="avatarWatermarkBtn" style="margin-top: 10px;">Watermark</button>
										<button name="submit" type="button" class="btn btn-info" id="avatarRemoveBtn" style="margin-top: 10px;">Hide</button>
									</div>
									<br>
									<br>
									<br>
									<div class="content">
										<form action="<?php echo base_url().'project/index.php/dashboard/autoLoad'?>" class="dropzone" id="dropzoneFrom"  >
										</form>
									</div>

									<h2>Avatar:</h2>
									<div class="row preview_section">
										
									</div>
								</div>
							</div>
						</div>

						<div class="myvideos" style="display: none;">
							<div class="row">
								<div class="col-md-12">
									<h4>My Videos</h4>
									<hr>
								</div>
							</div>
							<?php
								if(sizeof($vadio_array)>=1) {
									for ($i = 0; $i < sizeof($vadio_array); $i++) {
										if (($i % 2) == 0 && $i > 0) {
											echo "</div>";
										}
										if (($i % 2) == 0) {
											echo "<div class=\"row\">";
										}
										echo "<div class=\"col-md-6 myvideo\" style=\"margin-bottom: 5%;\">";
										echo "<div class=\"thumbnail\">";
										echo "<video width=\"320\" height=\"240\" controls style=\"margin-left: auto;margin-right: auto;border: none;\">";
										echo "<source src=\"../uploads/".$vadio_array[$i]->vname."\" type=\"video/mp4\">";
										echo "</video>";
										echo "<div class=\"caption\">";
										echo "<h5>Thumbnail label</h5>";
										echo "<p>".$vadio_array[$i]->vid."</p>";
										echo "<span title=\"Play-volume\">";
										echo "<i class=\"glyphicon glyphicon-expand\">&nbsp</i>";
										echo "3 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
												&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
												&nbsp &nbsp  &nbsp &nbsp &nbsp";
										echo "</span>";
										echo "<span title=\"Upload-time\">";
										echo "<i class=\"glyphicon glyphicon-time\">&nbsp</i>";
										echo "2020-04-03";
										echo "</span>";
										echo "<br>";
										echo "</div>";
										echo "</div>";
										echo "<button type=\"button\" class=\"btn btn-primary deletebtn\" >Delete</button>";
										echo "</div>";
									}
									if((sizeof($vadio_array)%2)!=0){
										echo "</div>";
									}
								}
							?>
						</div>
					<!-- </div> -->

						<div class="upload" style="display: none;">
							<div class="row">
								<div class="col-md-12">
									<h4>You Can Upload Video by Drag And Drop</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Drag Drop To Upload</h4>
									<br>

									<div class="content">
										<form action="<?php echo base_url().'project/index.php/dashboard/videoLoad'?>" class="dropzone" id="videoDropform"  >
										</form>
									</div>
									<div class="row">
										<button name="submit" type="button" class="btn btn-info" id="videouploadbtn" style="margin-top: 20px; margin-left: 20px;">Upload</button>
										<button name="submit" type="button" class="btn btn-info" id="postbtn" style="margin-top: 20px;margin-left: 20px;">Post</button>
									</div>

									<br>
									<br>
									<div class="row video_preview_section">
										<h4>Videos: </h4>
										<div class="col-md-6 " style="margin-top: 20px;">
											<p style='display: none'>"1.mp4"</p>
											<video width="320" height="240" controls style="margin-left: auto;margin-right: auto;border: none;">
												<source src="../uploads/1.mp4" type="video/mp4">
											</video>
										</div>
									</div>

									<br>
								</div>
							</div>
						</div>



						<div class="likes" style="display: none;">
							<div class="row">
								<div class="col-md-12">
									<h4>My Videos</h4>
									<hr>
								</div>
							</div>
							<?php
							if(sizeof($likes_array)>=1) {
								for ($i = 0; $i < sizeof($likes_array); $i++) {
									if (($i % 2) == 0 && $i > 0) {
										echo "</div>";
									}
									if (($i % 2) == 0) {
										echo "<div class=\"row\">";
									}
									echo "<div class=\"col-md-6 likes\" style=\"margin-bottom: 5%;\">";
									echo "<div class=\"thumbnail\">";
									echo "<video width=\"320\" height=\"240\" controls style=\"margin-left: auto;margin-right: auto;border: none;\">";
									echo "<source src=\"../uploads/".$likes_array[$i]->vname."\" type=\"video/mp4\">";
									echo "</video>";
									echo "<div class=\"caption\">";
									echo "<h5>Thumbnail label</h5>";
									echo "<p>".$likes_array[$i]->vid."</p>";
									echo "<span title=\"Play-volume\">";
									echo "<i class=\"glyphicon glyphicon-expand\">&nbsp</i>";
									echo "3 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
												&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
												&nbsp &nbsp  &nbsp &nbsp &nbsp";
									echo "</span>";
									echo "<span title=\"Upload-time\">";
									echo "<i class=\"glyphicon glyphicon-time\">&nbsp</i>";
									echo "2020-04-03";
									echo "</span>";
									echo "<br>";
									echo "</div>";
									echo "</div>";
									echo "<button type=\"button\" class=\"btn btn-primary unlikebtn\" >Unlike</button>";
									echo "</div>";
								}
								if((sizeof($likes_array)%2)!=0){
									echo "</div>";
								}
							}
							?>

						</div>
					<!-- </div> -->
				</div>
			</div>
		</div>
	</div>



</div>
</body>

<script>


	$("#postbtn").click(function () {
		post();
	});
	function post(){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/uploadVideoToWeb",
			success:function (data) {
			}
		});
	}


	$(document).on('click','#avatarResizeBtn',function () {
		// $name=$(this).parent().find('p').text();
		// $name=$name.replace(/['"]+/g, '');
		imageResize("user.png");

	});


	$(document).on('click','#avatarRoateBtn',function () {
		imageRoate("user.png");
	});

	$(document).on('click','#avatarWatermarkBtn',function () {
		imageWaterMark("user.png");
	});

	function imageWaterMark(name){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/img_watermark",
			method:"POST",
			data:{name:name},
			success:function (data) {
				console.log(data);
				if(data=="exist"){
					$(".avatar_picture").find('img').attr("src","../temp/marked_user.png");
				}
			}

		});
	}

	function imageRoate(name){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/img_roate",
			method:"POST",
			data:{name:name},
			success:function (data) {
				if(data=="exist"){
					$(".avatar_picture").find('img').attr("src","../temp/roated_user.png");
				}
			}

		});
	}









	function imageResize(name){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/img_resize",
			method:"POST",
			data:{name:name},
			success:function (data) {
				if(data=="exist"){
					$(".avatar_picture").find('img').attr("src","../temp/resized_user.png");
				}
			}

		});
		return true;
	}

	$(document).on('click','#avatarRemoveBtn',function () {
		$(this).parent().remove();
	});



	Dropzone.options.videoDropform={
		autoProcessQueue: false,
		acceptedFiles:'.mp4',
		init: function () {
			var submitBtn=document.querySelector("#videouploadbtn");
			myDropozone=this;
			submitBtn.addEventListener('click',function () {
				myDropozone.processQueue();
			});
			this.on('complete',function () {
				if(this.getQueuedFiles().length==0 && this.getUploadingFiles().length==0){
					var _this=this;
					_this.removeAllFiles();
					videoPreview();
				}
			});
		}
	};

	function videoPreview(){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/videopreview",
			success:function (data) {
				console.log(data);
				$(".video_preview_section").html(data);
			}

		});
	};

	preview();
	function preview(){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/preview",
			success:function (data) {
				$(".preview_section").html(data);
			}

		});
	}
	$(document).ready(function(){
		load_data();
	});

	$(document).on('click','.deletebtn',function () {
		var vid=$(this).parent().find('p').text();
		deleteMyVdo(vid);
		$(this).parent().remove();
	});

	$(document).on('click','.unlikebtn',function () {
		var vid=$(this).parent().find('p').text();
		unlikeVdo(vid);
		$(this).parent().remove();
	});
	function deleteMyVdo(query){
		$.ajax({url:"<?php echo base_url()?>project/index.php/dashboard/removeMyVdo",
			method:"POST",
			data:{query:query},
			success:function(response){
				if(response=="fail"){
					console.log("fail to delete");
				}else{
					console.log("deleted");
				}
			}
		});
	};

	function unlikeVdo(query){
		$.ajax({url:"<?php echo base_url()?>/project/index.php/dashboard/unlikeVdo",
			method:"POST",
			data:{query:query},
			success:function(response){
				if(response=="fail"){
					console.log("fail to delete");
				}else{
					console.log("deleted");
				}
			}
		});
	};


	$('.list-group > a').click(function () {
		var name = $(this).attr('id');
		$('.card-body > div').hide();
		$('.list-group > a').removeClass('active');
		$('#'+name).addClass('active');
		$("."+name).show();
	});



	$('.form-control').keyup(function(){
		var search = $(this).val();
		if(search != ''){
			load_data(search);
		}else{
			load_data();
		}
	});




	$(document).on('click','li',function () {
		$(".form-control").val($(this).text())
		$(".result").html("");
	});

	$(window).resize(function() {
		if($(window).width()<992){
			var searBarPosition=$(".form-control").position();
			var height = $(".form-control").outerHeight();
			var width = $(".form-control").outerWidth();
			$(".result").css({
				position: "relative",
				width:width,
				height:"auto",
				top: (searBarPosition.top-85)+ "px",
				left: (searBarPosition.left+2)+ "px"
			});
		}
		if($(window).width()>=992){
			var searBarPosition=$(".form-control").position();
			var height = $(".form-control").outerHeight();
			var width = $(".form-control").outerWidth();
			$(".result").css({
				position: "relative",
				width:width,
				height:"auto",
				top: (searBarPosition.top-height*1)+ "px",
				left: (searBarPosition.left+2)+ "px"
			});
		}
		if($(window).width()<768){
			$(".result").css({
				display: "none"
			});
		}
		$(".result li").attr("style","none");
	});


	$(".form-control").click(function (e) {
		// e.stopPropagation();
		// $(".result").css("display","block");
		displayResult();
	});

	function displayResult() {
		if($(window).width()<992){
			$(".result").css("background-color", "#F9F3F1");
			var searBarPosition=$(".form-control").position();
			var height = $(".form-control").outerHeight();
			var width = $(".form-control").outerWidth();
			$(".result").css("background-color", "#F9F3F1");
			$(".result").css({
				position: "relative",
				width:width,
				height:"auto",
				top: (searBarPosition.top-85)+ "px",
				left: (searBarPosition.left+2)+ "px"
			});
		}
		if($(window).width()>=992){
			$(".result").css("background-color", "#F9F3F1");
			console.log($(".form-control").position().left);
			console.log($(".form-control").position().top);
			var searBarPosition=$(".form-control").position();
			var height = $(".form-control").outerHeight();
			var width = $(".form-control").outerWidth();
			$(".result").css({
				position: "relative",
				width:width,
				height:"auto",
				top: (searBarPosition.top-height*1)+ "px",
				left: (searBarPosition.left+2)+ "px"
			}).show();
		}
		if($(window).width()<768){
			$(".result").css({
				display: "none"
			});
		}
		$(".result li").attr("style","none");
	};





	function load_data(query){
		$.ajax({url:"<?php echo base_url().'project/index.php/home/fetch';?>",
			method:"POST",
			data:{query:query},
			success:function(response){
				$('.result').html("");
				if (response == "No Data Found") {
					$('.result').html(response);
				}else if(response==""){
					$('.result').html("");
				}else{
					var obj = JSON.parse(response);
					if(obj[1].length>0){
						var items=[];
						$.each(obj[1], function(i,val){
							var infs=obj[0].information;
							if(infs==1){
								var name=val.vname;
								items.push("<h5>\Do you mean: \<li class=\"rl\">"+name+"</li></h5>");
							}else{
								items.push($("<li class='rl'>").text(val.vname));
							}

						});
						$('.result').append.apply($('.result'),items);
					} else{
						$('.result').html(response);
					}


				};
			}
		});
	};









</script>
</html>





