<?php
class Resetpsw extends CI_Controller {

	public function index(){
		$this->load->view("view_forgotpsw");
	}

	public function sendCode(){
		$this->load->model('user_model');
		$this->user_model->removeVerifyCode();
		$vertifyCode=$this->generateVerificationCode();
		$address = $this->input->post('email');
		$userinfo=$this->user_model->searchByEmail($address);
		if(count($userinfo)>0){
			$uname=$userinfo[0]->Name;
			$this->user_model->verifyCode($uname,$address,$vertifyCode);
		}
		$this->send_email($address,$vertifyCode);
		$this->load->view("view_inputcode");
	}

	public function codeVerify(){
		$code = $this->input->post('code');
		$this->load->model('user_model');
		$data=$this->user_model->getVerifyCode();
		$rightCode=$data[0]->code;
		if($rightCode==$code){
			$data['uname']=$data[0]->name;
			$this->load->view('view_setnewpsw',$data);
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


	public function updatapsw(){
		$this->load->model('user_model');
		$data=$this->user_model->getVerifyCode();
		$email=$data[0]->email;
		$newpassword= $this->input->post('newpsw');
		$data=$this->user_model->searchByEmail($email);
		if(count($data)>0){
			$email=$data[0]->email;
			$this->user_model->updatePSW($newpassword,$email);
			$this->user_model->removeVerifyCode();
			$this->load->view('view_login');
		}else{
			echo 'fail';
		}
	}


}
