<?php

//ץȫվ--- ���߳�
function all_links_duo($site_id,$ceng,$include_word,$not_include_word)
{
   global $db; 
   $new_url=array();
   $fenge=array();
   $nei=1;//1����ֻ������ 2�������� �մ�������
   $numm=20;//���������߳�
   	echo "<br><b>��ʼץȡ��".$ceng."��</b><br>";
	$ceng++;
	$row=$db->get_one("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
	if(empty($row)){echo "  ---------- û����������<br>";return;}//����Ҳ���������url,�����
	  
	  
   $query=$db->query("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_url[]=$row[url];
	 }
   $he_num = ceil(count($new_url)/$numm);//������Ҫѭ�����ٴ�
   $fenge=array_chunk($new_url,$numm);//������ָ�ɶ��ٿ����� ÿ���С$numm 


  /* echo "һ�����ٸ�";
   echo count($new_url);
      echo "��Ҫѭ��";
   echo $he_num;
   echo "��<br>";	*/
   
      
   for($i=0;$i<=$he_num;$i++) 
	 {
		 /*echo "��ʼѭ���� ".$i." ��<br>";
		 print_r($fenge[$i]);
		 echo "<br>";*/
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);
		 //��Ҫ�ѵõ�������  (����ֻ���� ��ַ��Դ��) ����  д�����ݿ� ,
			/*echo "<b>����ץ�����ַΪ</b>";
			print_r($fen_url[url]);
			echo "<br>";*/
		foreach ((array)$fen_url as $url => $file)
  	 	{ 
					$links = array();
					$temp_links = array();
					$cha_temp = array();
					$loy = array();
					$new_links = array();			
					$cha_links = array();
					$cha_links_num = array();
					
					$links = _striplinks($file);			   //��htmlcode����ȡ��ַ
					$links = _expandlinks($links, $url);       //��ȫ��ַ
					$links=check_wai($links,$nei,$url);
					$links=array_values(array_unique($links)); 
							
					$bianma = bianma($file);					  //��ȡ�õ�htmlcode�ı���
					$file  = Convert_File($file,$bianma);		 //ת�����б���Ϊgb2312	
					$loy = clean_lry($file,$url,"html"); 
					$title=$loy["title"];                     //�������еõ�����,��ֵ��title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($loy["fulltext"]); 
					$description=$loy["description"];         //�������еõ�����,��ֵ��description	
					$keywords=$loy["keywords"];               //�������еõ�����,��ֵ��keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();
				if($title==""){$title=str_cut($fulltxt,65); }
					
		//����url,��������	
	  		$array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      		$db->update("ve123_links",$array,"url='".$url."'");
	
			$all_num = count($links);
	  //��ʼ��ȡ ve123_links_temp ������site_id Ϊ$site_id ��url   Ȼ���ץȡ�� $links ����Ƚ�,���õ��Ĳ������  ve123_links_temp ��
			$query=$db->query("select url from ve123_links_temp where url like '%".getdomain($url)."%'");
			while($row=$db->fetch_array($query))
	 		 {		
				 $temp_links[]=rtrim($row[url],"/");
			  }  
			  		  
			$cha_temp=array_diff($links,$temp_links);
					
  			foreach((array)$cha_temp as $value)
  			 {
			 	if(check_include($value, $include_word, $not_include_word ))
				 {
					 $arral=array('url'=>$value,'site_id'=>$site_id);
					 $db->insert("ve123_links_temp",$arral);
				 }  

			 }				  

	//��ʼ��ȡ ve123_links ������site_id Ϊ $site_id ��url   Ȼ���ץȡ�� $links ����Ƚ�,���õ��Ĳ������  ve123_links ��  �ϼ������ �Ѵ�����
			$query=$db->query("select url from ve123_links where url like '%".getdomain($url)."%'");
			while($row=$db->fetch_array($query))
	 		 {		
		 		  $new_links[]=rtrim($row[url],"/");
	  		}  				 
		 
			$cha_links=array_diff($links,$new_links);

			foreach((array)$cha_links as $value)
  			 { 
				if(check_include($value, $include_word, $not_include_word ))
				 {
					$array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
					$db->insert("ve123_links",$array);
					$cha_links_num[]=$value;
				 } 
			 }	
			 
			$cha_num = count($cha_links_num);	 
			printLinksReport($cha_num, $all_num, $cl=0);
			 echo "<a href=".$url." target=_blank>".$url. "</a><br>";
			 
			$arral=array('no_id'=>1);
	 	    $db->update("ve123_links_temp",$arral,"url='$url'");	
			 ob_flush();
  	  		 flush();	  	  					
			}
		 }

	
   all_links_duo($site_id,$ceng,$include_word,$not_include_word);//�ٴε��ñ�������ʼѭ��
}	


