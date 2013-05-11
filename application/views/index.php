<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一号厅首页</title>
<link href="<?php echo base_url();?>css/style-movie.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>js/iepngfix_tilebg.js"></script>

<style type="text/css">

 /*
  USAGE:
  Copy and paste this one line into your site's CSS stylesheet.
  Add comma-separated CSS selectors / element names that have transparent PNGs.
  Remember that the path is RELATIVE TO THIS HTML FILE, not the CSS file.
  See below for another method of activating the script without adding CSS here.
 */

 img, div, input { behavior: url("iepngfix.htc") }


 /*
  Here's an example you might use in practice:
  img, div.menu, .pngfix, input { behavior: url("/css/iepngfix.htc") }
 */

 </style>

 <!--
  Consider wrapping the <style> element above in IE conditional comments.
  This will prevent the .HTC being downloaded by IE7+ at all.
  This might not work in IE6 installed alongside IE7 on the same computer.
  -->

 <!--[if lte IE 6]><style>/* ... your rules ... */</style><![endif]-->


 <script type="text/javascript">
 //<![CDATA[

 // If you don't want to put nonstandard properties in your stylesheet, here's yet
 // another means of activating the script. This assumes that you have at least one
 // stylesheet included already in the document above this script.
 // To activate, delete the CSS rules above and uncomment below (remove /* and */ ).

 /*
 if (document.all && /MSIE (5\.5|6)/.test(navigator.userAgent) &&
  document.styleSheets && document.styleSheets[0] && document.styleSheets[0].addRule)
 {
  document.styleSheets[0].addRule('*', 'behavior: url(iepngfix.htc)');
  // Feel free to add rules for specific elements only, as above.
  // You have to call this once for each selector, like so:
  //document.styleSheets[0].addRule('img', 'behavior: url(iepngfix.htc)');
  //document.styleSheets[0].addRule('div', 'behavior: url(iepngfix.htc)');
 }
 */


 // Here's another script that disables all PNGs in IE when the page is printed.
 /*
 if (window.attachEvent && /MSIE (5\.5|6)/.test(navigator.userAgent))
 {
  function printPNGFix(disable)
  {
   for (var  i = 0; i < document.all.length; i++)
   {
    var e = document.all[i];
    if (e.filters['DXImageTransform.Microsoft.AlphaImageLoader'] || e._png_print)
    {
     if (disable)
     {
      e._png_print = e.style.filter;
      e.style.filter = '';
     }
     else
     {
      e.style.filter = e._png_print;
      e._png_print = '';
     }
    }
   }
  };
  window.attachEvent('onbeforeprint',  function() { printPNGFix(1) });
  window.attachEvent('onafterprint',  function() { printPNGFix(0) });
 }
 */

 //]]>
 </script>
</head>

<body >
<div class="wrappernew1">
<div class="wrappernew2">
<!--顶部导航开始-->
<div class="topbar">
	<div class="topbar-left">目前已有60个城市  2123家影院在此比价</div>
    <div class="topbar-right">您好！欢迎来到一号厅！请 <a href="#">登录</a> 或 <a href="#">注册</a> <a href="#">收藏夹</a> </div>
</div>
<div class="clear"></div>
<!--顶部导航结束-->
<!--banner start-->
<div class="logo">
	<div class="logo-center"><input type="button" class="text-06 city_btn" value="城市" /><div class="city_div"><ul><li><a href="#">北京(125)</a></li><li><a href="#">上海(125)</a></li><li><a href="#">深圳(125)</a></li><li><a href="#">郑州(125)</a></li><li><a href="#">南京(125)</a></li></ul></div></div>
    <div class="logo-right">
    	<div id="search_box"> 
<form id="search_form" method="post" action="#"> 
<input type="text" id="s" value="输入您要搜索的影片或影院" class="swap_value" /> 
<input type="image" src="<?php echo base_url();?>images/btn_search_box2.gif" width="36" height="37" id="go" alt="Search" title="Search" /> 
</form> 
</div> 
    </div>
