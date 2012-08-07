<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
</head>
<body>
<?php
set_time_limit(0);
/*
@include_once 'QueryPath/QueryPath.php';

$url = '0.txt';

$content = htmlqp($url,'title')->text();

var_dump($content,123);



exit();*/

$urls = array( /*
'http://www.zhangjiajie.com/line/changshayiriyou_222.html',
'http://www.zhangjiajie.com/line/huamingloushaoshanyiriyou_205.html',
'http://www.zhangjiajie.com/line/mengdongheyiriyou_224.html',
'http://www.zhangjiajie.com/line/tianmenshanyiriyou_210.html',
'http://www.zhangjiajie.com/line/yueyangyiriyou_214.html',
'http://www.zhangjiajie.com/line/hengshanyiriyou_203.html',
'http://www.zhangjiajie.com/line/huanglongdongbaofenghuyiriyou_220.html',
'http://www.zhangjiajie.com/line/fenghuangguchenyiriyou_290.html',
'http://www.zhangjiajie.com/line/daxiaguyiriyou_206.html',
'http://www.zhangjiajie.com/line/zhangjiajieyiriyou_209.html',
'http://www.zhangjiajie.com/line/zhangjiajietianmenshanyiriyou_279.html',
'http://www.zhangjiajie.com/line/maoyanhepiaoliuyiriyou_207.html',
'http://www.zhangjiajie.com/line/zhangjiajieerriyou_242.html',
'http://www.zhangjiajie.com/line/fenghuangguchengmiaorenguerriyou_226.html',
'http://www.zhangjiajie.com/line/tianmenshanfenghuangguchengerriyou_218.html',
'http://www.zhangjiajie.com/line/fenghuangguchengerriyou_211.html',
'http://www.zhangjiajie.com/line/fenghuangguchengmiaorenguerriyou_231.html',
'http://www.zhangjiajie.com/line/fenghuangguchengerriyou_284.html',
'http://www.zhangjiajie.com/line/zhangjiajiepiaoliuerriyou_237.html',
'http://www.zhangjiajie.com/line/zhangjiajieerriyou_213.html',
'http://www.zhangjiajie.com/line/fenghuangguchengerriyou_240.html',
'http://www.zhangjiajie.com/line/zhangjiajietianmenshanbaofenghuerriyou_283.html',
'http://www.zhangjiajie.com/line/zhangjiajiesanriyou_216.html',
'http://www.zhangjiajie.com/line/tianmenshansanriyou_227.html',
'http://www.zhangjiajie.com/line/zhangjiajiefenghuangguchengsanriyou_221.html',
'http://www.zhangjiajie.com/line/changshazhangjiajiesanriyou_219.html',
'http://www.zhangjiajie.com/line/zhangjiajiesanriyou_243.html',
'http://www.zhangjiajie.com/line/changshawangfanzhangjiajiesanriyou_248.html',
'http://www.zhangjiajie.com/line/zhangjiajiesanriyou_246.html',
'http://www.zhangjiajie.com/line/yuanjiajieyangjiajiechunwansanriyou_215.html',
'http://www.zhangjiajie.com/line/zhangjiajiechunwansanriyou_268.html',
'http://www.zhangjiajie.com/line/zhangjiajiebaofenghu_270.html',
'http://www.zhangjiajie.com/line/fenghuangguchengdehangmiaozhaisanriyou_223.html',
'http://www.zhangjiajie.com/line/changshawangfan_234.html',
'http://www.zhangjiajie.com/line/zhangjiajiesanriyou_229.html',
'http://www.zhangjiajie.com/line/zhangjiajiebaofenghusanriyou_280.html',
'http://www.zhangjiajie.com/line/zhangjiajiewenquansanriyou_285.html',
'http://www.zhangjiajie.com/line/mengdonghepiaoliu_239.html',
'http://www.zhangjiajie.com/line/yuanjiajieyangjiajiechunwansanriyou_301.html',
'http://www.zhangjiajie.com/line/shengtailvyou_250.html',
'http://www.zhangjiajie.com/line/zjjhgsiriyou_254.html',
'http://www.zhangjiajie.com/line/siriyou_212.html',
'http://www.zhangjiajie.com/line/zhangjiajiefenghuangguchengsiriyou_281.html',
'http://www.zhangjiajie.com/line/zhangjiajiemengdonghe_238.html',
'http://www.zhangjiajie.com/line/zhangjiajiewenquansiriyou_261.html',
'http://www.zhangjiajie.com/line/zhangjiajiewenquansiriyou_230.html',
'http://www.zhangjiajie.com/line/zhangjiajiesiriyou_241.html',
'http://www.zhangjiajie.com/line/zhangjiajiesiriyou_244.html',
'http://www.zhangjiajie.com/line/changshazhangjiajiewuriyou_247.html',
'http://www.zhangjiajie.com/line/zhangjiajiesiriyou_299.html',
'http://www.zhangjiajie.com/line/zhangjiajiegaoduanshangwusiriyou_300.html',
'http://www.zhangjiajie.com/line/zhangjiajiesiriyou_289.html',
'http://www.zhangjiajie.com/line/zhangjiajiefenghuangguchengwuriyou_282.html',
'http://www.zhangjiajie.com/line/fenghuangguchengwuriyou_256.html',
'http://www.zhangjiajie.com/line/zhangjiajiewuriyou_249.html',
'http://www.zhangjiajie.com/line/zhangjiajiewuriyou_232.html',
'http://www.zhangjiajie.com/line/zhangjiajiewuriyou_264.html',
'http://www.zhangjiajie.com/line/zhangjiajiewuriyou_286.html',
'http://www.zhangjiajie.com/line/zhangjiajiewuriyou_253.html',
'http://www.zhangjiajie.com/line/zhangjiajieliuriyou_228.html',*/
'http://www.zhangjiajie.com/line/zhangjiajiewuriyou_291.html',
'http://www.zhangjiajie.com/line/hunanliuriyou_252.html',
'http://www.zhangjiajie.com/line/hunanliuriyou_260.html',
'http://www.zhangjiajie.com/line/zhangjiajieliuriyou_257.html',
'http://www.zhangjiajie.com/line/zhangjiajieliuriyou_288.html',
'http://www.zhangjiajie.com/line/zhangjiajieliuriyou_287.html',
'http://www.zhangjiajie.com/line/hunanqiriyou_225.html',
'http://www.zhangjiajie.com/line/zhangjiajieqiriyou_236.html'
); // 设置要抓取的页面URL 

