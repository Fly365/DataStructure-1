<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="path"><a href=""><?php echo $site_name;?></a> &gt;&gt; �������</div>
<div id="c90">
<div class="t3 bcb"><div class="t3t bgb">������� (<?php echo $quescount;?>)</div></div>
<div class="b3 bcb mb12">
<div class="w100">
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<script type="text/javascript">
function disQstate(s)
{ 
switch (s)
{
case 1:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_time.gif" alt="���������">';break;
case 2:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_ok.gif"  alt ="�ѽ������">';break;
case 3:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_vote.gif" alt="ͶƱ������">';break;
case 4:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_cancel.gif" alt="�ѹر�����">';break;
case 7:var op='<img src="<?php echo $web_path;?><?php echo $styledir;?>/icn_share.gif" alt="֪ʶ����">';break;
default: var op='δ֪����';
}
document.write(op);
}
</script>
<?php if(is_array($search_list)) { foreach($search_list as $search) { ?>
<tr>
<td class="ln23 f14" align="left" width="80%" height="30"><a href="<?php echo $search['qid'];?>" target="_blank"><?php echo $search['title'];?></a>
&nbsp;&nbsp;<script type="text/javascript">disQstate(<?php echo $search['status'];?>);</script></td></tr>
<?php } } ?>
</table>
<div id="pg">
<?php if($page>1) { ?>
<a href="search.php?word=<?php echo $word;?>&amp;page=1">{language page_first}</a>                                                                                                          
<a href="search.php?word=<?php echo $word;?>&amp;page=<?php echo $page_front;?>">ǰһҳ</a>
<?php } if($pagecount>1) { echo $pagelinks;?>
<?php } if($page<$pagecount) { ?>
<a href="search.php?word=<?php echo $word;?>&amp;page=<?php echo $page_next;?>">��һҳ</a>                                                                                                                        
<a href="search.php?word=<?php echo $word;?>&amp;page=<?php echo $pagecount;?>">[βҳ]</a>
<?php } ?>
                     
</div>
</div>
</div>
</div>
</div>
<br />
<?php include template('footer'); ?>
