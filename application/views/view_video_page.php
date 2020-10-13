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

		.fa-heart-o {
			color: red;
			cursor: pointer;
		}
		.fa-star-o {
			color: yellow;
			cursor: pointer;
		}
		.fa-heart {
			color: red;
			cursor: pointer;
		}

		.fa-star {
			color: yellow;
			cursor: pointer;
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

	<div class="container-fluid">
		<div id="vid" style="display: none;"><p><?php echo $video->vid?></p>></div>

		<div class="row videoSection" style="height:auto; width: auto;">
			<h4>Title: <?php echo $video->vname?></h4>
			<div class="caption">
				<h5>Thumbnail label</h5>
				<span title="Author">
								<i class="glyphicon glyphicon-user"></i>
								<?php echo $video->vauthor?> &nbsp &nbsp
				</span>

				<span title="Upload-time">
								<i class="glyphicon glyphicon-time"></i>
								<?php echo $video->vuploadtime?>
				</span>

			</div>

			<div class="row video" style="height:auto; width: auto;">
				<div class="col-lg-12">
					<div class="thumbnail" style="margin-right: auto; margin-left: auto;text-align:center;">
						<video width="320" height="240" controls style="margin-left: auto;margin-right: auto;border: none;">
							<source src="<?php echo"../../../uploads/".$video->vname?>" type="video/mp4">
						</video>
					</div>

				</div>
			</div>
			<div class="caption botton" style="font-size: 30px;">
				<span title="Play-volume">
								<i class="glyphicon glyphicon-expand" style="font-size: 25px;"></i>
								<?php echo $video->vplaytime?> &nbsp &nbsp
				</span>

				<span id = heart><i class="fa fa-heart-o" aria-hidden="true" >&nbsp &nbsp</i> </span>
				<span id = star><i class="fa fa-star-o" aria-hidden="true" ></i> </span>

			</div>
			<div class="row">
				<div class="col-lg-12">
					<h3>Comments: </h3>
					<div class="media">
						<div class="row commentSection">


							<?php
							if(sizeof($comment)>0){
								foreach ($comment as $c){
									echo '<div class="media-left media-middle">';
									echo '<a href="">';
									echo '<img class="media-object" src="../../../uploads/user.png" alt="..." style="height: 50px; width: 50px;">';
									echo '</a>';
									echo '</div>';
									echo '<div class="media-body">';
									echo '<h4 class="media-heading">'.$c->author.':</h4>';
									echo $c->content;
									echo '</div>';
									echo '<span title="Upload-time">';
									echo '&nbsp';
									echo '<i class="glyphicon glyphicon-time"></i>';
									echo $c->time;
									echo '</span>';
									echo '<br>';
									echo '<br>';
									echo '<br>';
									echo '<br>';
								}
							}
							?>



						</div>







					<div class="row">
						<div class="col-lg-12">
<!--							<form action="--><?php //echo base_url().'project/index.php/video/loadVideoPage/'.$video->vid;?><!--" method="post" style="display:block; margin: 0 auto;">-->
							<form method="post" style="display:block; margin: 0 auto;">
								<div class="md-form">
									<i class="fas fa-pencil-alt prefix"></i>
									<textarea id="form10 commentarea" name="comment" class="md-textarea" rows="3" cols="150">Enter text here..</textarea>
								</div>
								<br>
								<button type="button" id="commentbtn" class="send" style="float:right; margin-bottom: 30px;">Send</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>



</div>
</body>

<script>
	var i=0;
	$("#star").click(function () {
		var vid=$("#vid p").text();
		if(i==0){
			addToLike(vid);
			i=1;
		}else{
			removeFromLike(vid);
			i=0;
		}

	});

	$("#commentbtn").click(function () {
		$vdoid=$('#vid').find("p").text();
		$comment=$(".md-textarea").val();
		comment($comment,$vdoid);

	});


	function comment(comment,vdoid){
		$.ajax({url:"<?php echo base_url().'project/index.php/video/saveComments/';?>"+vdoid,
			method:"POST",
			data:{comment:comment},
			success:function(response){
				var obj = JSON.parse(response);
			console.log(obj["vid"]);
				var dt = new Date();
				var time = dt.getFullYear() + "-" + dt.getMonth() + "-" + dt.getDay();
					var $content="<div class=\"row\">\n" +
							"\t\t\t\t\t\t\t\t<div class=\"media-left media-middle\">\n" +
							"\t\t\t\t\t\t\t\t\t<a href=\"\">\n" +
							"\t\t\t\t\t\t\t\t\t\t<img class=\"media-object\" src=\"../../../uploads/user.png\" alt=\"...\" style=\"height: 50px; width: 50px;\">\n" +
							"\t\t\t\t\t\t\t\t\t</a>\n" +
							"\t\t\t\t\t\t\t\t</div>\n" +
							"\t\t\t\t\t\t\t\t<div class=\"media-body\">\n" +
							"\t\t\t\t\t\t\t\t\t<h4 class=\"media-heading\">"+obj["author"]+":</h4>\n" +
							"\t\t\t\t\t\t\t\t\t<p>"+obj["content"] +"</p>\n" +
							"\t\t\t\t\t\t\t\t</div>\n" +
							"\t\t\t\t\t\t\t\t<span title=\"Upload-time\">\n" +
							"\t\t\t\t\t\t\t\t\t&nbsp\n" +
							"\t\t\t\t\t\t\t\t<i class=\"glyphicon glyphicon-time\">"+obj["time"]+"</i>\n" +
							"\t\t\t\t\t\t\t</span>\n" +
							"\t\t\t\t\t\t\t\t<br>\n" +
							"\t\t\t\t\t\t\t\t<br>\n" +
							"\t\t\t\t\t\t\t\t<br>\n" +
							"\t\t\t\t\t\t\t\t<br>\n" +
							"\t\t\t\t\t\t\t</div>";
					$(".commentSection").append($content);
			}
		});
	};

	function addToLike(query){
		$.ajax({url:"<?php echo base_url().'project/index.php/video/like';?>",
			method:"POST",
			data:{query:query},
			success:function(response){
				if(response=="fail"){
				}else{
					console.log("like");
				}
			}
		});
	};


	function removeFromLike(query){

		$.ajax({url:"<?php echo base_url().'project/index.php/video/unlike';?>",
			method:"POST",
			data:{query:query},
			success:function(response){
				if(response=="fail"){
				}else{
					console.log("unlike");
				}
			}
		});
	};


	$("#heart").click(function(){
		if($("#heart").hasClass("liked")){
			$("#heart").html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
			$("#heart").removeClass("liked");
		}else{
			$("#heart").html('<i class="fa fa-heart" aria-hidden="true"></i>');
			$("#heart").addClass("liked");
		}
	});

	$("#star").click(function(){
		if($("#star").hasClass("liked")){
			$("#star").html('<i class="fa fa-star-o" aria-hidden="true"></i>');
			$("#star").removeClass("liked");
		}else{
			$("#star").html('<i class="fa fa-star" aria-hidden="true"></i>');
			$("#star").addClass("liked");
		}
	});
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