//һ����վ  
function find_sites($site_id,$ceng)
{
   global $db; 
   $new_url=array();
   $fenge=array();
   $numm=20;//���������߳�
   	echo "<br><b>��ʼץȡ��".$ceng."��</b><br>";
	$ceng++;
	$row=$db->get_one("select * from ve123_sites_temp where site_id='".$site_id."' and no_id='0'");
	if(empty($row)){echo "  ---------- û����������<br>";return;}//����Ҳ���������url,�����
	  
	  
   $query=$db->query("select * from ve123_sites_temp where site_id='".$site_id."' and no_id='0'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_url[]=$row[url];
	 }
   $he_num = ceil(count($new_url)/$numm);//������Ҫѭ�����ٴ�
   $fenge=array_chunk($new_url,$numm);//������ָ�ɶ��ٿ����� ÿ���С$numm 
    
   for($i=0;$i<=$he_num;$i++) 
	 {
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);
		 //��Ҫ�ѵõ�������  (����ֻ���� ��ַ��Դ��) ����  д�����ݿ� ,
		foreach ((array)$fen_url as $url => $file)
  	 	{ 
					$links = array();	
					$fen_link = array();
					$nei_link = array();
					$wai_link = array();
					$new_temp = array();
					$cha_temp = array();
					$new_site = array();
					$cha_site = array();
					$new_lik = array();
					$cha_lik = array();
					
					$links = _striplinks($file);			   //��htmlcode����ȡ��ַ
					$links = _expandlinks($links, $url);       //��ȫ��ַ					
					$fen_link=fen_link($links,$url);            //�������������ֿ�
					$nei_link=array_values(array_unique($fen_link[nei])); //�������� �ظ�����ַ
					$wai_link=GetSiteUrl($fen_link[wai]);                //��������ת������ҳ
					$wai_link=array_values(array_unique($wai_link)); //�������� �ظ�����ַ


					//���� ve123_sites_temp ������ site_id=-1  and no_id=0
  				  $query=$db->query("select url from ve123_sites_temp where site_id='".$site_id."'");
  				  while($row=$db->fetch_array($query)) { $new_temp[]=$row[url]; }
					$cha_temp=array_diff($nei_link,$new_temp);//���������бȽ� �ó��
					//��������� ve123_sites_temp ��
  					foreach((array)$cha_temp as $value)
  					  {		$arral=array('url'=>$value,'site_id'=>$site_id,'no_id'=>0);
							$db->insert("ve123_sites_temp",$arral);
					  }	
	  
					//���� ve123_sites ������ site_id=-1 global $db;
				  $query=$db->query("select url from ve123_sites where site_no='".$site_id."'");
				  while($row=$db->fetch_array($query))  {	$new_site[]=$row[url]; }
					$cha_site=array_diff($wai_link,$new_site);//���������бȽ� �ó��
					//��������� ve123_sites ��
 				 	foreach((array)$cha_site as $value)
					  {		$arral=array('url'=>$value,'site_no'=>$site_id);
							$db->insert("ve123_sites",$arral);
					  }			  
	  	
		
					//���� ve123_links ������ site_id=-1 global $db;
					global $db;
			      $query=$db->query("select url from ve123_links where site_id='".$site_id."'");
			      while($row=$db->fetch_array($query)) { $new_lik[]=$row[url]; }
					$cha_lik=array_diff($wai_link,$new_lik);//���������бȽ� �ó��	
					//���õ��Ĳ ������ ve123_links 
					foreach ((array)$cha_lik as $value)
				  	 { 							
					  	$array=array('url'=>$value,'site_id'=>$site_id);
						$db->insert("ve123_links",$array);
						echo "<font color=#C60A00><b>ץȡ��:</b></font>";
						echo "<a href=".$value." target=_blank>".$value."</a><br>";
					 }
		 
					$arral=array('no_id'=>1);
			 	    $db->update("ve123_sites_temp",$arral,"url='$url'");	
					 ob_flush();
 		 	  		 flush();	  	  					
			 }
	    }

	
   find_sites($site_id,$ceng);//�ٴε��ñ�������ʼѭ��
}	



//һ������ ��ץվ
function Update_sites($site_id)
{
   global $db; 
   $numm=20;//���������߳�
   $new_url = array();
   $fenge = array();
   
   $query=$db->query("select url from ve123_links where site_id='".$site_id."' and length(lrymd5)!=32");
   while($row=$db->fetch_array($query))
	 {		
		  $new_url[]=$row[url];
	 }
   $he_num = ceil(count($new_url)/$numm);//������Ҫѭ�����ٴ�
   $fenge=array_chunk($new_url,$numm);//������ָ�ɶ��ٿ����� ÿ���С$numm 
     
   for($i=0;$i<=$he_num;$i++) 
	 {
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);
		 //��Ҫ�ѵõ�������  (����ֻ���� ��ַ��Դ��) ����  д�����ݿ� ,
		foreach ((array)$fen_url as $url => $file)
  	 	{ 
					$links = array();
					$temp_links = array();
					$cha_temp = array();
					$loy = array();
					$new_links = array();			
					$cha_links = array();
					$cha_links_num = array();
					
					$bianma = bianma($file);					  //��ȡ�õ�htmlcode�ı���
					$file  = Convert_File($file,$bianma);		 //ת�����б���Ϊgb2312	
						if($file==-1) {echo "<b><font color=#C60A00>ץȡʧ��</b></font> ".$url."<br>"; continue;}
					$loy = clean_lry($file,$url,"html");      //���÷�������
					$title=$loy["title"];                     //�������еõ�����,��ֵ��title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($loy["fulltext"]); 
					$description=$loy["description"];         //�������еõ�����,��ֵ��description	
					$keywords=$loy["keywords"];               //�������еõ�����,��ֵ��keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();
				if($title==""){$title=str_cut($fulltxt,65); }
					
				//����url,��������
		   			echo "<b><font color=#0Ae600>�Ѹ���</font></b>";
					echo $title;
					echo "<a href=".$url." target=_blank>".$url. "</a><br>";	
	  		$array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      		$db->update("ve123_links",$array,"url='".$url."'");
		 }

	 }
}


