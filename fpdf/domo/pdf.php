<?php
require('../chinese.php');
//�������ݿ�
//$conn = mysql_connect("localhost", "kllife", "kuaile1@#3"); //�������ݿ�
//mysql_select_db("kllife", $conn); //ִ��SQL

$conn = mysql_connect("localhost", "managekllife", "B8QRKSDrVHE8HUFb"); //�������ݿ�
mysql_select_db("managekllife", $conn); //ִ��SQL
mysql_query("set names GBK");

//-------------------------------------
$did = $_GET['did']; //��ȡ����id
$new_line = $_GET['new_line'];
if (empty($did)){
	die('������Ϣ����');
}

$weekarray=array("��","һ","��","��","��","��","��");
$wheresql='';
$pageurl='';
$wheresql=" AND d.id=$did ";
if (empty($new_line)) {
	$sql_dpf="SELECT a.id as aid,d.id as did,a.title,b.waytravel,b.targetaddress,b.gatheringplace,c.id as cid,c.startdate,c.enddate,c.priceadult,c.pricechild,d.id as did,d.userid,d.male,d.woman,d.child,d.hdid,d.types,d.names,d.gender,d.shenfenid,d.mob,d.beizhu,d.ct_diaocha,d.ct_zjcode,d.ct_zhengjian,d.ct_names,d.addtime,d.zhuangtai,d.pay_type,d.InstCode,d.order_sn,d.ispay,d.paytime,d.isdj FROM xz_archives a INNER JOIN xz_addonline b ON b.aid = a.id INNER JOIN xz_lineactivity c ON c.aid = b.aid INNER JOIN xz_lineenertname d ON d.lineid = a.id AND d.hdid = c.id where 1=1 ".$wheresql." order by d.id desc";
} else {
	$sql_dpf="SELECT `a`.`id`,`a`.`title` AS `a_title`,`a`.`subheading`,`a`.`destination`,`a`.`assembly_point`,`a`.`travel_day`,`c`.`id`,`c`.`title` AS `c_title`,`c`.`stop_time`,`c`.`start_time`,`c`.`end_time`,`c`.`title`,`c`.`price_adult`,`c`.`price_child`,`d`.`id`,`d`.`userid`,`d`.`male`,`d`.`woman`,`d`.`child`,`d`.`lineid`,`d`.`hdid`,`d`.`types`,`d`.`names`,`d`.`gender`,`d`.`shenfenid`,`d`.`mob`,`d`.`beizhu`,`d`.`addtime`,`d`.`zhuangtai`,`d`.`order_sn`,`d`.`team_price`,`d`.`team_cut_price`,`d`.`need_pay_money` FROM `kl_line` AS `a` INNER JOIN `kl_batch` AS `c` INNER JOIN `xz_lineenertname` AS `d` ON `d`.`lineid` = `a`.`id` AND `d`.`hdid`=`c`.`id` WHERE 1=1 ".$wheresql." order by d.id desc";
}

$rs_dpf = mysql_query($sql_dpf, $conn) or die(mysql_error());
$row_dpf = mysql_fetch_assoc($rs_dpf);

if (!empty($new_line)) {
	$row_dpf['startdate'] = strtotime($row_dpf['start_time']);
	$row_dpf['enddate'] = strtotime($row_dpf['end_time']);
	$row_dpf['priceadult'] = $row_dpf['price_adult'];
	$row_dpf['pricechild'] = $row_dpf['price_child'];
}


class PDF extends PDF_Chinese
{
	var $col = 0;
	var $y0;
	
	function PrintChapter($num, $title, $file)
	{
		$this->SetFont('GB','B',15);
		$this->ChapterTitle($num,$title);
		$this->ChapterBody($file);
	}
	
	function ChapterTitle($num, $label)
	{
		$this->SetFont('GB','B',12);
		$this->Ln(4);
		$this->y0 = $this->GetY();
	}
	