</div>
<!--banner end-->
  <div class="nav">
  <ul>
  	<li><a href="#">首页</a></li>
    <li><a href="showing.html">影片</a></li>
    <li><a href="cinema.html">影院</a></li>
  </ul>
  </div>
<!--banner start-->
<div class="banner">
<div class="banner_left left"><a href="buy-movie.html"><img src="<?php echo base_url();?>images/banner.jpg" border="0" /></a></div>
<div class="bj left">
<div class="select_box select_div"><input type="text" value="北京" readonly="readonly"><ul><li>海淀区</li><li>崇文区</li><li>西城区</li></ul></div>
<div class="select_box mtp40 select_div"><input type="text" value="花市百老汇电影院" readonly="readonly"><ul><li>胜利电影院</li><li>永成电影院</li><li>万达影城</li></ul></div>
<div class="bj_btn_div"><input type="button" onclick="location='movietheaters.html'" /></div>
<ul class="bj_video"><li>选过的影院</li>
  <li><a href="movietheaters.html">花式百老汇电影院</a></li>
  <li><a href="movietheaters.html">万达国际影城（CBD店）</a></li>
  <li><a href="movietheaters.html">星美影城（双井店）</a></li>
</ul>
</div>
</div>
<!--banner end-->
<div class="contentwhole">
	<div class="contentwhole-left">
    	<div class="contentwhole-left-01">
        	<font class="contentwhole-left-01-word">正在热映</font>	<font class="contentwhole-left-01-word2">&nbsp;| <a href="showing.html">更多</a></font>        </div>
        <div class="contentwhole-left-02">
        	<ul>
            <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/thumb.jpg' alt='' border="0" /> <i></i>
  <p> 辛格的奇幻冒险大作<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1233_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 特种部队2：全面反击<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1234_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 分手合约<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">分手合约</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1192_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 北京遇上西雅图<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/955_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 厨子戏子痞子<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1263_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 变身超人<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1191_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 毒战<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容    </span>  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1151_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 柠檬<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1262_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 甜蜜十八岁<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1255_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 刺夜<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1232_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 叶问：终极一战<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
                       <!--一组开始-->
            	<li><div class="wrap"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1015_210_300.jpg' alt='' width="210" height="300" border="0" /> <i></i>
  <p> 忠烈杨家将<br /><font style="font-size:12px;">已有<font style="color:#fe0000;">2231</font>人比价</font>
  	<span>
    	导演：斯皮尔伯格<br />
        主演：自定义内容<br />
        片长：自定义内容<br />
        上映日期：自定义内容
    </span>
  
  </p>
  </a> </div>
  <p style="line-height:32px; "><span style="float:left"><font class="text-01">虎胆龙威</font><font class="text-02"> - 动作</font></span> <font class=" text-03" style="float:right; ">8.0</font></p><div class="clear"></div>
  <p>
  <div><div style="float:left"><font class="text-04">25</font><font class="text-02">元起</font></div>
  <div style="float:right" ><a href="buy-movie.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></div>
  </div></p>
  </li>
           <!-- 一组结束-->
          
            </ul>
        </div>
        <div class="clear"></div>
        <!--即将上映开始-->
        <div class="contentwhole-left-01">
        	<font class="contentwhole-left-01-word">即将上映</font>	<font class="contentwhole-left-01-word2">&nbsp;| <a href="movie.html
