<?php
class Login extends CI_Controller {
	public function index()
	{
		$this->load->model('user_model');
		$name = $this->input->post('username');
		$pw = $this->input->post('pw');
		$remember = $this->input->post('remember');
		if($name!=null){
			if($this->user_model->exist($name)){
				if($this->user_model->checkValid($name,$pw)){
					if($remember == "on"){
						setcookie('name',$name,time()+3600);
						setcookie('password',$pw,time()+3600);
						setcookie('remember',$remember,time()+3600);
					}else{
						setcookie('name',$name,time()-3600);
						setcookie('password',$pw,time()-3600);
						setcookie('remember',$remember,time()-3600);
					}
					$this->sessionSetting($name);
					$data["uname"]=$name;
					$this->load->view('view_login_success',$data);
				}
			}else if($this->user_model->checkValid($name,$pw)==false){
				$data['message']="fail";
				$this->load->view('view_login_fail',$data);
			}

		}else{
			$this->load->view('view_login');
		}


	}

	public function sessionSetting($name){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_userdata('logged_in', 1);
			$this->session->set_userdata('username',$name);
			$res=$this->user_model->searchIDByName($name);
			$ID=$res[0]->ID;
			$password=$res[0]->Password;
			$email=$res[0]->email;
			$phone=$res[0]->phone;
			$this->session->set_userdata('id',$ID);
			$this->session->set_userdata('password',$password);
			$this->session->set_userdata('email',$email);
			$this->session->set_userdata('phone',$phone);
		}
	}

	public function forgotPSW(){
		$vertifyCode=$this->generateVerificationCode();
		$address = $this->input->post('email');
		$this->send_email($address,$vertifyCode);
	}


	public function codeVerify(){
		$code = $this->input->post('code');
		$this->load->model('user_model');
		$data=$this->user_model->getVerifyCode();
		$rightCode=$data[0]->code;
		if($rightCode==$code){
			$data['uname']=$data[0]->name;
			$this->load->view('view_login_success',$data);
			$this->user_model->removeVerifyCode();
		}else{
			$data['message']="wrong verify code";
			$this->load->view('view_login_fail',$data);
		}

	}


	public function generateVerificationCode(){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 6; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


	public function send_email($address,$vertifyCode){
		$this->load->library('email');
		$config=Array(
			'protocol'=>'smtp',
			'smtp_host'=>'mailhub.eait.uq.edu.au',
			'smtp_port'=>25,
			'charset'=>'iso-8859-1',
			'mailtype'=>'html',
			'wordwrap'=>true
		);
		$this->email->initialize($config);
		$this->email->from('noreply@infs3202-6ab4a3da.uqcloud.net');
		$this->email->subject('xilxil registration');
		$this->email->message('Your verification code is '.$vertifyCode);
		$this->email->to($address);
		$this->email->send();

	}


}
