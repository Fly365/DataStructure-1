<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

//Cyask ���ò���

$dbhost = 'localhost';	// ���ݿ������
$dbuser = 'root';		// ���ݿ��û���
$dbpw = '11111111';				// ���ݿ�����
$dbname = 'anleye';		// ���ݿ���
$dbcharset = 'gbk';	// MySQL �ַ���
$pconnect = 0;			// ���ݿ�־����� 0=�ر�, 1=��
$tablepre = 'cy_';   // ����ǰ׺
$cookiepre = 'cyask_';	// cookie ǰ׺
$cookiedomain = '';		// cookie ������
$cookiepath  = '/';		// cookie ����·��
$cyask_key = '1234567890';
$charset = 'gbk';		// ����Ĭ���ַ���
$headercache = 0; 		// ҳ�滺�濪�� 0=�ر�, 1=��
$headercharset = 1;		// ǿ�������ַ���,ֻ����ʱʹ��
$tplrefresh = 1;		// ģ���Զ�ˢ�¿��� 0=�ر�, 1=��
$errorreport = 1;		// �Ƿ񱨸� PHP ����, 0=ֻ���������Ա�Ͱ���(����ȫ), 1=������κ���
$onlinehold = 300;		// ���߱���ʱ��
$attachdir = './attachments';	// ��������λ�� (������·��, ���� 777, ����Ϊ web �ɷ��ʵ���Ŀ¼, ���� "/", ���Ŀ¼����� "./" ��ͷ)
$attachurl = 'attachments';		// ����·�� URL ��ַ (��Ϊ��ǰ URL �µ���Ե�ַ�� http:// ��ͷ�ľ��Ե�ַ, ���� "/")
$htmlopen = 0; 			// ��̬ҳ���ɿ��� 0=�ر�, 1=��
?>