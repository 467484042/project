<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileUpload extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('view_upload');

	}



	public function multi_upload(){
		//0 for image ,1 for video
		$file_array=array();
		$file_type=0;
		if(sizeof($_FILES)>=1){
			$count = 0;
			$data['filename']='';
			$data['file_type']='';
			foreach ($_FILES['img']['name'] as $filename)
			{
				echo $filename.'</br>';
				if($this->fileType($filename)==0){
					$file_type=0;
				}else{
					$file_type=1;
				}
				$file_array[$filename]=$file_type;
				$tmp=$_FILES['img']['tmp_name'][$count];
				$target ='uploads/'.basename($filename);
				move_uploaded_file($tmp,$target);
				$count = $count+1;
				echo '...successfully uploaded '.$count.' file(s)</br>';
			}
			$data['file_array']=$file_array;
			$this->load->view('view_upload',$data);
		}else{
			$this->load->view('view_upload');
		}
	}

	public function fileType($filename){
		if($this->endsWith($filename,".mp4")){
			return 1;
		}else if($this->endsWith($filename,"png")){
			return 0;
		}else if($this->endsWith($filename,"jpg")){
			return 0;
		}
		else if($this->endsWith($filename,"gif")){
			return 0;
		}
		return -1;
	}
	public function endsWith($str,$reg){
		$length = strlen($reg);
		if ($length == 0) {
			return false;
		}
		return (substr($str, -$length) === $reg);

	}

	public function autoLoad(){
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|mp4';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		print_r('Uploaded Successfully.');
	}

}