//һ����վ  ��ʱ���õ�
function find_sites_($url)
{
	 $oldtime=time();
	 $site_id = -1;
	 $numm=10;
	 $links=array();
    $fen_link=array();	
	$lrp =array();	
	$nei_link =array();	
	$wai_link =array();	
	$new_temp =array();	
	$cha_temp =array();	
	$new_site =array();	
	$cha_site =array();	
	$new_lik =array();	
	$cha_lik =array();	
	$fenge =array();	
	
	$lrp = cmi($url);
	$links = _striplinks($lrp[$url]);			   //��htmlcode����ȡ��ַ
	$links = _expandlinks($links, $url);       //��ȫ��ַ
	$fen_link=fen_link($links,$url);        //�������������ֿ�
	$nei_link=array_values(array_unique($fen_link[nei])); //�������� �ظ�����ַ
	$wai_link=GetSiteUrl($fen_link[wai]);                //��������ת������ҳ
	$wai_link=array_values(array_unique($wai_link)); //�������� �ظ�����ַ
		/*print_r($nei_link);
		echo "<br><br>";
		print_r($wai_link);*/
		
	//���� ve123_sites_temp ������ site_id=-1  and no_id=0
	global $db;
   $query=$db->query("select url from ve123_sites_temp where site_id='-1' and no_id='0'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_temp[]=$row[url];
	 }

	$cha_temp=array_diff($nei_link,$new_temp);//���������бȽ� �ó��

	//��������� ve123_sites_temp ��
  	foreach((array)$cha_temp as $value)
  	  {
			$arral=array('url'=>$value,'site_id'=>$site_id,'no_id'=>0);
			$db->insert("ve123_sites_temp",$arral);
	  }	



	//���� ve123_temp ������ site_id=-1 global $db;
	global $db;
   $query=$db->query("select url from ve123_sites where site_no='-1'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_site[]=$row[url];
	 }

	$cha_site=array_diff($wai_link,$new_site);//���������бȽ� �ó��

	//��������� ve123_sites ��
  	foreach((array)$cha_site as $value)
  	  {
			$arral=array('url'=>$value,'site_no'=>$site_id);
			$db->insert("ve123_sites",$arral);
	  }		
	  
	//���� ve123_links ������ site_id=-1 global $db;
	global $db;
   $query=$db->query("select url from ve123_sites where site_id='-1'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_lik[]=$row[url];
	 }

	$cha_lik=array_diff($wai_link,$new_lik);//���������бȽ� �ó��	  






//���õ��Ĳ ������ ve123_links 
   $he_num = ceil(count($cha_lik)/$numm);//������Ҫѭ�����ٴ�
   $fenge=array_chunk($cha_lik,$numm);//������ָ�ɶ��ٿ����� ÿ���С$numm 
    
   for($i=0;$i<=$he_num;$i++) 
	 {
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);  //���߳̿�ʼ�ɼ�
		foreach ((array)$fen_url as $url => $file)
  	 	{ 							
					$bianma = bianma($file);					  //��ȡ�õ�htmlcode�ı���
					$file  = Convert_File($file,$bianma);		 //ת�����б���Ϊgb2312	
					$loy = clean_lry($file,$url,"html");        //���� file �б���� ������
					$title=$loy["title"];                     //�������еõ�����,��ֵ��title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($loy["fulltext"]); 
					$description=$loy["description"];         //�������еõ�����,��ֵ��description	
					$keywords=$loy["keywords"];               //�������еõ�����,��ֵ��keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();
				if($title==""){$title=str_cut($fulltxt,65); }
					
		//����url,��������	
	  		$array=array('url'=>$value,'lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
			$db->insert("ve123_links",$array);
			echo "<font color=#C60A00><b>ץȡ��:</b></font>".$title;
			echo "<a href=".$url." target=_blank>".$url."</a><br>";
	
		 }

	 }
		 
		 
		 
	   $newtime=time();
	   echo "  --- <b>��ʱ:</b>";
	   echo date("H:i:s",$newtime-$oldtime-28800);
	   echo "<br>";
	   del_links_temp($site_id);
}	



//ץȫվ--- ���߳�
function all_url_dan($url,$old,$nei,$ooo,$site_id,$include_word,$not_include_word)
{
   if(!is_url($url)) { return false;}
   global $db,$config;   
	
	$snoopy = new Snoopy;     //����snoopy����
	$snoopy->fetchlry($url); 
	$links=$snoopy->resulry; 
		if(!is_array($links)) {return;}
	$links=check_wai($links,$nei,$url);
	$links=array_values(array_unique($links)); 

	$title=$snoopy->title;
	$fulltxt=$snoopy->fulltxt; 
	$lrymd5=md5($fulltxt);
	$pagesize=$snoopy->pagesize;
	$description=$snoopy->description;
	$keywords=$snoopy->keywords;
	$updatetime=time();
	if($title==""){$title=str_cut($fulltxt,65); }

	//��ȡurl,��������	
	  $array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      $db->update("ve123_links",$array,"url='".$url."'");
		
	$all_num = count($links);
	$temp_links=array();
	$cha_temp=array();

	//��ʼ��ȡ ve123_links_temp ������site_id Ϊ$site_id ��url   Ȼ���ץȡ�� $links ����Ƚ�,���õ��Ĳ������  ve123_links_temp ��
	$query=$db->query("select url from ve123_links_temp where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		 $temp_links[]=rtrim($row[url],"/");
	  }  
	$cha_temp=array_diff($links,$temp_links);
			
  	 foreach((array)$cha_temp as $value)
  	 { 
		 $arral=array('url'=>$value,'site_id'=>$site_id);
		 $db->insert("ve123_links_temp",$arral);
	 }				  

	//��ʼ��ȡ ve123_links ������site_id Ϊ $site_id ��url   Ȼ���ץȡ�� $links ����Ƚ�,���õ��Ĳ������  ve123_links ��  �ϼ������ �Ѵ�����
	$query=$db->query("select url from ve123_links where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		   $new_links[]=rtrim($row[url],"/");
	  }  				 
		 
	$cha_links=array_diff($links,$new_links);
	$cha_num = count($cha_links);
	foreach((array)$cha_links as $value)
  	 { 
		if(check_include($value, $include_word, $not_include_word ))
		 {
			$array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
			$db->insert("ve123_links",$array);
		 } 
	 }	
	 
	printLinksReport($cha_num, $all_num, $cl=0);
	 echo "<a href=".$old." target=_blank>".$old. "</a>";
	 ob_flush();
     flush();	  	  
}



