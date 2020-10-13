<?php
class User_model extends CI_Model {

	public function removeVideoFromLike($uid,$vid)
	{

		$this->db->where('uid', $uid);
		$this->db->where('vid', $vid);
		$this->db->delete('likes');
	}
	public function removeVideoFromMake($uid,$vid)
	{

		$this->db->where('uid', $uid);
		$this->db->where('vid', $vid);
		$this->db->delete('makes');
	}
	public function fetchLikedVideos($uid)
	{
		$this->db->select("vid");
		$this->db->from("likes");
		$this->db->where("uid",$uid);
		return $this->db->get()->result();
	}


	public function fetchVideosByRange($list)
	{
		$this->db->select("*");
		$this->db->from("video");
		$this->db->where_in("vid",$list);
		return $this->db->get()->result();
	}


	public function addMake($uid,$vid){
		$data = array(
			'uid' => $uid,
			'vid' => $vid
		);

		$this->db->insert('makes', $data);
	}
	public function fetchVideos($uid)
	{
		$this->db->select("vid");
		$this->db->from("makes");
		$this->db->where("uid",$uid);
		return $this->db->get()->result();
	}
	public function fetchVideoByVname($vname)
	{
		$this->db->select("vid");
		$this->db->from("video");
		$this->db->where("vname",$vname);
		return $this->db->get()->result();
	}



	public function getNames(){
		$query=$this->db->query('select name from user_table');
		return $query->result();
	}

	public function addUser($name,$pw,$email,$phone){
		$this->load->library('encryption');
		$encrypt_pw=$this->encryption->encrypt($pw);
		$data = array(
			'Name'=>$name,
			'Password'=>$encrypt_pw,
			'email'=>$email,
			'phone'=>$phone
		);

		$this->db->insert('user_table',$data);
	}


	public function fetch_data($query)
	{
		$this->db->select("*");
		$this->db->from("video");
		if($query != '')
		{
			$this->db->like('vname', $query);
			$this->db->or_like('vauthor', $query);
		}
		$this->db->order_by('vname', 'DESC');
		return $this->db->get();
	}



	public function fetchVideoByName($vname){
		$this->db->select("*");
		$this->db->from("video");
		$this->db->where('vname', $vname);
		return $this->db->get()->result();
	}

	public function fetchVideoByID($vid){
		$this->db->select("*");
		$this->db->from("video");
		$this->db->where('vid', $vid);
		return $this->db->get()->result();
	}

	public function addLike($uid,$vid){
		$data = array(
			'uid'=>$uid,
			'vid'=>$vid
		);
		$this->db->insert('likes',$data);
	}

	public function unLike($uid,$vid){
		$this->db->where('uid', $uid);
		$this->db->where('vid', $vid);
		$this->db->delete('likes');
	}


	public function fetchAllVideo()
	{
		$this->db->select("*");
		$this->db->from("video");
		return $this->db->get()->result();
	}





	public function searchByEmail($eamil){
		$this->db->select("*");
		$this->db->from("user_table");
		$this->db->where('email', $eamil);
		return  $this->db->get()->result();
	}







	public function verifyCode($name,$email,$code){
		$data = array(
			'name'=>$name,
			'email'=>$email,
			'code'=>$code
		);

		$this->db->insert('verify_code',$data);
	}

	public function getVerifyCode(){
		$sql = "SELECT * FROM verify_code";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function removeVerifyCode(){
		$sql = "DELETE FROM verify_code";
		$query=$this->db->query($sql);
	}

	public function updateUser($name,$pw,$email,$phone,$ID){
		$this->db->set('Name', $name);
		$this->db->set('Password', $pw);
		$this->db->set('email', $email);
		$this->db->set('phone', $phone);
		$this->db->where('ID', $ID);
		$this->db->update('user_table');
	}
	public function updatePSW($pw,$email){
		$this->load->library('encryption');
		$encrypw=$this->encryption->decrypt($pw);
		$this->db->set('Password', $encrypw);
		$this->db->set('email', $email);
		$this->db->where('email', $email);
		$this->db->update('user_table');
	}


	public function checkUniqueName($name){
		$sql = "SELECT * FROM user_table WHERE name =?";
		$query=$this->db->query($sql,$name);
		$qrresult=$query->result();
		if(sizeof($qrresult)>=1){
			return false;
		}
		return true;
	}

	public function checkUniqueEmail($email){
		$sql = "SELECT * FROM user_table WHERE email =?";
		$query=$this->db->query($sql,$email);
		$qrresult=$query->result();
		if(sizeof($qrresult)>=1){
			return false;
		}
		return true;
	}

	public function searchUserByID($ID){
		$sql = "SELECT * FROM user_table WHERE id =?";
		$query=$this->db->query($sql,$ID);
		return $query->result();
	}


	public function searchUserByName($name){
		$sql = "SELECT * FROM user_table WHERE Name =?";
		$query=$this->db->query($sql,$name);
		return $query->result();
	}

	public function searchIDByName($name){
		$sql = "SELECT * FROM user_table WHERE Name =?";
		$query=$this->db->query($sql,$name);
		return $query->result();
	}




	public function exist($USERNAME){
		if(sizeof($this->searchUserByName($USERNAME))>0){
			return true;
		}else{
			return false;
		}
	}

	//check user name and password is correct
	public function checkValid($USERNAME,$UPW){
		if($this->exist($USERNAME)){
			if($this->verifyPW($USERNAME,$UPW)==0){
				return true;
			}
		}
		return false;
	}


	public function findVideoComment($vid){
		$sql = "SELECT * FROM comments WHERE vid =?";
		$query=$this->db->query($sql,$vid);
		return $query->result();
	}

	public function verifyPW($USERNAME,$pw){
		$sql = "SELECT Password FROM user_table WHERE Name =?";
		$query=$this->db->query($sql,$USERNAME);
		$qrresult=$query->result();
		$spw=$qrresult[0]->Password;
		$this->load->library('encryption');
		$dpw=$decrypt_pw=$this->encryption->decrypt($spw);
		return strcmp($dpw,$pw);
	}

	public function addComment($vid,$time,$author,$content){
		$data = array(
			'vid'=>$vid,
			'time'=>$time,
			'author'=>$author,
			'content'=>$content
		);
		$this->db->insert('comments',$data);
	}

	public function addVideo($name,$time,$author,$vuploadtime){
		$data = array(
			'vtimes'=>$time,
			'vauthor'=>$author,
			'vname'=>$name,
			'vuploadtime'=>$vuploadtime
		);
		$this->db->insert('video',$data);
	}

//	public function compPW($ID,$PW){
//		$result=$this->getPW($ID);
//		$storedPW=$result[0]->Password;
//		return strcmp($storedPW,$PW);
//	}





}
