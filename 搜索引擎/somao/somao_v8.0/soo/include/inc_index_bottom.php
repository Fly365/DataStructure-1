<p style="height:14px">
<?php
/*
�ٷ���ַ:http://www.qiaso.com/
�벻Ҫ�޸����ߵ���Ϣ,����Ҫ�����!!!
������̳:http://www.vz123.com/
����:����
php�����ռ�php+mysql
*/
$query=$db->query("select * from ve123_about where is_show order by sortid asc");
while($row=$db->fetch_array($query))
{
     if(stristr($row["url"],"http://"))
	 {
	    $url=$row["url"];
	 }
	 else
	 {
	    $url=$site["url"]."/a/".$row["filename"].".html";
	 }
?>
<a target="_blank" href="<?php echo $url;?>"><?php echo stripslashes($row["title"]);?></a> | 
<?php
}
?>
</p><p id=b>&copy;2009 Feimao <a href=#>ʹ��<?php echo $site["name"];?>ǰ�ض�</a> <a href=http://www.miibeian.gov.cn target=_blank><?php echo $site["icp"];?></a>
<img src=<?php echo $site["url"];?>/images/gs.gif></p>
