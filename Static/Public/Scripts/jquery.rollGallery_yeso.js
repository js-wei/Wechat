/*******************************

* rollGallery
* Copyright (c) yeso!
* Date: 2010-10-13

˵����
* ����԰�����Ԫ�ص�ֱ�Ӹ�Ԫ��Ӧ�ø÷���
* example: $("#picturewrap").rollGallery({ direction:"top",speed:2000,showNum:4,aniMethod:"easeOutCirc"});
* direction:�ƶ����򡣿�ȡֵΪ��"left" "top"
* speed:�ٶȡ���λ����
* noStep:����Ϊ��true  �򰴷ǲ�����ʽ�������ǲ����¶���Ч��ʧЧ��
* speedPx:�ǲ��������µ��ƶ��ٶȡ���λ����
* showNum:��ʾ����������Ԫ�������ɵ���Ԫ�ظ���
* rollNum:һ�ι����ĸ�����ע���ܸ�������ΪrollNum�ı�����
* aniSpeed:�����ٶ�
* aniMethod:�����������������磺easing��֧�֣�
* childrenSel:��Ԫ��ɸѡ��
*******************************/

//http://www.jsfoot.com/jquery/demo/2012-12-10/847.html


//<!--��ʾ���ݿ�ʼ-->
//<style type="text/css">
//*{margin:0;padding:0;list-style-type:none;}
//a,img{border:0;}
//body{font:12px/180% Arial, Helvetica, sans-serif,"����";}
//a{color:#333;text-decoration:none;}
//a:hover{color:#3366cc;text-decoration:underline;}
///* demo */
//.demo{width:686px;margin:40px auto;position:relative;}
//.demo h2{font-size:16px;height:44px;color:#3366cc;margin-top:20px;}
//.demo dl dt{font-size:14px;color:#ff6600;margin-top:40px;}
//.demo dl dt,.demo dl dd{line-height:22px;}
///* scrollbox */
//.scrollbox{position:relative;width:670px;height:146px;overflow:hidden;}
//.scrollbox ul{position:absolute;left:0px;top:0px;}
//.scrollbox li{float:left;width:670px;height:63px;overflow:hidden;padding:5px 0px;}
//.scrollbox li a{float:left;display:inline-block;width:156px;height:63px;overflow:hidden;margin-left:10px;}
//.scrollbox li a img{display:block;width:156px;height:63px;background:#eee;}
///* leftlist */
//#leftlist{width:999em;}
///* fontlist */
//#fontlist li{height:22px;line-height:22px;}
//#fontlist li a{width:auto;}
//</style>

//<script type="text/javascript" src="js/jquery.rollGallery_yeso.js"></script>
//<script type="text/javascript"> 
//$(document).ready(function($){
//	
//	$("#toplist").rollGallery({
//		direction:"top",
//		speed:2000,
//		showNum:2
//	});
//	
//	$("#leftlist").rollGallery({
//		direction:"left",
//		speed:2000,
//		showNum:1
//	});
//	
//	$("#fontlist").rollGallery({
//		direction:"top",
//		speed:2000,
//		showNum:2
//	});
//	
//});
//</script>



(function ($) {

    $.fn.rollGallery = function (options) {

        var opts = $.extend({}, $.fn.rollGallery.defaults, options);

        return this.each(function () {
            var _this = $(this);
            var step = 0;
            var maxMove = 0;
            var animateArgu = new Object();
            _this.intervalRGallery = null;

            if (opts.noStep && (!options.speed)) opts.speed = 30;

            if (opts.direction == "left") {
                step = _this.children(opts.childrenSel).outerWidth(true);
            } else {
                step = _this.children(opts.childrenSel).outerHeight(true);
            }

            maxMove = -(step * _this.children(opts.childrenSel).length);
            _this[0].maxMove = maxMove;
            if (opts.rollNum) step *= opts.rollNum;
            animateArgu[opts.direction] = "-=" + step;

            _this.children(opts.childrenSel).slice(0, opts.showNum).clone(true).appendTo(_this);
            _this.mouseover(function () { clearInterval(_this.intervalRGallery); });
            _this.mouseout(function () {
                _this.intervalRGallery = setInterval(function () {
                    if (parseInt(_this.css(opts.direction)) <= maxMove) {
                        _this.css(opts.direction, "0px");
                    }
                    if (opts.noStep) {
                        _this.css(opts.direction, (parseInt(_this.css(opts.direction)) - opts.speedPx + "px"));
                    }
                    else {
                        _this.animate(animateArgu, opts.aniSpeed, opts.aniMethod);
                    }
                }, opts.speed);
            });

            _this.mouseout();
        });

    };

    $.fn.rollGallery.defaults = {
        direction: "left",
        speed: 3000,
        noStep: false,
        speedPx: 1,
        showNum: 1,
        aniSpeed: "slow",
        aniMethod: "swing",
        childrenSel: "*"
    };

})(jQuery);


//        <dd>* direction���ƶ����򡣿�ȡֵΪ��"left" "top"</dd>
//		<dd>* speed���ٶȡ���λ����</dd>
//		<dd>* noStep������Ϊ��true  �򰴷ǲ�����ʽ�������ǲ����¶���Ч��ʧЧ��</dd>
//		<dd>* speedPx���ǲ��������µ��ƶ��ٶȡ���λ����</dd>
//		<dd>* showNum����ʾ����������Ԫ�������ɵ���Ԫ�ظ���</dd>
//		<dd>* rollNum��һ�ι����ĸ�����ע���ܸ�������ΪrollNum�ı�����</dd>
//		<dd>* aniSpeed�������ٶ�</dd>
//		<dd>* aniMethod�������������������磺easing��֧�֣�</dd>
//		<dd>* childrenSel����Ԫ��ɸѡ��</dd>
