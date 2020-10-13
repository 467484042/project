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
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
						<li><a href="<?php echo base_url().'project/index.php/dashboard';?>">Hi! <?php echo $_SESSION["username"]?></a></li>
						<li><a href="<?php echo base_url().'project/index.php/dashboard';?>">Profile</a></li>
						<li><a href="<?php echo base_url().'project/index.php/home/sessionDestory';?>">Logout</a></li>
					</ul>
				<?php endif;?>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="result" style="background-color: #8ba8af; border-radius:3px;">
		<a href="http://localhost/project/index.php/video/loadVideoPage/1"></a>
	</div>

	<div class="container-fluid">
		<div class="row videos" style="height:auto; width: auto;">
			<h4>Videos: </h4>
			<?php
			if(sizeof($file_array[0])>=1) {
				for ($i = 0; $i < sizeof($file_array[0]); $i++) {
					if (($i % 3) == 0 && $i > 0) {
						echo "</div>";
					}

					if (($i % 3) == 0) {
						echo "<div class=\"row\">";
					}
					echo "<div class=\"col-lg-4\">";
					echo "<div class=\"thumbnail\">";
					echo "<a href=\"".base_url()."project/index.php/video/loadVideoPage/".$file_array[0][$i]->vid."\">";
					echo "<video width=\"320\" height=\"240\" controls style=\"margin-left: auto;margin-right: auto;border: none;\">";
					echo "<source src=\"../uploads/".$file_array[0][$i]->vname."\" type=\"video/mp4\">";
					echo "</video>";
					echo "</a>";
					echo "<div class=\"caption\">";
					echo "<h5>".$file_array[0][$i]->vname."</h5>";
					echo "<p>...</p>";
					echo "<span title=\"Play-volume\">";
					echo "<i class=\"glyphicon glyphicon-expand\">&nbsp</i>";
					echo  $file_array[0][$i]->vplaytime." &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
									&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
									&nbsp &nbsp  &nbsp &nbsp &nbsp";
					echo "</span>";
					echo "<span title=\"Upload-time\">";
					echo "<i class=\"glyphicon glyphicon-time\">&nbsp</i>";
					echo  $file_array[0][$i]->vuploadtime;
					echo "</span>";
					echo "<br>";
					echo "<br>";
					echo "<span title=\"Author\">";
					echo "<i class=\"glyphicon glyphicon-user\">&nbsp</i>";
					echo $file_array[0][$i]->vauthor;
					echo "</span>";
					echo "</div>";
					echo "</div>";
					echo "</div>";

				}
				if((sizeof($file_array[0])%3)!=0){
					echo "</div>";
				}

			}
			?>
		</div>
	</div>



</div>
</body>

<script>

	$('.form-control').keyup(function(){
		var search = $(this).val();
		if(search != ''){
			load_data(search);
		}else{
			load_data();
		}
	});

	$(document).ready(function(){
		load_data();
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
				// width:width,
				// height:100+"px",
				// top: (searBarPosition.top-115)+ "px",
				// left: (searBarPosition.left+12)+ "px"
			});
		}
		$(".result li").attr("style","none");
	};

	// $(document).click(function () {
	// 	$(".result").css("display","none");
	// });



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





