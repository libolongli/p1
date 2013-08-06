<?php

	require_once 'db.class.php';
	/*
	 * @author libo
	 * date 2013-08-06
	 * 主要是完成信息发送和接收的接口
	 */
	class msg extends msg_db{
		public function __construct() {
        	$this->connect('localhost','root','root','project');
    	}
		//发送信息
		public function sendMessage($uid,$rids,$contents){		
			if(is_array($rids)){
				$rids = implode(",", $rids);
			}
			$now = $_SERVER['REQUEST_TIME'];			
			$sql = "INSERT INTO msg (uid,rids,contents,ts_created,ts_updated,status) VALUES";			
			$sql.= "({$uid},'{$rids}','{$contents}',{$now},{$now},1)";	
			$this->query($sql); 
			foreach (explode(",", $rids) as $key => $value){
				$sql = "INSERT INTO msg_log (uid,rid,ts_created) VALUES({$uid},{$value},$now)";
				$this->query($sql);
			}		
		}
		//获取信息
		public function getMessage($uid){
			$sql = "SELECT * FROM msg_log WHERE uid={$uid}";
			return $this->fetch_all($sql);
			
		}
	}
	
	$msg = new msg();
	$msg->sendMessage(1, "2,3,4,5,6", "这是一次测试");
	echo '发送成功!';


