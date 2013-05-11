/*
 * lafaso.class.js is lafaso public js
 * 2012.7.20
 * wangpengbin@lafaso.com
 * */

$.fn.extend({
	/*
	 * 分享到
	 * $('#share a').share(title,url,pic,content)
	 * a的className来分辨对应分享到的网站
	 * 参数均可为空
	 * */
	share:function(t,u,p,c){
		var _t = t || $('title').text();
		if (_t.length > 50){
			_t = _t.substring(0,50) + '...';
		}
		var
		t1 = encodeURI('我在@乐蜂网 看到一个很棒的商品，'),t2 = encodeURI('我在乐蜂网看到一个很棒的商品，'),t3 = encodeURI(' ，大家来试试哦！'),t4 = encodeURI('心水推荐 - '),
		U = encodeURIComponent(u || window.location.href),
		P = encodeURIComponent(p || 'http://images.lafaso.com/indexfiles/logo.jpg'),
		T = encodeURI(_t),
		C = encodeURI(c || t || $('title').text()),
		list = {
			sina:'http://v.t.sina.com.cn/share/share.php?url='+U+'&pic='+P+'&searchPic=false&title='+t1+T+t3,
			qqt:'http://v.t.qq.com/share/share.php?url='+U+'&source='+encodeURI('乐蜂网')+'&site=www.lafaso.com'+'&pic='+P+'&searchPic=false&title='+t1+T+t3,
			sohu:'http://t.sohu.com/third/post.jsp?&url='+U+'&content=utf-8&pic='+P+'&searchPic=false&title='+t1+T+t3,
			renren:'http://widget.renren.com/dialog/share?resourceUrl='+U+'&pic='+P+'&description='+C+'&charset=utf-8&searchPic=false&title='+t2+T+t3,
			qqz:'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+U+'&title='+t4+T+'&style=11&site='+encodeURI('乐蜂网')+'&pics='+P+'&summary='+t2+T+t3,
			kaixin:'http://www.kaixin001.com/rest/records.php?style=11&url='+U+'&pic='+P+'&content='+t2+T+t3,
			douban:'http://shuo.douban.com/!service/share?image='+P+'&href='+U+'&name='+t2+T+t3,
			t163:'http://t.163.com/article/user/checkLogin.do?link='+U+'&source='+encodeURI('乐蜂网')+'&images='+P+'&info='+t1+T+t3+U
		};
		$(this).click(function(){window.open(list[$(this).attr('class')]);return false});
	},
	/*
	 * 倒计时
	 * $(dom).countDown([stime,Now,endtime],[c,s,e],fn)
	 * 第一数组参数 开始时间，当前时间，结束时间。1,2 可为空
	 * 时间参数格式 时间撮，2012/12/21，2012/12/21 15:14:35
	 * 第二数组参数：
	 * @c 运行时HTML D/H/M/S : 天/时/分/秒 例子“<b>D</b>天<b>H</b>时<b>M</b>分<b>S</b>秒”
	 * @s 未开始时提示语
	 * @e 结束时提示语
	 * @fn 结束时回调函数
	 * */
	countDown:function(t,c,fn){
		function nd(d){return isNaN(d) ? (d ? new Date(d).getTime() : new Date().getTime()) : d * 1000;}
		var e = [nd(t[0]),nd(t[1]),nd(t[2])],_s = this,b;
		if(t[0] && e[0] > e[1]){
			$(_s).html(c[1]);return;
		}else if(e[1] > e[2]){
			fn && fn($(_s));
			$(_s).html(c[2]);return;
		}
		(b = function (s){
			if (s <= 0){fn && fn($(_s));$(_s).html(c[2]);return};
			var s = s || (e[2] - e[1]) / 1000,
			ms = {D:s/3600/24,H:s/3600%24,M:s/60%60,S:s%60};
			$(_s).html(c[0].replace(/D|H|M|S/g,function(a){return parseInt(ms[a])}));
			setTimeout(function(){b(s-1)},1000);
		})()
	}
});


$.extend({
	/*
	 * 选项卡
	 * $.tabCont(btn,cont,cls,evt,fn)
	 * @btn jq要抓取的按钮dom
	 * @cont jq要抓取的内容dom
	 * @cls 按钮选中的class
	 * @evt 事件
	 * @fn 切换后执行的function扩展，可为空
	 * */
tabCont:function(btn,cont,cls,evt,fn){
	$(btn).each(function(i){
		$(this).bind(evt,function(){
			$(this).addClass(cls).siblings().removeClass(cls);
			$(cont).eq(i).show().siblings(cont).hide();
			fn && fn(i,this);
			return false;
		});
	});
},
	/*
	 * 加入收藏
	 * $.addFavorite(o,title,url)
	 * $o  jq对象，抓取的按钮节点，可为多个
	 * @title 标题 可为空
	 * @url 地址 可为空
	 * */
addFavorite:function(o,title,url){
	var title = title || $('title').text(),url = url || location.href;
	o.click(function(){
	    if (window.sidebar) {
		    window.sidebar.addPanel(title, url, "");
	    } else if (document.all) {
		    window.external.AddFavorite(url, title);
	    } else{
		    alert("\u8BF7\u4F7F\u7528Ctrl+D\u52A0\u5165\u6536\u85CF");
	    }
		return false;
	});
},
	/*
	 * 图片懒加载-优化IE6
	 * $.imgLoad(o)
	 * @o jq要抓取的图片节点 可为空
	 * */
imgLoad:function(o){// imgload
	var _s = o || 'img',n = n || 0,h = function(){var d=document,y=(navigator.userAgent.toLowerCase().match(/iPad/i)=="ipad")?window.pageYOffset:Math.max(d.documentElement.scrollTop,d.body.scrollTop);return d.documentElement.clientHeight+y-n;},tim,_time = 0,
	l = function(){
		var hg = h();
		$(_s).each(function(){
			var _s2 = $(this).attr('src2'),t = $(this).offset().top;
			if(_s2 && t < hg && t > hg - 1000){$(this).attr("src",_s2).removeAttr('src2')};
		})};
	l();
	if(!!window.ActiveXObject && !window.XMLHttpRequest){_time = 600}
	$(window).scroll(function(){
		clearTimeout(tim);
		tim = setTimeout(function(){l()},_time);
	});
},	
	/*
	 * 目标跟随浏览器浮动
	 * $.scrollFloat(o)
	 * $o jq对象，抓取的目标节点
	 * */
scrollFloat:function(o){
	if (o.length == 0){return}
	var s = false,
	_orderTop = o.offset().top;
	$(window).scroll(function(){
		var nu = $(this).scrollTop();
		if(nu > _orderTop){o.css({'top':nu-_orderTop});s = true;}
		if(s && nu <= _orderTop){o.css({'top':0});s = false;}
	});
}

});
