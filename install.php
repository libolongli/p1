<?php
require_once 'db.class.php';
$db= new msg_db();
$db->connect('localhost', 'root', 'root');
$sql = <<<EOF1
create database project;
EOF1;
$db->query($sql);
$db->close();
$db->connect('localhost', 'root', 'root','project');
$sql = <<<EOF2
CREATE TABLE `msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rids` varchar(255) NOT NULL,
  `contents` varchar(255) DEFAULT NULL,
  `ts_created` int(11) NOT NULL,
  `ts_updated` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0代表已删除,1代表未读,2代表已读...',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

EOF2;
$db->query($sql);
$sql = <<<EOF
	CREATE TABLE `msg_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `ts_created` int(11) NOT NULL,
  `fleg` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8

EOF;
$db->query($sql);
echo "接下来可以执行msg.php进行测试";