$mh = curl_multi_init(); 
foreach ($urls as $i => $url) { 
	$save_to= 'data/'.md5($url).'.txt'; // 把抓取的代码写入该文件 
	$fp[$i] = fopen($save_to,"w"); 

	$conn[$i] = curl_init($url); 
	curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7"); 
	curl_setopt($conn[$i], CURLOPT_HEADER ,0); 
	curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT,60); 
	curl_setopt($conn[$i], CURLOPT_FILE,$fp[$i]); // 将爬取的代码写入文件 
	//curl_setopt($conn[$i],CURLOPT_RETURNTRANSFER,true); // 不将爬取代码写到浏览器，而是转化为字符串
	curl_multi_add_handle ($mh,$conn[$i]); 

} // 初始化 
do { 
	curl_multi_exec($mh,$active); 
} while ($active); // 执行 

/*
foreach ($urls as $i => $url) {
	$data = curl_multi_getcontent($conn[$i]); // 获得爬取的代码字符串
	$save_to=$i.'.txt'; // 把抓取的代码写入该文件 
	$st = fopen($save_to,"w"); 
	fwrite($st,$data); // 将字符串写入文件
	fclose($st);
} // 获得数据变量，并写入文件
*/

foreach ($urls as $i => $url) { 
	curl_multi_remove_handle($mh,$conn[$i]); 
	curl_close($conn[$i]); 
	fclose($fp[$i]);
} // 结束清理 
curl_multi_close($mh); 

?>
</body>
</html>

