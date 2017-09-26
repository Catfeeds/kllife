<?php
require('../chinese.php');
//链接数据库
//$conn = mysql_connect("localhost", "kllife", "kuaile1@#3"); //连接数据库
//mysql_select_db("kllife", $conn); //执行SQL

$conn = mysql_connect("localhost", "managekllife", "B8QRKSDrVHE8HUFb"); //连接数据库
mysql_select_db("managekllife", $conn); //执行SQL
mysql_query("set names GBK");

//-------------------------------------
$did = $_GET['did']; //获取参数id
$new_line = $_GET['new_line'];
if (empty($did)){
	die('下载信息错误');
}

$weekarray=array("日","一","二","三","四","五","六");
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
		$this->SetFont('GB','',10.5); //内容样式
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

//引入GB字体
$pdf->AddGBFont();

//合同第一页
$pdf->AddPage();

$pdf->SetFont('GB','B',12);
$pdf->Text(20,30,"GF--2014--2401");
$pdf->Text(140,30,"合同编号：");

$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(255,0,0);
$pdf->Text(160,30,substr($row_dpf['order_sn'],3,17));

$pdf->SetFont('GB','B',38);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,120,"西安市境内团队旅游合同",0,2,'C');

$pdf->SetFont('GB','B',15);
$pdf->Cell(0,20,"旅游者（代表）：__________________",0,2,'C');
$pdf->Cell(0,20,"组 团 旅 行 社：____________________",0,2,'C');
$pdf->Cell(0,20,"许 可 证 编 号：____________________",0,2,'C');

$pdf->SetFont('GB','',13);
$pdf->Text(110,140,$row_dpf['names']);
$pdf->Text(100,160,'陕西浪客国际旅行社有限责任公司');
$pdf->Text(110,180,'L-SNX00306');

$pdf->SetFont('GB','B',12);
$pdf->Cell(0,60,"  ",0,2,'C');
$pdf->Cell(0,10,"国家旅游局、国家工商行政管理总局制定",0,2,'C');
$pdf->Cell(0,10,"西安市旅游局、西安市工商行政管理局监印",0,2,'C');

//合同第二页
$pdf->AddPage();

$pdf->SetFont('GB','B',14);
$pdf->Cell(0,50,"使用说明",0,2,'C');