//ץȫվ--- ���߳�---���õ�
function add_all_url_ ($url,$old,$numm,$ooo,$site_id,$include_word,$not_include_word)
{
   if(!is_url($url)) { return false;}
   global $db,$config;   
	
	$snoopy = new Snoopy;     //����snoopy����
	$snoopy->fetchlry($url); 
	$links=$snoopy->resulry; 
		if(!is_array($links)) {return;}
	$links=check_wai($links,$numm,$url);
	$links=array_values(array_unique($links)); 

	$title=$snoopy->title;
	$fulltxt=$snoopy->fulltxt; 
	$lrymd5=md5($fulltxt);
	$pagesize=$snoopy->pagesize;
	$description=$snoopy->description;
	$keywords=$snoopy->keywords;
	$updatetime=time();
	if($title==""){$title=str_cut($fulltxt,65); }

	//��ȡurl,��������	
	  $array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      $db->update("ve123_links",$array,"url='".$url."'");
		
	$all_num = count($links);
	$temp_links=array();
	$cha_temp=array();

	//��ʼ��ȡ ve123_links_temp ������site_id Ϊ$site_id ��url   Ȼ���ץȡ�� $links ����Ƚ�,���õ��Ĳ������  ve123_links_temp ��
	$query=$db->query("select url from ve123_links_temp where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		 $temp_links[]=rtrim($row[url],"/");
	  }  
	$cha_temp=array_diff($links,$temp_links);
  	 foreach((array)$cha_temp as $value)
  	 { 
		 $arral=array('url'=>$value,'site_id'=>$site_id);
		 $db->insert("ve123_links_temp",$arral);
	 }				  

	//��ʼ��ȡ ve123_links ������site_id Ϊ $site_id ��url   Ȼ���ץȡ�� $links ����Ƚ�,���õ��Ĳ������  ve123_links ��  �ϼ������ �Ѵ�����
	$query=$db->query("select url from ve123_links where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		   $new_links[]=rtrim($row[url],"/");
	  }  				 
	$he_links=array_intersect($links,$new_links);
	$he_num = count($he_links);
		 
	$cha_links=array_diff($links,$new_links);
	$cha_num = count($cha_links);
	foreach((array)$cha_links as $value)
  	 { 
		if(check_include($value, $include_word, $not_include_word ))
		 {
			$array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
			$db->insert("ve123_links",$array);
		 } 
	 }	
	 
	printLinksReport($cha_num, $all_num, $cl=0);
	 echo "<a href=".$old." target=_blank>".$old. "</a>";
	 ob_flush();
     flush();	  	  
}


function printLinksReport($cha_num, $all_num, $cl) {
	global $print_results, $log_format;
	$cha_html = " <font color=\"blue\">ҳ�����<b>$all_num</b>������</font>�� <font color=\"red\"><b>$cha_num</b>�������ӡ�</font>\n";
	$no_html = " <font color=\"blue\">ҳ�����<b>$all_num</b>������</font>�� û�������ӡ�\n";	
	if($cha_num==0) {print $no_html; flush();}
	else{print $cha_html;}


}


function add_links_insite($link,$old,$numm,$ooo,$site_id,$include_word,$not_include_word)
{
   if(!is_url($link))
   {
      return false;
   }
   global $db,$config;
   
  /* $spider=new spider;  //ϵͳ�Դ�֩��
     echo "<b>��վ����</b>��Ĭ��GB2312��<b>:";
     $spider->url($link);
     echo "</b><br>";
     $links= $spider->get_insite_links();
	*/
   //$site_url=GetSiteUrl($link);
   $url_old=GetSiteUrl($old);
  	  echo "ԭʼҳ=".$url_old." - - <";
   	  echo "�ײ� id=".$site_id."> - - <";
      echo "�����ֶ�=".$include_word.">";
	  echo "<br>";
   /*if($ooo==0)
   {
   		$site=$db->get_one("select * from ve123_sites where url='".$url_old."'");
   		$site_id=$site["site_id"];
   		$include_word=$site["include_word"];  
   		$not_include_word=$site["not_include_word"]; 
   		$spider_depth=$site["spider_depth"];  
   }  */   

$snoopy = new Snoopy;     //����snoopy����
$snoopy->fetchlinks($link); 
$links=$snoopy->results; 
$links=check_wai($links,$numm,$link);
$links=array_values(array_unique($links)); 

  	 foreach((array)$links as $value)
  	 { 
	 	 $row=$db->get_one("select * from ve123_links_temp where url='".$value."'");
		 if(empty($row))
	        {
		 		$arral=array('url'=>$value,'site_id'=>$site_id);
			    $db->insert("ve123_links_temp",$arral);
			 }				  
	 
         $value=rtrim($value,"/");
         $row=$db->get_one("select * from ve123_links where url='".$value."'");	 	  
		if (check_include($value, $include_word, $not_include_word )) {
	        	 if(empty($row)&&is_url($value))
	              {
				     echo "<font color=#C60A00><b>ץȡ��:</b></font>";
			         $array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
		             $db->insert("ve123_links",$array);
			      }				  
			   else { echo "<b>�Ѵ�����:</b>";}
			   echo "<a href=".$value." target=_blank>".$value. "</a><br>";
				   ob_flush();
                   flush();

                  //$row=$db->get_one("select * from ve123_links_temp where url='".$value."'");

	             // if(empty($row)&&is_url($value))
	             // {
			     //    $array=array('url'=>$value,'site_id'=>$site_id);
		        //     $db->insert("ve123_links_temp",$array);
			     // }
			} 
  		 }
}

//ֻ����������������
function check_wai($lry_all,$nei,$url) {
    $lry_nei=array();//վ����������
    $lry_wai=array();//վ����������
	$new_url=getdomain($url);
	if($nei=="")
	{
	   foreach ((array)$lry_all as $value)
		{
			$lry_nei[]=rtrim($value,"/");
		}
	  return $lry_nei;
	}

    	foreach ((array)$lry_all as $value)
		{
	     	if(getdomain($value)==$new_url)
		 	{
			 	$lry_nei[]=rtrim($value,"/");
				//$lry_nei[]=$value;
			}
		 	else
			 { $lry_wai[]=rtrim($value,"/"); }
		}  
	if($nei==1){return $lry_nei;}
	if($nei==2){return $lry_wai;}
}

//�������������ֿ�
function fen_link($lry_all,$url) {
    $data=array();//վ����������
	$new_url=getdomain($url);

    	foreach ((array)$lry_all as $value)
		{
	     	if(getdomain($value)==$new_url)
		 	 {  $data['nei'][]=rtrim($value,"/"); }
		 	else
			 {  $data['wai'][]=rtrim($value,"/"); }
		}  	
	return $data;
}

