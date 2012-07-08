<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
?>
<!--  
<div class="con_left">
    	<div class="art_location">
        	<span class="baby"><a href="http://baby.39.net" title="育儿">育儿</a></span>
            <p><a class="ClassNav" href="http://www.39.net">首页</a> &gt; <a class="ClassNav" href="http://baby.39.net/">育儿</a>  &gt; <a class="ClassNav" href="http://baby.39.net/yq/">孕前</a>  &gt; <a class="ClassNav" href="http://baby.39.net/yq/yqzb/">孕前准备</a> &gt;<b>正文</b></p>
        </div>
        <div class="art_box">
        	<h1>备孕计划：用一年的时间准备怀孕</h1>
            <div class="art_info">
            	<div class="rank"><a href="http://baby.39.net/yezh/079/17/127220.html">&lt;&lt;&nbsp;育儿文章排行榜</a></div>
                <div class="date">2012-5-10&nbsp;&nbsp;&nbsp;&nbsp;MSN健康&nbsp;&nbsp;&nbsp;&nbsp;</div>
             </div>


			 <p class="summary">核心提示：如今，80后已经进入了生育高峰期，开始筹划“造人大计”。 如何孕育健康聪明的宝宝呢？我们专门请来专家，为准备生育的您制定了一个倒计时一年的备孕计划，让您以最佳的状态迎接新生命。</p>
            <div class="art_con" id="contentText">
            	<p><strong>　　一年倒计时</strong></p>
<p><strong>　　准父母都要做孕前检查</strong></p>
<p>　　我国取消强制性婚前检查已有近7年，各地婚检率明显下降，而新生儿出生缺陷发生比例却逐年增高。专家提醒，如果准备怀孕而且没有做过婚检，千万 不能再忽略孕前检查。最好在准备怀孕的半年前就先做孕前检查，确定身体是否处于健康状态。女性的基本孕前检查包括生殖系统及阴道炎症检查，检查时间最好是 月经刚刚干净的时候。</p>
<p>　　专家强调，准爸爸千万不能认为孕前检查与己无关，而要和准妈妈共同去做孕前检查。检查时间应为停止性生活7天后，检查内容包括有无<a class="blue" href="http://jbk.39.net/keshi/nanke/6ee2e.html" target="_blank">包茎</a>、<a class="blue" href="http://jbk.39.net/keshi/nanke/48f85.html" target="_blank">精索静脉曲张</a>、<a class="blue" href="http://jbk.39.net/keshi/nanke/48f82.html" target="_blank">前列腺炎</a>等，并进行相应的精液常规检查。</p>
<p><strong>　　口腔检查别偷懒</strong></p>
<p>　　资料显示，80%的女性怀孕时易出现牙疼、牙龈出血等问题。然而怀孕后头三个月和后三个月不能拔牙，怀孕初期拔牙易诱发<a class="blue" href="http://jbk.39.net/keshi/fuchan/chanke/48d97.html" target="_blank">流产</a>，怀孕晚期拔牙易发生<a class="blue" href="http://jbk.39.net/keshi/fuchan/chanke/4e33f.html" target="_blank">早产</a>。</p>
<p>　　所以，孕前要将所有“问题”牙齿都处理好，以免致病菌进入血液循环，通过血液进入胎盘影响胎儿的生长发育，甚至发生早产。而且，如果孕妇有蛀牙，宝宝出生后患蛀牙的可能性也大大增加。因此，如果女性患有牙病，最好在怀孕前及时治愈。</p>
<p><strong>　　孕前最好接种两种疫苗</strong></p>
<p>　　我国目前还没有专为女性设计的怀孕免疫计划。专家建议女性最好在怀孕前接种<a class="blue" href="http://jbk.39.net/keshi/crk/4e2de.html" target="_blank">乙肝</a>疫苗和<a class="blue" href="http://jbk.39.net/keshi/crk/4dc7e.html" target="_blank">风疹</a>疫苗。乙肝疫苗至少应该在孕前9到10个月注射，才能 保证怀孕的时候体内乙肝疫苗病毒完全消失并产生抗体。另外，有些人在3针注射完还需要进行加强注射，所以最好将接种乙肝疫苗的时间提前到孕前11个月。</p>
<p>　　孕期感染风疹病毒可能导致胎儿畸形。为保险起见，最好提前8个月注射风疹疫苗，并在接种2个月后确认体内是否有抗体产生。至少应该在孕前3个月注射风疹疫苗，这样才能保证怀孕的时候体内风疹疫苗病毒完全消失，不会影响胎儿。</p>
<p><strong>　　半年倒计时</strong></p>
<p><strong>　　基础体温记录掌握排卵期</strong></p>
<p>　　排卵期间最易受孕。如果月经规律，排卵期是在下次月经来潮前的第14天左右。如果月经不正常，可测量基础体温来确定排卵期，即每天清晨醒来时， 不要起床，也不要移动身体，先用体温表测量体温，排卵正常的女性基础体温一般在经期后稍低，排卵日可能更低，排卵后的体温要比排卵前高 0.3到 0.5℃。</p>
<p>　　除了测量基础体温外，观察宫颈黏液变化、通过排卵试纸测试等，也可测出排卵期。</p>
<div class="hzh_botleft">
广告
</div>
<p><strong>　　3个月倒计时</strong></p>
<p><strong>　　补充叶酸不可少</strong></p>
<p>　　怀孕前3个月开始女性应该每天补充0.4毫克叶酸，减少新生儿神经管畸形风险。从怀孕之前3个月还要注意加强营养，多吃一些高蛋白和维生素丰富的食物，多补充矿物质、维生素、微量元素等，以保证生殖细胞的发育。饮食要多样化，不偏食，避免食用被污染的食物。
            </p></div>
            <div class="art_page">
				 <b>1</b>  <a target="_self" href="2021363_1.html">2</a> <span>上一页</span><span><a href="2021363_1.html" target="_self">下一页</a></span>
            </div>


     </div>
</div>
-->
<div class="wrap">
	<div class="con_left">
	        <div class="art_box">
	        	<h1><?php print $title; ?></h1>
				 <p class="summary">核心提示：如今，80后已经进入了生育高峰期，开始筹划“造人大计”。 如何孕育健康聪明的宝宝呢？我们专门请来专家，为准备生育的您制定了一个倒计时一年的备孕计划，让您以最佳的状态迎接新生命。</p>
	            <div class="art_con" id="contentText">
	            <?php print render($page['content']); ?>
	            </div>
	     </div>
	</div>
	<div class="con_right">
	</div>
</div>