">更多</a></font>
       </div>
         <div class="contentwhole-left-02">
         	<ul>
           <!--一组开始-->
            	<li><div class="wrap2"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1080_210_300.jpg' alt='' width="210" height="300" /> <i></i>
  </a> </div>
  <p style="line-height:32px; "><font class="text-01">虎胆龙威</font></p>
  <p> <font class="text-02">上映时间 2012年12月11日</font></p>
  </li>
           <!-- 一组结束-->
                      <!--一组开始-->
            	<li><div class="wrap2"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1191_210_300.jpg' alt='' width="210" height="300" /> <i></i>
  </a> </div>
  <p style="line-height:32px; "><font class="text-01">虎胆龙威</font></p>
  <p> <font class="text-02">上映时间 2012年12月11日</font></p>
  </li>
           <!-- 一组结束-->

           <!--一组开始-->
            	<li><div class="wrap2"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1228_210_300.jpg' alt='' width="210" height="300" /> <i></i>
  </a> </div>
  <p style="line-height:32px; "><font class="text-01">虎胆龙威</font></p>
  <p> <font class="text-02">上映时间 2012年12月11日</font></p>
  </li>
           <!-- 一组结束-->

           <!--一组开始-->
            	<li><div class="wrap2"> <a href="buy-movie.html"> <img src='<?php echo base_url();?>images/1245_210_300.jpg' alt='' width="210" height="300" /> <i></i>
  </a> </div>
  <p style="line-height:32px; "><font class="text-01">虎胆龙威</font></p>
  <p> <font class="text-02">上映时间 2012年12月11日</font></p>
  </li>
           <!-- 一组结束-->

            </ul>
         </div>
        <!--即将上映结束-->
        <div class="clear"></div>
        <!--热门影院开始-->
        	 <div class="contentwhole-left-01">
        	<font class="contentwhole-left-01-word">热门影院</font>	<font class="contentwhole-left-01-word2">&nbsp;| <a href="cinema.html
">更多</a></font>
      </div>
          <div class="contentwhole-left-02">
          		<table  id="movienew" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%">&nbsp;<font class="text-01-1">花市百老汇电影</font></td>
    <td width="18%">&nbsp;<font class="text-01-2">￥ 30起</font></td>
    <td width="7%">&nbsp;<img src="<?php echo base_url();?>images/pic1.png" width="26" height="26" /></td>
    <td width="7%"><img src="<?php echo base_url();?>images/pic2.png" width="26" height="26" /></td>
    <td width="15%">&nbsp;</td>
    <td width="23%"><a href="movietheaters.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;<font class="text-01-1">花市百老汇电影</font></td>
    <td>&nbsp;<font class="text-01-2">￥ 30起</font></td>
    <td>&nbsp;</td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic2.png" width="26" height="26" /></td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic3.png" width="26" height="26" /></td>
    <td><a href="movietheaters.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;<font class="text-01-1">花市百老汇电影</font></td>
    <td>&nbsp;<font class="text-01-2">￥ 30起</font></td>
    <td>&nbsp;</td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic2.png" width="26" height="26" /></td>
    <td>&nbsp;</td>
    <td><a href="movietheaters.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;<font class="text-01-1">花市百老汇电影</font></td>
    <td>&nbsp;<font class="text-01-2">￥ 30起</font></td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic1.png" width="26" height="26" /></td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic2.png" width="26" height="26" /></td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic3.png" width="26" height="26" /></td>
    <td><a href="movietheaters.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;<font class="text-01-1">花市百老汇电影</font></td>
    <td>&nbsp;<font class="text-01-2">￥ 30起</font></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;<img src="<?php echo base_url();?>images/pic3.png" width="26" height="26" /></td>
    <td><a href="movietheaters.html"><img src="<?php echo base_url();?>images/button.jpg" width="75" height="27" /></a></td>
  </tr>
</table>

          </div>
        <!--热门影院结束-->
        
    </div>
<div class="contentwhole-right">
    	<div class="contentwhole-right-hot"><a href="#"><img src="<?php echo base_url();?>images/hot.jpg" width="231" height="122" /></a></div>
        <div class="contentwhole-right-02">
        	<!--滚动开始-->
    <script type="text/javascript" src="<?php echo base_url();?>js/55E.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/55D.js"></script>
<div class="hotlist">
<dl class="on">
<dt><b>01</b><a target="_blank" href="buy-movie.html">辛格的奇幻冒险</a> </dt><dd><b>01</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg"/></a><em><span>￥</span>39.9  <font style="color:#f84a24; margin-left:10px;">8.6</font></em><a class="productname" target="_blank" href="#">天使之爱&蓝色妖姬至尊香水组合套装30ml*2</a></dd></dl>

