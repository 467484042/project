<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->database();
		$this->load->helper('form');
		$this->load->model('user_model');
		$data['file_array']=array();
		$data['file_array']=$this->fetchVideos();
		$this->login();
	}
	public function login(){
//		$ID=$this->input->post('input_id');
//		$name=$this->input->post('input_username');
//		$pw=$this->input->post('input_pw');
//		$phone=$this->input->post('input_phone');
		$data['file_array']=$this->fetchVideos();
//		if($ID!=null &&$name!=null &$pw!=null& $phone!=null){
//			$this->user_model->addUser($ID,$name,$pw,$phone);
//			$ID=null;
//			$name=null;
//			$pw=null;
//			$phone=null;
//		}

		//Redirect: avoid refresh resend post data
//		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//			$_SESSION['postdata'] = $_POST;
//			unset($_POST);
//			header("Location: ".$_SERVER['PHP_SELF']);
//			exit;
//		}
//		$data['results']=$this->user_model->getNames();
		if($this->session->userdata('logged_in')){
//			$data['session_statu']="logged in";
			$this->load->view('view_home_page',$data);
		}else{
//			$data['session_statu']="not logged in";
			$this->load->view('view_home_page',$data);
		}
	}

	public function sessionDestory(){
		session_destroy();
		header('Location: '.base_url()."project/index.php/home");
	}

	public function getVideoNames(){
		$fileArr=array();
		$a=scandir('.\uploads');

		foreach ($a as $item){
			$fileArr[$item]=$this->fileType($item);
		}
		return $fileArr;
	}

	public function fetchVideos(){
		$this->load->model('user_model');
		$fileArr[]=$this->user_model->fetchAllVideo();

		return $fileArr;
	}


	public function fileType($filename){
		if(strlen($filename)<4){
			return -1;
		}
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


	public function fetch(){
		$this->load->database();
		$this->load->model('user_model');
		$output ='';
		$query = '';
		$infs['information']=0;
		$data[0]=$infs;
		if($this->input->post('query')!=''){
			$query = $this->input->post('query');
			$data[] = $this->user_model->fetch_data($query)->result();
		}

//		$data[] = $this->user_model->fetch_data($query)->result();
		if(count($data)>1){
			if(count($data[1]) > 0){
				$data[0]['information']=2;
				echo json_encode ($data);
			}else{
				$videoes=$this->user_model->fetchAllVideo();
				$videoList=array();
				foreach ($videoes as $video){
					$name=$video->vname;
					$similarity=0;
					if(similar_text($name, $query, $similarity)>=0.6){
						$videoList[$video->vname]=$similarity;
					}
				}
				if(count($videoList)>0){
					$data[0]['information']=1;
					arsort($videoList);
					$similar=array_keys($videoList)[0];
					$data[1] = $this->user_model->fetch_data($similar)->result();
					echo json_encode ($data);
				}else{
					$output .= 'No Data Found';
				}

			}
		}

		echo $output;
	}


	public function fuzzyFetch(){
		$this->load->database();
		$this->load->model('user_model');
		$infs['information']="find exactly matched result";
		$data[0]=$infs;
		$data[]=null;
		print_r(count($data));
	}




}