	function ChapterBody($file)
	{
		$txt = file_get_contents($file);
		$this->SetFont('GB','',10.5); //������ʽ
		$this->MultiCell(98,6,$txt);
	}
	
	function SetCol($col)
	{
		$this->col = $col;
		$x = 10+$col*50;
		$this->SetLeftMargin($x);
		$this->SetX($x);
	}
	
	function AcceptPageBreak()
	{
		if($this->col<2)
		{
			$this->SetCol($this->col+2);
			$this->SetY($this->y0);
			return false;
		}
		else
		{
			$this->SetCol(0);
			return true;
		}
	}

}
 
$pdf = new PDF();

//����GB����
$pdf->AddGBFont();

//��ͬ��һҳ
$pdf->AddPage();

$pdf->SetFont('GB','B',12);
$pdf->Text(20,30,"GF--2014--2401");
$pdf->Text(140,30,"��ͬ��ţ�");

$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(255,0,0);
$pdf->Text(160,30,substr($row_dpf['order_sn'],3,17));

$pdf->SetFont('GB','B',38);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,120,"�����о����Ŷ����κ�ͬ",0,2,'C');

$pdf->SetFont('GB','B',15);
$pdf->Cell(0,20,"�����ߣ�������__________________",0,2,'C');
$pdf->Cell(0,20,"�� �� �� �� �磺____________________",0,2,'C');
$pdf->Cell(0,20,"�� �� ֤ �� �ţ�____________________",0,2,'C');

$pdf->SetFont('GB','',13);
$pdf->Text(110,140,$row_dpf['names']);
$pdf->Text(100,160,'�����˿͹����������������ι�˾');
$pdf->Text(110,180,'L-SNX00306');

$pdf->SetFont('GB','B',12);
$pdf->Cell(0,60,"  ",0,2,'C');
$pdf->Cell(0,10,"�������ξ֡����ҹ������������ܾ��ƶ�",0,2,'C');
$pdf->Cell(0,10,"���������ξ֡������й�����������ּ�ӡ",0,2,'C');

//��ͬ�ڶ�ҳ
$pdf->AddPage();

$pdf->SetFont('GB','B',14);
$pdf->Cell(0,50,"ʹ��˵��",0,2,'C');

