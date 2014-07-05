<?php
/**
*
* �˷�ҳ����,�Ǵ���һ����Ŀ����������д��,ԭ��ֻ��һ������,��д��һ����,���׸����
* Ч���ǰٶȷ�ҳ������,���漰���ݿ����,
* ʵ����,��ҳ��ȷ�Ǻ����ݿ�����ֿ���
* ʹ�÷���
* $total = 50;
* $page = new Page($total);
* echo $page->show();
*
*/
class Page {
    public $total;  //��ҳ��,������,����Ҫ����ҳ�������
    public $pn;         //��ǰҳ��
    public $start;     //������ʼҳ
    public $end;       //������ֹҳ
    public $url;      //��ǰ��url,���� index.php?p=
    public $display;  //�����ʾ��ҳ��,������5,����˵�����5ҳ,�ܹ���10ҳ
    public function __construct($total, $url = '?pn=', $display = '5') {
        $this->total = $total;
        $this->url = $url;
        $this->display = $display;
        $this->init();
        $this->order();
    }

/**
  *��ʼ��,�����򵥵İ�ȫ����,��Ȼ,�������չ��������Դﵽ���Ҫ��
  */
    public function init() {
        //��ȡ��ǰ��ҳ��
        $this->pn = (@$_GET ['pn'] + 0 <= 0)? 1: (@$_GET ['pn'] + 0);
        if (!is_int($this->pn)) {
            $this->pn = 1;
        }
        //���������ҳ��������һ���ϴ����,�������������,��ʾ���һҳ
        //������Լ���չΪ"��ǰû�����ҵ���ҳ",�������ȥ��,��show������Ӹ��жϾ�����
        if ($this->pn >= $this->total) {
            $this->pn= $this->total;
        }
    } 
    /**
     *���ｫ����ô��ʾΪ�ٶȷ�ҳ������Ч��,��Ȼ,�Ѿ�������
     *���оֲ�û�д����,���������鷳������
     */
     public function order() {
        if ($this->total <= 2 * $this->display) {
            $this->start = 1;
            $this->end = $this->total;
        } else {
            if ($this->pn <= $this->display) {
                $this->start = 1;
                $this->end = 2 * $this->display;
            } else {
                if ($this->pn > $this->display && ($this->total - $this->pn >= $this->display - 1)) {
                    $this->start = $this->pn - $this->display;
                    $this->end = $this->pn + $this->display - 1;
                } else {
                    $this->start = $this->total - 2 * $this->display + 1;
                    $this->end = $this->total;
                }
            }
        }
    }
    public function show() {
        //���û������,��ȻҲ��û�з�ҳ��
        if ($this->total <= 1) {
            return false;
			//exit;
        }
        else
		     {
               $re = '';  
               // $preǰһҳ $next ��һҳ
               // $re .= "<a href=\"{$this->url}1\">��ҳ</a>";
               $pre = ($this->pn - 1 <= 0) ? 1 : ($this->pn - 1);
               $re .= "";
               //�����ǰҳ�ǵ�һҳ,��Ҫ��ҳ��ǰһҳ
               if ($this->pn == 1) {
                   $re = '';
               }
               for ($i = $this->start; $i <= $this->end; $i++) {
                   $re .= ($i == $this->pn)? "$i ": "";
               }
  
               $next = ($this->pn + 1 >= $this->total) ? $this->total : ($this->pn + 1);
               //��ǰҳ�����һҳ��ҳ��,��Ҫ��һҳ�����һҳ
               if ($this->pn != $this->total) {
                   $re .= "";
                  // $re .= "<a href=\"{$this->url}$this->total\">���һҳ</a>";
               }   
                return $re;
		   }
    }
}
?>