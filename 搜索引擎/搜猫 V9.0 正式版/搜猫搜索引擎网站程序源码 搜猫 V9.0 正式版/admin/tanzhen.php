<?php

require 'global.php';
;echo '';
$admessage = '���̽����������ʾ��<br />'.
"<a href=\"http://www.1230530.com\" target=\"_blank\">".
'�������PHP̽��V2.1 Build 040616<br />ǰȥ���Ի򷢱����</a>';
$defstyle = 'sim';
error_reporting(E_CORE_ERROR);
set_time_limit(0);
header('Content-Type: text/html; charset=gb2312');
$mtime = explode(' ',microtime());
$starttime = $mtime[1] +$mtime[0];
if(!get_cfg_var('register_globals')){
foreach($HTTP_GET_VARS as $key =>$val){
$$key = $val;
}
foreach($HTTP_POST_VARS as $key =>$val){
$$key = $val;
}
}
if(!$style)$style = $defstyle;
$PHP_SELF = $HTTP_SERVER_VARS[PHP_SELF] ?$HTTP_SERVER_VARS[PHP_SELF] : $HTTP_SERVER_VARS[SCRIPT_NAME];
$phpos = PHP_OS;
if($phpos=='BSD'||$phpos=='FreeBSD'||$phpos=='Linux'||$phpos=='NetBSD'||$phpos=='OpenBSD'||$phpos=='Darwin'){
$osinfo = uptime();
}else{
$osinfo = '�Բ���'.$phpos.'ϵͳ��֧��';
}
if(get_cfg_var('safemode')){
$safemode = '��';
}else {
$safemode = '��';
}
if (get_cfg_var('file_uploads') == '1'){
$upsize = get_cfg_var('upload_max_filesize');
}else {
$upsize = '�������ϴ�';
}
if (isset($_SERVER['SERVER_ADMIN'])){
$adminmail = "<a href=\"mailto:".$_SERVER['SERVER_ADMIN']."\" title=\"�����ʼ�\">".$_SERVER['SERVER_ADMIN'].'</a>';
}else{
$adminmail = "<a href=\"mailto:".get_cfg_var('sendmail_from')."\" title=\"�����ʼ�\">".get_cfg_var('sendmail_from').'</a>';
}
$dis_func = get_cfg_var('disable_functions');
if ($dis_func == ''){
$dis_func = "<span class=\"false\" ><b>��</b></span>";
}else {
$dis_func = str_replace(' ','<br />',$dis_func);
$dis_func = str_replace(',','<br />',$dis_func);
}
if(ereg('phpinfo',$dis_func)){
$phpinfo = "<span class=\"false\"><b>��</b></span><span class=\"s\">PHPINFO</span>";
}else{
$phpinfo = "<span class=\"ture\"><b>��</b></span><a href=\"$PHP_SELF?style=$style&testinfo=phpinfo#bottom\" title=\"��˲鿴PHPINFOϸ��Ϣ\">PHPINFO</a>";
}
function find_program ($program)
{
$path = array('/bin','/sbin','/usr/bin','/usr/sbin','/usr/local/bin','/usr/local/sbin');
while ($this_path = current($path)) {
if (is_executable("$this_path/$program")) {
return "$this_path/$program";
}
next($path);
}
return;
}
function execute_program ($program,$args = '')
{
$buffer = '';
$program = find_program($program);
if (!$program) {return;}
if ($args) {
$args_list = split(' ',$args);
for ($i = 0;$i <count($args_list);$i++) {
if ($args_list[$i] == '|') {
$cmd = $args_list[$i+1];
$new_cmd = find_program($cmd);
$args = ereg_replace("\| $cmd","| $new_cmd",$args);
}
}
}
}
function grab_key ($key)
{
return execute_program('sysctl',"-n $key");
}
function get_sys_ticks ()
{
$s = explode(' ',grab_key('kern.boottime'));
$a = ereg_replace('{ ','',$s[3]);
$sys_ticks = time() -$a;
return $sys_ticks;
}
function uptime ()
{
if(PHP_OS=='Linux'){
$fd = fopen('/proc/uptime','r');
$ar_buf = split(' ',fgets($fd,4096));
fclose($fd);
$sys_ticks = trim($ar_buf[0]);
}else{
$sys_ticks = get_sys_ticks();
}
$min   = $sys_ticks / 60;
$hours = $min / 60;
$days  = floor($hours / 24);
$hours = floor($hours -($days * 24));
$min   = floor($min -($days * 60 * 24) -($hours * 60));
if ($days != 0) {
$result = ''.$days.'��';
}
if ($hours != 0) {
$result .= ''.$hours.'Сʱ';
}
$result .= ''.$min.'����';
return "$result";
}
function gettimeout(){
GLOBAL $starttime;
$mtime = explode(' ',microtime());
$endtime = $mtime[1] +$mtime[0];
$totaltime = ($endtime -$starttime);
$totaltime = number_format($totaltime,7);
$debuginfo = "Processed in $totaltime second(s)";
return $debuginfo;
}
function issupp($func_name,$func='function_exists')
{
if ($func($func_name)){
$su = "<span class=\"ture\"><b>��</b></span>";
}else {
$su = "<span class=\"false\"><b>x</b></span>";
}
return $su;
}
function int_test()
{
$time_start=gettimeofday();
for($index=0;$index<=3000000;$index++);
{
$count=1+1;
}
$time_end=gettimeofday();
$time=($time_end['usec']-$time_start['usec'])/1000000;
$time=$time+$time_end['sec']-$time_start['sec'];
$time=round($time*1000)/1000;
return($time);
}
function float_test()
{
$test=pi();
$time_start=gettimeofday();
for($index=0;$index<=3000000;$index++);
{
sqrt($test);
}
$time_end=gettimeofday();
$time=($time_end['usec']-$time_start['usec'])/1000000;
$time=$time+$time_end['sec']-$time_start['sec'];
$time=round($time*1000)/1000;
return($time);
}
function io_test()
{
global $PHP_SELF;
$fp=fopen(".$PHP_SELF",'r');
$time_start=gettimeofday();
for($index=0;$index<10000;$index++)
{
fread($fp,10240);
rewind($fp);
}
$time_end=gettimeofday();
fclose($fp);
$time=($time_end['usec']-$time_start['usec'])/1000000;
$time=$time+$time_end['sec']-$time_start['sec'];
$time=round($time*1000)/1000;
return($time);
}
if ($test)
{
switch($test)
{
case 'int':
$vint	= int_test();
break;
case 'float':
$vfloat	= float_test();
break;
case 'io':
$vio	= io_test();
break;
}
}
function te_val($val){
if($val){
if($val == '0'){
$vale = 'С��0.001��';
}else{
$vale = $val.'��';
}
}else{
$vale = 'δ����';
}
return $vale;
}
if($style == 'sim'){
$skin[bdcolor]	= '#ffffff';
$skin[tdfont]	= '#666666';
$skin[tdborder] = '#cccccc';
$skin[tdbg]		= '#fcfcfc';
$skin[flink]	= '#336699';
$skin[fhove]	= '#b4c8d8';
}elseif($style == 'red'){
$skin[bdcolor]	= '#FFCC99';
$skin[tdfont]	= '#333333';
$skin[tdborder] = '#FF6600';
$skin[tdbg]		= '#FFAC84';
$skin[flink]	= '#FF3399';
$skin[fhove]	= '#FF9999';
}elseif($style == 'blu'){
$skin[bdcolor]	= '#DAFEEC';
$skin[tdfont]	= '#626262';
$skin[tdborder] = '#009900';
$skin[tdbg]		= '#D1FCF9';
$skin[flink]	= '#33CC99';
$skin[fhove]	= '#0099FF';
}
$info[0]  = array('������ʱ��',date('Y��m��d�� h:i:s',time()));
$info[1]  = array('����������',"<a href=\"http://$_SERVER[SERVER_NAME]\"  title=\"���ʴ�����\" target=\"_blank\">$_SERVER[SERVER_NAME]</a>");
$info[2]  = array('������IP��ַ',gethostbyname($_SERVER['SERVER_NAME']));
$info[3]  = array('����������ϵͳ',PHP_OS);
$info[4]  = array('����������ʱ��',$osinfo);
$info[5]  = array('����������ϵͳ���ֱ���',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$info[6]  = array('��������������',$_SERVER['SERVER_SOFTWARE']);
$info[7]  = array('Web����˿�',$_SERVER['SERVER_PORT']);
$info[8]  = array('PHP���з�ʽ',strtoupper(php_sapi_name()));
$info[9]  = array('PHP�汾',PHP_VERSION);
$info[10] = array('�����ڰ�ȫģʽ',$safemode);
$info[11] = array('����������Ա',$adminmail);
$info[12] = array('���ļ�·��',$_SERVER['SCRIPT_FILENAME']);
$info[13] = array('����ʹ��URL���ļ�allow_url_fopen',issupp('allow_url_fopen','get_cfg_var'));
$info[14] = array('����̬�������ӿ�enable_dl',issupp('enable_dl','get_cfg_var'));
$info[15] = array('��ʾ������Ϣdisplay_errors',issupp('display_errors','get_cfg_var'));
$info[16] = array('�Զ�����ȫ�ֱ���register_globals',issupp('register_globals','get_cfg_var'));
$info[17] = array('�����������ʹ���ڴ���memory_limit',get_cfg_var('memory_limit'));
$info[18] = array('POST����ֽ���post_max_size',get_cfg_var('post_max_size'));
$info[19] = array('��������ϴ��ļ�upload_max_filesize',$upsize);
$info[20] = array('���������ʱ��max_execution_time',get_cfg_var('max_execution_time').'��');
$info[21] = array('�����õĺ���disable_functions',$dis_func);
$info[22] = array('PHP��ϢPHPINFO',$phpinfo);
$info[23] = array('Ŀǰ���п���ռ�diskfreespace',intval(diskfreespace('.') / (1024 * 1024)).'Mb');
$info[24] = array('ƴд��� ASpell Library',issupp('aspell_new'));
$info[25] = array('�߾�����ѧ���� BCMath',issupp('bcadd'));
$info[26] = array('�������� Calendar',issupp('JDToGregorian'));
$info[27] = array('DBA���ݿ�',issupp('dba_close'));
$info[28] = array('dBase���ݿ�',issupp('dbase_close'));
$info[29] = array('DBM���ݿ�',issupp('dbmclose'));
$info[30] = array('FDF�����ϸ�ʽ Forms Data Format',issupp('FDF_close'));
$info[31] = array('FilePro���ݿ�',issupp('filepro'));
$info[32] = array('Hyperwave���ݿ�',issupp('hw_close'));
$info[33] = array('ͼ�δ��� GD Library',issupp('imageline'));
$info[34] = array('IMAP�����ʼ�ϵͳ',issupp('imap_close'));
$info[35] = array('Informix���ݿ�',issupp('ifx_close'));
$info[36] = array('InterBase���ݿ�',issupp('ibase_close'));
$info[37] = array('LDAPĿ¼Э��',issupp('ldap_close'));
$info[38] = array('MCrypt���ܴ���',issupp('mcrypt_cbc'));
$info[39] = array('��ϡ���� MHash',issupp('mhash'));
$info[40] = array('mSQL���ݿ�',issupp('msql_close'));
$info[41] = array('SQL Server���ݿ�',issupp('mssql_close'));
$info[42] = array('MySQL���ݿ�',issupp('mysql_close'));
$info[43] = array('SyBase���ݿ�',issupp('sybase_close'));
$info[44] = array('Yellow Pageϵͳ',issupp('yp_match'));
$info[45] = array('Oracle���ݿ�',issupp('ora_close'));
$info[46] = array('Oracle 8 ���ݿ�',issupp('OCILogOff'));
$info[47] = array('PREL�����﷨ PCRE',issupp('preg_match'));
$info[48] = array('PDF�ĵ�֧��',issupp('pdf_close'));
$info[49] = array('Postgre SQL���ݿ�',issupp('pg_close'));
$info[50] = array('SNMP�������Э��',issupp('snmpget'));
$info[51] = array('VMailMgr�ʼ�����',issupp('vm_adduser'));
$info[52] = array('WDDX֧��(Web Distributed Data Exchange)',issupp('wddx_add_vars'));
$info[53] = array('ѹ���ļ�֧��(Zlib)',issupp('gzclose'));
$info[54] = array('XML����',issupp('xml_set_object'));
$info[55] = array('FTP',issupp('ftp_login'));
$info[56] = array('ODBC���ݿ�����',issupp('odbc_close'));
$info[57] = array('Session֧��',issupp('session_start'));
$info[58] = array('Socket֧��',issupp('fsockopen'));
;echo '<!--���������������������������������������� C1G��PHP̽�� ����������������������������������������������-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="author" content="www.c1gstudio.com" /> 
<meta name="description" content="C1G��php̽��" /> 
<meta name="keywords" content="HTML,w3c,c1g,��Ӱ,���,����,php,mysql,ͼƬ,flash,music,mp3,����,����,����,���,����,��ʽ,����,������,studio,��վ,��ҳ" />
<title>&nbsp;Explorer Internet Microsoft -/C1G��PHP̽��\\</title>
<style type="text/css">
 td		{font-size:8pt; color: ';echo $skin[tdfont];echo ';font-family:Verdana}
 input		{BORDER-RIGHT: ';echo $skin[tdborder];echo ' 1px solid; BORDER-TOP: ';echo $skin[tdborder];echo ' 1px solid; BORDER-LEFT: ';echo $skin[tdborder];echo ' 1px solid; COLOR: ';echo $skin[tdfont];echo '; BORDER-BOTTOM: ';echo $skin[tdborder];echo ' 1px solid; BACKGROUND-COLOR: ';echo $skin[bdcolor];echo '} 
 body		{text-align: center; left: 0px; top: 200px; font-size:8pt; color: ';echo $skin[tdfont];echo ';font-family:Verdana; SCROLLBAR-FACE-COLOR: #ffffff; background color:';echo $skin[bdcolor];echo ';cursor:SCROLLBAR-HIGHLIGHT-COLOR: #ffffff; SCROLLBAR-SHADOW-COLOR: #aaaaaa; SCROLLBAR-3DLIGHT-COLOR: #aaaaaa; SCROLLBAR-ARROW-COLOR: #dddddd; SCROLLBAR-TRACK-COLOR: #ffffff; SCROLLBAR-DARKSHADOW-COLOR: #ffffff }
 a:link		{text-decoration:none; color:';echo $skin[flink];echo '} 
 a:visited	{text-decoration:none; color:';echo $skin[flink];echo '} 
 a:active	{text-decoration:none; color:';echo $skin[flink];echo '} 
 a:hover	{COLOR: ';echo $skin[fhove];echo '; }
 .tb		{BORDER-RIGHT: ';echo $skin[tdborder];echo ' 1px solid; BORDER-TOP: ';echo $skin[tdborder];echo ' 1px solid; BORDER-LEFT: ';echo $skin[tdborder];echo ' 1px solid; BORDER-BOTTOM: ';echo $skin[tdborder];echo ' 1px solid;background-color:';echo $skin[tdborder];echo '}
 .tb0		{BORDER-RIGHT: ';echo $skin[tdborder];echo ' 1px solid; BORDER-TOP: ';echo $skin[tdborder];echo ' 1px solid; BORDER-LEFT: ';echo $skin[tdborder];echo ' 1px solid; BORDER-BOTTOM: ';echo $skin[tdborder];echo ' 1px solid;background-color:';echo $skin[tdbg];echo '}
 .tb1		{background-color:';echo $skin[bdcolor];echo '}
 .ture		{color: green}
 .false		{color:red}
 .u			{text-decoration: underline}
 .s			{text-decoration: line-through}
 </style>
</head>

<body >
<div  id="top" style="MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px">

<table width="100%"  border="0" cellpadding="0" cellspacing="1" >
<tr class="tb"><td align="left"><table class="table" cellspacing="0" cellpadding="5" width="99%" align="center" 
border="1">
  <tbody>
    <tr>
      <td><strong>��¼��Ϣ</strong></td>
    </tr>
    <tr>
      <td>���ã�admin��ӭ��������վ����ҳ��</td>
    </tr>
    <tr>
      <td><span class="hback">��ݲ˵��� <a 
      href="http://127.0.0.1/1/admin/Admin_Set.php">����Ա����</a>&nbsp;��&nbsp;<a 
      href="http://127.0.0.1/1/admin/Admin_Log.php">��־����</a> ��<a 
      href="http://127.0.0.1/1/admin/Admin_Notice.php">�������</a></span></td>
    </tr>
  </tbody>
</table></td>
</tr>
<tr class="tb"><td align="left">

 <table width="100%" border="0" cellpadding="2" cellspacing="1" style="background-color:';echo $skin[tdborder];echo ';">
 <tr><td class="tb1">
  <table width="100%" border="0" cellpadding="0" cellspacing="1" >
  <tr>
  <td style="width:100" ><a href="#server">����������</a></td>
  <td style="width:100"><a href="#php">PHP��������</a></td>
  <td style="width:100"><a href="#basic">���֧��״��</a></td>
  <td style="width:100"><a href="#define">�Զ�����</a></td>
  <td style="width:100"><a href="#power">���������ܼ��</a></td>
  <td style="width:100">';echo $phpinfo;echo '</td>
  </tr>
  </table>
 </td></tr>
 </table>

</td></tr>
<tr><td>
';
for($a=0;$a<5;$a++){
if($a == 0){
$hp = array('server','����������');
}elseif($a == 1){
$hp = array('php','PHP��������');
}elseif($a == 2){
$hp = array('basic','���֧��״��');
}elseif($a == 3){
$hp = array('define','�Զ�����');
}elseif($a == 4){
$hp = array('power',' ���������ܼ�� ');
}
;echo '
 <a name="';echo $hp[0];echo '"></a>
 <table width="100%" border="0" cellpadding="0" cellspacing="1" >
 <tr><td>

  <table width="100%" border="0" cellpadding="4" cellspacing="0" >
   <tr><td class="tb0"  style="width:100" align="center">';echo $hp[1];echo '</td><td></td></tr>
  </table>

 </td></tr>
 <tr><td>

  <table width="100%" border="0" cellpadding="2" cellspacing="1"  style="background-color:';echo $skin[tdborder];echo ';">
  <tr><td class="tb1">
   <table width="100%" border="0" cellpadding="2" cellspacing="1" >
';
if($a == 0){
for($i=0;$i<=12;$i++){
echo "<tr align=\"left\"><td style=\"width:30%\">".$info[$i][0]."</td><td style=\"width:70%\">".$info[$i][1]."</td></tr>\n";
}
}elseif($a == 1){
for($i=13;$i<=23;$i++){
echo "<tr align=\"left\"><td style=\"width:70%\">".$info[$i][0]."</td><td style=\"width:30%\">".$info[$i][1]."</td></tr>\n";
}
}elseif($a == 2){
for($i=24;$i<=58;$i++){
echo "<tr align=\"left\"><td style=\"width:70%\">".$info[$i][0]."</td><td style=\"width:30%\">".$info[$i][1]."</td></tr>\n";
}
}elseif($a == 3){
;echo '   <tr><td>

	<a name="';echo $hp[0];echo '"></a>
	<table border="0" width="100%" cellspacing="1" cellpadding="1">
	<tr><td><label title="classname" >����������������������Ҫ���Ĳ�����</label><a href="#" title="����variables_order:gpc_order:magic_quotes_gpc:asp_tags:session.save_path">ProgId��ClassId��</a> 
	</td></tr>
	<tr><td align="center" style="height:30" >
	<form name="form1" action="';echo $PHP_SELF;echo '#define" method="post" >
	<input name="ft" value="check" type="hidden" />
	<input name="style" value="';echo $style;echo '" type="hidden" />
	<input class="input" type="text" value="" name="classname" size="40" />
	<input type="submit" value="ȷ��" class="backc" name="submit1" />
	<input type="reset" value="����" class="backc" name="reset1" /> 
	</form>
	</td></tr>
	</table>

   </td></tr>
';if($ft=='check'){;echo '   <tr><td>

	<table border="0" width="100%" cellspacing="2" cellpadding="1">
	<tr style="height:18" class="mytr" align="center">
	<td style="width:70%">�� ѯ �� �� �� ��</td>
	<td style="width:30%">����</td>
	</tr>
	<tr align="center" style="height:18">
	<td align="left">&nbsp;';echo $classname;echo '&nbsp;</td>
	<td align="center">&nbsp;�뿴����Ĳ���</td></tr>
	<tr align="center" ><td align="left" style="height:18">&nbsp;Getenv��ʽ</td><td align="left">&nbsp;';echo getenv("$classname");echo '</td></tr>
	<tr align="center" ><td align="left" style="height:18">&nbsp;Get_cfg_var��ʽ</td><td align="left">&nbsp;';echo get_cfg_var("$classname");echo '</td></tr>
	<tr align="cente" ><td align="left" style="height:18">&nbsp;Get_magic_quotes_gpc��ʽ</td><td align="left">&nbsp;';echo get_magic_quotes_gpc("$classname");echo '</td></tr>
	<tr align="center" ><td align="left" style="height:18">&nbsp;Get_magic_quotes_runtime��ʽ</td><td align="left">&nbsp;';echo get_magic_quotes_runtime("$classname");echo '</td></tr>
	</table>

   </td></tr>
';
}
}elseif($a == 4){
;echo '   <tr><td>
	<a name="';echo $hp[0];echo '"></a>

	<table width="100%" border="0" cellspacing="2" cellpadding="1">
	';
for($j=0;$j<3;$j++){
if($j == 0) {
$do = 'int';
if($vfloat) $otval = "<input type=\"hidden\" name=\"vfloat\" value=\"$vfloat\" />\n";
if($vio) $otval .= "<input type=\"hidden\" name=\"vio\" value=\"$vio\" />\n";
$show = $vint ?'���²���': '����';
$pval = array('1.782��','5.603��','67.371��','1.456��',te_val($vint));
$phead = '����������������(1+1����300���)';
}elseif($j == 1){
$do = 'float';
$otval = '';
if($vint) $otval = "<input type=\"hidden\" name=\"vint\" value=\"$vint\" />\n";
if($vio) $otval .= "<input type=\"hidden\" name=\"vio\" value=\"$vio\" />\n";
$show = $vfloat ?'���²���': '����';
$pval = array('1.821��','2.618��','29.44��','1.291��',te_val($vfloat));
$phead = '����������������(��ƽ��300���)';
}elseif($j == 2){
$do = 'io';
$otval = '';
if($vfloat) $otval = "<input type=\"hidden\" name=\"vfloat\" value=\"$vfloat\" />\n";
if($vint) $otval .= "<input type=\"hidden\" name=\"vint\" value=\"$vint\" />\n";
$show = $vio ?'���²���': '����';
$pval = array('0.073��','0.128��','0.332��','0.092��',te_val($vio));
$phead = '����I/O��������(��ȡ10K�ļ�10000��)';
}
;echo '	<tr class="myhead" align="left"> 
	<td colspan="2" ><b>';echo $phead;echo '</b></td>
	</tr>
	<tr class="mytr" align="left"> 
	<td style="width:70%" >C1G�ĵ���(6C/1.4G+128M+Win2000)</td>
	<td style="width:30%" >';echo $pval[0];echo '</td>
	</tr>
	<tr class="mytr" align="left"> 
	<td style="width:70%" >zanadoo.com(C1.3G+256M+Linux)(2003/03/15 17:58)</td>
	<td style="width:30%" >';echo $pval[1];echo '</td>
	</tr>
	<tr class="mytr" align="left"> 
	<td>51.net������A��(598MHz+SCSI)(2003/03/15 17:28)</td>
	<td>';echo $pval[2];echo '</td>
	</tr>
	<tr class="mytr" align="left"> 
	<td>�и������PHP��(2003/03/15 17:36)</td>
	<td>';echo $pval[3];echo '</td>
	</tr>
	<tr class="mytr" align="left" valign="top">
	<td>
	<form name="test';echo $j;echo '" method="post" action="';echo $PHP_SELF;echo '#power">
	������ʹ�õ���̨������';echo $otval;echo '	<input name="style" value="';echo $style;echo '" type="hidden" />
	<input type="hidden" name="test" value="';echo $do;echo '" />
	[<a href="javascript:test';echo $j;echo '.submit()">';echo $show;echo '</a>]
	</form>
	</td>
	<td>';echo $pval[4];echo '</td>
	</tr>
	';};echo '	</table>

   </td></tr>
   ';
}
;echo '   </table>
  </td></tr>
  </table>
 </td></tr>
 </table>
';
}
;echo '</td></tr>
<tr><td>
 <table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
 <td style="width:150"><p style="MARGIN-TOP: 0px">&nbsp;<span style="FONT-SIZE: 7pt; color:#333333;ext-decoration: underline">Powered by somao </span></p></td>
 <td align="center"><span style="font-size: 7pt; color:#333333">';echo gettimeout();echo '</span></td>
 <td align="right"><a href="#top" title="ǰ������">������</a></td>
 </tr>
 </table>
</td></tr>
</table>
</div>

<a name="bottom" id="bottom"></a>
</body>
</html>
';
if($testinfo)phpinfo();

?>
