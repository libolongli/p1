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
		public function getMessage($where,$page=1,$limit=20,$sort= " DESC"){
			$sql = "SELECT * FROM msg_log WHERE 1=1 ";
			if($where){
				foreach ($where as $key => $value) {
					$sql .= "AND {$key}={$value} ";
				}
			}

			$limitstart = ($page-1)*$limit;
			$sql .= " ORDER BY id {$sort} ";
			$sql .="LIMIT ".$limitstart.",".$limit;
			return array(
				'data' => $this->fetch_all($sql),
				'page' =>$page,
				'limit' =>$limit
			);	
		}

	}
	
	//$msg = new msg();
	//$msg->sendMessage(1, "2,3,4,5,6", "这是一次测试");
	//echo '发送成功!';
	//
	//$data = $msg->getMessage(array('uid'=>1));
	//print_r($data);exit;

