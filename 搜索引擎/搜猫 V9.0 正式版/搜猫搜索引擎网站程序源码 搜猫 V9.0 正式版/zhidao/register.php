<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'register');
require './include/common.inc.php';

$url=empty($_GET['url']) ? $_POST['url'] : $_GET['url'];
if($command=='registed')
{
	if($cyask_uid)
	{
		show_message('login_succeed_member', $url);
	}

	$query = $dblink->query("SELECT count(*) FROM {$tablepre}member WHERE regip='$onlineip'");
	$usernum = $dblink->result($query,0);
	if($usernum >= $count_ip_register)
	{
		show_message('regist_ip_used', '');
    }
	
	if(check_submit($_POST['registsubmit'], $_POST['formhash']))
	{
		$cyask_user = trim($_POST['username']);
		$cyask_user = strtolower($cyask_user);
		$cyask_email = trim($_POST['email']);
		
		if(!is_email($cyask_email))
		{
			show_message('regist_email_error_4', '');
			exit;
		}
		
		$query = $dblink->query("SELECT email FROM {$tablepre}member WHERE email='$cyask_email'");
		$email_num = $dblink->num_rows($query);
		if($email_num > 0)
		{
			show_message('regist_email_error_6', '');
			exit;
		}
	
		$query = $dblink->query("SELECT username FROM {$tablepre}member WHERE username='$cyask_user'");
		$name_num = $dblink->num_rows($query);

		if($name_num == 0)
		{
			$cyask_pw = md5($_POST['password']);
			
			$sql="INSERT INTO {$tablepre}member SET username='$cyask_user',password='$cyask_pw',email='$cyask_email',adminid='5',regip='$onlineip',lastlogin='$timestamp'";
			if($query = $dblink->query($sql))
			{
				$cyask_uid = $dblink->insert_id();
			}
			
			update_score($cyask_uid, $score_register, '+');
				
			$cookietime = 60*60*24;
			set_cookie('compound', authcode("$cyask_uid\t$cyask_user\t$cyask_pw", 'ENCODE', $cyask_key), $cookietime);
			set_cookie('styleid', $styleid, $cookietime);
				
			show_message('regist_succeed', $url);
		}
		else
		{
			show_message('regist_name_used', '');
        }
	}
	else
	{
		exit("url error");
	}
}
else if($command == 'getpw')
{
	if($cyask_uid)
	{
		show_message('login_succeed_member', './');
	}
	if(check_submit($_POST['getpwsubmit'], $_POST['formhash']))
	{
		$email=trim($_POST['email']);
		
		$query=$dblink->query("SELECT uid,username FROM {$tablepre}member WHERE email='$email'");
		$user_num=$dblink->num_rows($query);
		if($user_num)
		{
			$member=$dblink->fetch_array($query);
			$idstring = rand_code(8);
			$dblink->query("UPDATE {$tablepre}member SET authstr='$timestamp\t1\t$idstring' WHERE uid='$member[uid]'");
			
			$get_passwd_subject='�һء�'.$site_name.'����¼����';
			$get_passwd_message=$member[username].' ����ã�������ʹ�á�'.$site_name.'�������һع��ܡ�
----------------------------------------------------------------------<br />

����Ҫ������֮�ڣ�ͨ�������������������������룺<br />

http://www.cyask.com/getpw.php?uid='.$member[uid].'&id='.$idstring.'

(������治��������ʽ���뽫��ַ�ֹ�ճ�����������ַ���ٷ���)<br />

�����ҳ��򿪺������µ�������ύ������ʹ���µ������¼�ˡ��������ڸ��˿ռ�����ʱ�޸��������롣<br />

�������ύ�ߵ� IP Ϊ '.$onlineip.' &nbsp;ʱ��Ϊ '.date("Y��n��j�� Hʱi��").'<br />
<br />
'.$site_name;

			sendmail($member['email'],$get_passwd_subject,$get_passwd_message);

			show_message('getpw_send_succeed', './');
			exit;
		}
		else
		{
			show_message('email_not_exist', '');
        }
	}
	else
	{
		include template('getpw');
	}
}
else
{
	include template('register');
}
?>