$pdf->SetFont('GB','',12);
$pdf->Write(13,'����1.����ͬΪʾ���ı������л����񹲺͹����� �������ۡ� �� ��̨��������������������֮��ǩ���ŶӾ��ڰ������κ�ͬʱʹ�ã��������ۡ� �� ��̨�������μ��߾��Σ���
����2.˫��������Ӧ����Ͼ������ѡ�񱾺�ͬЭ�����������ṩ��ѡ����ո�Ӧ����������ʽ��д������
����3. ˫�������˿���������ʽ�Ա�ʾ���ı��������Ա�����߲��䣬��������߲�������ݣ����ü���������Ӧ����������е������Ρ�
����4.��ʾ���ı��ɹ������ξֺ͹��ҹ������������ֹܾ�ͬ�ƶ������ͣ���ȫ����Χ������ʹ�á�
');

$pdf->SetFont('GB','B',14);
$pdf->Cell(0,50,"���������ල����",0,2,'C');

$pdf->SetFont('GB','',12);
$pdf->Text(50,195,"������ල��Ͷ�ߵ绰��");
$pdf->Text(50,205,"�����������ʼ���Ͷ�ߵ绰��029-87630166");

$pdf->SetFont('GB','B',14);
$pdf->Cell(0,45,"  ",0,2,'C');
$pdf->Cell(0,10,"�Ծ����ء��й������������������Լ�����໥�ල���໥���ѣ����������ο͡�",1,2,'C');

//��ͬ��������
$pdf->AddPage();

$pdf->SetFont('GB','B',13);
$pdf->Cell(0,10,"�ŶӾ������κ�ͬ",0,2,'C');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"��һ�¡�������Ͷ���",0,2,'C');
$pdf->ChapterBody('txt/context1.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"�ڶ��¡�����ͬ�Ķ���",0,2,'C');
$pdf->ChapterBody('txt/context2.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"�����¡�����ͬ˫����Ȩ������",0,2,'C');
$pdf->ChapterBody('txt/context3.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"�����¡�����ͬ�ı����ת��",0,2,'C');
$pdf->ChapterBody('txt/context4.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"�����¡�����ͬ�Ľ��",0,2,'C');
$pdf->ChapterBody('txt/context5.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"�����¡���ΥԼ����",0,2,'C');
$pdf->ChapterBody('txt/context6.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"�����¡���Э������",0,2,'C');
$pdf->ChapterBody('txt/context7.txt');

$pdf->SetFont('GB','',12);
$pdf->Text(40,240,date("Y",$row_dpf['startdate'])."������".date("m",$row_dpf['startdate'])."������".date("d",$row_dpf['startdate']));
$pdf->Text(40,246,date("Y",$row_dpf['enddate'])."������".date("m",$row_dpf['enddate'])."������".date("d",$row_dpf['enddate']));

if(empty($new_line)){
	$pdf->Text(30,252,round(($row_dpf['enddate']-$row_dpf['startdate'])/86400)."����������������".(round(($row_dpf['enddate']-$row_dpf['startdate'])/86400)-1) );
}else{
	$pdf->Text(30,252,$row_dpf['travel_day']."����������������".($row_dpf['travel_day'] - 1));
}


$pdf->Text(33,264,$row_dpf['priceadult']);

if($row_dpf['pricechild']==0)
{
	$pricechild = "---";	
}
else
{
	$pricechild = $row_dpf['pricechild'];
}
$pdf->Text(20,270,$pricechild);
$pdf->Text(85,270,"---");

$cjjg = ($row_dpf['male']+$row_dpf['woman'])*$row_dpf['priceadult'];
$rtjg = $row_dpf['child']*$row_dpf['pricechild'];
$zjg = $cjjg+$rtjg;
$pdf->Text(160,10,$zjg);

if($row_dpf['zhuangtai']==8 or $row_dpf['zhuangtai']==2)
{
	$zffs = "���߸���";
	$zfsj = "ǩ��ͬʱ֧��ȫ��";
}
elseif($row_dpf['zhuangtai']==7 or $row_dpf['zhuangtai']==10)
{
	$zffs = "���߸���+�ֽ�";
	$zfsj = "ǩ��ͬʱ֧�����ֿβ���ڳ���ǰ3��֧�����";
}
else{
	$zffs = "δ����";
	$zfsj = "δ����";	
}
$pdf->Text(155,16,$zffs);
$pdf->Text(115,28,$zfsj);
$pdf->SetFont('GB','',18);
$pdf->Text(149,70,'��');
$pdf->SetFont('GB','',12);
$pdf->Text(122,94,'ͬ��');
$pdf->Text(122,100,'���仧�⵱��');
$pdf->Text(124,106,'��ͬ��');
$pdf->Text(124,112,'��ͬ��');
$pdf->Text(124,124,'ͬ��');
$pdf->Text(132,136,'ͬ��');
$pdf->Text(140,142,'���仧�⵱��');
$pdf->Text(145,262,"2");

$pdf->ChapterBody('txt/context8.txt');
$pdf->Image('image/stamp.png', 135, 20, 60, 60);
$pdf->SetFont('GB','',12);
$pdf->Text(63,44,$row_dpf['names']);
$pdf->Text(40,62,$row_dpf['mob']);
$pdf->Text(40,85,date("Y",$row_dpf['addtime'])."������".date("m",$row_dpf['addtime'])."����".date("d",$row_dpf['addtime']));
$pdf->Text(40,92,'����ʡ������������');
$pdf->Text(152,56,'����');
$pdf->Text(143,69,'029-88225622');
$pdf->Text(143,15,'2');
$pdf->Text(180,15,'1');

$pdf->SetFont('GB','',10.5);
$pdf->Line(10,107,205,107);
$pdf->Text(20,116,'����1�����α�����������󸽣�');
$pdf->Text(20,122,'����2�������г̵���������󸽣�');
$pdf->Text(20,128,'����3��');

$pdf->SetFont('GB','B',11);
$pdf->SetXY(10,134);
$pdf->Cell(0,7,"��Ը��������Э��",0,2,'C');

$pdf->SetFont('GB','',10.5);
$pdf->Cell(40,12,"����ʱ��",1,0,'C',0);
$pdf->Cell(25,12,"�ص�",1,0,'C',0);
$pdf->Cell(25,12,"���ﳡ������",1,0,'C',0);
$pdf->Cell(25,12,"��Ҫ��Ʒ��Ϣ",1,0,'C',0);
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->MultiCell(25,6,"�ͣ��ʱ�䣨���ӣ�",1,'C');
$pdf->setxy($x+25,$y);
$pdf->Cell(25,12,"����˵��",1,0,'C',0);
$pdf->MultiCell(25,6,"������ǩ��ͬ��",1,'C');

$pdf->SetXY(10,153);
$pdf->Cell(40,9,"�ꡡ�¡��ա�ʱ",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"ǩ��:",'LBR',2,'L');

$pdf->SetXY(10,162);
$pdf->Cell(40,9,"�ꡡ�¡��ա�ʱ",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"ǩ��:",'LBR',2,'L');

$pdf->SetXY(10,171);
$pdf->Cell(40,9,"�ꡡ�¡��ա�ʱ",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"ǩ��:",'LBR',2,'L');
$pdf->Text(20,188,'�����羭����ǩ����________________');

$pdf->Text(20,200,'����4��');

$pdf->SetFont('GB','B',11);
$pdf->SetXY(10,205);
$pdf->Cell(0,7,"��Ը�μ����и���������Ŀ����Э��",0,2,'C');

$pdf->SetFont('GB','',10.5);
$pdf->Cell(40,12,"����ʱ��",1,0,'C',0);
$pdf->Cell(25,12,"�ص�",1,0,'C',0);
$pdf->Cell(28,12,"��Ŀ���ƺ�����",1,0,'C',0);
$pdf->Cell(22,12,"����(Ԫ)",1,0,'C',0);
$pdf->Cell(30,12,"��Ŀʱ��(����)",1,0,'C',0);
$pdf->Cell(20,12,"����˵��",1,0,'C',0);
$pdf->MultiCell(25,6,"������ǩ��ͬ��",1,'C');

$pdf->SetXY(10,224);
$pdf->Cell(40,9,"�ꡡ�¡��ա�ʱ",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(28,9,"",'LB',0,'C');
$pdf->Cell(22,9,"",'LB',0,'C');
$pdf->Cell(30,9,"",'LB',0,'C');
$pdf->Cell(20,9,"",'LB',0,'C');
$pdf->Cell(25,9,"ǩ��:",'LBR',2,'L');

$pdf->SetXY(10,233);
$pdf->Cell(40,9,"�ꡡ�¡��ա�ʱ",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(28,9,"",'LB',0,'C');
$pdf->Cell(22,9,"",'LB',0,'C');
$pdf->Cell(30,9,"",'LB',0,'C');
$pdf->Cell(20,9,"",'LB',0,'C');
$pdf->Cell(25,9,"ǩ��:",'LBR',2,'L');

$pdf->SetXY(10,242);
$pdf->Cell(40,9,"�ꡡ�¡��ա�ʱ",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(28,9,"",'LB',0,'C');
$pdf->Cell(22,9,"",'LB',0,'C');
$pdf->Cell(30,9,"",'LB',0,'C');
$pdf->Cell(20,9,"",'LB',0,'C');
$pdf->Cell(25,9,"ǩ��:",'LBR',2,'L');

$pdf->Text(20,260,'�����羭����ǩ����________________');

//����PDF�ļ�
date_default_timezone_set("Asia/Shanghai");
$pdf->Output("".$row_dpf['order_sn'].".pdf","D");
die;

?>