<dl><dt><b>02</b><a target="_blank" href="buy-movie.html">特种部队2：全面反击</a> </dt><dd><b>02</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>03</b><a target="_blank" href="buy-movie.html">分手合约</a> </dt><dd><b>03</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>04</b><a target="_blank" href="buy-movie.html">北京遇上西雅图</a> </dt><dd><b>04</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>05</b><a target="_blank" href="buy-movie.html">厨子戏子痞子</a> </dt><dd><b>05</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>06</b><a target="_blank" href="buy-movie.html">变身超人</a> </dt><dd><b>06</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>07</b><a target="_blank" href="buy-movie.html">毒战</a> </dt><dd><b>07</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>


<dl><dt><b>08</b><a target="_blank" href="buy-movie.html">柠檬</a> </dt><dd><b>08</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>09</b><a target="_blank" href="buy-movie.html">甜蜜十八岁</a> </dt><dd><b>09</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>

<dl><dt><b>10</b><a target="_blank" href="buy-movie.html">刺夜</a> </dt><dd><b>10</b><a target="_blank" href="buy-movie.html"><img alt="" src="<?php echo base_url();?>images/hot2.jpg" /></a><em><span>￥</span>58.0<font style="color:#f84a24;margin-left:10px;">8.6</font></em><a target="_blank" href="buy-movie.html">Jcare维生素C咀嚼片90片</a></dd></dl>
</div>

<script type="text/javascript">
	function topCcountDown(t,c,_self,fn){
		function nd(d){return isNaN(d) ? (d ? new Date(d).getTime() : new Date().getTime()) : d * 1000;}
		var e = [nd(t[0]),nd(t[1]),nd(t[2])],_s = _self,b;
		if(t[0] && e[0] > e[1]){
			$(_s).html(c[1]);return;
		}else if(e[1] > e[2]){
			fn && fn($(_s));
			$(_s).html(c[2]);return;
		}
		(b=function(l){
			var l=l||(e[2]-e[1])/100,k={
				D:l/36000/24,H:l/36000%24,M:l/600%60,S:l/10%60,s:l%10
			};
			$(_s).html(c[0].replace(/D|H|M|S|s/g,function(m){
				var n = parseInt(k[m]) + ''
				if (n.length == 1 && m != 'D' && m != 's'){
					n = 0 + n;
				}
				return n
			}));
			setTimeout(function(){b(l-1)},100);
		})()
	}

	$(window).load(function(){

		//$('body').prepend('<div id="top_countdown" class="top_countdown"><div><a href="http://cuxiao.lefeng.com/zhuanti_qwdbjzsb.html?biid=7520" target="_blank"></a><span><b>00</b><b>00</b><b>00</b><b>00</b></span></div></div>');

		//topCcountDown([,,'2013/03/02'],['<b>H</b><b>M</b><b>S</b><b>s</b>','',''],'#top_countdown span',function(){$('#top_countdown').remove()});


		var _picArray = [{'url':'http://pinpai.lefeng.com/nike.html?biid=33809'},{'url':'http://product.lefeng.com/brand/brandDetail.jsp?brandId=2515'},{'url':'http://product.lefeng.com/brand/brandDetail.jsp?brandId=3652223'},{'url':'http://www.lefeng.com/paula.html'},{'url':'http://www.lefeng.com/mianmo/sqshop1.html'},{'url':'http://product.lefeng.com/brand/brandDetail.jsp?brandId=1663'},{'url':'http://product.lefeng.com/brand/1124552.html'},{'url':'http://pinpai.lefeng.com/huanxing.html'}];


		var _picT = new Date();
		var _picI = Math.ceil(_picT.getTime() / (1000*60*10)) % 8;
		//var _picI = 0;
		var _dom = $("#superstar a");

		function showCarousel(){
			$('#superstar').html('<a href="'+_picArray[_picI].url+'" style="display:block;width:430px;height:104px;" target="_blank"></a>');
			$('.Chead').css('background','#fff url(http://img10.imglafaso.com/<?php echo base_url();?>images/sale/sale_wmdz'+ _picI +'.jpg) no-repeat center bottom');
		}

		//setInterval(showCarousel,1000*60);
		showCarousel();


	});