$pdf->SetFont('GB','',12);
$pdf->Write(13,'　　1.本合同为示范文本，供中华人民共和国境内 （不含港、 澳 、台地区）旅行社与旅游者之间签订团队境内包价旅游合同时使用（不含赴港、 澳 、台地区旅游及边境游）。
　　2.双方当事人应当结合具体情况选择本合同协议条款中所提供的选择项，空格处应当以文字形式填写完整。
　　3. 双方当事人可以书面形式对本示范文本内容予以变更或者补充，但变更或者补充的内容，不得减轻或者免除应当由旅行社承担的责任。
　　4.本示范文本由国家旅游局和国家工商行政管理总局共同制定、解释，在全国范围内推行使用。
');

$pdf->SetFont('GB','B',14);
$pdf->Cell(0,50,"服务质量监督管理",0,2,'C');

$pdf->SetFont('GB','',12);
$pdf->Text(50,195,"旅行社监督、投诉电话：");
$pdf->Text(50,205,"西安市旅游质监所投诉电话：029-87630166");

$pdf->SetFont('GB','B',14);
$pdf->Cell(0,45,"  ",0,2,'C');
$pdf->Cell(0,10,"自觉遵守《中国公民国内旅游文明公约》，相互监督，相互提醒，争当文明游客。",1,2,'C');

//合同具体内容
$pdf->AddPage();

$pdf->SetFont('GB','B',13);
$pdf->Cell(0,10,"团队境内旅游合同",0,2,'C');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第一章　　术语和定义",0,2,'C');
$pdf->ChapterBody('txt/context1.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第二章　　合同的订立",0,2,'C');
$pdf->ChapterBody('txt/context2.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第三章　　合同双方的权利义务",0,2,'C');
$pdf->ChapterBody('txt/context3.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第四章　　合同的变更与转让",0,2,'C');
$pdf->ChapterBody('txt/context4.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第五章　　合同的解除",0,2,'C');
$pdf->ChapterBody('txt/context5.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第六章　　违约责任",0,2,'C');
$pdf->ChapterBody('txt/context6.txt');

$pdf->SetFont('GB','B',12);
$pdf->Cell(80,10,"第七章　　协议条款",0,2,'C');
$pdf->ChapterBody('txt/context7.txt');

$pdf->SetFont('GB','',12);
$pdf->Text(40,240,date("Y",$row_dpf['startdate'])."　　　".date("m",$row_dpf['startdate'])."　　　".date("d",$row_dpf['startdate']));
$pdf->Text(40,246,date("Y",$row_dpf['enddate'])."　　　".date("m",$row_dpf['enddate'])."　　　".date("d",$row_dpf['enddate']));

if(empty($new_line)){
	$pdf->Text(30,252,round(($row_dpf['enddate']-$row_dpf['startdate'])/86400)."　　　　　　　　".(round(($row_dpf['enddate']-$row_dpf['startdate'])/86400)-1) );
}else{
	$pdf->Text(30,252,$row_dpf['travel_day']."　　　　　　　　".($row_dpf['travel_day'] - 1));
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
	$zffs = "在线付款";
	$zfsj = "签合同时支付全款";
}
elseif($row_dpf['zhuangtai']==7 or $row_dpf['zhuangtai']==10)
{
	$zffs = "在线付款+现金";
	$zfsj = "签合同时支付部分款，尾款在出团前3天支付完成";
}
else{
	$zffs = "未付款";
	$zfsj = "未付款";	
}
$pdf->Text(155,16,$zffs);
$pdf->Text(115,28,$zfsj);
$pdf->SetFont('GB','',18);
$pdf->Text(149,70,'√');
$pdf->SetFont('GB','',12);
$pdf->Text(122,94,'同意');
$pdf->Text(122,100,'领袖户外当地');
$pdf->Text(124,106,'不同意');
$pdf->Text(124,112,'不同意');
$pdf->Text(124,124,'同意');
$pdf->Text(132,136,'同意');
$pdf->Text(140,142,'领袖户外当地');
$pdf->Text(145,262,"2");

$pdf->ChapterBody('txt/context8.txt');
$pdf->Image('image/stamp.png', 135, 20, 60, 60);
$pdf->SetFont('GB','',12);
$pdf->Text(63,44,$row_dpf['names']);
$pdf->Text(40,62,$row_dpf['mob']);
$pdf->Text(40,85,date("Y",$row_dpf['addtime'])."　　　".date("m",$row_dpf['addtime'])."　　".date("d",$row_dpf['addtime']));
$pdf->Text(40,92,'陕西省西安市雁塔区');
$pdf->Text(152,56,'郭煜');
$pdf->Text(143,69,'029-88225622');
$pdf->Text(143,15,'2');
$pdf->Text(180,15,'1');

$pdf->SetFont('GB','',10.5);
$pdf->Line(10,107,205,107);
$pdf->Text(20,116,'附件1：旅游报名表（旅行社后附）');
$pdf->Text(20,122,'附件2：旅游行程单（旅行社后附）');
$pdf->Text(20,128,'附件3：');

$pdf->SetFont('GB','B',11);
$pdf->SetXY(10,134);
$pdf->Cell(0,7,"自愿购物活动补充协议",0,2,'C');

$pdf->SetFont('GB','',10.5);
$pdf->Cell(40,12,"具体时间",1,0,'C',0);
$pdf->Cell(25,12,"地点",1,0,'C',0);
$pdf->Cell(25,12,"购物场所名称",1,0,'C',0);
$pdf->Cell(25,12,"主要商品信息",1,0,'C',0);
$y = $pdf->gety();
$x = $pdf->getx();
$pdf->MultiCell(25,6,"最长停留时间（分钟）",1,'C');
$pdf->setxy($x+25,$y);
$pdf->Cell(25,12,"其他说明",1,0,'C',0);
$pdf->MultiCell(25,6,"旅游者签名同意",1,'C');

$pdf->SetXY(10,153);
$pdf->Cell(40,9,"年　月　日　时",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"签名:",'LBR',2,'L');

$pdf->SetXY(10,162);
$pdf->Cell(40,9,"年　月　日　时",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"签名:",'LBR',2,'L');

$pdf->SetXY(10,171);
$pdf->Cell(40,9,"年　月　日　时",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(25,9,"签名:",'LBR',2,'L');
$pdf->Text(20,188,'旅行社经办人签名：________________');

$pdf->Text(20,200,'附件4：');

$pdf->SetFont('GB','B',11);
$pdf->SetXY(10,205);
$pdf->Cell(0,7,"自愿参加另行付费旅游项目补充协议",0,2,'C');

$pdf->SetFont('GB','',10.5);
$pdf->Cell(40,12,"具体时间",1,0,'C',0);
$pdf->Cell(25,12,"地点",1,0,'C',0);
$pdf->Cell(28,12,"项目名称和内容",1,0,'C',0);
$pdf->Cell(22,12,"费用(元)",1,0,'C',0);
$pdf->Cell(30,12,"项目时长(分钟)",1,0,'C',0);
$pdf->Cell(20,12,"其他说明",1,0,'C',0);
$pdf->MultiCell(25,6,"旅游者签名同意",1,'C');

$pdf->SetXY(10,224);
$pdf->Cell(40,9,"年　月　日　时",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(28,9,"",'LB',0,'C');
$pdf->Cell(22,9,"",'LB',0,'C');
$pdf->Cell(30,9,"",'LB',0,'C');
$pdf->Cell(20,9,"",'LB',0,'C');
$pdf->Cell(25,9,"签名:",'LBR',2,'L');

$pdf->SetXY(10,233);
$pdf->Cell(40,9,"年　月　日　时",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(28,9,"",'LB',0,'C');
$pdf->Cell(22,9,"",'LB',0,'C');
$pdf->Cell(30,9,"",'LB',0,'C');
$pdf->Cell(20,9,"",'LB',0,'C');
$pdf->Cell(25,9,"签名:",'LBR',2,'L');

$pdf->SetXY(10,242);
$pdf->Cell(40,9,"年　月　日　时",'LB',0,'R',0);
$pdf->Cell(25,9,"",'LB',0,'C');
$pdf->Cell(28,9,"",'LB',0,'C');
$pdf->Cell(22,9,"",'LB',0,'C');
$pdf->Cell(30,9,"",'LB',0,'C');
$pdf->Cell(20,9,"",'LB',0,'C');
$pdf->Cell(25,9,"签名:",'LBR',2,'L');

$pdf->Text(20,260,'旅行社经办人签名：________________');

//保存PDF文件
date_default_timezone_set("Asia/Shanghai");
$pdf->Output("".$row_dpf['order_sn'].".pdf","D");
die;

?>