function check_include($link, $include_word, $not_include_word) {
	$url_word = Array ();
	$not_url_word = Array ();
	$is_shoulu = true;
					
	if ($include_word != "") {
		$url_word = explode(",", $include_word);
	}
	if ($not_include_word != "") {
		$not_url_word = explode(",", $not_include_word);
	}	
	
	foreach ($not_url_word as $v_key) {
		$v_key = trim($v_key);
		if ($v_key != "") {
			if (substr($v_key, 0, 1) == '*') {
				if (preg_match(substr($v_key, 1), $link)) {
					$is_shoulu = false;
					break;
				}
			} else {
				if (!(strpos($link, $v_key) === false)) {
					$is_shoulu = false;
					break;
				}
			}
		}
	}
	if ($is_shoulu && $include_word != "") {
		$is_shoulu = false;
		foreach ($url_word as $v_key) {
			$v_key = trim($v_key);
			if ($v_key != "") {
				if (substr($v_key, 0, 1) == '*') {
					if (preg_match(substr($v_key, 1), $link)) {
						$is_shoulu = true;
						break 2;
					}
				} else {
					if (strpos($link, $v_key) !== false) {
						$is_shoulu = true;
						break;
					}
				}
			}
		}
	}
	return $is_shoulu;
}					 

function add_links_site_fromtemp($in_url)
{
      global $db;
	  $domain=getdomain($in_url);
	  $query=$db->query("select * from ve123_links_temp where url like '%".$domain."%' and no_id='0'");
	  while($row=$db->fetch_array($query))
	  {
	        @$db->query("update ve123_links_temp set no_id='1' where url='".$row["url"]."'");
	        add_links_insite($row["url"],$row["url"],1,1);
			//sleep(3);
	  }
	  //sleep(5);
	  add_links_site_fromtemp($in_url) ;   
}
function insert_links($url)
{
   global $db,$config;
   $spider=new spider;
   $spider->url($url);
   $links= $spider->links();
   $sites= $spider->sites();

   foreach($sites as $value)
   {
   
          $site_url=GetSiteUrl($link);
          $site=$db->get_one("select * from ve123_sites where url='".$site_url."'");
          $site_id=$site["site_id"];
                  $row=$db->get_one("select * from ve123_links where url='".$value."'");
	 
	              if(empty($row)&&is_url($value))
	              {
				  
				     echo $value."<br>";
			         $array=array('url'=>$value,'site_id'=>$site_id,'level'=>'0');
		             $db->insert("ve123_links",$array);
					
			      }
				  else
				  {
				      echo "�Ѵ���:".$value."<br>";
				  }
				   ob_flush();
                   flush();
				   //sleep(1);
		     $row=$db->get_one("select * from ve123_sites where url='".$value."'");
	 
	              if(empty($row)&&is_url($value))
	              {
			         $array=array('url'=>$value,'spider_depth'=>$config["spider_depth"],'addtime'=>time());
		             $db->insert("ve123_sites",$array);
					
			      }
   }
    //sleep(1);
   foreach($links as $value)
   {
         $row=$db->get_one("select * from ve123_links_temp where url='".$value."'");
	     if(empty($row)&&is_url($value))
	     {
			$array=array('url'=>$value);
		    $db->insert("ve123_links_temp",$array);
		 }
   }
}
function GetUrl_AllSite($in_url)
{
      global $db;
	  $query=$db->query("select * from ve123_links_temp where url like '%".$in_url."%' and  updatetime<='".(time()-(86400*30))."'");
	  while($row=$db->fetch_array($query))
	  {
	        @$db->query("update ve123_links_temp set updatetime='".time()."' where url='".$row["url"]."'");
	        insert_links($row["url"]);
			//sleep(3);
	  }
	  //sleep(5);
	  GetUrl_AllSite($in_url) ;
}

function Updan_link($url,$site_id)
{
	global $db;
		 $row=$db->get_one("select * from ve123_links_temp where url='".$url."'");
		 if(empty($row))
	        {
				$arral=array('url'=>$url,'site_id'=>$site_id);
			    $db->insert("ve123_links_temp",$arral); 
			 }
			 
         $row=$db->get_one("select * from ve123_links where url like '%".$url."%'");
		 if(empty($row))
		 {
				     echo "<font color=#C60A00><b>ץȡ��:</b></font>".$url."<br>";
			         $array=array('url'=>$url,'site_id'=>$site_id,'level'=>'1');
		             $db->insert("ve123_links",$array);	
		 }
		else
		{
		   echo "�Ѵ���:".$url."<br>";
		}
}

function Updan_zhua($url,$site_id)
{
	global $db;
	$lrp = array();
	$links = array();
	$fen_link = array();
	$nei_link = array();
	$new_temp = array();
	$cha_temp = array();
	
	$lrp = cmi($url);
	$links = _striplinks($lrp[$url]);			//��htmlcode����ȡ��ַ
	$links = _expandlinks($links, $url);        //��ȫ��ַ
	$fen_link=fen_link($links,$url);            //�������������ֿ�
	$nei_link=array_values(array_unique($fen_link[nei])); //�������� �ظ�����ַ
	
		//���� ve123_sites_temp ������ site_id=-1  and no_id=0
    $query=$db->query("select url from ve123_sites_temp where site_id='".$site_id."'");
    while($row=$db->fetch_array($query)) { $new_temp[]=$row[url]; }
	$cha_temp=array_diff($nei_link,$new_temp);//���������бȽ� �ó��
	//��������� ve123_sites_temp ��
  	foreach((array)$cha_temp as $value)
  	  {		$arral=array('url'=>$value,'site_id'=>$site_id,'no_id'=>0);
			$db->insert("ve123_sites_temp",$arral);
	  }	
	
}