</script>



<script type="text/javascript">

	

//轮播1t3效果
	$('.sliderbox .sh').hover(function(){
		$(this).stop().fadeTo(300,0).siblings('.sh').stop().fadeTo(300,0.3);
	},function(){
		$('.sliderbox .sh').stop().fadeTo(300,0);
	});


	//热门排行商品经过显示
	$('.hotlist dl dt').mouseenter(function(){
		$(this).hide().next().show().parent().siblings().find('dt').show().next().hide();
	});

	//热门排行第一个商品显示
	$('.hotlist').each(function(){
		$(this).find('dl:first').addClass('on').find('b').css({'background-position':'-144px -343px','color':'#979797'});
	});

	



</script>

           <!--滚动结束-->
          <div class="clear"></div>
           <div class="contentwhole-right-hot" style="margin-top:8px;"><span class="contentwhole-right-hot" style="margin-top:8px;"><a href="#"><img src="<?php echo base_url();?>images/hot.jpg" width="231" height="122" /></a></span></div>
            <p style="margin-top:20px; "><font class="text-01">热片提醒</font></p>
         <div class="contentwhole-right-03">
           		<p style="margin-left:16px;*margin-left:16px;_margin-left:8px;"><input type="text" class="text-007" value="请输入手机号" /></p>
               <p style="text-align:center; margin-top:15px;"><input type="button" class="text-077" value="免费订阅" /></p>
          </div>
        </div>
  </div>
  <div class="clear"></div>
  <!--页脚开始-->
  <p style="text-align:center;padding-top:30px;"><img src="<?php echo base_url();?>images/footerlogo.png" width="112" height="58" /></p>
<div class="friendlink">  
    <font style="color:#808080;">友情链接</font>
    <a href="http://www.beiwaionline.com">北外网院</a>
    <a href="http://www.beiwaibest.com">北外成功英语</a>
    <a href="http://qingshao.beiwaibest.com">剑桥证书</a>
    <a href="http://qingshao.beiwaibest.com">北外青少英语</a>
    <a href="http://liuxue.beiwaibest.com">北外留学预科 </a>
    <a href="http://www.bfsu.edu.cn">北京外国语大学</a> 
    <a href="http://www.bfsu.edu.cn">外研社</a> 
    <a href="http://www.bfsu.edu.cn">剑桥ESOL考试中心</a>
    <a href="http://www.bfsu.edu.cn">土豆视频空间</a>
    <a href="http://www.bfsu.edu.cn">教育团购网</a>
</div>
<div class="copyright">
<p>京ICP备05073170号 Copyright  <span class=fontArial>&copy;</span> 2001-2012 beiwaionline.com, All Rights Reserved</p>
<p>************************************************************　Email:eclass@beiwaionline.com</p>
  <p style="text-align:center;padding-top:10px; padding-bottom:30px;"><img src="<?php echo base_url();?>images/web.gif" width="112" height="41" /></p>
</div>
<!--页脚结束-->

</div>
</div>
</div>

<script>
$(".city_btn").toggle(function(){
	$(".city_div").slideToggle();
	},function(){
	$(".city_div").slideUp();	
	})
//xiala
$(document).ready(function(){
	$(".select_div input").click(function(){
		$(".select_div ul").hide();
		var thisinput=$(this);
		var thisul=$(this).parent().find("ul");
		if(thisul.css("display")=="none"){
			if(thisul.height()>200){thisul.css({height:"200"+"px","overflow-y":"scroll" })};
			thisul.fadeIn("100");
			thisul.hover(function(){},function(){thisul.fadeOut("100");})
			thisul.find("li").click(function(){thisinput.val($(this).text());thisul.fadeOut("100");}).hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
			}
		else{
			thisul.fadeOut("fast");
			}
	})
});
</script>
</body>
</html>
