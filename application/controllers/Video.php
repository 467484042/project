<?php
class Video extends CI_Controller {
	public function index($vid=1)
	{
//		$this->load->model('user_model');
//		$this->saveComments();
//		$results=$this->user_model->findVideoComment(1);
//		$data['results']=$results;
//		$this->load->view('view_video1',$data);
//		$this->saveComments($vid);
//		$this->load->model('user_model');
//		$data["video"]=$this->user_model->fetchVideoByName($vid)[0];
//		$data["comment"]=$this->user_model->findVideoComment($vid);
//		$this->load->view('view_video_page',$data);
	}


	public function loadVideoPage($vname=1){
		$this->load->model('user_model');
		$data["video"]=$this->user_model->fetchVideoByID($vname)[0];
		$data["comment"]=$this->user_model->findVideoComment($vname);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_SESSION['postdata'] = $_POST;
			unset($_POST);
			header("Location: ".$_SERVER['PHP_SELF']);
			exit;
		}
		$this->load->view('view_video_page',$data);
	}

	public function saveComments($videoID){
		$this->load->model('user_model');
		if(isset($_SESSION['logged_in'])){
			if(strlen($this->input->post('comment'))>0){
				$content=$this->input->post('comment');
				$vid=$videoID;
				$time=date("Y-m-d");
				$author=$this->session->userdata('username');
				$this->user_model->addComment($vid,$time,$author,$content);
				$data["vid"]=$vid;
				$data["content"]=$content;
				$data["time"]=$time;
				$data["author"]=$author;
				echo json_encode($data);
			}
		}else{
			$ip=$this->get_client_ip();
			if(strlen($this->input->post('comment'))>0){
				$content=$this->input->post('comment');
				$vid=$videoID;
				$time=date("Y-m-d h:i:sa");
				$author=$ip;
				$this->user_model->addComment($vid,$time,$author,$content);
				$data["vid"]=$vid;
				$data["content"]=$content;
				$data["time"]=$time;
				$data["author"]=$author;
				echo json_encode($data);
			}

		}

	}
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function like(){
		if(isset($_SESSION['logged_in'])){
			$uid=$this->session->userdata('id');
			$vid=$this->input->post('query');
			$this->load->model('user_model');
			$this->user_model->addLike($uid,$vid);
			echo "finish insert";
		}else{
			echo "fail";
		}
	}

	public function unlike(){
		if(isset($_SESSION['logged_in'])){
			$uid=$this->session->userdata('id');
			$vid=$this->input->post('query');
			$this->load->model('user_model');
			$this->user_model->unLike($uid,$vid);
			echo "removed";
		}else{
			echo "fail";
		}
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
}

?>