function Update_link($url)
{
   global $db,$bug_url;
   $is_success=FALSE;
   $is_shoulu=FALSE;
   
   /*$spider=new spider;
   $spider->url($url);
   $title=$spider->title;
   $fulltxt=$spider->fulltxt;
   $lrymd5=md5($spider->fulltxt);
   $pagesize=$spider->pagesize;
   $keywords=$spider->keywords;
   $htmlcode=$spider->htmlcode;
   $description=$spider->description;*/
   
	$snoopy = new Snoopy;     //����snoopy����
	$snoopy->fetchtext($url); 
	$title=$snoopy->title;
	$fulltxt=$snoopy->fulltxt; 
	$lrymd5=md5($fulltxt);
	$pagesize=$snoopy->pagesize;
		$description=$snoopy->description;
		$keywords=$snoopy->keywords;
   //echo "fulltxt=".$fulltxt."<br>";
   	
   $updatetime=time();
  			 //$site_url=GetSiteUrl($url);
  			 //$site=$db->get_one("select * from ve123_sites where url='".$site_url."'");
  			 //$site_id=$site["site_id"];
   			//echo "site_id".$site["site_id"]."<br>";
		if($title==""){$title=str_cut($fulltxt,65); }
   		echo "<b><font color=#0Ae600>�Ѹ���</font></b>";
		echo $title;
   $array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
   			//$db->query("update ve123_links set updatetime='".time()."' where url='".$url."'"); //����ʱ��
        	//$s=array();
        	//$s=explode("?",$title);
		    //$domain=GetSiteUrl($url);
			//$site=$db->get_one("select * from ve123_sites where url='".$domain."'");
                $db->update("ve123_links",$array,"url='".$url."'");
			    $is_success=TRUE;

  if(empty($bug_url))
   {
       exit();
   }
   return $is_success;

}

function Update_All_Link_($in_url='',$days,$qiangzhi)
{
      global $db;
	  $new_url=array();
	  $fen_url=array();
	  $fenge=array();
	  $numm=20;//���������߳�
	  //if($qiangzhi==0){ $lry="and strlen(lrymd5)!=32";}
	  //else { ;}
	  
	  if(empty($in_url))
	  {
		$sql="select url from ve123_links where length(lrymd5)!=32 order by link_id desc";
	  }
	  else
	  {
	     $sql="select url from ve123_links where url like '%".getdomain($in_url)."%' and length(lrymd5)!=32 order by link_id desc";
	  }
	  echo $sql."<br>";
	  $query=$db->query($sql);
	  while($row=$db->fetch_array($query))
	 	 {		
			 $new_url[]=$row[url];
	 	 }	  
	 $he_num = ceil(count($new_url)/$numm);//������Ҫѭ�����ٴ�
	 //echo "<br><b>��Ҫѭ�����ٴ�=</b>".$he_num."<br>";

	$fenge=array_chunk($new_url,$numm);//������ָ�ɶ��ٿ����� ÿ���С$numm
	
	for($i=0;$i<=$he_num;$i++) 
	//for($i=0;$i<=1;$i++) 
	 {
		$fen_url=cmi($fenge[$i]);
		 //��Ҫ�ѵõ�������  (����ֻ���� ��ַ��Դ��) ����  д�����ݿ� ,
			
		foreach ((array)$fen_url as $url => $file)
  	 	{ 	
					$bianma = bianma($file);					  //��ȡ�õ�htmlcode�ı���
					$file  = Convert_File($file,$bianma);		 //ת�����б���Ϊgb2312	
					$lry = clean_lry($file,$url,"html"); 
					$title=$lry["title"];                     //�������еõ�����,��ֵ��title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($lry["fulltext"]); 
					$description=$lry["description"];         //�������еõ�����,��ֵ��description	
					$keywords=$lry["keywords"];               //�������еõ�����,��ֵ��keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();

				if($title==""){$title=str_cut($fulltxt,65); }
   					echo "<b><font color=#0Ae600>�Ѹ���</font></b>";
					echo $title;
					echo "<a href=".$url." target=_blank>".$url. "</a><br>";
				$array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
                $db->update("ve123_links",$array,"url='".$url."'");							
		}
	 }
}



function cmi($links,$killspace=TRUE,$forhtml=TRUE,$timeout=6,$header=0,$follow=1){

       	    $res=array();//���ڱ����� 	    	
    		$mh = curl_multi_init();//������curl����Ϊ�˼���ͬʱִ��		
    		foreach ((array)$links as $i => $url) {
    			 $conn[$url]=curl_init($url);//��url�к���gb2312���֣�����FTPʱ��Ҫ�ڴ���url��ʱ����һ�£����ﲻ��
    			 curl_setopt($conn[$url], CURLOPT_TIMEOUT, $timeout);//��ʱ�������ҳ���HTMLԴ�������ʱ�䣬һ������1s�ڵģ����Ļ�Ӧ��Ҳ����6�룬����������16����
    			 curl_setopt($conn[$url], CURLOPT_HEADER, $header);//����������ͷ��ֻҪԴ��
    			 curl_setopt($conn[$url],CURLOPT_RETURNTRANSFER,1);//����Ϊ1
    			 curl_setopt($conn[$url], CURLOPT_FOLLOWLOCATION, $follow);//���ҳ�溬���Զ���ת�Ĵ�����301����302HTTPʱ���Զ���ת���ҳ��
    			 curl_multi_add_handle ($mh,$conn[$url]);//�ؼ���һ��Ҫ�������漸��֮�£�����curl���󸳸������
    		}
    		//����һ�󲽵�Ŀ����Ϊ�˼���cpu����ν��������ʱ����������php.net�Ľ��飬�����ǹ̶��÷�
    		do {
    				$mrc = curl_multi_exec($mh,$active);//��������ʱ��������ͣʱ��active=true
    		   } while ($mrc == CURLM_CALL_MULTI_PERFORM);//�����ڽ�������ʱ
    		while ($active and $mrc == CURLM_OK)
			 	{//��������ʱ��������ͣʱ��active=true,Ϊ�˼���cpu����ν����,��һ����������
    				if (curl_multi_select($mh) != -1)
					 {
    					do {  $mrc = curl_multi_exec($mh, $active);
    						} while ($mrc == CURLM_CALL_MULTI_PERFORM);
    				 }
    			 }

    		  foreach ((array)$links as $i => $url) {
    			  $cinfo=curl_getinfo($conn[$url]);//������ȡ��һЩ���õĲ�����������Ϊ��header
					  $res[$url]=curl_multi_getcontent($conn[$url]);
				  if(!$forhtml){//��Լ�ڴ�			
					  $res[$url]=NULL;
				  }
				 /*������һ�η�һЩ�����ĵĳ�����룬��������HTML���ұ�����һ��=NULL��Ҫ���ѣ���ʱ��ն����ͷ��ڴ棬�˳����ڲ������������Դ��̫��������������
				 //��ʵ�ϣ�����Ӧ����һ��callback����������Ӧ�ý�����߼�ֱ�ӷŵ�����������Ϊ�˳�����ظ���û��ô��
    			   preg_match_all($preg,$res[$i],$matchlinks);
    			   $res[$i]=NULL;*/
                 
                  curl_close($conn[$url]);//�ر����ж��� 
                  curl_multi_remove_handle($mh  , $conn[$url]);   //���������ͷ���Դ           			   
    			 
    		} 
    		curl_multi_close($mh);$mh=NULL;$conn=NULL;$links=NULL;
      	
    		return $res;
    }

