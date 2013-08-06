<?php
	require_once 'db.class.php';
	class msg extends msg_db{
		public function __construct() {
        	$this->connect('localhost','root','root','project');
    	}
		//发送信息
		public function sendMessage($uid,$rids,$contents){		
			if(is_array($rids)){
				$rids = implode(",", $rids);
			}
			$now = $_REQUEST['TIME'];			
			$sql = "INSERT INTO msg (uid,rids,contents,ts_created,ts_updated,status) VALUES";			
			$sql.= "({$uid},'{$rids}','{$contents}',{$now},{$now},1)";	
			$this->query($sql);
		}
		//获取信息
		public function getMessage($uid){
			$sql = "SELECT * FROM msg_log WHERE uid={$uid}";
			return $this->fetch_all($sql);
			
		}
	}


