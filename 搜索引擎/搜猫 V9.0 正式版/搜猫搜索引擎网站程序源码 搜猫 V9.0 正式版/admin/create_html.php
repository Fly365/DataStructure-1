<?php

$php=$_GET['php'].'.php';
$html=$_GET['html'].'.html';
ob_start();
require $php;
$file=ob_get_contents();
ob_end_clean();
$fp=@fopen($html,'w') or die('д��ʽ���ļ�ʧ�ܣ��������Ŀ¼�Ƿ�Ϊ��д');
@fputs($fp,$file."<div style=\"display:none\">http://www.1230530.com/</div>") or die('�ļ�д��ʧ��,�������Ŀ¼�Ƿ�Ϊ��д');
@fclose($fp);
echo '���ɳɹ�!';

?>
