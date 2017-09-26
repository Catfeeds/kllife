-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 02 月 15 日 16:06
-- 服务器版本: 5.5.37
-- PHP 版本: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `managekllife`
--

-- --------------------------------------------------------

--
-- 表的结构 `kl_set`
--

CREATE TABLE IF NOT EXISTS `kl_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '这只编号',
  `station_id` int(10) unsigned DEFAULT '1' COMMENT '设置所属站点编号',
  `type` varchar(255) DEFAULT NULL COMMENT '设置类型',
  `key` varchar(255) DEFAULT NULL COMMENT '设置键',
  `value` text COMMENT '设置值',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=230 ;

--
-- 转存表中的数据 `kl_set`
--

INSERT INTO `kl_set` (`id`, `station_id`, `type`, `key`, `value`, `sort`) VALUES
(118, 1, 'phone_home_index', 'zhuanti1', '1487140094', 1),
(117, 1, 'phone_home_index', 'zhuanti2', '1487140094', 2),
(4, 1, 'pc_home_index', 'choose_us', '1487140094', 0),
(5, 1, 'pc_home_index', 'zhuanti1', '{"img_main":"http://img.kllife.com/2017-01-25_58881e2723097.jpg","img_banner":"http://img.kllife.com/2017-01-25_58881b5618ade.png","title":"甘南净土","subheading":"享受18°的夏天","desc":"拉卜楞寺的辩经声随着炊烟一同升起，草原上沁入心脾的酥油香久未散去，郎木寺如世外桃源般遗世独立，扎尕那峥嵘的石城在云雾中若隐若现……这里是圣境天堂般的甘南，光影中姑娘绯红的侧脸格外好看，转经廊外的老者默念着六字真言，充满信仰的人们匍匐在漫漫长路。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/22"}', 1),
(6, 1, 'pc_home_index', 'zhuanti2', '{"img_main":"http://img.kllife.com/2017-01-25_588821dec694e.jpg","img_banner":"http://img.kllife.com/2017-01-25_588822052ddde.png","title":"多彩贵州","subheading":"淳朴的少数民族风情","desc":"贵州秀丽古朴、风景如画，是世界上岩溶地貌发育最典型的地区之一，有最绚丽多彩的喀斯特景观。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/19"}', 2),
(7, 1, 'pc_home_index', 'zhuanti3', '{"img_main":"http://img.kllife.com/2017-01-25_58882323432af.jpg","img_banner":"http://img.kllife.com/2017-01-25_5888234b2601c.png","title":"圣域西藏","subheading":"神的孩子都要去西藏","desc":"西藏应该可以称得上最为“极致”的地方了，美得极致，高得极致，神圣得极致。如果你没有到达超过海拔5000米的高度，没有在空气稀薄地带感受过肺部的紧缩，没有在耀眼的阳光下被冰雪的反射光照射的无法张开双眼，没有在急剧下降的温度中体会渐渐变轻的生命，你将无法明白这个词的含义。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/20"}', 3),
(193, 2, 'pc_home_index', 'surrounding_line_recommend1', '{"id":"195","img":"http:\\/\\/img.kllife.com\\/2017-01-24_588709de8f650.jpg","title":"\\u4ed9\\u971e\\u53e4\\u9053","subheading":"2017\\u5168\\u5e74\\u8ba1\\u5212\\uff1a\\u4e24\\u65e5\\u5f92\\u6b65\\u4ed9\\u971e\\u53e4\\u9053\\uff0c\\u5bbf\\u5eff\\u516b\\u90fd\\u53e4\\u9547\\uff0c\\u52c7\\u6500\\u6c5f\\u90ce\\u5c71\\uff01\\uff08\\u53e4\\u9053\\u5f92\\u6b656\\u516c\\u91cc\\u5de6\\u53f3\\uff09","send_word":"1.\\u6c5f\\u90ce\\u5c71\\u4ee5\\u201c\\u4e2d\\u56fd\\u4e39\\u971e\\u201d\\u800c\\u95fb\\u540d\\u4e8e\\u4e16\\uff0c\\u5c71\\u4f53\\u5448\\u201c\\u5ddd\\u201d\\u5b57\\u5f62\\u6392\\u5217\\u3002\\u98ce\\u666f\\u72ec\\u7279\\uff0c\\u4e0d\\u53ef\\u9519\\u8fc7\\u3002\\n2.\\u5bbf\\u5eff\\u516b\\u90fd\\u53e4\\u9547\\u2014\\u4f53","cut_price":490,"destination":"\\u6c5f\\u5c71","leader_recommend":"0"}', 1),
(8, 1, 'pc_home_index', 'zhuanti4', '{"img_main":"http://img.kllife.com/2017-01-25_58884722d2adc.jpg","img_banner":"http://img.kllife.com/2017-01-25_5888463409d4a.png","title":"大美青海","subheading":"每个人都该去的环湖路","desc":"青海有太多梦中的景象，金黄的花海、耀眼的雪山、似海的碧水，恍然间，以为自己走进一场梦境。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/25"}', 4),
(125, 1, 'pc_home_index', 'zhuanti11', '', 11),
(9, 1, 'pc_home_index', 'zhuanti5', '{"img_main":"http://img.kllife.com/2017-01-25_58884f2fc73ce.jpg","img_banner":"http://img.kllife.com/2017-01-25_588847c72696b.png","title":"坝上草原","subheading":"策马奔腾共享人生繁华","desc":"坝上的美丽已不是秘密，天地间的灵性也许比风景的存在更为重要，你可以追溯那群奔跑的骏马、安静的牛羊，以及萦绕在心头的炊烟。带上相机、嗅着露珠、迎着阳光，让自己与一丝风景重叠……","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/24"}', 5),
(124, 1, 'pc_home_index', 'zhuanti10', '', 10),
(10, 1, 'pc_home_index', 'zhuanti6', '{"img_main":"http://img.kllife.com/2017-01-25_58884f98d4114.jpg","img_banner":"http://img.kllife.com/2017-01-25_5888496d9924e.png","title":"新疆是个好地方","subheading":"","desc":"新疆的喀纳斯是集冰川、湖泊、森林、草原、牧场、河流、民族风情、珍稀动植物于一体的综合景区； 壮观的冰川映衬着宁静的湖水，茫茫的草原包容着幽深的原始森林，古朴的图瓦人居住在禾木、白哈巴的原始村落，让人痴迷。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/21"}', 6),
(122, 1, 'pc_home_index', 'zhuanti7', '{"img_main":"http://img.kllife.com/2017-01-25_5888506be3abd.jpg","img_banner":"http://img.kllife.com/2017-01-25_58884fc844b45.png","title":"冰雪神话","subheading":"雪乡那么美","desc":"漫步雪乡，看着那些“雪蘑菇”、“雪蛋糕”和“奶油冰棍”，仿佛置身于《绿野仙踪》里北风女神的宫殿，一切的一切，都被雪公主的巧手做成了冰清玉洁的雕塑。称这里是一座天然的“雪雕城”，真是一点也不过分。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/23"}', 7),
(11, 1, 'pc_home_index', 'zhaunti7', '1487140094', 6),
(12, 1, 'pc_home_index', 'zhuanti8', '', 8),
(123, 1, 'pc_home_index', 'zhuanti9', '', 9),
(13, 1, 'pc_home_index', 'cs_tel', '1487140094', 0),
(145, 1, 'pc_home_index', 'photograph_line_recommend0', '{"id":"32"}', 0),
(155, 1, 'pc_home_index', 'lunbo3_url', 'http://kllife.com//home/index.php?s=/home/line/subject/id/21', 0),
(156, 1, 'pc_home_index', 'config_update_time', '1487145446', 0),
(146, 1, 'pc_home_index', 'photograph_line_recommend1', '{"id":"121"}', 1),
(143, 1, 'pc_home_index', 'theme_line_recommend5', '{"id":"124"}', 5),
(142, 1, 'pc_home_index', 'theme_line_recommend4', '{"id":"127"}', 4),
(141, 1, 'pc_home_index', 'theme_line_recommend3', '{"id":"114"}', 3),
(140, 1, 'pc_home_index', 'theme_line_recommend2', '{"id":"122"}', 2),
(139, 1, 'pc_home_index', 'theme_line_recommend1', '{"id":"125"}', 1),
(136, 1, 'pc_set', 'askfor_link', 'http://pqt.zoosnet.net/LR/Chatpre.aspx?id=PQT43116159&lng=cn', 0),
(138, 1, 'pc_home_index', 'theme_line_recommend0', '{"id":"128"}', 0),
(137, 1, 'pc_set', 'statistic_script', '<!--网站认证代码--> \n<div style="width:1200px; height:40px; margin:0 auto; text-align:center;">\n<a key ="56e24e9defbfb06cccdf1aa0" logo_size="83x30" logo_type="business" href="http://www.anquan.org"><script src="http://static.anquan.org/static/outer/js/aq_auth.js"></script></a>\n</div>\n<!--商务通代码--> \n<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&float=1&lng=cn"></script>\n<script language="javascript" type="text/javascript" src="http://kllife.com/swt/js/swt.js"></script>\n<!--百度统计--> \n<script>\nvar _hmt = _hmt || [];\n(function() {\n  var hm = document.createElement("script");\n  hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";\n  var s = document.getElementsByTagName("script")[0]; \n  s.parentNode.insertBefore(hm, s);\n})();\n</script> \n<!--CNZZ统计--> \n<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cdiv id=''cnzz_stat_icon_1000019958''%3E%3C/div%3E%3Cscript src=''" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000019958%26show%3Dpic'' type=''text/javascript''%3E%3C/script%3E"));</script> \n<!--网盟网站定向代码--> \n<script type="text/javascript">\n<!-- \n(function (d) {\n(window.bd_cpro_rtid = window.bd_cpro_rtid || []).push({id:"nWckPj0L"});\nvar s = d.createElement("script");s.type = "text/javascript";s.async = true;s.src = location.protocol + "//cpro.baidu.com/cpro/ui/rt.js";\nvar s0 = d.getElementsByTagName("script")[0];s0.parentNode.insertBefore(s, s0);\n})(document);\n//-->\n</script>\n', 0),
(135, 1, 'pc_home_index', 'depth_line_recommend5', '{"id":"186"}', 5),
(134, 1, 'pc_home_index', 'depth_line_recommend4', '{"id":"39"}', 4),
(133, 1, 'pc_home_index', 'depth_line_recommend3', '{"id":"113"}', 3),
(132, 1, 'pc_home_index', 'depth_line_recommend2', '{"id":"37"}', 2),
(131, 1, 'pc_home_index', 'depth_line_recommend1', '{"id":"29"}', 1),
(129, 1, 'pc_home_index', 'depth_line_recommend0', '{"id":"30"}', 0),
(128, 1, 'pc_home_index', 'surrounding_line_recommend5', '{"id":"153"}', 5),
(127, 1, 'pc_home_index', 'surrounding_line_recommend4', '{"id":"179"}', 4),
(121, 1, 'pc_home_index', 'activity2', '{"subheading":"寒冷档不住家长和孩子们出游的兴奋，越旅行越长大！","author":"琪琪乖乖","url":"http://shequ.kllife.com/Index/youjidetail.html?id=2578","img":"http://img.kllife.com/2017-02-06_5897cd4b3bc17.jpg"}', 0),
(119, 1, 'pc_home_index', 'surrounding_line_recommend3', '{"id":"28"}', 3),
(112, 1, 'phone_home_index', 'lunbo1', '1487140094', 0),
(113, 1, 'phone_home_index', 'lunbo2', '1487140094', 0),
(114, 1, 'phone_home_index', 'lunbo3', '1487140094', 0),
(110, 1, 'pc_home_index', 'activity0', '{"subheading":"冬摄大运河，总有风景不可错过，总有年味让人回味！","author":"柒月先森","url":"http://shequ.kllife.com/Index/youjidetail.html?id=2723","img":"http://img.kllife.com/2017-01-17_587e18042c9ad.jpg"}', 0),
(75, 1, 'pc_home_index', 'leader1', '1487140094', 0),
(76, 1, 'pc_home_index', 'leader2', '1487140094', 1),
(77, 1, 'pc_home_index', 'leader3', '1487140094', 2),
(78, 1, 'pc_home_index', 'leader4', '1487140094', 4),
(147, 1, 'pc_home_index', 'photograph_line_recommend2', '{"id":"65"}', 2),
(82, 1, 'pc_home_index', 'choose_us', '1487140094', 0),
(83, 1, 'pc_home_index', 'lunbo1', 'http://img.kllife.com/2017-01-25_58882d9207d01.jpg', 0),
(84, 1, 'pc_home_index', 'lunbo2', 'http://img.kllife.com/2017-01-25_588859b73cee7.jpg', 0),
(85, 1, 'pc_home_index', 'lunbo3', 'http://img.kllife.com/2017-02-13_58a15b125b037.jpg', 0),
(86, 1, 'pc_home_index', 'surrounding_line_tab', '[{"id":"0","type_key":"surrounding_line_recommend","type_desc":"推荐"}]', 0),
(88, 1, 'pc_home_index', 'depth_line_tab', '[{"id":"0","type_key":"depth_line_recommend","type_desc":"推荐"}]', 0),
(89, 1, 'pc_home_index', 'hot_line_tab', '[{"id":"0","type_key":"hot_line_recommend","type_desc":"推荐"}]', 0),
(157, 1, 'pc_set', 'config_update_time', '1487144273', 0),
(159, 1, 'phone_home_index', 'config_update_time', '1487140094', 0),
(90, 1, 'pc_home_index', 'hot_line_recommend0', '{"id":"121"}', 0),
(91, 1, 'pc_home_index', 'hot_line_recommend1', '{"id":"29"}', 1),
(92, 1, 'pc_home_index', 'hot_line_recommend2', '{"id":"30"}', 2),
(93, 1, 'pc_home_index', 'hot_line_recommend3', '{"id":"37"}', 3),
(94, 1, 'pc_home_index', 'hot_line_recommend4', '{"id":"113"}', 4),
(101, 1, 'pc_home_index', 'video0', '{"id":"35","title":"\\u6c34\\u4e0a\\u9b54\\u9b3c\\u57ce","subheading":"\\u9886\\u8896\\u6237\\u5916\\u6c34\\u4e0a\\u9b54\\u9b3c\\u57ce\\u5bfb\\u68a6\\u5c0f\\u961f","img":"http:\\/\\/img.kllife.com\\/2017-01-17_587e13cfedbe1.jpg","href":"XMTY0MDQ5NTkzNg==","create_time":"2017-01-17 20:53:38","uploader":"{\\"account_type_id\\":\\"1\\",\\"id\\":\\"1\\"}"}', 0),
(95, 1, 'pc_home_index', 'photograph_line_tab', '[{"id":"0","type_key":"photograph_line_recommend","type_desc":"推荐"}]', 0),
(96, 1, 'pc_home_index', 'theme_line_tab', '[{"id":"0","type_key":"theme_line_recommend","type_desc":"推荐"}]', 0),
(97, 1, 'pc_home_index', 'surrounding_line_recommend0', '{"id":"144"}', 0),
(99, 1, 'pc_home_index', 'surrounding_line_recommend1', '{"id":"140"}', 1),
(100, 1, 'pc_home_index', 'surrounding_line_recommend2', '{"id":"139"}', 2),
(116, 1, 'phone_home_index', 'zhuanti3', '1487140094', 3),
(102, 1, 'pc_home_index', 'video1', '{"id":"36","title":"\\u65b0\\u7586\\uff0c\\u518d\\u51fa\\u53d1\\uff01","subheading":"\\u9886\\u8896\\u6237\\u5916\\u65b0\\u7586\\u8e29\\u7ebf\\u5c0f\\u5206\\u961f","img":"http:\\/\\/img.kllife.com\\/2017-01-17_587e24b5dd02e.jpg","href":"XMTU4MjczNjgwMA==","create_time":"2017-01-17 22:06:03","uploader":"{\\"account_type_id\\":\\"1\\",\\"id\\":\\"1\\"}"}', 1),
(103, 1, 'pc_home_index', 'article0', '{"id":"22","short_title":"\\u6625\\u8282\\u7f57\\u5e73\\u8d4f\\u6cb9\\u83dc\\u82b1\\u6700\\u5168\\u653b\\u7565","send_word":"\\u6bcf\\u5e742\\u30013\\u6708\\u4efd\\uff0c20\\u4e07\\u4ea9\\u6cb9\\u83dc\\u82b1\\u5728\\u7f57\\u5e73\\u575d\\u5b50\\u7ade\\u76f8\\u4e89\\u653e\\uff0c\\u653e\\u773c\\u671b\\u53bb\\uff0c\\u662f\\u4e00\\u7247\\u4e00\\u671b\\u65e0\\u9645\\u7684\\u91d1\\u9ec4\\u3002 \\u200b","face_image":"http:\\/\\/img.kllife.com\\/2017-01-11_5875d18ae7e09.png","author":"\\u82cf\\u6587\\u5a77"}', 0),
(104, 1, 'pc_home_index', 'article1', '{"id":"21","short_title":"\\u51ac\\u5b63\\u65c5\\u6e38\\u8005\\u73a9\\u96ea\\u7684\\u5929\\u5802","send_word":"\\u7ea2\\u7ea2\\u7684\\u706f\\u7b3c\\u3001\\u7cbe\\u81f4\\u7684\\u96ea\\u96d5\\u3001\\u96ea\\u8611\\u83c7\\u3001\\u523a\\u6fc0\\u7684\\u96ea\\u5730\\u6469\\u6258\\u3001\\u6253\\u96ea\\u5708\\uff0c\\u4e00\\u8d77\\u53bb\\u611f\\u53d7\\u72ec\\u7279\\u7684\\u96ea\\u4e61\\u9b45\\u529b\\u3002","face_image":"http:\\/\\/img.kllife.com\\/2017-01-11_5875ce9b8e0d9.png","author":"\\u82cf\\u6587\\u5a77"}', 0),
(105, 1, 'pc_home_index', 'article2', '{"id":"20","short_title":"\\u5143\\u9633\\u68af\\u7530\\u666f\\u70b9\\u6700\\u4f73\\u62cd\\u6444\\u653b\\u7565","send_word":"\\u5728\\u5143\\u9633\\uff0c\\u7ecf\\u8fc7\\u5343\\u767e\\u5e74\\u6765\\u5404\\u65cf\\u4eba\\u6c11\\u8f9b\\u52e4\\u7684\\u52b3\\u52a8\\uff0c\\u4f9d\\u5c71\\u5f00\\u57a6\\u4e8636\\u4e07\\u591a\\u4ea9\\u7684\\u68af\\u7530\\uff0c\\u582a\\u79f0\\u4e16\\u754c\\u4e00\\u7edd\\u3002\\u5f53\\u592a\\u9633\\u5347\\u8d77\\uff0c\\u7ea2\\u971e\\u6ee1...","face_image":"http:\\/\\/img.kllife.com\\/2017-01-11_5875ca5264f66.png","author":"\\u82cf\\u6587\\u5a77"}', 2),
(106, 1, 'pc_home_index', 'video2', '{"id":"33","title":"\\u805a\\u7126\\u540c\\u5c71","subheading":"\\u767e\\u540d\\u6444\\u5f71\\u5e08\\u9f50\\u805a\\u540c\\u5c71","img":"http:\\/\\/img.kllife.com\\/2017-01-17_587e11d481d0a.jpg","href":"XMjQ3MzQ2Nzc1Ng==","create_time":"2017-01-17 20:45:10","uploader":"{\\"account_type_id\\":\\"1\\",\\"id\\":\\"1\\"}"}', 2),
(115, 1, 'phone_home_index', 'zhuanti0', '1487140094', 0),
(107, 1, 'pc_home_index', 'article3', '{"id":"11","short_title":"\\u8272\\u8fbe\\u6709\\u5f88\\u591a\\u8bd7\\u548c\\u8fdc\\u65b9\\u7684\\u7530\\u91ce","send_word":"\\u5bf9\\u8272\\u8fbe\\u4e86\\u89e3\\u7684\\u670b\\u53cb\\u4e0d\\u5c11\\uff0c\\u4f46\\u662f\\u5927\\u90e8\\u5206\\u670b\\u53cb\\u53ea\\u77e5\\u9053\\u8272\\u8fbe\\u6709\\u4e94\\u660e\\u4f5b\\u5b66\\u9662\\u548c\\u5929\\u846c\\u53f0\\uff0c\\u90a3\\u8272\\u8fbe\\u96be\\u9053\\u53ea\\u6709\\u8fd9\\u4e24\\u4e2a\\u5730\\u65b9\\uff1fNO\\uff01...","face_image":"http:\\/\\/img.kllife.com\\/2016-12-23_585cf480dcf2a.jpg","author":"admin"}', 3),
(120, 1, 'pc_home_index', 'activity1', '{"subheading":"人文风光与环境人像齐聚，杭州摄影师们年前的一次重大福利","author":"杰森","url":"http://shequ.kllife.com/Index/youjidetail.html?id=2712","img":"http://img.kllife.com/2017-01-17_587e194d14241.jpg"}', 0),
(111, 1, 'pc_home_index', 'zhuanti0', '{"img_main":"http://img.kllife.com/2017-01-25_588818ede3267.jpg","img_banner":"http://img.kllife.com/2017-01-25_58880135ca4e5.png","title":"醉美云南","subheading":"旅游必不可少的目的地","desc":"古人用”彩云南现”遥指这片神秘的云岭高原，在这块红土高原上，有四季如春的昆明，有古南诏大理，有神秘圣境香格里拉，有充满柔软时光的丽江，这里绚丽斑斓的多民族文化给了她的神秘多彩的无限魅力。","url":"http://kllife.com//home/index.php?s=/home/line/subject/id/18"}', 0),
(154, 1, 'pc_home_index', 'lunbo2_url', 'http://kllife.com//home/index.php?s=/home/line/subject/id/18', 0),
(148, 1, 'pc_home_index', 'photograph_line_recommend3', '{"id":"182"}', 3),
(149, 1, 'pc_home_index', 'photograph_line_recommend4', '{"id":"112"}', 4),
(150, 1, 'pc_home_index', 'photograph_line_recommend5', '{"id":"113"}', 5),
(151, 1, 'pc_set', 'team_link', 'http://kllife.com/home/index.php?s=/home/line/book', 0),
(153, 1, 'pc_home_index', 'lunbo1_url', 'http://kllife.com/home/index.php?s=/home/line/info/id/37', 0),
(160, 1, 'pc_home_top_menu', 'config_update_time', '1487140094', 0),
(191, 2, 'pc_home_index', 'surrounding_line_recommend0', '{"id":"28","img":"http:\\/\\/img.kllife.com\\/2016-12-13_584f6527542c6.jpg","title":"\\u5fbd\\u676d\\u53e4\\u9053","subheading":"2016\\u5168\\u5e74\\u8ba1\\u5212\\uff1a\\u8f7b\\u88c5\\u5355\\u65e5\\u5f92\\u6b65\\u7a7f\\u8d8a\\uff0c\\u72ec\\u5bb6\\u7b56\\u5212\\u2014\\u2014\\u7528\\u201c\\u6362\\u5ba2\\u201d\\u884c\\u4e3a\\u4eb2\\u8eab\\u4f53\\u4f1a\\u53e4\\u7ecf\\u5546\\u4e4b\\u9053\\uff08\\u514d\\u8d39\\u63d0\\u4f9b\\u767b\\u5c71\\u6756\\uff0c\\u7ec4\\u7ec7\\u6237\\u5916\\u91ce\\u708a\\uff09","send_word":"\\u5fbd\\u676d\\u53e4\\u9053\\n\\u2605\\u65b0\\u9a74\\u5fc5\\u4fee\\u8bfe\\uff0c\\u4e2d\\u56fd\\u5341\\u5927\\u7ecf\\u5178\\u5f92\\u6b65\\u7ebf\\u8def\\n\\u2605\\u662f\\u53e4\\u65f6\\u6d59\\u5546\\u548c\\u5fbd\\u5546\\u7684\\u7ecf\\u5546\\u4e4b\\u9053\\uff0c\\u4e2d\\u56fd\\u7b2c\\u4e00\\u6761\\u53e4\\u9053\\n\\u2605\\u7ebf\\u8def\\u96be","cut_price":180,"destination":"\\u5b89\\u5fbd","leader_recommend":"0"}', 0),
(194, 2, 'pc_home_index', 'surrounding_line_recommend2', '{"id":"187","img":"http:\\/\\/img.kllife.com\\/2017-02-14_58a2a3ed2805d.jpg","title":"\\u9ec4\\u5357\\u53e4\\u9053","subheading":"\\u53e4\\u6811\\u68af\\u7530\\u2014\\u66ae\\u6625\\u91cc\\u6f2b\\u6b65\\u77f3\\u677f\\u8def\\uff0c\\u770b\\u67ab\\u53f6\\u7684\\u5ae9\\u7eff\\u548c\\u675c\\u9e43\\u7684\\u706b\\u7ea2\\uff01\\uff08\\u5355\\u65e5\\u5f92\\u6b65\\u7ea68\\u516c\\u91cc\\uff09","send_word":"1.\\u9ec4\\u5357\\u53e4\\u9053\\u662f\\u65e7\\u65f6\\u8fde\\u63a5\\u5929\\u53f0\\u5230\\u4e34\\u6d77\\u6700\\u8fd1\\u7684\\u53e4\\u9053\\uff0c\\u9752\\u77f3\\u53e4\\u9053\\u7ef5\\u5ef610\\u591a\\u91cc\\uff0c\\u4e24\\u8fb9\\u662f\\u53e4\\u6811\\u53c2\\u5929\\uff0c\\u7ffb\\u8fc7\\u5c71\\u90a3\\u8fb9\\u662f\\u7ef5\\u5ef6\\u65e0","cut_price":160,"destination":"\\u5929\\u53f0","leader_recommend":"0"}', 2),
(195, 2, 'pc_home_index', 'surrounding_line_recommend3', '{"id":"181","img":"http:\\/\\/img.kllife.com\\/2017-01-23_5885b9d8c9d0a.jpg","title":"\\u98de\\u9e70\\u9053","subheading":"\\u5355\\u65e5\\u5f92\\u6b65\\u7a7f\\u8d8a\\u5212\\u5ca9\\u5c71\\u98de\\u9e70\\u9053\\uff0c\\u5728\\u60ac\\u5d16\\u4e0a\\u884c\\u8d70\\uff0c\\u4f53\\u9a8c\\u5145\\u6ee1\\u60ca\\u9669\\u523a\\u6fc0\\u7684\\u72ec\\u7279\\u4e4b\\u65c5\\uff08\\u5f92\\u6b65\\u7ea68\\u516c\\u91cc\\uff09","send_word":"","cut_price":170,"destination":"\\u53f0\\u5dde","leader_recommend":"0"}', 3),
(196, 2, 'pc_home_index', 'surrounding_line_recommend4', '{"id":"33","img":"http:\\/\\/img.kllife.com\\/2017-02-14_58a2ce980471d.png","title":"\\u5434\\u8d8a\\u53e4\\u9053","subheading":"2017\\u5168\\u5e74\\u8ba1\\u5212:\\u5355\\u65e5\\u5f92\\u6b65\\u5434\\u8d8a\\u53e4\\u9053\\uff0c\\u89c2\\u6d59\\u897f\\u5929\\u6c60\\u3002\\u4e0e\\u53e4\\u9053\\u6765\\u4e2a\\u4eb2\\u5bc6\\u63a5\\u89e6\\u5427\\uff01(\\u5f92\\u6b65\\u7ea610\\u516c\\u91cc)","send_word":"\\u5434\\u8d8a\\u53e4\\u9053\\n\\u2605\\u73b0\\u4fdd\\u5b58\\u57fa\\u672c\\u5b8c\\u6574\\u7684\\u9752\\u77f3\\u53e4\\u9053\\u7ea615\\u516c\\u91cc\\uff0c\\u4e3a\\u4e94\\u4ee3\\u5341\\u56fd\\u65f6\\u671f\\u5434\\u8d8a\\uff08\\u6d59\\u6c5f\\uff09\\u4e0e\\u5357\\u5510\\uff08\\u5b89\\u5fbd\\uff09\\u7684\\u4e3b\\u8981\\u901a\\u9053\\u3002","cut_price":140,"destination":"\\u5b89\\u5fbd","leader_recommend":"0"}', 4),
(197, 2, 'pc_home_index', 'surrounding_line_recommend5', '{"id":"187","img":"http:\\/\\/img.kllife.com\\/2017-02-14_58a2a3ed2805d.jpg","title":"\\u9ec4\\u5357\\u53e4\\u9053","subheading":"\\u53e4\\u6811\\u68af\\u7530\\u2014\\u66ae\\u6625\\u91cc\\u6f2b\\u6b65\\u77f3\\u677f\\u8def\\uff0c\\u770b\\u67ab\\u53f6\\u7684\\u5ae9\\u7eff\\u548c\\u675c\\u9e43\\u7684\\u706b\\u7ea2\\uff01\\uff08\\u5355\\u65e5\\u5f92\\u6b65\\u7ea68\\u516c\\u91cc\\uff09","send_word":"1.\\u9ec4\\u5357\\u53e4\\u9053\\u662f\\u65e7\\u65f6\\u8fde\\u63a5\\u5929\\u53f0\\u5230\\u4e34\\u6d77\\u6700\\u8fd1\\u7684\\u53e4\\u9053\\uff0c\\u9752\\u77f3\\u53e4\\u9053\\u7ef5\\u5ef610\\u591a\\u91cc\\uff0c\\u4e24\\u8fb9\\u662f\\u53e4\\u6811\\u53c2\\u5929\\uff0c\\u7ffb\\u8fc7\\u5c71\\u90a3\\u8fb9\\u662f\\u7ef5\\u5ef6\\u65e0","cut_price":160,"destination":"\\u5929\\u53f0","leader_recommend":"0"}', 5),
(229, 1, 'cache_set_subject_19?bd-guizhou', 'config_update_time', '1487145990', 0),
(226, 2, 'pc_home_index', 'config_update_time', '1487145446', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