function clean_lry($file, $url, $type) {
	$data=array();
	$file = preg_replace("/<link rel[^<>]*>/i", " ", $file);
	//$file = preg_replace("@<!--sphider_noindex-->.*?<!--\/sphider_noindex-->@si", " ",$file);	
	$file = preg_replace("@<!--.*?-->@si", " ",$file);	
	$file = preg_replace("@<script[^>]*?>.*?</script>@si", " ",$file);

	$file = preg_replace("/&nbsp;/", " ", $file);
	$file = preg_replace("/&raquo;/", " ", $file);
	$file=str_replace("'","��",$file);
		
	$regs = Array ();	
		preg_match("/<meta +name *=[\"']?description[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $file, $regs);
		if (isset ($regs)) 
		{
		 	$description = $regs[1]; 
			$file = str_replace($regs[0], "", $file);
		 }
	$regs = Array ();		 
		preg_match("/<meta +name *=[\"']?keywords[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $file, $regs);
		if (isset ($regs))
		 { 
		 	$keywords = $regs[1];
		 	$file = str_replace($regs[0], "", $file);
		 }
	$regs = Array ();	
		$keywords = preg_replace("/[, ]+/", " ", $keywords);

	if (preg_match("@<title *>(.*?)<\/title*>@si", $file, $regs)) {
		$title = trim($regs[1]);
		$file = str_replace($regs[0], "", $file);
	} 
	
	$file = preg_replace("@<style[^>]*>.*?<\/style>@si", " ", $file);

	//create spaces between tags, so that removing tags doesnt concatenate strings
	$file = preg_replace("/<[\w ]+>/", "\\0 ", $file);
	$file = preg_replace("/<\/[\w ]+>/", "\\0 ", $file);
	$file = strip_tags($file);

	//$fulltext = $file;
	//$file .= " ".$title;

	$file = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $file);
    $file = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $file);
	$file = strtolower($file);

	$file = preg_replace("/&[a-z]{1,6};/", " ", $file);
	$file = preg_replace("/[\*\^\+\?\\\.\[\]\^\$\|\{\)\(\}~!\"\/@#?%&=`?><:,]+/", " ", $file);
	$file = preg_replace("/\s+/", " ", $file);
	//$data['fulltext'] = $fulltext;
	$data['fulltext'] = addslashes($file);
	$data['title'] = addslashes($title);
	$data['description'] = $description;
	$data['keywords'] = $keywords;

	return $data;

}


function bianma($file)
{
			preg_match_all("/<meta.+?charset=([-\w]+)/i",$file,$rs);
			$chrSet=strtoupper(trim($rs[1][0]));
			return $chrSet;	
}
	
function Convert_File($file,$charSet)
{
	             $conv_file = html_entity_decode($file);   
                 $charSet = strtoupper(trim($charSet));
				 if($charSet != "GB2312"&&$charSet != "GBK")
				 {                    
                        $file=convertfile($charSet,"GB2312",$conv_file);
						if($file==-1){ return -1; }
                 }  
				return $file;
}
	
