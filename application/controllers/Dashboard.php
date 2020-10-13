<?php
class Dashboard extends CI_Controller {
	public function index(){
//		$GLOBALS['exist_name']=0;
//		$GLOBALS['exist_email']=0;
//		$this->load->model('user_model');
//		$username=$this->session->userdata('username');
//
//		$this->displayCurrentINFO();
		$data['user']=$this->retriveCurrentINFO();
		$data["vadio_array"]=$this->getAuthorVieos();
		$data["likes_array"]=$this->getAuthorLikeVieos();
		$this->load->view("view_dashboard_page",$data);
	}

	public function uploadVideoToWeb(){
		$files=scandir('./videotemp');
		$this->load->model('user_model');
		$author=$uid=$this->session->userdata('username');
		$uid=$uid=$this->session->userdata('id');
		foreach ($files as $file){
			if('.'!=$file && '..'!=$file){
				$this->user_model->addVideo($file,1,$author,date("Y-m-d"));
			}

		}
		foreach ($files as $file){
			if('.'!=$file && '..'!=$file){
				$vid=$this->user_model->fetchVideoByVname($file)[0]->vid;
				$this->user_model->addMake($uid,$vid);
			}
		}
		$this->moveFiles();
	}

	public function moveFiles(){
		$srcDir = './videotemp';
		$destDir = './uploads';

		if (file_exists($destDir)) {
			if (is_dir($destDir)) {
				if (is_writable($destDir)) {
					if ($handle = opendir($srcDir)) {
						while (false !== ($file = readdir($handle))) {
							if (is_file($srcDir . '/' . $file)) {
								rename($srcDir . '/' . $file, $destDir . '/' . $file);
							}
						}
						closedir($handle);
					} else {
						echo "$srcDir could not be opened.\n";
					}
				} else {
					echo "$destDir is not writable!\n";
				}
			} else {
				echo "$destDir is not a directory!\n";
			}
		} else {
			echo "$destDir does not exist\n";
		}
	}

	public function videopreview(){
		$result=array();
		$files=scandir('./videotemp');
		$output="";
		if($files!=false){
			for($i=0;$i<count($files);$i++){
				if('.'!=$files[$i] && '..'!=$files[$i]){
					if (($i % 2) == 0 && $i > 0) {
						$output.= "</div>";
					}
					$output.="<div class=\"col-md-6 \" style=\"margin-top: 20px;\">
											<p style='display: none'>\"".$files[$i]."\"</p>
											<video width=\"320\" height=\"240\" controls style=\"margin-left: auto;margin-right: auto;border: none;\">
												<source src=\"../videotemp/".$files[$i]."\" type=\"video/mp4\">
											</video>
										</div>";
					if (($i % 2) == 0) {
						$output.= "<div class=\"row\">";
					}
				}
			}

			if((sizeof($files)%2)!=0){
				$output.= "</div>";
			}
		}
		echo $output;
	}

	public function preview(){
		$result=array();
		$files=scandir('./temp');
		$output="";
		if($files!=false){
			foreach ($files as $file){
				if('.'!=$file && '..'!=$file){
					$output.="<div class=\"col-md-2 \" style=\"margin-top: 20px;\">
											<p style='display: none'>".$file."</p>
											<img src=\"../temp/".$file."\" alt=\"Avatar\" style=\"width:50px;height:50px; border: solid 1px black;border-radius: 50%;\">
										</div>";
				}

			}
		}
		echo $output;
	}
	public function autoLoad(){
		$config['upload_path']   = '../temp';
		$config['allowed_types'] = 'gif|jpg|png|mp4';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		print_r('Uploaded Successfully.');
	}
	public function videoLoad(){
		$config['upload_path']   = '../videotemp';
		$config['allowed_types'] = 'gif|jpg|png|mp4';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		print_r('Uploaded Successfully.');
	}

	public function img_resize(){
		$name=$this->input->post('name');
		$config['image_library'] = 'gd2';
		$config['source_image'] = '../temp/'.$name;
		$config['new_image'] = '../temp/resized_'.$name;
		$config['create_thumb'] = false;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 75;
		$config['height']       = 50;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		if ( ! $this->image_lib->crop())
		{
			echo $this->image_lib->display_errors();
		}
		if(file_exists($config['new_image'])){
			echo "exist";
		}
	}


	public function img_crop(){
		$config['source_image'] = '../temp/user.png';
		$config['new_image'] = '../temp/croped_user.png';
		$config['x_axis'] = 600;
		$config['y_axis'] = 160;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->crop();

	}