function convertfile($in_charset, $out_charset, $str)
{
		//if(function_exists('mb_convert_encoding'))
		//{
		$in_charset=explode(',',$in_charset);
		$encode_arr = array('GB2312','GBK','UTF-8','ASCII','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
		$cha_temp=array_intersect($encode_arr,$in_charset);
		$cha_temp=implode('',$cha_temp);
		    if(empty($in_charset)||empty($cha_temp))
			{
                 $encoded = mb_detect_encoding($str, $encode_arr);
				 $in_charset=$encoded;
			}
			if(empty($in_charset)){ return -1; }
			echo $in_charset;
			return mb_convert_encoding($str, $out_charset, $in_charset);
		/*}
		else
		{
			require_once PATH.'include/charset.func.php';
			$in_charset = strtoupper($in_charset);
			$out_charset = strtoupper($out_charset);
			if($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312'))
			{
				return utf8_to_gbk($str);
			}
			if(($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8')
			{
				return gbk_to_utf8($str);
			}
			return $str;
		}*/
}


function Update_All_Link($in_url='',$days,$qiangzhi)
{
      global $db;
	  if(empty($in_url))
	  {
	    //$sql="select * from ve123_links where updatetime<='".(time()-(86400*$days))."' order by link_id desc";//echo $days."<br>";
		$sql="select * from ve123_links order by link_id desc";//echo $days."<br>";
	  }
	  else
	  {
	     $sql="select * from ve123_links where url like '%".getdomain($in_url)."%' order by link_id desc";//echo $days."<br>";
		 //$sql="select * from ve123_links where url like '%".$in_url."%' order by link_id desc";//echo $days."<br>";
	  }
	  //$sql="select * from ve123_links order by link_id";
	  echo $sql."<br>";
	  $query=$db->query($sql);
	  while($row=$db->fetch_array($query))
	  {
	     if(is_url($row["url"]))
		 {
	       // echo "�ǺǺǺ�".$row["lrymd5"]."<br>";
            ob_flush();
            flush();
            //sleep(1);
			//if($row["lrymd5"]==""){ Update_link($row["url"],$row["lrymd5"]); }
			if($qiangzhi==1){ Update_link($row["url"]); }
			else {
				if(strlen($row["lrymd5"])!=32){ Update_link($row["url"]); }
				else {echo "<b>δ�ı�</b>"; }
				}
		echo "<a href=".$row["url"]." target=_blank>".$row["url"]. "</a><br>";
		 }
			
			////sleep(2);
	  }
	 // echo "<br><b>ȫ���������</b> �������:";
	 // echo date("Y��m��d�� H:i:s",time());
	  //sleep(2);
	 // Update_All_Link($in_url) ;
}


function url_ce($val, $parent_url, $can_leave_domain) {
	global $ext, $mainurl, $apache_indexes, $strip_sessids;

	$valparts = parse_url($val);
	$main_url_parts = parse_url($mainurl);
	//if ($valparts['host'] != "" && $valparts['host'] != $main_url_parts['host']  && $can_leave_domain != 1) {return '';}
	
	reset($ext);
	while (list ($id, $excl) = each($ext))
		if (preg_match("/\.$excl$/i", $val))
			return '';

	if (substr($val, -1) == '\\') {return '';}
	if (isset($valparts['query'])) {if ($apache_indexes[$valparts['query']]) {return '';}}
	if (preg_match("/[\/]?mailto:|[\/]?javascript:|[\/]?news:/i", $val)) {return '';}
	if (isset($valparts['scheme'])) {$scheme = $valparts['scheme'];}
	else {$scheme ="";}
	if (!($scheme == 'http' || $scheme == '' || $scheme == 'https')) {return '';}

	$regs = Array ();
	while (preg_match("/[^\/]*\/[.]{2}\//", $valpath, $regs)) {
		$valpath = str_replace($regs[0], "", $valpath);
	}

	$valpath = preg_replace("/\/+/", "/", $valpath);
	$valpath = preg_replace("/[^\/]*\/[.]{2}/", "",  $valpath);
	$valpath = str_replace("./", "", $valpath);
	if(substr($valpath,0,1)!="/") {$valpath="/".$valpath;}
	
	$query = "";
	if (isset($val_parts['query'])) {$query = "?".$val_parts['query'];}
	if ($main_url_parts['port'] == 80 || $val_parts['port'] == "") {$portq = "";} 
	else {$portq = ":".$main_url_parts['port'];}

	return $val;
}


function iframe_ce($val, $parent_url, $can_leave_domain) {
	global $ext, $mainurl, $apache_indexes, $strip_sessids;

	$valparts = parse_url($val);
	$main_url_parts = parse_url($mainurl);
	//if ($valparts['host'] != "" && $valparts['host'] != $main_url_parts['host']  && $can_leave_domain != 1) {return '';}
	
	reset($ext);
	while (list ($id, $excl) = each($ext))
		if (preg_match("/\.$excl$/i", $val))
			return '';

	if (substr($val, -1) == '\\') {return '';}
	if (isset($valparts['query'])) {if ($apache_indexes[$valparts['query']]) {return '';}}
	if (preg_match("/[\/]?mailto:|[\/]?javascript:|[\/]?news:/i", $val)) {return '';}
	if (isset($valparts['scheme'])) {$scheme = $valparts['scheme'];}
	else {$scheme ="";}
	if (!($scheme == 'http' || $scheme == '' || $scheme == 'https')) {return '';}

	$regs = Array ();
	while (preg_match("/[^\/]*\/[.]{2}\//", $valpath, $regs)) {
		$valpath = str_replace($regs[0], "", $valpath);
	}

	$valpath = preg_replace("/\/+/", "/", $valpath);
	$valpath = preg_replace("/[^\/]*\/[.]{2}/", "",  $valpath);
	$valpath = str_replace("./", "", $valpath);
	if(substr($valpath,0,1)!="/") {$valpath="/".$valpath;}
	
	$query = "";
	if (isset($val_parts['query'])) {$query = "?".$val_parts['query'];}
	if ($main_url_parts['port'] == 80 || $val_parts['port'] == "") {$portq = "";} 
	else {$portq = ":".$main_url_parts['port'];}

	return $val;
}


function _striplinks($document)
{						
		$match = array();
		$links = array();
		preg_match_all("'<\s*(a\s.*?href|[i]*frame\s.*?src)\s*=\s*([\'\"])?([+:%\/\?~=&\\\(\),._a-zA-Z0-9-]*)'isx",$document,$links,PREG_PATTERN_ORDER);		
		foreach ($links[3] as $val)
		  {
			if (($a = url_ce($val, $url, $can_leave_domain)) != '')
			  { $match[] = $a; }
			$checked_urls[$val[1]] = 1;
		  }				
	   return $match;
}
	

function _expandlinks($links,$URI)
{	
		preg_match("/^[^\?]+/",$URI,$match);
		$match = preg_replace("|/[^\/\.]+\.[^\/\.]+$|","",$match[0]);
		$match = preg_replace("|/$|","",$match);
		$match_part = parse_url($match);
		$match_root =
		$match_part["scheme"]."://".$match_part["host"];
		$URI_PARTS = parse_url($URI);
		$host = $URI_PARTS["host"];
				
		$search = array( 	"|^http://".preg_quote($host)."|i",
							"|^(\/)|i",
							"|^(?!http://)(?!mailto:)|i",
							"|/\./|",
							"|/[^\/]+/\.\./|"
						);
						
		$replace = array(	"",
							$match_root."/",
							$match."/",
							"/",
							"/"
						);			
				
		$expandedLinks = preg_replace($search,$replace,$links);

		return $expandedLinks;
}	
	
function foothtml()
{
echo "<div style=\"text-align:center;\"><a target=\"_blank\" href=\"http://www.1230530.com\">Powered by ��ʱ��</a></div>";
}
?>