	public function img_watermark(){
		$this->load->library('image_lib');
		$config['source_image'] = '../temp/user.png';
		$config['new_image'] = '../temp/marked_user.png';
		//The image path,which you would like to watermarking
		$config['wm_text'] = 'Pilipili.com';
		$config['wm_type'] = 'text';
		$config['wm_font_size'] = 16;
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'right';
		$config['wm_padding'] = '20';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
		}
		if(file_exists($config['new_image'])){
			echo "exist";
		}
	}



	public function img_roate(){
		$config['source_image'] = '../temp/user.png';
		$config['new_image'] = '../temp/roated_user.png';
		$config['rotation_angle'] = '90';
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);

		$this->image_lib->rotate();
		if ( ! $this->image_lib->rotate())
		{
			echo $this->image_lib->display_errors();
		}
		if(file_exists($config['new_image'])){
			echo "exist";
		}
	}


	public function removeMyVdo(){
		if(isset($_SESSION['logged_in'])){
			$uid=$this->session->userdata('id');
			$vid=$this->input->post('query');
			$this->load->model('user_model');
			$this->user_model->removeVideoFromMake($uid,$vid);
			echo "removed";
		}else{
			echo "fail";
		}

	}


	public function unlikeVdo(){
		if(isset($_SESSION['logged_in'])){
			$uid=$this->session->userdata('id');
			$vid=$this->input->post('query');
			$this->load->model('user_model');
			$this->user_model->removeVideoFromLike($uid,$vid);
			echo "removed";
		}else{
			echo "fail";
		}

	}

	public function getAuthorVieos(){
		$this->load->model('user_model');
		$videoIDS=$this->user_model->fetchVideos($_SESSION['id']);
		$cc=array();
		if(count($videoIDS)>0){
			for($i=0;$i<count($videoIDS);$i++){
				$cc[]=$videoIDS[$i]->vid;
			}
			return $this->user_model->fetchVideosByRange($cc);
		}
		return array();

	}

	public function getAuthorLikeVieos(){
		$this->load->model('user_model');
		$videoIDS=$this->user_model->fetchLikedVideos($_SESSION['id']);
		$cc=array();
		if(count($videoIDS)>0){
			for($i=0;$i<count($videoIDS);$i++){
				$cc[]=$videoIDS[$i]->vid;
			}
			return $this->user_model->fetchVideosByRange($cc);
		}
		return array();
	}

	public function retriveCurrentINFO(){
		$this->load->model('user_model');
		$UID=$this->session->userdata('id');
		$qr_result=$this->user_model->searchUserByID($UID);

		$data = array(
			'id'=>$qr_result[0]->ID,
			'name'=>$qr_result[0]->Name,
			'password'=>$qr_result[0]->Password,
			'email'=>$qr_result[0]->email,
			'phone'=>$qr_result[0]->phone
		);
		$this->load->library('encryption');
		$data['password']=$this->encryption->decrypt($data['password']);
		$data['password']=$this->encryption->decrypt($qr_result[0]->Password);
		return $data;
	}
	public function displayCurrentINFO(){
		$this->load->view('view_profile',$this->retriveCurrentINFO());
	}

	public function update(){
		$this->load->model('user_model');
		$data['username']=$this->input->post('username');
		$data['password']=$this->input->post('newpass');
		$data['email']=$this->input->post('email');
		$data['phone']=$this->input->post('phone');
		if(!isset($_POST['username'])){
			$data['username']=$this->session->userdata('username');
		}else{
			if(!$this->user_model->checkUniqueEmail($data['email'])){
				$data['username']=$this->session->userdata('username');
			}
		}
		if(!isset($_POST['password'])){
			$data['password']=$this->session->userdata('password');
		}
		if(!isset($_POST['email'])){
			$data['email']=$this->session->userdata('email');
		}

		if(!isset($_POST['phone'])){
			$data['phone']=$this->session->userdata('phone');
		}

		$this->user_model->updateUser($data['username'],$data['password'],$data['email'],$data['phone'],$this->session->userdata('id'));
		$data['user']=$this->retriveCurrentINFO();
		header('Location: '.base_url()."project/index.php/dashboard");
		$this->load->view("view_dashboard_page",$data);

	}


	public function updateProfile(){
		$GLOBALS['exist_name']=0;
		$GLOBALS['exist_email']=0;
		$name = $this->input->post('input_username');
		$email = $this->input->post('input_email');
		$pw = $this->input->post('input_pw');
		$phone = $this->input->post('input_phone');
		$data=(array)$this->retriveCurrentINFO();
		//situation : username and email not change
		if(!strcmp($data['name'],$name) && !strcmp($data['email'],$email)){
			$this->user_model->updateUser($name,$pw,$email,$phone,$data['id']);
			$this->load->view('view_profile',$this->retriveCurrentINFO());
		}else{
			//situation:change both username and email
			if(strcmp($data['name'],$name) && strcmp($data['email'],$email)){
				if($this->user_model->exist($name)){
					$GLOBALS['exist_name']=1;
				}
				if(!$this->user_model->checkUniqueEmail($email)){
					$GLOBALS['exist_email']=1;
				}
				if(!$this->user_model->exist($name) && $this->user_model->checkUniqueEmail($email)){
					$this->user_model->updateUser($name,$pw,$email,$phone,$data['id']);
				}
				$this->load->view('view_profile',$this->retriveCurrentINFO());
			}
			//situation:change username only
			if(strcmp($data['name'],$name) && !strcmp($data['email'],$email) ){
				echo "222";
				if($this->user_model->exist($name)){
					$GLOBALS['exist_name']=1;
					$this->load->view('view_profile',$this->retriveCurrentINFO());
				}else{

					$this->user_model->updateUser($name,$pw,$email,$phone,$data['id']);
					$this->load->view('view_profile',$this->retriveCurrentINFO());
				}
			}

			//situation: change email only
			if(!strcmp($data['name'],$name) && strcmp($data['email'],$email) ){
				if(!$this->user_model->checkUniqueEmail($email)){
					$GLOBALS['exist_email']=1;
					$this->load->view('view_profile',$this->retriveCurrentINFO());
				}else{
					$this->user_model->updateUser($name,$pw,$email,$phone,$data['id']);
					$this->load->view('view_profile',$this->retriveCurrentINFO());

				}
			}


		}

	}
}
