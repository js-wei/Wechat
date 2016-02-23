<?php
	/**
	 * 打印函数
	 * @param array $array
	 */
	function p($array){
		dump($array,1,'<pre>',0);	
	}
	// cuplayer.com去除转义字符 
	function stripslashes_array(&$array) { 
	    while(list($key,$var) = each($array)) { 
	        if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || ''.intval($key) == "$key")) { 
	            if (is_string($var)) { 
	                $array[$key] = stripslashes($var); 
	            } 
	            if (is_array($var))  { 
	                $array[$key] = stripslashes_array($var); 
	            } 
	        } 
	    } 
	    return $array; 
	} 
	/**
        * [limitArray 取出指定范围数组]
        * @param  [type] $arr   [description]
        * @param  [type] $start [description]
        * @param  [type] $end   [description]
        * @return [type]        [description]
        */
        function limitArray($arr,$start,$end=0){
		if($end==0){
			$end = count($arr)-1;
		}
		
		for($i=$start; $i < $end; $i++) { 
			if ($i<count($arr)) {
				$_result[]=$arr[$i];
			}
		}
		return $_result;
	}
	/**
	 * [getMacAddr 生成MAC]
	 */
	function getMacAddr(){
	    $return_array = array();
	    $temp_array = array();
	    $mac_addr = "";
	    
	    @exec("arp -a",$return_array);
	    
	    foreach($return_array as $value)
	    {
	        if(strpos($value,$_SERVER["REMOTE_ADDR"]) !== false &&
	        preg_match("/(:?[0-9a-f]{2}[:-]){5}[0-9a-f]{2}/i",$value,$temp_array))
	        {
	            $mac_addr = $temp_array[0];
	            break;
	        }
	    }
	    
	    return ($mac_addr);
	}

	/**
	 * [build_order_no 生成订单号]
	 * @return [type] [description]
	 */
	function build_order_no(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }


	function showimg($id,$db){
		$db=!empty($db)?$db:'goods';
        $connect=!empty($connect)?$connect:C('DB_CONFIG2');
        $model= M($db,"market_",$connect);
		$good=$model->where(array('g_id'=>$id))->find();
		echo $good['g_icon'];
		//$this->ajaxReturn(array('status'=>1,'result'=>array('id'=>$good['g_id'],'ico'=>$good['g_icon'])));
		//p(C('TMPL_PARSE_STRING.__IMAGE__'));die;
		//$str = C('TMPL_PARSE_STRING.__IMAGE__').'/'.$good['g_icon'];
		// $str = "<img src=''>";
		//$this->ajaxReturn( "<img src=\""+$str+"\" width=\"50\"/>");
		
	}

	/**
	 * 创建二维码
	 * @param $data                         数据源
	 * @param string $path                  保存地址
	 * @param string $filename              保存名称
	 * @param string $logo                  logo地址
	 * @param bool $save_and_print          输出且保存
	 * @param int $size                     点的大小：1到10
	 * @param string $level                 容错等级:L水平7%的字码可被修正,M水平15%的字码可被修正,Q水平25%的字码可被修正,H水平30%的字码可被修正Size表示图片每个黑点的像素。
	 * @param int $padding                  补白大小
	 */
	function Qrcode($data,$logo='',$path='',$filename='',$save_and_print=false,$type=false,$output='json',$size=4,$level='L',$padding=1){

	    vendor('phpqrcode.phpqrcode');
	    
	    if(!is_dir($path)){
	        mkdir($path);
	    }
	    if(empty($logo) || $logo==false){
	        if(empty($filename) || $filename==false){
				$full_name='./Data/QRcode/temp.png';
	            ob_end_clean();
	            \QRcode::png($data,$full_name,$level,$size,$padding,$save_and_print);
				if($type){
                	imagepng($QrCode,$full_name);
                	$base64_image_content = "data:png;base64," . chunk_split(base64_encode(file_get_contents($full_name)));
                	echo $base64_image_content;
                	unlink($full_name);
                }else{
                	\QRcode::png($data,false,$level,$size,$padding,$save_and_print);
                }

	        }else{
	            $full_name=$path.$filename;
	            if($save_and_print){
	            	if($type){
	                	imagepng($QrCode,$full_name);
	                	$base64_image_content = "data:png;base64," . chunk_split(base64_encode(file_get_contents($full_name)));
	                	exit($base64_image_content);
	                }else{
	                	\QRcode::png($data,$full_name,$level,$size,$padding,$save_and_print);
	                }
	                
	            }else{
	            	if($type){
	                	imagepng($QrCode,$full_name);
	                	$base64_image_content = "data:png;base64," . chunk_split(base64_encode(file_get_contents($full_name)));
	                	echo $base64_image_content;
	                	unlink($full_name);
	                }else{
	                	\QRcode::png($data,false,$level,$size,$padding,$save_and_print);
	                	unlink($full_name);
	                }

	               
	            }

	        }
	    }else{
	        if($save_and_print){
	            if((empty($filename) || $filename==false)){
	                switch($output){
	                    case 'json':
	                        header("Content-type:text/html;charset=utf-8");
	                        exit(json_encode(array( 'status'=>0, 'msg'=>'param invalid,please enter parameters:path or filename.')));
	                        break;
	                    case 'xml':
	                        header("Content-type:text/xml;charset=utf-8");
	                        exit("<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<Message>\n\t<status>0</status>\n\t<msg>param invalid,please enter parameters:path or filename.</msg>\n</Message>");
	                        break;
	                    case 'string':
	                    default:
	                        header("Content-type:text/html;charset=utf-8");
	                        exit('param invalid,please enter parameters:path or filename.');
	                }
	            }else{

	                if(strpos($filename,".")===false){
	                    $filename = $filename.'.png';
	                }

	                $full_name=$path.$filename;
	                ob_end_clean();
	                \QRcode::png($data,$full_name,$level,$size,$padding,$save_and_print);

	                $QrCode = imagecreatefromstring(file_get_contents($full_name));
	                $logo = imagecreatefromstring(file_get_contents($logo));

	                $QrCode_width=imagesx($QrCode);
	                $logo_width=imagesx($logo);
	                $logo_height=imagesy($logo);
	                $logo_QrCode_width=$QrCode_width/7;
	                $scale = $logo_width/$logo_QrCode_width;
	                $logo_QrCode_height=$logo_height/$scale;
	                $form_width=($QrCode_width-$logo_QrCode_width)/2;

	                imagecopyresampled($QrCode,$logo,$form_width,$form_width,0,0,$logo_QrCode_width,$logo_QrCode_height,$logo_width,$logo_height);

	                if(!empty($path)){
	                    if($save_and_print){
	                        if($type){
	                        	imagepng($QrCode,$full_name);
	                        	$base64_image_content = "data:png;base64," . chunk_split(base64_encode(file_get_contents($full_name)));
			                	exit($base64_image_content);
			                }else{
			                	imagepng($QrCode,$full_name);
				                header('Content-type:image/png');
				                imagepng($QrCode);
			                }
	                    }else{
	                        imagepng($QrCode,$full_name);
	                    }
	                }
	            }
	        }else{
	            $full_name='./Data/QRcode/temp.png';
	            ob_end_clean();
	            \QRcode::png($data,$full_name,$level,$size,$padding,$save_and_print);
	            $QrCode = imagecreatefromstring(file_get_contents($full_name));
	            $logo = imagecreatefromstring(file_get_contents($logo));

	            $QrCode_width=imagesx($QrCode);
	            $logo_width=imagesx($logo);
	            $logo_height=imagesy($logo);
	            $logo_QrCode_width=$QrCode_width/8;
	            $scale = $logo_width/$logo_QrCode_width;
	            $logo_QrCode_height=$logo_height/$scale;
	            $form_width=($QrCode_width-$logo_QrCode_width)/2;

	            imagecopyresampled($QrCode,$logo,$form_width,$form_width,0,0,$logo_QrCode_width,$logo_QrCode_height,$logo_width,$logo_height);

	           
	            if($save_and_print){
	                if($type){
	                	imagepng($QrCode,$full_name);
	                	//base64
						$base64_image_content = "data:png;base64," . chunk_split(base64_encode(file_get_contents($full_name)));
	                	echo $base64_image_content;
	                }else{
	                	imagepng($QrCode,$full_name);
		                header('Content-type:image/png');
		                imagepng($QrCode);
	                }
	            }else{
	                if($type){
						$base64_image_content = "data:png;base64," . chunk_split(base64_encode(file_get_contents($full_name)));
						echo $base64_image_content;
						unlink($full_name);
	                }else{
	                	header('Content-type:image/png');
	                	imagepng($QrCode);
	                	unlink($full_name);
	                }
	            }
	        }
	    }
	}
    /**
     * 列出目录下的所有文件
     * @param str $path 目录
     * @param str $exts 后缀
     * @param array $list 路径数组
     * @return array 返回路径数组
     */
    function dir_list($path, $exts = '', $list = array()) {
        $path = dir_path($path);
        $files = glob($path . '*');
        foreach($files as $v) {
            if (!$exts || preg_match("/\.($exts)/i", $v)) {
                $list[] = $v;
                if (is_dir($v)) {
                    $list = dir_list($v, $exts, $list);
                }
            }
        }
        return $list;
    }

    /**
     * 组织地址目录
     * @param $path
     * @return mixed|string
     */
    function dir_path($path) {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') $path = $path . '/';
        return $path;
    }

/*
* 得到客户端ip
* @param $type
*/
	function get_browse_ip($type = 0) {
	    $type       =  $type ? 1 : 0;
	    static $ip  =   NULL;
	    if ($ip !== NULL) return $ip[$type];
	    if($_SERVER['HTTP_X_REAL_IP']){//nginx 代理模式下，获取客户端真实IP
	        $ip=$_SERVER['HTTP_X_REAL_IP'];     
	    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
	        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
	    }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
	        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
	        $pos    =   array_search('unknown',$arr);
	        if(false !== $pos) unset($arr[$pos]);
	        $ip     =   trim($arr[0]);
	    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
	        $ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
	    }else{
	        $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    // IP地址合法验证
	    $long = sprintf("%u",ip2long($ip));
	    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
	    return $ip[$type];
	}
	/**
	 * [download 下载文件]
	 * @param  string $url      [文件地址]
	 * @param  string $filename [显示名称]
	 * @return [type]           [description]
	 */
	function download($url='',$filename=''){
		import("ORG.Net.Http");
		$url = !empty($url) ? $url : './Data/dirty_words_formart_config.xml';
		Http::download($url,$filename);
	}
	/**
	 * [getVersionName 获取游戏版本]
	 * @param  integer $id [description]
	 * @return [type]      [description]
	 */
	function getVersionName($id=0){

		$version=M('download')->find($id);
		//return M('download')->getlastsql();
		return $version['title'];
	}

	//汉字转Unicode
	/*function unicode_encode($name){
	    $name = iconv('UTF-8', 'UCS-2', $name);

	    $len = strlen($name);

	    $str = '';
	    for ($i = 0; $i < $len - 1; $i = $i + 2)
	    {
	        $c = $name[$i];
	        $c2 = $name[$i + 1];
	        if (ord($c) > 0)
	        {    // 两个字节的文字
	            $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
	        }
	        else
	        {
	            $str .= $c2;
	        }

	    }
	   return $str;
	}
	//将UNICODE编码后的内容进行解码
	function unicode_decode($name){
	    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
	    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
	    preg_match_all($pattern, $name, $matches);
	    if (!empty($matches))
	    {
	        $name = '';
	        for ($j = 0; $j < count($matches[0]); $j++)
	        {
	            $str = $matches[0][$j];
	            if (strpos($str, '\\u') === 0)
	            {
	                $code = base_convert(substr($str, 2, 2), 16, 10);
	                $code2 = base_convert(substr($str, 4), 16, 10);
	                $c = chr($code).chr($code2);
	                $c = iconv('UCS-2', 'UTF-8', $c);
	                $name .= $c;
	            }
	            else
	            {
	                $name .= $str;
	            }
	        }
	    }
	    return $name;
	}*/

	function unicode_encode ($word){
		$word0 = iconv('gbk', 'utf-8', $word);
		$word1 = iconv('utf-8', 'gbk', $word0);
		$word = ($word1 == $word) ? $word0 : $word;
		$word = json_encode($word);
		$word = preg_replace_callback('/\\\\u(\w{4})/', create_function('$hex', 'return \'&#\'.hexdec($hex[1]).\';\';'), substr($word, 1, strlen($word)-2));
		return $word;
	}
	function unicode_decode ($uncode)
	{
		$word = json_decode(preg_replace_callback('/&#(\d{5});/', create_function('$dec', 'return \'\\u\'.dechex($dec[1]);'), '"'.$uncode.'"'));
		return $word;
	}
	/**
	 * 检测访问的ip是否为规定的允许的ip
	 * Enter description here ...
	 */
	function check_ip($id=''){
		if(!empty($id)){
			$ALLOWED_IP=explode(',', $id);
		}else{
			$ALLOWED_IP=array('192.168.2.*','127.0.0.1','192.168.2.49');
		}
		
		$IP=get_browse_ip();
		$check_ip_arr= explode('.',$IP);	//要检测的ip拆分成数组
		//p($IP);p($ALLOWED_IP);die;
		#限制IP
		if(!in_array($IP,$ALLOWED_IP)) {
			foreach ($ALLOWED_IP as $val){
			    if(strpos($val,'*')!==false){//发现有*号替代符
			    	 $arr=array();//
			    	 $arr=explode('.', $val);
			    	 $bl=true;//用于记录循环检测中是否有匹配成功的
			    	 for($i=0;$i<4;$i++){
			    	 	if($arr[$i]!='*'){//不等于*  就要进来检测，如果为*符号替代符就不检查
			    	 		if($arr[$i]!=$check_ip_arr[$i]){
			    	 			$bl=false;
			    	 			break;//终止检查本个ip 继续检查下一个ip
			    	 		}
			    	 	}
			    	 }//end for 
			    	 if($bl){//如果是true则找到有一个匹配成功的就返回
			    	 	return;
			    	 	die;
			    	 }
			    }
			}//end foreach
			header('HTTP/1.1 403 Forbidden');
			echo "Access forbidden";
			die;
		}
	}
	/**
	 * 转换彩虹字
	 * @param string $str
	 * @param int $size
	 * @param bool $bold
	 * @return string
	 */
	function color_txt($str,$size=20,$bold=false){
		$len = mb_strlen($str);
		$colorTxt   = '';
		if($bold){
			$bold="bolder";
			$bolder="font-weight:".$bold;
		}
		for($i=0; $i<$len; $i++) {
			$colorTxt .=  '<span style="font-size:'.$size.'px;'.$bolder.'; color:'.rand_color().'">'.mb_substr($str,$i,1,'utf-8').'</span>';
		}
		return $colorTxt;
	}
	
	function rand_color(){
		return '#'.sprintf("%02X",mt_rand(0,255)).sprintf("%02X",mt_rand(0,255)).sprintf("%02X",mt_rand(0,255));
	}
	/**
	 * 替换表情
	 * @param string $content
	 * @return string
	 */
	function replace_phiz($content){
		preg_match_all('/\[.*?\]/is', $content, $arr);
		/**
		 * 替换表情
		 */
		if($arr[0]){
			$phiz=F('phiz','','./data/');
			foreach ($arr[0] as $v){
				foreach ($phiz as $key =>$value){
					if($v=='['.$value.']'){
						$content=str_repeat($v, '<img src="'.__ROOT__.'/Public/Images/phiz/'.$key.'.gif"/>',$content);
						break;
					}
				}
			}
			return $content;
		}
	}
	/**
	 * 截取字符串
	 * @param string $str
	 * @param int $start
	 * @param int $length
	 * @param string $charset
	 * @param bool $suffix
	 * @return string|string
	 */
	function sub_str($str,$start=0,$length,$charset="utf-8",$suffix=true){
		$l=strlen($str);

		if(function_exists("mb_substr"))
			return 	!$suffix?mb_substr($str,$start,$length,$charset):mb_substr($str,$start,$length,$charset)."…";
		else if(function_exists('iconv_substr')){
			return  !$suffix?iconv_substr($str,$start,$length,$charset):iconv_substr($str,$start,$length,$charset)."…";
		}
		$re['utf-8']="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312']="/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']="/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']="/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset],$str,$match);
		$slice = join("",array_slice($match[0],$start,$length));

		if($suffix){
			if($l>$length){
				return $slice."…";
			}else{
				return $slice;
			}
		} 
	}

	//获取栏目类型
	function getPosition($type){

		switch ($type) {
			case 1:
				$t='头部';
				break;
			case 2:
				$t='中部';
				break;
			case 3:
				$t='左侧';
				break;
			case 4:
				$t='右侧';
				break;
			case 5:
				$t='底部';
				break;
		}
		return $t;
	}
	function fbanner($arr){
		$str='';
		foreach ($arr as  $v) {
			//./Public/Uploads/
			//$str .='box.add({"url":"'.__ROOT__.'/Public/Uploads/'.$v['path'].'","href":"'.$v['url'].'","title":"'.$v['info'].'"});';
			$str .='box.add({"url":"'.$v['path'].'","href":"'.$v['url'].'","title":"'.$v['info'].'"});';
		}
		return str_replace('./Public/Uploads/','/Public/Uploads/', $str);
	}
	/**
	 * [paichu 去掉指定的字符串]
	 * @param  [type] $mub [description]
	 * @param  [type] $zhi [description]
	 * @param  [type] $a   [description]
	 * @return [type]      [description]
	 */
	function paichu($mub,$zhi,$a='l'){
	    if(!$mub){
	        return "被替换的字符串不存在";
	    }

	    $mub = mb_convert_encoding($mub,'GB2312','UTF-8');
	    $zhi = mb_convert_encoding($zhi,'GB2312','UTF-8');
	     
	    if($a==""){
	    	$last = str_replace($mub,"",$zhi);
	    }elseif($a=="r"){
	        $last = substr($mub, strrpos($mub,$zhi));
	    }elseif($a=="l"){
	        //$last = preg_replace("/[\d\D\w\W\s\S]*[".$mub."]+/","",$zhi);
	        $last = substr($mub,0,strrpos($mub,$zhi));
	    }
	    //$last =  mb_convert_encoding($last,'UTF-8','GB2312'); 
	    return $last;

    }

	//获取img
	function get_images($str){
		/*preg_match_all('/\s+src\s?\=\s?[\'|"]([^\'|"]*)/is', $str, $match);
		//print_r( );*/
		$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/"; 
		preg_match_all($pattern,$str,$match); 
		return $match; 
	}
	//高亮关键词
	function heigLine($key,$content){
		return preg_replace('/'.$key.'/i', '<font color="red"><b>'.$key.'</b></font>', $content);
	}
	//激活当前导航
	function nav_now($id){
		$str="";
		if(Cookie('cid')==$id){
			$str='nav-item-current';
		}
		return $str;
		
	}
	//得到当前的栏目
	function get_channel($cid){
		if(!$cid){
			return '全站';
		}
		$channel=M('column')->find($cid);
		return $channel['title'];
	}
	function option($arr){
		
		$str='<option value="'.$arr['id'].'">'.$arr['title'].'</option>';
		return $str;
	}
	function get_img($src){
		$str="";
		$img=split(',',$src);
		for ($i=0; $i <= count($img)-2; $i++) { 
			$str.= '<img style="margin-left:10px;" height="50" src="'.$img[$i].'">';
		}
		return $str;
	}
	/**
	 * [get_image 得到图片]
	 * @param  [type] $img [图片资源字符串]
	 * @return [type]      [description]
	 */
	function get_image($img){
		
		$arr=explode(',', $img);
		$str="";
		for ($i=0; $i <=count($arr)-1; $i++) { 
			$str.='<img src="__IMAGE__/'.$arr[$i].'">';
		}
		
		return $str;
	}
	function get_first($img){
		
		$arr=explode(',', $img);
		$str=$arr[0];
		return $str;
	}
	
	function reg($str){		 
		return  _strip_tags(array("p", "br"),$str); 

	}
  
	/**   
	* PHP去掉特定的html标签
	* @param array $string   
	* @param bool $str  
	* @return string
	*/  
	function _strip_tags($tagsArr,$str) {   
	    foreach ($tagsArr as $tag) {  
	        $p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";  
	    }  
	    $return_str = preg_replace($p,"",$str);  
	    return $return_str;  
	}  
	/**
	 * [tag 截取字符串]
	 * @param  [type] $资源字符串
	 * @param  [type] $开始位置
	 * @param  [type] $截取长度
	 * @return [type] 结果字符串
	 */
	function tagstr($str,$start=0,$length=250){	
		$str=strip_tags(htmlspecialchars_decode($str));
		$temp=mb_substr($str,$start,$length,'utf-8');
		//return (strlen($str)>$length*1.5)?$temp.'...':$temp;
		return $temp;
	}


	/**  
	 * * 系统邮件发送函数  
	 * @param string $to    接收邮件者邮箱  
	 * @param string $name  接收邮件者名称  
	 * @param string $subject 邮件主题   
	 * @param string $body    邮件内容  
	 * @param string $attachment 附件列表 
	 * @return boolean   
	 */ 
	function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){     
		$config = C('THINK_EMAIL');     
		vendor('PHPMailer.class#phpmailer'); 
		//从PHPMailer目录导class.phpmailer.php类文件     
		$mail             = new PHPMailer(); //PHPMailer对象     
		$mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码     
		$mail->IsSMTP();  // 设定使用SMTP服务     
		$mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能,1 = errors and messages,2 = messages only     
		$mail->SMTPAuth   = false;                  // 启用 SMTP 验证功能     
		$mail->SMTPSecure = 'ssl';                 // 使用安全协议     
		$mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器     
		$mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号     
		$mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名     
		$mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码     
		$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);     
		$replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];     
		$replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];     
		$mail->AddReplyTo($replyEmail, $replyName);     
		$mail->Subject    = $subject;     
		$mail->MsgHTML($body);     
		$mail->AddAddress($to, $name);     
		if(is_array($attachment)){ // 添加附件         
			foreach ($attachment as $file){             
				is_file($file) && $mail->AddAttachment($file);         
			}     
		}     
		return $mail->Send() ? true : $mail->ErrorInfo; 
	}
	/**
	 * [SplitWord 分词]
	 * @param [type] $str [description]
	 */
	function SplitWord($str){
		vendor('SplitWord/SplitWord'); 
		$split=new SplitWord();
		$data=$split->SplitRMM($str);
		p($data);
		$split->Clear();
		return $data;
	}


	/*
     * 邮件发送
     * @param string $to 收件人邮箱，多个邮箱用,分开
     * @param string $title 标题
     * @param string $content 内容
     */

    function send_email($to,$title,$content,$webname="官方网站"){
        import('Class.Mail',APP_PATH);
        //邮件相关变量
        $cfg_smtp_server = 'smtp.163.com';
        $cfg_ask_guestview = '8';
        $cfg_smtp_port = '25';
        $cfg_ask_guestanswer = '8';
        $cfg_smtp_usermail = 'js_weiwei_100@163.com';//你的邮箱
        $cfg_smtp_user = 'js_weiwei_100@163.com';//你的邮箱号
        $cfg_smtp_password = 'wei110120';//你的邮箱密码

        $smtp = new smtp($cfg_smtp_server,$cfg_smtp_port,true,$cfg_smtp_usermail,$cfg_smtp_password);
        $smtp->debug = false;
        
        $cfg_webname=$webname;
        $mailtitle=$title;//邮件标题
        $mailbody=$content;//邮件内容 
                //$to 多个邮箱用,分隔
        $mailtype='html';
        return $smtp->sendmail($to,$cfg_webname,$cfg_smtp_usermail, $mailtitle, $mailbody, $mailtype);
    }
    /**
     * [NoRand 不重复随机数]
     * @param integer $begin [description]
     * @param integer $end   [description]
     * @param integer $limit [description]
     */
    function NoRand($begin=0,$end=20,$limit=4){
		$rand_array=range($begin,$end);
		shuffle($rand_array);//调用现成的数组随机排列函数
		return implode('',array_slice($rand_array,0,$limit));//截取前$limit个
	}
	/**
	 * [zeroize 数字补足]
	 * @param  int $num    		[带补足数字]
	 * @param  int $length 		[补足长度]
	 * @param  string $fill   	[补足字符]
	 * @param  int $fill   	  	[补足字符]
	 * @return [type]         	[description]
	 */
	function zeroize($num,$length=10,$type=1,$fill='0'){
		$type=$type?STR_PAD_LEFT:STR_PAD_RIGHT;
		return str_pad($num,$length,$fill,$type);
	}
	
	
	//////////////////////////////////////////////////////
    //Orderlist数据表，用于保存用户的购买订单记录；
    /* Orderlist数据表结构；
    CREATE TABLE `tb_orderlist` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `userid` int(11) DEFAULT NULL,购买者userid
      `username` varchar(255) DEFAULT NULL,购买者姓名
      `ordid` varchar(255) DEFAULT NULL,订单号
      `ordtime` int(11) DEFAULT NULL,订单时间
      `productid` int(11) DEFAULT NULL,产品ID
      `ordtitle` varchar(255) DEFAULT NULL,订单标题
      `ordbuynum` int(11) DEFAULT '0',购买数量
      `ordprice` float(10,2) DEFAULT '0.00',产品单价
      `ordfee` float(10,2) DEFAULT '0.00',订单总金额
      `ordstatus` int(11) DEFAULT '0',订单状态
      `payment_type` varchar(255) DEFAULT NULL,支付类型
      `payment_trade_no` varchar(255) DEFAULT NULL,支付接口交易号
      `payment_trade_status` varchar(255) DEFAULT NULL,支付接口返回的交易状态
      `payment_notify_id` varchar(255) DEFAULT NULL,
      `payment_notify_time` varchar(255) DEFAULT NULL,
      `payment_buyer_email` varchar(255) DEFAULT NULL,
      `ordcode` varchar(255) DEFAULT NULL,      
      `isused` int(11) DEFAULT '0',
      `usetime` int(11) DEFAULT NULL,
      `checkuser` int(11) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
    */
    //在线交易订单支付处理函数
    //函数功能：根据支付接口传回的数据判断该订单是否已经支付成功；
    //返回值：如果订单已经成功支付，返回true，否则返回false；
    function checkorderstatus($ordid){
        $Ord=M('orderlist');
        $ordstatus=$Ord->where('ordid='.$ordid)->getField('ordstatus');
        if($ordstatus==1){
            return true;
        }else{
            return false;    
        }
    }
    //处理订单函数
    //更新订单状态，写入订单支付后返回的数据
    function orderhandle($parameter){
        $ordid=$parameter['out_trade_no'];
        $data['payment_trade_no']      =$parameter['trade_no'];
        $data['payment_trade_status']  =$parameter['trade_status'];
        $data['payment_notify_id']     =$parameter['notify_id'];
        $data['payment_notify_time']   =$parameter['notify_time'];
        $data['payment_buyer_email']   =$parameter['buyer_email'];
        $data['ordstatus']             =1;
        $Ord=M('Orderlist');
        $Ord->where('ordid='.$ordid)->save($data);
    } 
    /*-----------------------------------
    2013.8.13更正
    下面这个函数，其实不需要，大家可以把他删掉，
    具体看我下面的修正补充部分的说明
    ------------------------------------*/
    //获取一个随机且唯一的订单号；
    function getordcode(){
        $Ord=M('Orderlist');
        $numbers = range (10,99);
        shuffle ($numbers); 
        $code=array_slice($numbers,0,4); 
        $ordcode=$code[0].$code[1].$code[2].$code[3];
        $oldcode=$Ord->where("ordcode='".$ordcode."'")->getField('ordcode');
        if($oldcode){
            getordcode();
        }else{
            return $ordcode;
        }
    }
    /**
     * [getKey 根据value得到数组key]
     * @param  [type] $arr   [数组]
     * @param  [type] $value [值]
     * @return [type]        [description]
     */
    function getKey($arr,$value) {
	 	if(!is_array($arr)) return null;
			foreach($arr as $k =>$v) {
			  $return = getKey($v, $value);
			  if($v == $value){
			   	return $k;
			  }
			  if(!is_null($return)){
			   return $return;
			}
		}
	}

	/**
	 * [getAxpress 获取快递公司]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getexpress($id){
		$express=M('express')->find($id);
		return $express['name'];
	}

	/**
	 * [goods 商品名称]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function goods($id){
		$good=M('article')->find($id);
		return $good['title'];
	}
	

	/**
	 * [goods 下单人]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function member($id){
		$good=M('member')->find($id);

		return $good['username'];
	}

	/**
	 * [goods 下单人]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function address_member($id){
		$good=M('address')->where(array('mid'=>$id))->find();
		return $good['name'];
	}

	/**
	 * [goods 下单人]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function address_tel($id){
		$good=M('address')->find($id);
		return $good['mobile']+$good['phone'];
	}

	/**
	 * [goods 邮寄地址]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function address($id){
		$area_array=array();
		$sub_array=array();
		$area_array[0] = "请选择";
		$area_array[11]="北京市";
		$sub_array[11];
		$sub_array[11][0]="请选择";
		$sub_array[11][1101]="东城区";
		$sub_array[11][1102]="西城区";
		$sub_array[11][1103]="崇文区";
		$sub_array[11][1104]="宣武区";
		$sub_array[11][1105]="朝阳区";
		$sub_array[11][1106]="丰台区";
		$sub_array[11][1107]="石景山区";
		$sub_array[11][1108]="海淀区";
		$sub_array[11][1109]="门头沟区";
		$sub_array[11][1111]="房山区";
		$sub_array[11][1112]="通州区";
		$sub_array[11][1113]="顺义区";
		$sub_array[11][1114]="昌平区";
		$sub_array[11][1115]="大兴区";
		$sub_array[11][1116]="怀柔区";
		$sub_array[11][1117]="平谷区";
		$sub_array[11][1128]="密云县";
		$sub_array[11][1129]="延庆县";
		$area_array[12]="天津市";
		$sub_array[12];
		$sub_array[12][0]="请选择";
		$sub_array[12][1201]="和平区";
		$sub_array[12][1202]="河东区";
		$sub_array[12][1203]="河西区";
		$sub_array[12][1204]="南开区";
		$sub_array[12][1205]="河北区";
		$sub_array[12][1206]="红桥区";
		$sub_array[12][1207]="塘沽区";
		$sub_array[12][1208]="汉沽区";
		$sub_array[12][1209]="大港区";
		$sub_array[12][1210]="东丽区";
		$sub_array[12][1211]="西青区";
		$sub_array[12][1212]="津南区";
		$sub_array[12][1213]="北辰区";
		$sub_array[12][1214]="武清区";
		$sub_array[12][1215]="宝坻区";
		$sub_array[12][1221]="宁河县";
		$sub_array[12][1223]="静海县";
		$sub_array[12][1225]="蓟县";
		$area_array[13]="河北省";
		$sub_array[13];
		$sub_array[13][0]="请选择";
		$sub_array[13][1301]="石家庄市";
		$sub_array[13][1302]="唐山市";
		$sub_array[13][1303]="秦皇岛市";
		$sub_array[13][1304]="邯郸市";
		$sub_array[13][1305]="邢台市";
		$sub_array[13][1306]="保定市";
		$sub_array[13][1307]="张家口市";
		$sub_array[13][1308]="承德市";
		$sub_array[13][1309]="沧州市";
		$sub_array[13][1310]="廊坊市";
		$sub_array[13][1311]="衡水市";
		$area_array[14]="山西省";
		$sub_array[14];
		$sub_array[14][0]="请选择";
		$sub_array[14][1401]="太原市";
		$sub_array[14][1402]="大同市";
		$sub_array[14][1403]="阳泉市";
		$sub_array[14][1404]="长治市";
		$sub_array[14][1405]="晋城市";
		$sub_array[14][1406]="朔州市";
		$sub_array[14][1407]="晋中市";
		$sub_array[14][1408]="运城市";
		$sub_array[14][1409]="忻州市";
		$sub_array[14][1410]="临汾市";
		$sub_array[14][1411]="吕梁市";
		$area_array[15]="内蒙古";
		$sub_array[15];
		$sub_array[15][0]="请选择";
		$sub_array[15][1501]="呼和浩特市";
		$sub_array[15][1502]="包头市";
		$sub_array[15][1503]="乌海市";
		$sub_array[15][1504]="赤峰市";
		$sub_array[15][1505]="通辽市";
		$sub_array[15][1506]="鄂尔多斯市";
		$sub_array[15][1507]="呼伦贝尔市";
		$sub_array[15][1508]="巴彦淖尔市";
		$sub_array[15][1509]="乌兰察布市";
		$sub_array[15][1522]="兴安盟";
		$sub_array[15][1525]="锡林郭勒盟";
		$sub_array[15][1529]="阿拉善盟";
		$area_array[21]="辽宁省";
		$sub_array[21];
		$sub_array[21][0]="请选择";
		$sub_array[21][2101]="沈阳市";
		$sub_array[21][2102]="大连市";
		$sub_array[21][2103]="鞍山市";
		$sub_array[21][2104]="抚顺市";
		$sub_array[21][2105]="本溪市";
		$sub_array[21][2106]="丹东市";
		$sub_array[21][2107]="锦州市";
		$sub_array[21][2108]="营口市";
		$sub_array[21][2109]="阜新市";
		$sub_array[21][2110]="辽阳市";
		$sub_array[21][2111]="盘锦市";
		$sub_array[21][2112]="铁岭市";
		$sub_array[21][2113]="朝阳市";
		$sub_array[21][2114]="葫芦岛市";
		$area_array[22]="吉林省";
		$sub_array[22];
		$sub_array[22][0]="请选择";
		$sub_array[22][2201]="长春市";
		$sub_array[22][2202]="吉林市";
		$sub_array[22][2203]="四平市";
		$sub_array[22][2204]="辽源市";
		$sub_array[22][2205]="通化市";
		$sub_array[22][2206]="白山市";
		$sub_array[22][2207]="松原市";
		$sub_array[22][2208]="白城市";
		$sub_array[22][2224]="延边州";
		$area_array[23]="黑龙江省";
		$sub_array[23];
		$sub_array[23][0]="请选择";
		$sub_array[23][2301]="哈尔滨市";
		$sub_array[23][2302]="齐齐哈尔市";
		$sub_array[23][2303]="鸡西市";
		$sub_array[23][2304]="鹤岗市";
		$sub_array[23][2305]="双鸭山市";
		$sub_array[23][2306]="大庆市";
		$sub_array[23][2307]="伊春市";
		$sub_array[23][2308]="佳木斯市";
		$sub_array[23][2309]="七台河市";
		$sub_array[23][2310]="牡丹江市";
		$sub_array[23][2311]="黑河市";
		$sub_array[23][2312]="绥化市";
		$sub_array[23][2327]="大兴安岭地区";
		$area_array[31]="上海市";
		$sub_array[31];
		$sub_array[31][0]="请选择";
		$sub_array[31][3101]="黄浦区";
		$sub_array[31][3104]="徐汇区";
		$sub_array[31][3105]="长宁区";
		$sub_array[31][3106]="静安区";
		$sub_array[31][3107]="普陀区";
		$sub_array[31][3108]="闸北区";
		$sub_array[31][3109]="虹口区";
		$sub_array[31][3110]="杨浦区";
		$sub_array[31][3112]="闵行区";
		$sub_array[31][3113]="宝山区";
		$sub_array[31][3114]="嘉定区";
		$sub_array[31][3115]="浦东新区";
		$sub_array[31][3116]="金山区";
		$sub_array[31][3117]="松江区";
		$sub_array[31][3118]="青浦区";
		$sub_array[31][3120]="奉贤区";
		$sub_array[31][3130]="崇明县";
		$area_array[32]="江苏省";
		$sub_array[32];
		$sub_array[32][0]="请选择";
		$sub_array[32][3201]="南京市";
		$sub_array[32][3202]="无锡市";
		$sub_array[32][3203]="徐州市";
		$sub_array[32][3204]="常州市";
		$sub_array[32][3205]="苏州市";
		$sub_array[32][3206]="南通市";
		$sub_array[32][3207]="连云港市";
		$sub_array[32][3208]="淮安市";
		$sub_array[32][3209]="盐城市";
		$sub_array[32][3210]="扬州市";
		$sub_array[32][3211]="镇江市";
		$sub_array[32][3212]="泰州市";
		$sub_array[32][3213]="宿迁市";
		$area_array[33]="浙江省";
		$sub_array[33];
		$sub_array[33][0]="请选择";
		$sub_array[33][3301]="杭州市";
		$sub_array[33][3302]="宁波市";
		$sub_array[33][3303]="温州市";
		$sub_array[33][3304]="嘉兴市";
		$sub_array[33][3305]="湖州市";
		$sub_array[33][3306]="绍兴市";
		$sub_array[33][3307]="金华市";
		$sub_array[33][3308]="衢州市";
		$sub_array[33][3309]="舟山市";
		$sub_array[33][3310]="台州市";
		$sub_array[33][3311]="丽水市";
		$area_array[34]="安徽省";
		$sub_array[34];
		$sub_array[34][0]="请选择";
		$sub_array[34][3401]="合肥市";
		$sub_array[34][3402]="芜湖市";
		$sub_array[34][3403]="蚌埠市";
		$sub_array[34][3404]="淮南市";
		$sub_array[34][3405]="马鞍山市";
		$sub_array[34][3406]="淮北市";
		$sub_array[34][3407]="铜陵市";
		$sub_array[34][3408]="安庆市";
		$sub_array[34][3410]="黄山市";
		$sub_array[34][3411]="滁州市";
		$sub_array[34][3412]="阜阳市";
		$sub_array[34][3413]="宿州市";
		$sub_array[34][3414]="巢湖市";
		$sub_array[34][3415]="六安市";
		$sub_array[34][3416]="亳州市";
		$sub_array[34][3417]="池州市";
		$sub_array[34][3418]="宣城市";
		$area_array[35]="福建省";
		$sub_array[35];
		$sub_array[35][0]="请选择";
		$sub_array[35][3501]="福州市";
		$sub_array[35][3502]="厦门市";
		$sub_array[35][3503]="莆田市";
		$sub_array[35][3504]="三明市";
		$sub_array[35][3505]="泉州市";
		$sub_array[35][3506]="漳州市";
		$sub_array[35][3507]="南平市";
		$sub_array[35][3508]="龙岩市";
		$sub_array[35][3509]="宁德市";
		$area_array[36]="江西省";
		$sub_array[36];
		$sub_array[36][0]="请选择";
		$sub_array[36][3601]="南昌市";
		$sub_array[36][3602]="景德镇市";
		$sub_array[36][3603]="萍乡市";
		$sub_array[36][3604]="九江市";
		$sub_array[36][3605]="新余市";
		$sub_array[36][3606]="鹰潭市";
		$sub_array[36][3607]="赣州市";
		$sub_array[36][3608]="吉安市";
		$sub_array[36][3609]="宜春市";
		$sub_array[36][3610]="抚州市";
		$sub_array[36][3611]="上饶市";
		$area_array[37]="山东省";
		$sub_array[37];
		$sub_array[37][0]="请选择";
		$sub_array[37][3701]="济南市";
		$sub_array[37][3702]="青岛市";
		$sub_array[37][3703]="淄博市";
		$sub_array[37][3704]="枣庄市";
		$sub_array[37][3705]="东营市";
		$sub_array[37][3706]="烟台市";
		$sub_array[37][3707]="潍坊市";
		$sub_array[37][3708]="济宁市";
		$sub_array[37][3709]="泰安市";
		$sub_array[37][3710]="威海市";
		$sub_array[37][3711]="日照市";
		$sub_array[37][3712]="莱芜市";
		$sub_array[37][3713]="临沂市";
		$sub_array[37][3714]="德州市";
		$sub_array[37][3715]="聊城市";
		$sub_array[37][3716]="滨州市";
		$sub_array[37][3717]="菏泽市";
		$area_array[41]="河南省";
		$sub_array[41];
		$sub_array[41][0]="请选择";
		$sub_array[41][4101]="郑州市";
		$sub_array[41][4102]="开封市";
		$sub_array[41][4103]="洛阳市";
		$sub_array[41][4104]="平顶山市";
		$sub_array[41][4105]="安阳市";
		$sub_array[41][4106]="鹤壁市";
		$sub_array[41][4107]="新乡市";
		$sub_array[41][4108]="焦作市";
		$sub_array[41][4109]="濮阳市";
		$sub_array[41][4110]="许昌市";
		$sub_array[41][4111]="漯河市";
		$sub_array[41][4112]="三门峡市";
		$sub_array[41][4113]="南阳市";
		$sub_array[41][4114]="商丘市";
		$sub_array[41][4115]="信阳市";
		$sub_array[41][4116]="周口市";
		$sub_array[41][4117]="驻马店市";
		$sub_array[41][4118]="济源市";
		$area_array[42]="湖北省";
		$sub_array[42];
		$sub_array[42][0]="请选择";
		$sub_array[42][4201]="武汉市";
		$sub_array[42][4202]="黄石市";
		$sub_array[42][4203]="十堰市";
		$sub_array[42][4205]="宜昌市";
		$sub_array[42][4206]="襄阳市";
		$sub_array[42][4207]="鄂州市";
		$sub_array[42][4208]="荆门市";
		$sub_array[42][4209]="孝感市";
		$sub_array[42][4210]="荆州市";
		$sub_array[42][4211]="黄冈市";
		$sub_array[42][4212]="咸宁市";
		$sub_array[42][4213]="随州市";
		$sub_array[42][4228]="恩施州";
		$sub_array[42][4229]="仙桃市";
		$sub_array[42][4230]="潜江市";
		$sub_array[42][4231]="天门市";
		$sub_array[42][4232]="神农架";
		$sub_array[42][4233]="江汉油田";
		$area_array[43]="湖南省";
		$sub_array[43];
		$sub_array[43][0]="请选择";
		$sub_array[43][4301]="长沙市";
		$sub_array[43][4302]="株洲市";
		$sub_array[43][4303]="湘潭市";
		$sub_array[43][4304]="衡阳市";
		$sub_array[43][4305]="邵阳市";
		$sub_array[43][4306]="岳阳市";
		$sub_array[43][4307]="常德市";
		$sub_array[43][4308]="张家界市";
		$sub_array[43][4309]="益阳市";
		$sub_array[43][4310]="郴州市";
		$sub_array[43][4311]="永州市";
		$sub_array[43][4312]="怀化市";
		$sub_array[43][4313]="娄底市";
		$sub_array[43][4331]="湘西";
		$area_array[44]="广东省";
		$sub_array[44];
		$sub_array[44][0]="请选择";
		$sub_array[44][4401]="广州市";
		$sub_array[44][4402]="韶关市";
		$sub_array[44][4403]="深圳市";
		$sub_array[44][4404]="珠海市";
		$sub_array[44][4405]="汕头市";
		$sub_array[44][4406]="佛山市";
		$sub_array[44][4407]="江门市";
		$sub_array[44][4408]="湛江市";
		$sub_array[44][4409]="茂名市";
		$sub_array[44][4412]="肇庆市";
		$sub_array[44][4413]="惠州市";
		$sub_array[44][4414]="梅州市";
		$sub_array[44][4415]="汕尾市";
		$sub_array[44][4416]="河源市";
		$sub_array[44][4417]="阳江市";
		$sub_array[44][4418]="清远市";
		$sub_array[44][4419]="东莞市";
		$sub_array[44][4420]="中山市";
		$sub_array[44][4451]="潮州市";
		$sub_array[44][4452]="揭阳市";
		$sub_array[44][4453]="云浮市";
		$area_array[45]="广西";
		$sub_array[45];
		$sub_array[45][0]="请选择";
		$sub_array[45][4501]="南宁市";
		$sub_array[45][4502]="柳州市";
		$sub_array[45][4503]="桂林市";
		$sub_array[45][4504]="梧州市";
		$sub_array[45][4505]="北海市";
		$sub_array[45][4506]="防城港市";
		$sub_array[45][4507]="钦州市";
		$sub_array[45][4508]="贵港市";
		$sub_array[45][4509]="玉林市";
		$sub_array[45][4510]="百色市";
		$sub_array[45][4511]="贺州市";
		$sub_array[45][4512]="河池市";
		$sub_array[45][4513]="来宾市";
		$sub_array[45][4514]="崇左市";
		$area_array[46]="海南省";
		$sub_array[46];
		$sub_array[46][0]="请选择";
		$sub_array[46][4601]="海口市";
		$sub_array[46][4602]="三亚市";
		$sub_array[46][4603]="五指山市";
		$sub_array[46][4604]="琼海市";
		$sub_array[46][4605]="儋州市";
		$sub_array[46][4607]="文昌市";
		$sub_array[46][4608]="万宁市";
		$sub_array[46][4609]="东方市";
		$sub_array[46][4623]="定安县";
		$sub_array[46][4624]="屯昌县";
		$sub_array[46][4625]="澄迈县";
		$sub_array[46][4626]="临高县";
		$sub_array[46][4627]="白沙";
		$sub_array[46][4628]="昌江";
		$sub_array[46][4629]="乐东";
		$sub_array[46][4630]="陵水";
		$sub_array[46][4631]="保亭";
		$sub_array[46][4632]="琼中";
		$sub_array[46][4690]="洋浦经济开发区";
		$area_array[50]="重庆市";
		$sub_array[50];
		$sub_array[50][0]="请选择";
		$sub_array[50][5001]="万州区";
		$sub_array[50][5002]="涪陵区";
		$sub_array[50][5003]="渝中区";
		$sub_array[50][5004]="大渡口区";
		$sub_array[50][5005]="江北区";
		$sub_array[50][5006]="沙坪坝区";
		$sub_array[50][5007]="九龙坡区";
		$sub_array[50][5008]="南岸区";
		$sub_array[50][5009]="北碚区";
		$sub_array[50][5010]="万盛区";
		$sub_array[50][5011]="双桥区";
		$sub_array[50][5012]="渝北区";
		$sub_array[50][5013]="巴南区";
		$sub_array[50][5014]="黔江区";
		$sub_array[50][5015]="长寿区";
		$sub_array[50][5016]="江津区";
		$sub_array[50][5017]="合川区";
		$sub_array[50][5019]="南川区";
		$sub_array[50][5022]="綦江县";
		$sub_array[50][5023]="潼南县";
		$sub_array[50][5024]="铜梁县";
		$sub_array[50][5025]="大足县";
		$sub_array[50][5026]="荣昌县";
		$sub_array[50][5027]="璧山县";
		$sub_array[50][5028]="梁平县";
		$sub_array[50][5029]="城口县";
		$sub_array[50][5030]="丰都县";
		$sub_array[50][5031]="垫江县";
		$sub_array[50][5032]="武隆县";
		$sub_array[50][5033]="忠县";
		$sub_array[50][5034]="开县";
		$sub_array[50][5035]="云阳县";
		$sub_array[50][5036]="奉节县";
		$sub_array[50][5037]="巫山县";
		$sub_array[50][5038]="巫溪县";
		$sub_array[50][5040]="石柱土家族自治县";
		$sub_array[50][5041]="秀山土家族苗族自治县";
		$sub_array[50][5042]="酉阳土家族苗族自治县";
		$sub_array[50][5043]="彭水苗族土家族自治县";
		$sub_array[50][5083]="永川区";
		$sub_array[50][5084]="北部新区";
		$area_array[51]="四川省";
		$sub_array[51];
		$sub_array[51][0]="请选择";
		$sub_array[51][5101]="成都市";
		$sub_array[51][5103]="自贡市";
		$sub_array[51][5104]="攀枝花市";
		$sub_array[51][5105]="泸州市";
		$sub_array[51][5106]="德阳市";
		$sub_array[51][5107]="绵阳市";
		$sub_array[51][5108]="广元市";
		$sub_array[51][5109]="遂宁市";
		$sub_array[51][5110]="内江市";
		$sub_array[51][5111]="乐山市";
		$sub_array[51][5113]="南充市";
		$sub_array[51][5114]="眉山市";
		$sub_array[51][5115]="宜宾市";
		$sub_array[51][5116]="广安市";
		$sub_array[51][5117]="达州市";
		$sub_array[51][5118]="雅安市";
		$sub_array[51][5119]="巴中市";
		$sub_array[51][5120]="资阳市";
		$sub_array[51][5132]="阿坝州";
		$sub_array[51][5133]="甘孜";
		$sub_array[51][5134]="凉山";
		$area_array[52]="贵州省";
		$sub_array[52];
		$sub_array[52][0]="请选择";
		$sub_array[52][5201]="贵阳市";
		$sub_array[52][5202]="六盘水市";
		$sub_array[52][5203]="遵义市";
		$sub_array[52][5204]="安顺市";
		$sub_array[52][5205]="毕节市";
		$sub_array[52][5206]="铜仁市";
		$sub_array[52][5223]="黔西南";
		$sub_array[52][5226]="黔东南";
		$sub_array[52][5227]="黔南布";
		$area_array[53]="云南省";
		$sub_array[53];
		$sub_array[53][0]="请选择";
		$sub_array[53][5301]="昆明市";
		$sub_array[53][5303]="曲靖市";
		$sub_array[53][5304]="玉溪市";
		$sub_array[53][5305]="保山市";
		$sub_array[53][5306]="昭通市";
		$sub_array[53][5307]="丽江市";
		$sub_array[53][5308]="普洱市(*)";
		$sub_array[53][5309]="临沧市";
		$sub_array[53][5323]="楚雄";
		$sub_array[53][5325]="红河";
		$sub_array[53][5326]="文山";
		$sub_array[53][5328]="西双版纳";
		$sub_array[53][5329]="大理";
		$sub_array[53][5331]="德宏";
		$sub_array[53][5333]="怒江";
		$sub_array[53][5334]="迪庆";
		$area_array[54]="西藏";
		$sub_array[54];
		$sub_array[54][0]="请选择";
		$sub_array[54][5401]="拉萨市";
		$sub_array[54][5421]="昌都地区";
		$sub_array[54][5422]="山南地区";
		$sub_array[54][5423]="日喀则地区";
		$sub_array[54][5424]="那曲地区";
		$sub_array[54][5425]="阿里地区";
		$sub_array[54][5426]="林芝地区";
		$area_array[61]="陕西省";
		$sub_array[61];
		$sub_array[61][0]="请选择";
		$sub_array[61][6101]="西安市";
		$sub_array[61][6102]="铜川市";
		$sub_array[61][6103]="宝鸡市";
		$sub_array[61][6104]="咸阳市";
		$sub_array[61][6105]="渭南市";
		$sub_array[61][6106]="延安市";
		$sub_array[61][6107]="汉中市";
		$sub_array[61][6108]="榆林市";
		$sub_array[61][6109]="安康市";
		$sub_array[61][6110]="商洛市";
		$sub_array[61][6151]="杨凌示范区";
		$area_array[62]="甘肃省";
		$sub_array[62];
		$sub_array[62][0]="请选择";
		$sub_array[62][6201]="兰州市";
		$sub_array[62][6202]="嘉峪关市";
		$sub_array[62][6203]="金昌市";
		$sub_array[62][6204]="白银市";
		$sub_array[62][6205]="天水市";
		$sub_array[62][6206]="武威市";
		$sub_array[62][6207]="张掖市";
		$sub_array[62][6208]="平凉市";
		$sub_array[62][6209]="酒泉市";
		$sub_array[62][6210]="庆阳市";
		$sub_array[62][6211]="定西市";
		$sub_array[62][6212]="陇南市";
		$sub_array[62][6229]="临夏";
		$sub_array[62][6230]="甘南";
		$area_array[63]="青海省";
		$sub_array[63];
		$sub_array[63][0]="请选择";
		$sub_array[63][6301]="西宁市";
		$sub_array[63][6321]="海东地区";
		$sub_array[63][6322]="海北";
		$sub_array[63][6323]="黄南";
		$sub_array[63][6325]="海南";
		$sub_array[63][6326]="果洛";
		$sub_array[63][6327]="玉树";
		$sub_array[63][6328]="海西";
		$area_array[64]="宁夏";
		$sub_array[64];
		$sub_array[64][0]="请选择";
		$sub_array[64][6401]="银川市";
		$sub_array[64][6402]="石嘴山市";
		$sub_array[64][6403]="吴忠市";
		$sub_array[64][6404]="固原市";
		$sub_array[64][6405]="中卫市";
		$area_array[65]="新疆";
		$sub_array[65];
		$sub_array[65][0]="请选择";
		$sub_array[65][6501]="乌鲁木齐市";
		$sub_array[65][6502]="克拉玛依市";
		$sub_array[65][6521]="吐鲁番地区";
		$sub_array[65][6522]="哈密地区";
		$sub_array[65][6523]="昌吉";
		$sub_array[65][6527]="博尔塔拉";
		$sub_array[65][6528]="巴音郭楞";
		$sub_array[65][6529]="阿克苏地区";
		$sub_array[65][6530]="克孜勒";
		$sub_array[65][6531]="喀什地区";
		$sub_array[65][6532]="和田地区";
		$sub_array[65][6540]="伊犁";
		$sub_array[65][6542]="塔城地区";
		$sub_array[65][6543]="阿勒泰地区";
		$sub_array[65][6590]="自治区直辖县级行政单位";
		$area_array[71]="台湾省";
		$sub_array[71];
		$sub_array[71][0]="请选择";
		$sub_array[71][7101]="台北市";
		$sub_array[71][7102]="高雄市";
		$sub_array[71][7103]="基隆市";
		$sub_array[71][7104]="台中市";
		$sub_array[71][7105]="台南市";
		$sub_array[71][7106]="新竹市";
		$sub_array[71][7107]="嘉义市";
		$sub_array[71][7108]="台北县";
		$sub_array[71][7109]="宜兰县";
		$sub_array[71][7110]="新竹县";
		$sub_array[71][7111]="桃园县";
		$sub_array[71][7112]="苗栗县";
		$sub_array[71][7113]="台中县";
		$sub_array[71][7114]="彰化县";
		$sub_array[71][7115]="南投县";
		$sub_array[71][7116]="嘉义县";
		$sub_array[71][7117]="云林县";
		$sub_array[71][7118]="台南县";
		$sub_array[71][7119]="高雄县";
		$sub_array[71][7120]="屏东县";
		$sub_array[71][7121]="台东县";
		$sub_array[71][7122]="花莲县";
		$sub_array[71][7123]="澎湖县";
		$area_array[81]="香港";
		$sub_array[81];
		$sub_array[81][0]="请选择";
		$sub_array[81][8101]="中西区";
		$sub_array[81][8102]="东区";
		$sub_array[81][8103]="九龙城区";
		$sub_array[81][8104]="观塘区";
		$sub_array[81][8105]="南区";
		$sub_array[81][8106]="深水区";
		$sub_array[81][8107]="湾仔区";
		$sub_array[81][8108]="黄大仙区";
		$sub_array[81][8109]="油尖旺区";
		$sub_array[81][8110]="离岛区";
		$sub_array[81][8111]="葵青区";
		$sub_array[81][8112]="北区";
		$sub_array[81][8113]="西贡区";
		$sub_array[81][8114]="沙田区";
		$sub_array[81][8115]="屯门区";
		$sub_array[81][8116]="大埔区";
		$sub_array[81][8117]="荃湾区";
		$sub_array[81][8118]="元朗区";
		$area_array[82]="澳门";
		$sub_array[82];
		$sub_array[82][0]="请选择";
		$sub_array[82][8201]="花地玛堂区";
		$sub_array[82][8202]="圣安多尼堂区";
		$sub_array[82][8203]="大堂区";
		$sub_array[82][8204]="望德堂区";
		$sub_array[82][8205]="风顺堂区";
		$sub_array[82][8206]="嘉模堂区";
		$sub_array[82][8207]="圣方济各堂区";
		$l_arr=array();
		$sub_arr=array();
		$l_arr[1301]="石家庄市";
		$sub_arr[1301];
		$sub_arr[1301][0]="请选择";
		$sub_arr[1301][130102]="长安区";
		$sub_arr[1301][130103]="桥东区";
		$sub_arr[1301][130104]="桥西区";
		$sub_arr[1301][130105]="新华区";
		$sub_arr[1301][130107]="井陉矿区";
		$sub_arr[1301][130108]="裕华区";
		$sub_arr[1301][130121]="井陉县";
		$sub_arr[1301][130123]="正定县";
		$sub_arr[1301][130124]="栾城县";
		$sub_arr[1301][130125]="行唐县";
		$sub_arr[1301][130126]="灵寿县";
		$sub_arr[1301][130127]="高邑县";
		$sub_arr[1301][130128]="深泽县";
		$sub_arr[1301][130129]="赞皇县";
		$sub_arr[1301][130130]="无极县";
		$sub_arr[1301][130131]="平山县";
		$sub_arr[1301][130132]="元氏县";
		$sub_arr[1301][130133]="赵县";
		$sub_arr[1301][130181]="辛集市";
		$sub_arr[1301][130182]="藁城市";
		$sub_arr[1301][130183]="晋州市";
		$sub_arr[1301][130184]="新乐市";
		$sub_arr[1301][130185]="鹿泉市";
		$l_arr[1302]="唐山市";
		$sub_arr[1302];
		$sub_arr[1302][0]="请选择";
		$sub_arr[1302][130202]="路南区";
		$sub_arr[1302][130203]="路北区";
		$sub_arr[1302][130204]="古冶区";
		$sub_arr[1302][130205]="开平区";
		$sub_arr[1302][130207]="丰南区";
		$sub_arr[1302][130208]="丰润区";
		$sub_arr[1302][130223]="滦县";
		$sub_arr[1302][130224]="滦南县";
		$sub_arr[1302][130225]="乐亭县";
		$sub_arr[1302][130227]="迁西县";
		$sub_arr[1302][130229]="玉田县";
		$sub_arr[1302][130230]="唐海县";
		$sub_arr[1302][130281]="遵化市";
		$sub_arr[1302][130283]="迁安市";
		$l_arr[1303]="秦皇岛市";
		$sub_arr[1303];
		$sub_arr[1303][0]="请选择";
		$sub_arr[1303][130302]="海港区";
		$sub_arr[1303][130303]="山海关区";
		$sub_arr[1303][130304]="北戴河区";
		$sub_arr[1303][130321]="青龙县";
		$sub_arr[1303][130322]="昌黎县";
		$sub_arr[1303][130323]="抚宁县";
		$sub_arr[1303][130324]="卢龙县";
		$l_arr[1304]="邯郸市";
		$sub_arr[1304];
		$sub_arr[1304][0]="请选择";
		$sub_arr[1304][130402]="邯山区";
		$sub_arr[1304][130403]="丛台区";
		$sub_arr[1304][130404]="复兴区";
		$sub_arr[1304][130406]="峰峰矿区";
		$sub_arr[1304][130421]="邯郸县";
		$sub_arr[1304][130423]="临漳县";
		$sub_arr[1304][130424]="成安县";
		$sub_arr[1304][130425]="大名县";
		$sub_arr[1304][130426]="涉县";
		$sub_arr[1304][130427]="磁县";
		$sub_arr[1304][130428]="肥乡县";
		$sub_arr[1304][130429]="永年县";
		$sub_arr[1304][130430]="邱县";
		$sub_arr[1304][130431]="鸡泽县";
		$sub_arr[1304][130432]="广平县";
		$sub_arr[1304][130433]="馆陶县";
		$sub_arr[1304][130434]="魏县";
		$sub_arr[1304][130435]="曲周县";
		$sub_arr[1304][130481]="武安市";
		$l_arr[1305]="邢台市";
		$sub_arr[1305];
		$sub_arr[1305][0]="请选择";
		$sub_arr[1305][130502]="桥东区";
		$sub_arr[1305][130503]="桥西区";
		$sub_arr[1305][130521]="邢台县";
		$sub_arr[1305][130522]="临城县";
		$sub_arr[1305][130523]="内丘县";
		$sub_arr[1305][130524]="柏乡县";
		$sub_arr[1305][130525]="隆尧县";
		$sub_arr[1305][130526]="任县";
		$sub_arr[1305][130527]="南和县";
		$sub_arr[1305][130528]="宁晋县";
		$sub_arr[1305][130529]="巨鹿县";
		$sub_arr[1305][130530]="新河县";
		$sub_arr[1305][130531]="广宗县";
		$sub_arr[1305][130532]="平乡县";
		$sub_arr[1305][130533]="威县";
		$sub_arr[1305][130534]="清河县";
		$sub_arr[1305][130535]="临西县";
		$sub_arr[1305][130581]="南宫市";
		$sub_arr[1305][130582]="沙河市";
		$l_arr[1306]="保定市";
		$sub_arr[1306];
		$sub_arr[1306][0]="请选择";
		$sub_arr[1306][130602]="新市区";
		$sub_arr[1306][130603]="北市区";
		$sub_arr[1306][130604]="南市区";
		$sub_arr[1306][130621]="满城县";
		$sub_arr[1306][130622]="清苑县";
		$sub_arr[1306][130623]="涞水县";
		$sub_arr[1306][130624]="阜平县";
		$sub_arr[1306][130625]="徐水县";
		$sub_arr[1306][130626]="定兴县";
		$sub_arr[1306][130627]="唐县";
		$sub_arr[1306][130628]="高阳县";
		$sub_arr[1306][130629]="容城县";
		$sub_arr[1306][130630]="涞源县";
		$sub_arr[1306][130631]="望都县";
		$sub_arr[1306][130632]="安新县";
		$sub_arr[1306][130633]="易县";
		$sub_arr[1306][130634]="曲阳县";
		$sub_arr[1306][130635]="蠡县";
		$sub_arr[1306][130636]="顺平县";
		$sub_arr[1306][130637]="博野县";
		$sub_arr[1306][130638]="雄县";
		$sub_arr[1306][130681]="涿州市";
		$sub_arr[1306][130682]="定州市";
		$sub_arr[1306][130683]="安国市";
		$sub_arr[1306][130684]="高碑店市";
		$l_arr[1307]="张家口市";
		$sub_arr[1307];
		$sub_arr[1307][0]="请选择";
		$sub_arr[1307][130702]="桥东区";
		$sub_arr[1307][130703]="桥西区";
		$sub_arr[1307][130705]="宣化区";
		$sub_arr[1307][130706]="下花园区";
		$sub_arr[1307][130721]="宣化县";
		$sub_arr[1307][130722]="张北县";
		$sub_arr[1307][130723]="康保县";
		$sub_arr[1307][130724]="沽源县";
		$sub_arr[1307][130725]="尚义县";
		$sub_arr[1307][130726]="蔚县";
		$sub_arr[1307][130727]="阳原县";
		$sub_arr[1307][130728]="怀安县";
		$sub_arr[1307][130729]="万全县";
		$sub_arr[1307][130730]="怀来县";
		$sub_arr[1307][130731]="涿鹿县";
		$sub_arr[1307][130732]="赤城县";
		$sub_arr[1307][130733]="崇礼县";
		$l_arr[1308]="承德市";
		$sub_arr[1308];
		$sub_arr[1308][0]="请选择";
		$sub_arr[1308][130802]="双桥区";
		$sub_arr[1308][130803]="双滦区";
		$sub_arr[1308][130804]="鹰手营子矿区";
		$sub_arr[1308][130821]="承德县";
		$sub_arr[1308][130822]="兴隆县";
		$sub_arr[1308][130823]="平泉县";
		$sub_arr[1308][130824]="滦平县";
		$sub_arr[1308][130825]="隆化县";
		$sub_arr[1308][130826]="丰宁县";
		$sub_arr[1308][130827]="宽城县";
		$sub_arr[1308][130828]="围场县";
		$l_arr[1309]="沧州市";
		$sub_arr[1309];
		$sub_arr[1309][0]="请选择";
		$sub_arr[1309][130902]="新华区";
		$sub_arr[1309][130903]="运河区";
		$sub_arr[1309][130921]="沧县";
		$sub_arr[1309][130922]="青县";
		$sub_arr[1309][130923]="东光县";
		$sub_arr[1309][130924]="海兴县";
		$sub_arr[1309][130925]="盐山县";
		$sub_arr[1309][130926]="肃宁县";
		$sub_arr[1309][130927]="南皮县";
		$sub_arr[1309][130928]="吴桥县";
		$sub_arr[1309][130929]="献县";
		$sub_arr[1309][130930]="孟村县";
		$sub_arr[1309][130981]="泊头市";
		$sub_arr[1309][130982]="任丘市";
		$sub_arr[1309][130983]="黄骅市";
		$sub_arr[1309][130984]="河间市";
		$l_arr[1310]="廊坊市";
		$sub_arr[1310];
		$sub_arr[1310][0]="请选择";
		$sub_arr[1310][131002]="安次区";
		$sub_arr[1310][131003]="广阳区";
		$sub_arr[1310][131022]="固安县";
		$sub_arr[1310][131023]="永清县";
		$sub_arr[1310][131024]="香河县";
		$sub_arr[1310][131025]="大城县";
		$sub_arr[1310][131026]="文安县";
		$sub_arr[1310][131028]="大厂县";
		$sub_arr[1310][131081]="霸州市";
		$sub_arr[1310][131082]="三河市";
		$l_arr[1311]="衡水市";
		$sub_arr[1311];
		$sub_arr[1311][0]="请选择";
		$sub_arr[1311][131102]="桃城区";
		$sub_arr[1311][131121]="枣强县";
		$sub_arr[1311][131122]="武邑县";
		$sub_arr[1311][131123]="武强县";
		$sub_arr[1311][131124]="饶阳县";
		$sub_arr[1311][131125]="安平县";
		$sub_arr[1311][131126]="故城县";
		$sub_arr[1311][131127]="景县";
		$sub_arr[1311][131128]="阜城县";
		$sub_arr[1311][131181]="冀州市";
		$sub_arr[1311][131182]="深州市";
		$l_arr[1401]="太原市";
		$sub_arr[1401];
		$sub_arr[1401][0]="请选择";
		$sub_arr[1401][140105]="小店区";
		$sub_arr[1401][140106]="迎泽区";
		$sub_arr[1401][140107]="杏花岭区";
		$sub_arr[1401][140108]="尖草坪区";
		$sub_arr[1401][140109]="万柏林区";
		$sub_arr[1401][140110]="晋源区";
		$sub_arr[1401][140121]="清徐县";
		$sub_arr[1401][140122]="阳曲县";
		$sub_arr[1401][140123]="娄烦县";
		$sub_arr[1401][140181]="古交市";
		$l_arr[1402]="大同市";
		$sub_arr[1402];
		$sub_arr[1402][0]="请选择";
		$sub_arr[1402][140202]="城区";
		$sub_arr[1402][140203]="矿区";
		$sub_arr[1402][140211]="南郊区";
		$sub_arr[1402][140212]="新荣区";
		$sub_arr[1402][140221]="阳高县";
		$sub_arr[1402][140222]="天镇县";
		$sub_arr[1402][140223]="广灵县";
		$sub_arr[1402][140224]="灵丘县";
		$sub_arr[1402][140225]="浑源县";
		$sub_arr[1402][140226]="左云县";
		$sub_arr[1402][140227]="大同县";
		$l_arr[1403]="阳泉市";
		$sub_arr[1403];
		$sub_arr[1403][0]="请选择";
		$sub_arr[1403][140302]="城区";
		$sub_arr[1403][140303]="矿区";
		$sub_arr[1403][140311]="郊区";
		$sub_arr[1403][140321]="平定县";
		$sub_arr[1403][140322]="盂县";
		$l_arr[1404]="长治市";
		$sub_arr[1404];
		$sub_arr[1404][0]="请选择";
		$sub_arr[1404][140402]="城区";
		$sub_arr[1404][140411]="郊区";
		$sub_arr[1404][140421]="长治县";
		$sub_arr[1404][140423]="襄垣县";
		$sub_arr[1404][140424]="屯留县";
		$sub_arr[1404][140425]="平顺县";
		$sub_arr[1404][140426]="黎城县";
		$sub_arr[1404][140427]="壶关县";
		$sub_arr[1404][140428]="长子县";
		$sub_arr[1404][140429]="武乡县";
		$sub_arr[1404][140430]="沁县";
		$sub_arr[1404][140431]="沁源县";
		$sub_arr[1404][140481]="潞城市";
		$l_arr[1405]="晋城市";
		$sub_arr[1405];
		$sub_arr[1405][0]="请选择";
		$sub_arr[1405][140502]="城区";
		$sub_arr[1405][140521]="沁水县";
		$sub_arr[1405][140522]="阳城县";
		$sub_arr[1405][140524]="陵川县";
		$sub_arr[1405][140525]="泽州县";
		$sub_arr[1405][140581]="高平市";
		$l_arr[1406]="朔州市";
		$sub_arr[1406];
		$sub_arr[1406][0]="请选择";
		$sub_arr[1406][140602]="朔城区";
		$sub_arr[1406][140603]="平鲁区";
		$sub_arr[1406][140621]="山阴县";
		$sub_arr[1406][140622]="应县";
		$sub_arr[1406][140623]="右玉县";
		$sub_arr[1406][140624]="怀仁县";
		$l_arr[1407]="晋中市";
		$sub_arr[1407];
		$sub_arr[1407][0]="请选择";
		$sub_arr[1407][140702]="榆次区";
		$sub_arr[1407][140721]="榆社县";
		$sub_arr[1407][140722]="左权县";
		$sub_arr[1407][140723]="和顺县";
		$sub_arr[1407][140724]="昔阳县";
		$sub_arr[1407][140725]="寿阳县";
		$sub_arr[1407][140726]="太谷县";
		$sub_arr[1407][140727]="祁县";
		$sub_arr[1407][140728]="平遥县";
		$sub_arr[1407][140729]="灵石县";
		$sub_arr[1407][140781]="介休市";
		$l_arr[1408]="运城市";
		$sub_arr[1408];
		$sub_arr[1408][0]="请选择";
		$sub_arr[1408][140802]="盐湖区";
		$sub_arr[1408][140821]="临猗县";
		$sub_arr[1408][140822]="万荣县";
		$sub_arr[1408][140823]="闻喜县";
		$sub_arr[1408][140824]="稷山县";
		$sub_arr[1408][140825]="新绛县";
		$sub_arr[1408][140826]="绛县";
		$sub_arr[1408][140827]="垣曲县";
		$sub_arr[1408][140828]="夏县";
		$sub_arr[1408][140829]="平陆县";
		$sub_arr[1408][140830]="芮城县";
		$sub_arr[1408][140881]="永济市";
		$sub_arr[1408][140882]="河津市";
		$l_arr[1409]="忻州市";
		$sub_arr[1409];
		$sub_arr[1409][0]="请选择";
		$sub_arr[1409][140902]="忻府区";
		$sub_arr[1409][140921]="定襄县";
		$sub_arr[1409][140922]="五台县";
		$sub_arr[1409][140923]="代县";
		$sub_arr[1409][140924]="繁峙县";
		$sub_arr[1409][140925]="宁武县";
		$sub_arr[1409][140926]="静乐县";
		$sub_arr[1409][140927]="神池县";
		$sub_arr[1409][140928]="五寨县";
		$sub_arr[1409][140929]="岢岚县";
		$sub_arr[1409][140930]="河曲县";
		$sub_arr[1409][140931]="保德县";
		$sub_arr[1409][140932]="偏关县";
		$sub_arr[1409][140981]="原平市";
		$l_arr[1410]="临汾市";
		$sub_arr[1410];
		$sub_arr[1410][0]="请选择";
		$sub_arr[1410][141002]="尧都区";
		$sub_arr[1410][141021]="曲沃县";
		$sub_arr[1410][141022]="翼城县";
		$sub_arr[1410][141023]="襄汾县";
		$sub_arr[1410][141024]="洪洞县";
		$sub_arr[1410][141025]="古县";
		$sub_arr[1410][141026]="安泽县";
		$sub_arr[1410][141027]="浮山县";
		$sub_arr[1410][141028]="吉县";
		$sub_arr[1410][141029]="乡宁县";
		$sub_arr[1410][141030]="大宁县";
		$sub_arr[1410][141031]="隰县";
		$sub_arr[1410][141032]="永和县";
		$sub_arr[1410][141033]="蒲县";
		$sub_arr[1410][141034]="汾西县";
		$sub_arr[1410][141081]="侯马市";
		$sub_arr[1410][141082]="霍州市";
		$l_arr[1411]="吕梁市";
		$sub_arr[1411];
		$sub_arr[1411][0]="请选择";
		$sub_arr[1411][141102]="离石区";
		$sub_arr[1411][141121]="文水县";
		$sub_arr[1411][141122]="交城县";
		$sub_arr[1411][141123]="兴县";
		$sub_arr[1411][141124]="临县";
		$sub_arr[1411][141125]="柳林县";
		$sub_arr[1411][141126]="石楼县";
		$sub_arr[1411][141127]="岚县";
		$sub_arr[1411][141128]="方山县";
		$sub_arr[1411][141129]="中阳县";
		$sub_arr[1411][141130]="交口县";
		$sub_arr[1411][141181]="孝义市";
		$sub_arr[1411][141182]="汾阳市";
		$l_arr[1501]="呼和浩特市";
		$sub_arr[1501];
		$sub_arr[1501][0]="请选择";
		$sub_arr[1501][150102]="新城区";
		$sub_arr[1501][150103]="回民区";
		$sub_arr[1501][150104]="玉泉区";
		$sub_arr[1501][150105]="赛罕区";
		$sub_arr[1501][150121]="土默特左旗";
		$sub_arr[1501][150122]="托克托县";
		$sub_arr[1501][150123]="和林格尔县";
		$sub_arr[1501][150124]="清水河县";
		$sub_arr[1501][150125]="武川县";
		$l_arr[1502]="包头市";
		$sub_arr[1502];
		$sub_arr[1502][0]="请选择";
		$sub_arr[1502][150202]="东河区";
		$sub_arr[1502][150203]="昆都仑区";
		$sub_arr[1502][150204]="青山区";
		$sub_arr[1502][150205]="石拐区";
		$sub_arr[1502][150206]="白云矿区";
		$sub_arr[1502][150207]="九原区";
		$sub_arr[1502][150221]="土默特右旗";
		$sub_arr[1502][150222]="固阳县";
		$sub_arr[1502][150223]="达尔罕茂明安联合旗";
		$l_arr[1503]="乌海市";
		$sub_arr[1503];
		$sub_arr[1503][0]="请选择";
		$sub_arr[1503][150302]="海勃湾区";
		$sub_arr[1503][150303]="海南区";
		$sub_arr[1503][150304]="乌达区";
		$l_arr[1504]="赤峰市";
		$sub_arr[1504];
		$sub_arr[1504][0]="请选择";
		$sub_arr[1504][150402]="红山区";
		$sub_arr[1504][150403]="元宝山区";
		$sub_arr[1504][150404]="松山区";
		$sub_arr[1504][150421]="阿鲁科尔沁旗";
		$sub_arr[1504][150422]="巴林左旗";
		$sub_arr[1504][150423]="巴林右旗";
		$sub_arr[1504][150424]="林西县";
		$sub_arr[1504][150425]="克什克腾旗";
		$sub_arr[1504][150426]="翁牛特旗";
		$sub_arr[1504][150428]="喀喇沁旗";
		$sub_arr[1504][150429]="宁城县";
		$sub_arr[1504][150430]="敖汉旗";
		$l_arr[1505]="通辽市";
		$sub_arr[1505];
		$sub_arr[1505][0]="请选择";
		$sub_arr[1505][150502]="科尔沁区";
		$sub_arr[1505][150521]="科尔沁左翼中旗";
		$sub_arr[1505][150522]="科尔沁左翼后旗";
		$sub_arr[1505][150523]="开鲁县";
		$sub_arr[1505][150524]="库伦旗";
		$sub_arr[1505][150525]="奈曼旗";
		$sub_arr[1505][150526]="扎鲁特旗";
		$sub_arr[1505][150581]="霍林郭勒市";
		$l_arr[1506]="鄂尔多斯市";
		$sub_arr[1506];
		$sub_arr[1506][0]="请选择";
		$sub_arr[1506][150602]="东胜区";
		$sub_arr[1506][150621]="达拉特旗";
		$sub_arr[1506][150622]="准格尔旗";
		$sub_arr[1506][150623]="鄂托克前旗";
		$sub_arr[1506][150624]="鄂托克旗";
		$sub_arr[1506][150625]="杭锦旗";
		$sub_arr[1506][150626]="乌审旗";
		$sub_arr[1506][150627]="伊金霍洛旗";
		$l_arr[1507]="呼伦贝尔市";
		$sub_arr[1507];
		$sub_arr[1507][0]="请选择";
		$sub_arr[1507][150702]="海拉尔区";
		$sub_arr[1507][150721]="阿荣旗";
		$sub_arr[1507][150722]="莫力达瓦达斡尔族自治旗";
		$sub_arr[1507][150723]="鄂伦春自治旗";
		$sub_arr[1507][150724]="鄂温克族自治旗";
		$sub_arr[1507][150725]="陈巴尔虎旗";
		$sub_arr[1507][150726]="新巴尔虎左旗";
		$sub_arr[1507][150727]="新巴尔虎右旗";
		$sub_arr[1507][150781]="满洲里市";
		$sub_arr[1507][150782]="牙克石市";
		$sub_arr[1507][150783]="扎兰屯市";
		$sub_arr[1507][150784]="额尔古纳市";
		$sub_arr[1507][150785]="根河市";
		$l_arr[1508]="巴彦淖尔市";
		$sub_arr[1508];
		$sub_arr[1508][0]="请选择";
		$sub_arr[1508][150802]="临河区";
		$sub_arr[1508][150821]="五原县";
		$sub_arr[1508][150822]="磴口县";
		$sub_arr[1508][150823]="乌拉特前旗";
		$sub_arr[1508][150824]="乌拉特中旗";
		$sub_arr[1508][150825]="乌拉特后旗";
		$sub_arr[1508][150826]="杭锦后旗";
		$l_arr[1509]="乌兰察布市";
		$sub_arr[1509];
		$sub_arr[1509][0]="请选择";
		$sub_arr[1509][150902]="集宁区";
		$sub_arr[1509][150921]="卓资县";
		$sub_arr[1509][150922]="化德县";
		$sub_arr[1509][150923]="商都县";
		$sub_arr[1509][150924]="兴和县";
		$sub_arr[1509][150925]="凉城县";
		$sub_arr[1509][150926]="察哈尔右翼前旗";
		$sub_arr[1509][150927]="察哈尔右翼中旗";
		$sub_arr[1509][150928]="察哈尔右翼后旗";
		$sub_arr[1509][150929]="四子王旗";
		$sub_arr[1509][150981]="丰镇市";
		$l_arr[1522]="兴安盟";
		$sub_arr[1522];
		$sub_arr[1522][0]="请选择";
		$sub_arr[1522][152201]="乌兰浩特市";
		$sub_arr[1522][152202]="阿尔山市";
		$sub_arr[1522][152221]="科尔沁右翼前旗";
		$sub_arr[1522][152222]="科尔沁右翼中旗";
		$sub_arr[1522][152223]="扎赉特旗";
		$sub_arr[1522][152224]="突泉县";
		$l_arr[1525]="锡林郭勒盟";
		$sub_arr[1525];
		$sub_arr[1525][0]="请选择";
		$sub_arr[1525][152501]="二连浩特市";
		$sub_arr[1525][152502]="锡林浩特市";
		$sub_arr[1525][152522]="阿巴嘎旗";
		$sub_arr[1525][152523]="苏尼特左旗";
		$sub_arr[1525][152524]="苏尼特右旗";
		$sub_arr[1525][152525]="东乌珠穆沁旗";
		$sub_arr[1525][152526]="西乌珠穆沁旗";
		$sub_arr[1525][152527]="太仆寺旗";
		$sub_arr[1525][152528]="镶黄旗";
		$sub_arr[1525][152529]="正镶白旗";
		$sub_arr[1525][152530]="正蓝旗";
		$sub_arr[1525][152531]="多伦县";
		$l_arr[1529]="阿拉善盟";
		$sub_arr[1529];
		$sub_arr[1529][0]="请选择";
		$sub_arr[1529][152921]="阿拉善左旗";
		$sub_arr[1529][152922]="阿拉善右旗";
		$sub_arr[1529][152923]="额济纳旗";
		$l_arr[2101]="沈阳市";
		$sub_arr[2101];
		$sub_arr[2101][0]="请选择";
		$sub_arr[2101][210102]="和平区";
		$sub_arr[2101][210103]="沈河区";
		$sub_arr[2101][210104]="大东区";
		$sub_arr[2101][210105]="皇姑区";
		$sub_arr[2101][210106]="铁西区";
		$sub_arr[2101][210111]="苏家屯区";
		$sub_arr[2101][210112]="东陵区";
		$sub_arr[2101][210113]="沈北新区";
		$sub_arr[2101][210114]="于洪区";
		$sub_arr[2101][210122]="辽中县";
		$sub_arr[2101][210123]="康平县";
		$sub_arr[2101][210124]="法库县";
		$sub_arr[2101][210181]="新民市";
		$l_arr[2102]="大连市";
		$sub_arr[2102];
		$sub_arr[2102][0]="请选择";
		$sub_arr[2102][210202]="中山区";
		$sub_arr[2102][210203]="西岗区";
		$sub_arr[2102][210204]="沙河口区";
		$sub_arr[2102][210211]="甘井子区";
		$sub_arr[2102][210212]="旅顺口区";
		$sub_arr[2102][210213]="金州区";
		$sub_arr[2102][210224]="长海县";
		$sub_arr[2102][210281]="瓦房店市";
		$sub_arr[2102][210282]="普兰店市";
		$sub_arr[2102][210283]="庄河市";
		$l_arr[2103]="鞍山市";
		$sub_arr[2103];
		$sub_arr[2103][0]="请选择";
		$sub_arr[2103][210302]="铁东区";
		$sub_arr[2103][210303]="铁西区";
		$sub_arr[2103][210304]="立山区";
		$sub_arr[2103][210311]="千山区";
		$sub_arr[2103][210321]="台安县";
		$sub_arr[2103][210323]="岫岩县";
		$sub_arr[2103][210381]="海城市";
		$l_arr[2104]="抚顺市";
		$sub_arr[2104];
		$sub_arr[2104][0]="请选择";
		$sub_arr[2104][210402]="新抚区";
		$sub_arr[2104][210403]="东洲区";
		$sub_arr[2104][210404]="望花区";
		$sub_arr[2104][210411]="顺城区";
		$sub_arr[2104][210421]="抚顺县";
		$sub_arr[2104][210422]="新宾县";
		$sub_arr[2104][210423]="清原县";
		$l_arr[2105]="本溪市";
		$sub_arr[2105];
		$sub_arr[2105][0]="请选择";
		$sub_arr[2105][210502]="平山区";
		$sub_arr[2105][210503]="溪湖区";
		$sub_arr[2105][210504]="明山区";
		$sub_arr[2105][210505]="南芬区";
		$sub_arr[2105][210521]="本溪县";
		$sub_arr[2105][210522]="桓仁县";
		$l_arr[2106]="丹东市";
		$sub_arr[2106];
		$sub_arr[2106][0]="请选择";
		$sub_arr[2106][210602]="元宝区";
		$sub_arr[2106][210603]="振兴区";
		$sub_arr[2106][210604]="振安区";
		$sub_arr[2106][210624]="宽甸县";
		$sub_arr[2106][210681]="东港市";
		$sub_arr[2106][210682]="凤城市";
		$l_arr[2107]="锦州市";
		$sub_arr[2107];
		$sub_arr[2107][0]="请选择";
		$sub_arr[2107][210702]="古塔区";
		$sub_arr[2107][210703]="凌河区";
		$sub_arr[2107][210711]="太和区";
		$sub_arr[2107][210726]="黑山县";
		$sub_arr[2107][210727]="义县";
		$sub_arr[2107][210781]="凌海市";
		$sub_arr[2107][210782]="北镇市";
		$l_arr[2108]="营口市";
		$sub_arr[2108];
		$sub_arr[2108][0]="请选择";
		$sub_arr[2108][210802]="站前区";
		$sub_arr[2108][210803]="西市区";
		$sub_arr[2108][210804]="鲅鱼圈区";
		$sub_arr[2108][210811]="老边区";
		$sub_arr[2108][210881]="盖州市";
		$sub_arr[2108][210882]="大石桥市";
		$l_arr[2109]="阜新市";
		$sub_arr[2109];
		$sub_arr[2109][0]="请选择";
		$sub_arr[2109][210902]="海州区";
		$sub_arr[2109][210903]="新邱区";
		$sub_arr[2109][210904]="太平区";
		$sub_arr[2109][210905]="清河门区";
		$sub_arr[2109][210911]="细河区";
		$sub_arr[2109][210921]="阜新县";
		$sub_arr[2109][210922]="彰武县";
		$l_arr[2110]="辽阳市";
		$sub_arr[2110];
		$sub_arr[2110][0]="请选择";
		$sub_arr[2110][211002]="白塔区";
		$sub_arr[2110][211003]="文圣区";
		$sub_arr[2110][211004]="宏伟区";
		$sub_arr[2110][211005]="弓长岭区";
		$sub_arr[2110][211011]="太子河区";
		$sub_arr[2110][211021]="辽阳县";
		$sub_arr[2110][211081]="灯塔市";
		$l_arr[2111]="盘锦市";
		$sub_arr[2111];
		$sub_arr[2111][0]="请选择";
		$sub_arr[2111][211102]="双台子区";
		$sub_arr[2111][211103]="兴隆台区";
		$sub_arr[2111][211121]="大洼县";
		$sub_arr[2111][211122]="盘山县";
		$l_arr[2112]="铁岭市";
		$sub_arr[2112];
		$sub_arr[2112][0]="请选择";
		$sub_arr[2112][211202]="银州区";
		$sub_arr[2112][211204]="清河区";
		$sub_arr[2112][211221]="铁岭县";
		$sub_arr[2112][211223]="西丰县";
		$sub_arr[2112][211224]="昌图县";
		$sub_arr[2112][211281]="调兵山市";
		$sub_arr[2112][211282]="开原市";
		$l_arr[2113]="朝阳市";
		$sub_arr[2113];
		$sub_arr[2113][0]="请选择";
		$sub_arr[2113][211302]="双塔区";
		$sub_arr[2113][211303]="龙城区";
		$sub_arr[2113][211321]="朝阳县";
		$sub_arr[2113][211322]="建平县";
		$sub_arr[2113][211324]="喀喇沁";
		$sub_arr[2113][211381]="北票市";
		$sub_arr[2113][211382]="凌源市";
		$l_arr[2114]="葫芦岛市";
		$sub_arr[2114];
		$sub_arr[2114][0]="请选择";
		$sub_arr[2114][211402]="连山区";
		$sub_arr[2114][211403]="龙港区";
		$sub_arr[2114][211404]="南票区";
		$sub_arr[2114][211421]="绥中县";
		$sub_arr[2114][211422]="建昌县";
		$sub_arr[2114][211481]="兴城市";
		$sub_arr[2114][211491]="杨家杖子开发区";
		$l_arr[2201]="长春市";
		$sub_arr[2201];
		$sub_arr[2201][0]="请选择";
		$sub_arr[2201][220102]="南关区";
		$sub_arr[2201][220103]="宽城区";
		$sub_arr[2201][220104]="朝阳区";
		$sub_arr[2201][220105]="二道区";
		$sub_arr[2201][220106]="绿园区";
		$sub_arr[2201][220112]="双阳区";
		$sub_arr[2201][220122]="农安县";
		$sub_arr[2201][220181]="九台市";
		$sub_arr[2201][220182]="榆树市";
		$sub_arr[2201][220183]="德惠市";
		$l_arr[2202]="吉林市";
		$sub_arr[2202];
		$sub_arr[2202][0]="请选择";
		$sub_arr[2202][220202]="昌邑区";
		$sub_arr[2202][220203]="龙潭区";
		$sub_arr[2202][220204]="船营区";
		$sub_arr[2202][220211]="丰满区";
		$sub_arr[2202][220221]="永吉县";
		$sub_arr[2202][220281]="蛟河市";
		$sub_arr[2202][220282]="桦甸市";
		$sub_arr[2202][220283]="舒兰市";
		$sub_arr[2202][220284]="磐石市";
		$l_arr[2203]="四平市";
		$sub_arr[2203];
		$sub_arr[2203][0]="请选择";
		$sub_arr[2203][220302]="铁西区";
		$sub_arr[2203][220303]="铁东区";
		$sub_arr[2203][220322]="梨树县";
		$sub_arr[2203][220323]="伊通";
		$sub_arr[2203][220381]="公主岭市";
		$sub_arr[2203][220382]="双辽市";
		$l_arr[2204]="辽源市";
		$sub_arr[2204];
		$sub_arr[2204][0]="请选择";
		$sub_arr[2204][220402]="龙山区";
		$sub_arr[2204][220403]="西安区";
		$sub_arr[2204][220421]="东丰县";
		$sub_arr[2204][220422]="东辽县";
		$l_arr[2205]="通化市";
		$sub_arr[2205];
		$sub_arr[2205][0]="请选择";
		$sub_arr[2205][220502]="东昌区";
		$sub_arr[2205][220503]="二道江区";
		$sub_arr[2205][220521]="通化县";
		$sub_arr[2205][220523]="辉南县";
		$sub_arr[2205][220524]="柳河县";
		$sub_arr[2205][220581]="梅河口市";
		$sub_arr[2205][220582]="集安市";
		$l_arr[2206]="白山市";
		$sub_arr[2206];
		$sub_arr[2206][0]="请选择";
		$sub_arr[2206][220602]="八道江区";
		$sub_arr[2206][220605]="江源区";
		$sub_arr[2206][220621]="抚松县";
		$sub_arr[2206][220622]="靖宇县";
		$sub_arr[2206][220623]="长白县";
		$sub_arr[2206][220681]="临江市";
		$l_arr[2207]="松原市";
		$sub_arr[2207];
		$sub_arr[2207][0]="请选择";
		$sub_arr[2207][220702]="宁江区";
		$sub_arr[2207][220721]="前郭尔罗斯";
		$sub_arr[2207][220722]="长岭县";
		$sub_arr[2207][220723]="乾安县";
		$sub_arr[2207][220724]="扶余县";
		$l_arr[2208]="白城市";
		$sub_arr[2208];
		$sub_arr[2208][0]="请选择";
		$sub_arr[2208][220802]="洮北区";
		$sub_arr[2208][220821]="镇赉县";
		$sub_arr[2208][220822]="通榆县";
		$sub_arr[2208][220881]="洮南市";
		$sub_arr[2208][220882]="大安市";
		$l_arr[2224]="延边州";
		$sub_arr[2224];
		$sub_arr[2224][0]="请选择";
		$sub_arr[2224][222401]="延吉市";
		$sub_arr[2224][222402]="图们市";
		$sub_arr[2224][222403]="敦化市";
		$sub_arr[2224][222404]="珲春市";
		$sub_arr[2224][222405]="龙井市";
		$sub_arr[2224][222406]="和龙市";
		$sub_arr[2224][222424]="汪清县";
		$sub_arr[2224][222426]="安图县";
		$l_arr[2301]="哈尔滨市";
		$sub_arr[2301];
		$sub_arr[2301][0]="请选择";
		$sub_arr[2301][230102]="道里区";
		$sub_arr[2301][230103]="南岗区";
		$sub_arr[2301][230104]="道外区";
		$sub_arr[2301][230108]="平房区";
		$sub_arr[2301][230109]="松北区";
		$sub_arr[2301][230110]="香坊区";
		$sub_arr[2301][230111]="呼兰区";
		$sub_arr[2301][230112]="阿城区";
		$sub_arr[2301][230123]="依兰县";
		$sub_arr[2301][230124]="方正县";
		$sub_arr[2301][230125]="宾县";
		$sub_arr[2301][230126]="巴彦县";
		$sub_arr[2301][230127]="木兰县";
		$sub_arr[2301][230128]="通河县";
		$sub_arr[2301][230129]="延寿县";
		$sub_arr[2301][230182]="双城市";
		$sub_arr[2301][230183]="尚志市";
		$sub_arr[2301][230184]="五常市";
		$l_arr[2302]="齐齐哈尔市";
		$sub_arr[2302];
		$sub_arr[2302][0]="请选择";
		$sub_arr[2302][230202]="龙沙区";
		$sub_arr[2302][230203]="建华区";
		$sub_arr[2302][230204]="铁锋区";
		$sub_arr[2302][230205]="昂昂溪区";
		$sub_arr[2302][230206]="富拉尔基区";
		$sub_arr[2302][230207]="碾子山区";
		$sub_arr[2302][230208]="梅里斯达斡尔族区";
		$sub_arr[2302][230221]="龙江县";
		$sub_arr[2302][230223]="依安县";
		$sub_arr[2302][230224]="泰来县";
		$sub_arr[2302][230225]="甘南县";
		$sub_arr[2302][230227]="富裕县";
		$sub_arr[2302][230229]="克山县";
		$sub_arr[2302][230230]="克东县";
		$sub_arr[2302][230231]="拜泉县";
		$sub_arr[2302][230281]="讷河市";
		$l_arr[2303]="鸡西市";
		$sub_arr[2303];
		$sub_arr[2303][0]="请选择";
		$sub_arr[2303][230302]="鸡冠区";
		$sub_arr[2303][230303]="恒山区";
		$sub_arr[2303][230304]="滴道区";
		$sub_arr[2303][230305]="梨树区";
		$sub_arr[2303][230306]="城子河区";
		$sub_arr[2303][230307]="麻山区";
		$sub_arr[2303][230321]="鸡东县";
		$sub_arr[2303][230381]="虎林市";
		$sub_arr[2303][230382]="密山市";
		$l_arr[2304]="鹤岗市";
		$sub_arr[2304];
		$sub_arr[2304][0]="请选择";
		$sub_arr[2304][230402]="向阳区";
		$sub_arr[2304][230403]="工农区";
		$sub_arr[2304][230404]="南山区";
		$sub_arr[2304][230405]="兴安区";
		$sub_arr[2304][230406]="东山区";
		$sub_arr[2304][230407]="兴山区";
		$sub_arr[2304][230421]="萝北县";
		$sub_arr[2304][230422]="绥滨县";
		$l_arr[2305]="双鸭山市";
		$sub_arr[2305];
		$sub_arr[2305][0]="请选择";
		$sub_arr[2305][230502]="尖山区";
		$sub_arr[2305][230503]="岭东区";
		$sub_arr[2305][230505]="四方台区";
		$sub_arr[2305][230506]="宝山区";
		$sub_arr[2305][230521]="集贤县";
		$sub_arr[2305][230522]="友谊县";
		$sub_arr[2305][230523]="宝清县";
		$sub_arr[2305][230524]="饶河县";
		$l_arr[2306]="大庆市";
		$sub_arr[2306];
		$sub_arr[2306][0]="请选择";
		$sub_arr[2306][230602]="萨尔图区";
		$sub_arr[2306][230603]="龙凤区";
		$sub_arr[2306][230604]="让胡路区";
		$sub_arr[2306][230605]="红岗区";
		$sub_arr[2306][230606]="大同区";
		$sub_arr[2306][230621]="肇州县";
		$sub_arr[2306][230622]="肇源县";
		$sub_arr[2306][230623]="林甸县";
		$sub_arr[2306][230624]="杜尔伯特";
		$l_arr[2307]="伊春市";
		$sub_arr[2307];
		$sub_arr[2307][0]="请选择";
		$sub_arr[2307][230702]="伊春区";
		$sub_arr[2307][230703]="南岔区";
		$sub_arr[2307][230704]="友好区";
		$sub_arr[2307][230705]="西林区";
		$sub_arr[2307][230706]="翠峦区";
		$sub_arr[2307][230707]="新青区";
		$sub_arr[2307][230708]="美溪区";
		$sub_arr[2307][230709]="金山屯区";
		$sub_arr[2307][230710]="五营区";
		$sub_arr[2307][230711]="乌马河区";
		$sub_arr[2307][230712]="汤旺河区";
		$sub_arr[2307][230713]="带岭区";
		$sub_arr[2307][230714]="乌伊岭区";
		$sub_arr[2307][230715]="红星区";
		$sub_arr[2307][230716]="上甘岭区";
		$sub_arr[2307][230722]="嘉荫县";
		$sub_arr[2307][230781]="铁力市";
		$l_arr[2308]="佳木斯市";
		$sub_arr[2308];
		$sub_arr[2308][0]="请选择";
		$sub_arr[2308][230803]="向阳区";
		$sub_arr[2308][230804]="前进区";
		$sub_arr[2308][230805]="东风区";
		$sub_arr[2308][230811]="郊区";
		$sub_arr[2308][230822]="桦南县";
		$sub_arr[2308][230826]="桦川县";
		$sub_arr[2308][230828]="汤原县";
		$sub_arr[2308][230833]="抚远县";
		$sub_arr[2308][230881]="同江市";
		$sub_arr[2308][230882]="富锦市";
		$l_arr[2309]="七台河市";
		$sub_arr[2309];
		$sub_arr[2309][0]="请选择";
		$sub_arr[2309][230902]="新兴区";
		$sub_arr[2309][230903]="桃山区";
		$sub_arr[2309][230904]="茄子河区";
		$sub_arr[2309][230921]="勃利县";
		$l_arr[2310]="牡丹江市";
		$sub_arr[2310];
		$sub_arr[2310][0]="请选择";
		$sub_arr[2310][231002]="东安区";
		$sub_arr[2310][231003]="阳明区";
		$sub_arr[2310][231004]="爱民区";
		$sub_arr[2310][231005]="西安区";
		$sub_arr[2310][231024]="东宁县";
		$sub_arr[2310][231025]="林口县";
		$sub_arr[2310][231081]="绥芬河市";
		$sub_arr[2310][231083]="海林市";
		$sub_arr[2310][231084]="宁安市";
		$sub_arr[2310][231085]="穆棱市";
		$l_arr[2311]="黑河市";
		$sub_arr[2311];
		$sub_arr[2311][0]="请选择";
		$sub_arr[2311][231102]="爱辉区";
		$sub_arr[2311][231121]="嫩江县";
		$sub_arr[2311][231123]="逊克县";
		$sub_arr[2311][231124]="孙吴县";
		$sub_arr[2311][231181]="北安市";
		$sub_arr[2311][231182]="五大连池市";
		$l_arr[2312]="绥化市";
		$sub_arr[2312];
		$sub_arr[2312][0]="请选择";
		$sub_arr[2312][231202]="北林区";
		$sub_arr[2312][231221]="望奎县";
		$sub_arr[2312][231222]="兰西县";
		$sub_arr[2312][231223]="青冈县";
		$sub_arr[2312][231224]="庆安县";
		$sub_arr[2312][231225]="明水县";
		$sub_arr[2312][231226]="绥棱县";
		$sub_arr[2312][231281]="安达市";
		$sub_arr[2312][231282]="肇东市";
		$sub_arr[2312][231283]="海伦市";
		$l_arr[2327]="大兴安岭地区";
		$sub_arr[2327];
		$sub_arr[2327][0]="请选择";
		$sub_arr[2327][232701]="加格达奇区";
		$sub_arr[2327][232702]="松岭区";
		$sub_arr[2327][232703]="新林区";
		$sub_arr[2327][232704]="呼中区";
		$sub_arr[2327][232721]="呼玛县";
		$sub_arr[2327][232722]="塔河县";
		$sub_arr[2327][232723]="漠河县";
		$l_arr[3201]="南京市";
		$sub_arr[3201];
		$sub_arr[3201][0]="请选择";
		$sub_arr[3201][320102]="玄武区";
		$sub_arr[3201][320103]="白下区";
		$sub_arr[3201][320104]="秦淮区";
		$sub_arr[3201][320105]="建邺区";
		$sub_arr[3201][320106]="鼓楼区";
		$sub_arr[3201][320107]="下关区";
		$sub_arr[3201][320111]="浦口区";
		$sub_arr[3201][320113]="栖霞区";
		$sub_arr[3201][320114]="雨花台区";
		$sub_arr[3201][320115]="江宁区";
		$sub_arr[3201][320116]="六合区";
		$sub_arr[3201][320124]="溧水县";
		$sub_arr[3201][320125]="高淳县";
		$l_arr[3202]="无锡市";
		$sub_arr[3202];
		$sub_arr[3202][0]="请选择";
		$sub_arr[3202][320202]="崇安区";
		$sub_arr[3202][320203]="南长区";
		$sub_arr[3202][320204]="北塘区";
		$sub_arr[3202][320205]="锡山区";
		$sub_arr[3202][320206]="惠山区";
		$sub_arr[3202][320211]="滨湖区";
		$sub_arr[3202][320281]="江阴市";
		$sub_arr[3202][320282]="宜兴市";
		$l_arr[3203]="徐州市";
		$sub_arr[3203];
		$sub_arr[3203][0]="请选择";
		$sub_arr[3203][320302]="鼓楼区";
		$sub_arr[3203][320303]="云龙区";
		$sub_arr[3203][320304]="九里区";
		$sub_arr[3203][320305]="贾汪区";
		$sub_arr[3203][320311]="泉山区";
		$sub_arr[3203][320321]="丰县";
		$sub_arr[3203][320322]="沛县";
		$sub_arr[3203][320323]="铜山县";
		$sub_arr[3203][320324]="睢宁县";
		$sub_arr[3203][320381]="新沂市";
		$sub_arr[3203][320382]="邳州市";
		$l_arr[3204]="常州市";
		$sub_arr[3204];
		$sub_arr[3204][0]="请选择";
		$sub_arr[3204][320402]="天宁区";
		$sub_arr[3204][320404]="钟楼区";
		$sub_arr[3204][320405]="戚墅堰区";
		$sub_arr[3204][320411]="新北区";
		$sub_arr[3204][320412]="武进区";
		$sub_arr[3204][320481]="溧阳市";
		$sub_arr[3204][320482]="金坛市";
		$l_arr[3205]="苏州市";
		$sub_arr[3205];
		$sub_arr[3205][0]="请选择";
		$sub_arr[3205][320502]="沧浪区";
		$sub_arr[3205][320503]="平江区";
		$sub_arr[3205][320504]="金阊区";
		$sub_arr[3205][320505]="虎丘区";
		$sub_arr[3205][320506]="吴中区";
		$sub_arr[3205][320507]="相城区";
		$sub_arr[3205][320581]="常熟市";
		$sub_arr[3205][320582]="张家港市";
		$sub_arr[3205][320583]="昆山市";
		$sub_arr[3205][320584]="吴江市";
		$sub_arr[3205][320585]="太仓市";
		$l_arr[3206]="南通市";
		$sub_arr[3206];
		$sub_arr[3206][0]="请选择";
		$sub_arr[3206][320602]="崇川区";
		$sub_arr[3206][320611]="港闸区";
		$sub_arr[3206][320621]="海安县";
		$sub_arr[3206][320623]="如东县";
		$sub_arr[3206][320681]="启东市";
		$sub_arr[3206][320682]="如皋市";
		$sub_arr[3206][320683]="通州市";
		$sub_arr[3206][320684]="海门市";
		$l_arr[3207]="连云港市";
		$sub_arr[3207];
		$sub_arr[3207][0]="请选择";
		$sub_arr[3207][320703]="连云区";
		$sub_arr[3207][320705]="新浦区";
		$sub_arr[3207][320706]="海州区";
		$sub_arr[3207][320721]="赣榆县";
		$sub_arr[3207][320722]="东海县";
		$sub_arr[3207][320723]="灌云县";
		$sub_arr[3207][320724]="灌南县";
		$l_arr[3208]="淮安市";
		$sub_arr[3208];
		$sub_arr[3208][0]="请选择";
		$sub_arr[3208][320802]="清河区";
		$sub_arr[3208][320803]="楚州区";
		$sub_arr[3208][320804]="淮阴区";
		$sub_arr[3208][320811]="清浦区";
		$sub_arr[3208][320826]="涟水县";
		$sub_arr[3208][320829]="洪泽县";
		$sub_arr[3208][320830]="盱眙县";
		$sub_arr[3208][320831]="金湖县";
		$l_arr[3209]="盐城市";
		$sub_arr[3209];
		$sub_arr[3209][0]="请选择";
		$sub_arr[3209][320902]="亭湖区";
		$sub_arr[3209][320903]="盐都区";
		$sub_arr[3209][320921]="响水县";
		$sub_arr[3209][320922]="滨海县";
		$sub_arr[3209][320923]="阜宁县";
		$sub_arr[3209][320924]="射阳县";
		$sub_arr[3209][320925]="建湖县";
		$sub_arr[3209][320981]="东台市";
		$sub_arr[3209][320982]="大丰市";
		$l_arr[3210]="扬州市";
		$sub_arr[3210];
		$sub_arr[3210][0]="请选择";
		$sub_arr[3210][321002]="广陵区";
		$sub_arr[3210][321003]="邗江区";
		$sub_arr[3210][321011]="维扬区";
		$sub_arr[3210][321023]="宝应县";
		$sub_arr[3210][321081]="仪征市";
		$sub_arr[3210][321084]="高邮市";
		$sub_arr[3210][321088]="江都市";
		$l_arr[3211]="镇江市";
		$sub_arr[3211];
		$sub_arr[3211][0]="请选择";
		$sub_arr[3211][321102]="京口区";
		$sub_arr[3211][321111]="润州区";
		$sub_arr[3211][321112]="丹徒区";
		$sub_arr[3211][321181]="丹阳市";
		$sub_arr[3211][321182]="扬中市";
		$sub_arr[3211][321183]="句容市";
		$l_arr[3212]="泰州市";
		$sub_arr[3212];
		$sub_arr[3212][0]="请选择";
		$sub_arr[3212][321202]="海陵区";
		$sub_arr[3212][321203]="高港区";
		$sub_arr[3212][321281]="兴化市";
		$sub_arr[3212][321282]="靖江市";
		$sub_arr[3212][321283]="泰兴市";
		$sub_arr[3212][321284]="姜堰市";
		$l_arr[3213]="宿迁市";
		$sub_arr[3213];
		$sub_arr[3213][0]="请选择";
		$sub_arr[3213][321302]="宿城区";
		$sub_arr[3213][321311]="宿豫区";
		$sub_arr[3213][321322]="沭阳县";
		$sub_arr[3213][321323]="泗阳县";
		$sub_arr[3213][321324]="泗洪县";
		$l_arr[3301]="杭州市";
		$sub_arr[3301];
		$sub_arr[3301][0]="请选择";
		$sub_arr[3301][330102]="上城区";
		$sub_arr[3301][330103]="下城区";
		$sub_arr[3301][330104]="江干区";
		$sub_arr[3301][330105]="拱墅区";
		$sub_arr[3301][330106]="西湖区";
		$sub_arr[3301][330108]="滨江区";
		$sub_arr[3301][330109]="萧山区";
		$sub_arr[3301][330110]="余杭区";
		$sub_arr[3301][330122]="桐庐县";
		$sub_arr[3301][330127]="淳安县";
		$sub_arr[3301][330182]="建德市";
		$sub_arr[3301][330183]="富阳市";
		$sub_arr[3301][330185]="临安市";
		$l_arr[3302]="宁波市";
		$sub_arr[3302];
		$sub_arr[3302][0]="请选择";
		$sub_arr[3302][330203]="海曙区";
		$sub_arr[3302][330204]="江东区";
		$sub_arr[3302][330205]="江北区";
		$sub_arr[3302][330206]="北仑区";
		$sub_arr[3302][330211]="镇海区";
		$sub_arr[3302][330212]="鄞州区";
		$sub_arr[3302][330225]="象山县";
		$sub_arr[3302][330226]="宁海县";
		$sub_arr[3302][330281]="余姚市";
		$sub_arr[3302][330282]="慈溪市";
		$sub_arr[3302][330283]="奉化市";
		$l_arr[3303]="温州市";
		$sub_arr[3303];
		$sub_arr[3303][0]="请选择";
		$sub_arr[3303][330302]="鹿城区";
		$sub_arr[3303][330303]="龙湾区";
		$sub_arr[3303][330304]="瓯海区";
		$sub_arr[3303][330322]="洞头县";
		$sub_arr[3303][330324]="永嘉县";
		$sub_arr[3303][330326]="平阳县";
		$sub_arr[3303][330327]="苍南县";
		$sub_arr[3303][330328]="文成县";
		$sub_arr[3303][330329]="泰顺县";
		$sub_arr[3303][330381]="瑞安市";
		$sub_arr[3303][330382]="乐清市";
		$l_arr[3304]="嘉兴市";
		$sub_arr[3304];
		$sub_arr[3304][0]="请选择";
		$sub_arr[3304][330402]="南湖区";
		$sub_arr[3304][330411]="秀洲区";
		$sub_arr[3304][330421]="嘉善县";
		$sub_arr[3304][330424]="海盐县";
		$sub_arr[3304][330481]="海宁市";
		$sub_arr[3304][330482]="平湖市";
		$sub_arr[3304][330483]="桐乡市";
		$l_arr[3305]="湖州市";
		$sub_arr[3305];
		$sub_arr[3305][0]="请选择";
		$sub_arr[3305][330502]="吴兴区";
		$sub_arr[3305][330503]="南浔区";
		$sub_arr[3305][330521]="德清县";
		$sub_arr[3305][330522]="长兴县";
		$sub_arr[3305][330523]="安吉县";
		$l_arr[3306]="绍兴市";
		$sub_arr[3306];
		$sub_arr[3306][0]="请选择";
		$sub_arr[3306][330602]="越城区";
		$sub_arr[3306][330621]="绍兴县";
		$sub_arr[3306][330624]="新昌县";
		$sub_arr[3306][330681]="诸暨市";
		$sub_arr[3306][330682]="上虞市";
		$sub_arr[3306][330683]="嵊州市";
		$l_arr[3307]="金华市";
		$sub_arr[3307];
		$sub_arr[3307][0]="请选择";
		$sub_arr[3307][330702]="婺城区";
		$sub_arr[3307][330703]="金东区";
		$sub_arr[3307][330723]="武义县";
		$sub_arr[3307][330726]="浦江县";
		$sub_arr[3307][330727]="磐安县";
		$sub_arr[3307][330781]="兰溪市";
		$sub_arr[3307][330782]="义乌市";
		$sub_arr[3307][330783]="东阳市";
		$sub_arr[3307][330784]="永康市";
		$l_arr[3308]="衢州市";
		$sub_arr[3308];
		$sub_arr[3308][0]="请选择";
		$sub_arr[3308][330802]="柯城区";
		$sub_arr[3308][330803]="衢江区";
		$sub_arr[3308][330822]="常山县";
		$sub_arr[3308][330824]="开化县";
		$sub_arr[3308][330825]="龙游县";
		$sub_arr[3308][330881]="江山市";
		$l_arr[3309]="舟山市";
		$sub_arr[3309];
		$sub_arr[3309][0]="请选择";
		$sub_arr[3309][330902]="定海区";
		$sub_arr[3309][330903]="普陀区";
		$sub_arr[3309][330921]="岱山县";
		$sub_arr[3309][330922]="嵊泗县";
		$l_arr[3310]="台州市";
		$sub_arr[3310];
		$sub_arr[3310][0]="请选择";
		$sub_arr[3310][331002]="椒江区";
		$sub_arr[3310][331003]="黄岩区";
		$sub_arr[3310][331004]="路桥区";
		$sub_arr[3310][331021]="玉环县";
		$sub_arr[3310][331022]="三门县";
		$sub_arr[3310][331023]="天台县";
		$sub_arr[3310][331024]="仙居县";
		$sub_arr[3310][331081]="温岭市";
		$sub_arr[3310][331082]="临海市";
		$l_arr[3311]="丽水市";
		$sub_arr[3311];
		$sub_arr[3311][0]="请选择";
		$sub_arr[3311][331102]="莲都区";
		$sub_arr[3311][331121]="青田县";
		$sub_arr[3311][331122]="缙云县";
		$sub_arr[3311][331123]="遂昌县";
		$sub_arr[3311][331124]="松阳县";
		$sub_arr[3311][331125]="云和县";
		$sub_arr[3311][331126]="庆元县";
		$sub_arr[3311][331127]="景宁";
		$sub_arr[3311][331181]="龙泉市";
		$l_arr[3401]="合肥市";
		$sub_arr[3401];
		$sub_arr[3401][0]="请选择";
		$sub_arr[3401][340102]="瑶海区";
		$sub_arr[3401][340103]="庐阳区";
		$sub_arr[3401][340104]="蜀山区";
		$sub_arr[3401][340105]="新站区";
		$sub_arr[3401][340106]="高新区";
		$sub_arr[3401][340107]="经开区";
		$sub_arr[3401][340111]="包河区";
		$sub_arr[3401][340121]="长丰县";
		$sub_arr[3401][340122]="肥东县";
		$sub_arr[3401][340123]="肥西县";
		$l_arr[3402]="芜湖市";
		$sub_arr[3402];
		$sub_arr[3402][0]="请选择";
		$sub_arr[3402][340202]="镜湖区";
		$sub_arr[3402][340203]="弋江区";
		$sub_arr[3402][340207]="鸠江区";
		$sub_arr[3402][340208]="三山区";
		$sub_arr[3402][340221]="芜湖县";
		$sub_arr[3402][340222]="繁昌县";
		$sub_arr[3402][340223]="南陵县";
		$l_arr[3403]="蚌埠市";
		$sub_arr[3403];
		$sub_arr[3403][0]="请选择";
		$sub_arr[3403][340302]="龙子湖区";
		$sub_arr[3403][340303]="蚌山区";
		$sub_arr[3403][340304]="禹会区";
		$sub_arr[3403][340311]="淮上区";
		$sub_arr[3403][340321]="怀远县";
		$sub_arr[3403][340322]="五河县";
		$sub_arr[3403][340323]="固镇县";
		$l_arr[3404]="淮南市";
		$sub_arr[3404];
		$sub_arr[3404][0]="请选择";
		$sub_arr[3404][340402]="大通区";
		$sub_arr[3404][340403]="田家庵区";
		$sub_arr[3404][340404]="谢家集区";
		$sub_arr[3404][340405]="八公山区";
		$sub_arr[3404][340406]="潘集区";
		$sub_arr[3404][340421]="凤台县";
		$l_arr[3405]="马鞍山市";
		$sub_arr[3405];
		$sub_arr[3405][0]="请选择";
		$sub_arr[3405][340502]="金家庄区";
		$sub_arr[3405][340503]="花山区";
		$sub_arr[3405][340504]="雨山区";
		$sub_arr[3405][340505]="开发区";
		$sub_arr[3405][340506]="博望新区";
		$sub_arr[3405][340507]="示范园区";
		$sub_arr[3405][340521]="当涂县";
		$sub_arr[3405][340522]="含山县";
		$sub_arr[3405][340523]="和县";
		$l_arr[3406]="淮北市";
		$sub_arr[3406];
		$sub_arr[3406][0]="请选择";
		$sub_arr[3406][340602]="杜集区";
		$sub_arr[3406][340603]="相山区";
		$sub_arr[3406][340604]="烈山区";
		$sub_arr[3406][340621]="濉溪县";
		$l_arr[3407]="铜陵市";
		$sub_arr[3407];
		$sub_arr[3407][0]="请选择";
		$sub_arr[3407][340702]="铜官山区";
		$sub_arr[3407][340703]="狮子山区";
		$sub_arr[3407][340711]="郊区";
		$sub_arr[3407][340721]="铜陵县";
		$l_arr[3408]="安庆市";
		$sub_arr[3408];
		$sub_arr[3408][0]="请选择";
		$sub_arr[3408][340802]="迎江区";
		$sub_arr[3408][340803]="大观区";
		$sub_arr[3408][340811]="宜秀区";
		$sub_arr[3408][340822]="怀宁县";
		$sub_arr[3408][340823]="枞阳县";
		$sub_arr[3408][340824]="潜山县";
		$sub_arr[3408][340825]="太湖县";
		$sub_arr[3408][340826]="宿松县";
		$sub_arr[3408][340827]="望江县";
		$sub_arr[3408][340828]="岳西县";
		$sub_arr[3408][340881]="桐城市";
		$l_arr[3410]="黄山市";
		$sub_arr[3410];
		$sub_arr[3410][0]="请选择";
		$sub_arr[3410][341002]="屯溪区";
		$sub_arr[3410][341003]="黄山区";
		$sub_arr[3410][341004]="徽州区";
		$sub_arr[3410][341021]="歙县";
		$sub_arr[3410][341022]="休宁县";
		$sub_arr[3410][341023]="黟县";
		$sub_arr[3410][341024]="祁门县";
		$l_arr[3411]="滁州市";
		$sub_arr[3411];
		$sub_arr[3411][0]="请选择";
		$sub_arr[3411][341102]="琅琊区";
		$sub_arr[3411][341103]="南谯区";
		$sub_arr[3411][341122]="来安县";
		$sub_arr[3411][341124]="全椒县";
		$sub_arr[3411][341125]="定远县";
		$sub_arr[3411][341126]="凤阳县";
		$sub_arr[3411][341181]="天长市";
		$sub_arr[3411][341182]="明光市";
		$l_arr[3412]="阜阳市";
		$sub_arr[3412];
		$sub_arr[3412][0]="请选择";
		$sub_arr[3412][341202]="颍州区";
		$sub_arr[3412][341203]="颍东区";
		$sub_arr[3412][341204]="颍泉区";
		$sub_arr[3412][341221]="临泉县";
		$sub_arr[3412][341222]="太和县";
		$sub_arr[3412][341225]="阜南县";
		$sub_arr[3412][341226]="颍上县";
		$sub_arr[3412][341282]="界首市";
		$l_arr[3413]="宿州市";
		$sub_arr[3413];
		$sub_arr[3413][0]="请选择";
		$sub_arr[3413][341302]="埇桥区";
		$sub_arr[3413][341321]="砀山县";
		$sub_arr[3413][341322]="萧县";
		$sub_arr[3413][341323]="灵璧县";
		$sub_arr[3413][341324]="泗县";
		$l_arr[3414]="巢湖市";
		$sub_arr[3414];
		$sub_arr[3414][0]="请选择";
		$sub_arr[3414][341402]="居巢区";
		$sub_arr[3414][341421]="庐江县";
		$sub_arr[3414][341422]="无为县";
		$sub_arr[3414][341423]="和县";
		$l_arr[3415]="六安市";
		$sub_arr[3415];
		$sub_arr[3415][0]="请选择";
		$sub_arr[3415][341502]="金安区";
		$sub_arr[3415][341503]="裕安区";
		$sub_arr[3415][341521]="寿县";
		$sub_arr[3415][341522]="霍邱县";
		$sub_arr[3415][341523]="舒城县";
		$sub_arr[3415][341524]="金寨县";
		$sub_arr[3415][341525]="霍山县";
		$l_arr[3416]="亳州市";
		$sub_arr[3416];
		$sub_arr[3416][0]="请选择";
		$sub_arr[3416][341602]="谯城区";
		$sub_arr[3416][341621]="涡阳县";
		$sub_arr[3416][341622]="蒙城县";
		$sub_arr[3416][341623]="利辛县";
		$l_arr[3417]="池州市";
		$sub_arr[3417];
		$sub_arr[3417][0]="请选择";
		$sub_arr[3417][341702]="贵池区";
		$sub_arr[3417][341721]="东至县";
		$sub_arr[3417][341722]="石台县";
		$sub_arr[3417][341723]="青阳县";
		$l_arr[3418]="宣城市";
		$sub_arr[3418];
		$sub_arr[3418][0]="请选择";
		$sub_arr[3418][341802]="宣州区";
		$sub_arr[3418][341821]="郎溪县";
		$sub_arr[3418][341822]="广德县";
		$sub_arr[3418][341823]="泾县";
		$sub_arr[3418][341824]="绩溪县";
		$sub_arr[3418][341825]="旌德县";
		$sub_arr[3418][341881]="宁国市";
		$l_arr[3501]="福州市";
		$sub_arr[3501];
		$sub_arr[3501][0]="请选择";
		$sub_arr[3501][350102]="鼓楼区";
		$sub_arr[3501][350103]="台江区";
		$sub_arr[3501][350104]="仓山区";
		$sub_arr[3501][350105]="马尾区";
		$sub_arr[3501][350111]="晋安区";
		$sub_arr[3501][350121]="闽侯县";
		$sub_arr[3501][350122]="连江县";
		$sub_arr[3501][350123]="罗源县";
		$sub_arr[3501][350124]="闽清县";
		$sub_arr[3501][350125]="永泰县";
		$sub_arr[3501][350128]="平潭县";
		$sub_arr[3501][350181]="福清市";
		$sub_arr[3501][350182]="长乐市";
		$l_arr[3502]="厦门市";
		$sub_arr[3502];
		$sub_arr[3502][0]="请选择";
		$sub_arr[3502][350203]="思明区";
		$sub_arr[3502][350205]="海沧区";
		$sub_arr[3502][350206]="湖里区";
		$sub_arr[3502][350211]="集美区";
		$sub_arr[3502][350212]="同安区";
		$sub_arr[3502][350213]="翔安区";
		$l_arr[3503]="莆田市";
		$sub_arr[3503];
		$sub_arr[3503][0]="请选择";
		$sub_arr[3503][350302]="城厢区";
		$sub_arr[3503][350303]="涵江区";
		$sub_arr[3503][350304]="荔城区";
		$sub_arr[3503][350305]="秀屿区";
		$sub_arr[3503][350322]="仙游县";
		$l_arr[3504]="三明市";
		$sub_arr[3504];
		$sub_arr[3504][0]="请选择";
		$sub_arr[3504][350402]="梅列区";
		$sub_arr[3504][350403]="三元区";
		$sub_arr[3504][350421]="明溪县";
		$sub_arr[3504][350423]="清流县";
		$sub_arr[3504][350424]="宁化县";
		$sub_arr[3504][350425]="大田县";
		$sub_arr[3504][350426]="尤溪县";
		$sub_arr[3504][350427]="沙县";
		$sub_arr[3504][350428]="将乐县";
		$sub_arr[3504][350429]="泰宁县";
		$sub_arr[3504][350430]="建宁县";
		$sub_arr[3504][350481]="永安市";
		$l_arr[3505]="泉州市";
		$sub_arr[3505];
		$sub_arr[3505][0]="请选择";
		$sub_arr[3505][350502]="鲤城区";
		$sub_arr[3505][350503]="丰泽区";
		$sub_arr[3505][350504]="洛江区";
		$sub_arr[3505][350505]="泉港区";
		$sub_arr[3505][350521]="惠安县";
		$sub_arr[3505][350524]="安溪县";
		$sub_arr[3505][350525]="永春县";
		$sub_arr[3505][350526]="德化县";
		$sub_arr[3505][350527]="金门县";
		$sub_arr[3505][350581]="石狮市";
		$sub_arr[3505][350582]="晋江市";
		$sub_arr[3505][350583]="南安市";
		$l_arr[3506]="漳州市";
		$sub_arr[3506];
		$sub_arr[3506][0]="请选择";
		$sub_arr[3506][350602]="芗城区";
		$sub_arr[3506][350603]="龙文区";
		$sub_arr[3506][350622]="云霄县";
		$sub_arr[3506][350623]="漳浦县";
		$sub_arr[3506][350624]="诏安县";
		$sub_arr[3506][350625]="长泰县";
		$sub_arr[3506][350626]="东山县";
		$sub_arr[3506][350627]="南靖县";
		$sub_arr[3506][350628]="平和县";
		$sub_arr[3506][350629]="华安县";
		$sub_arr[3506][350681]="龙海市";
		$l_arr[3507]="南平市";
		$sub_arr[3507];
		$sub_arr[3507][0]="请选择";
		$sub_arr[3507][350702]="延平区";
		$sub_arr[3507][350721]="顺昌县";
		$sub_arr[3507][350722]="浦城县";
		$sub_arr[3507][350723]="光泽县";
		$sub_arr[3507][350724]="松溪县";
		$sub_arr[3507][350725]="政和县";
		$sub_arr[3507][350781]="邵武市";
		$sub_arr[3507][350782]="武夷山市";
		$sub_arr[3507][350783]="建瓯市";
		$sub_arr[3507][350784]="建阳市";
		$l_arr[3508]="龙岩市";
		$sub_arr[3508];
		$sub_arr[3508][0]="请选择";
		$sub_arr[3508][350802]="新罗区";
		$sub_arr[3508][350821]="长汀县";
		$sub_arr[3508][350822]="永定县";
		$sub_arr[3508][350823]="上杭县";
		$sub_arr[3508][350824]="武平县";
		$sub_arr[3508][350825]="连城县";
		$sub_arr[3508][350881]="漳平市";
		$l_arr[3509]="宁德市";
		$sub_arr[3509];
		$sub_arr[3509][0]="请选择";
		$sub_arr[3509][350902]="蕉城区";
		$sub_arr[3509][350921]="霞浦县";
		$sub_arr[3509][350922]="古田县";
		$sub_arr[3509][350923]="屏南县";
		$sub_arr[3509][350924]="寿宁县";
		$sub_arr[3509][350925]="周宁县";
		$sub_arr[3509][350926]="柘荣县";
		$sub_arr[3509][350981]="福安市";
		$sub_arr[3509][350982]="福鼎市";
		$l_arr[3601]="南昌市";
		$sub_arr[3601];
		$sub_arr[3601][0]="请选择";
		$sub_arr[3601][360102]="东湖区";
		$sub_arr[3601][360103]="西湖区";
		$sub_arr[3601][360104]="青云谱区";
		$sub_arr[3601][360105]="湾里区";
		$sub_arr[3601][360111]="青山湖区";
		$sub_arr[3601][360121]="南昌县";
		$sub_arr[3601][360122]="新建县";
		$sub_arr[3601][360123]="安义县";
		$sub_arr[3601][360124]="进贤县";
		$l_arr[3602]="景德镇市";
		$sub_arr[3602];
		$sub_arr[3602][0]="请选择";
		$sub_arr[3602][360202]="昌江区";
		$sub_arr[3602][360203]="珠山区";
		$sub_arr[3602][360222]="浮梁县";
		$sub_arr[3602][360281]="乐平市";
		$l_arr[3603]="萍乡市";
		$sub_arr[3603];
		$sub_arr[3603][0]="请选择";
		$sub_arr[3603][360302]="安源区";
		$sub_arr[3603][360313]="湘东区";
		$sub_arr[3603][360321]="莲花县";
		$sub_arr[3603][360322]="上栗县";
		$sub_arr[3603][360323]="芦溪县";
		$l_arr[3604]="九江市";
		$sub_arr[3604];
		$sub_arr[3604][0]="请选择";
		$sub_arr[3604][360402]="庐山区";
		$sub_arr[3604][360403]="浔阳区";
		$sub_arr[3604][360421]="九江县";
		$sub_arr[3604][360423]="武宁县";
		$sub_arr[3604][360424]="修水县";
		$sub_arr[3604][360425]="永修县";
		$sub_arr[3604][360426]="德安县";
		$sub_arr[3604][360427]="星子县";
		$sub_arr[3604][360428]="都昌县";
		$sub_arr[3604][360429]="湖口县";
		$sub_arr[3604][360430]="彭泽县";
		$sub_arr[3604][360481]="瑞昌市";
		$l_arr[3605]="新余市";
		$sub_arr[3605];
		$sub_arr[3605][0]="请选择";
		$sub_arr[3605][360502]="渝水区";
		$sub_arr[3605][360521]="分宜县";
		$l_arr[3606]="鹰潭市";
		$sub_arr[3606];
		$sub_arr[3606][0]="请选择";
		$sub_arr[3606][360602]="月湖区";
		$sub_arr[3606][360622]="余江县";
		$sub_arr[3606][360681]="贵溪市";
		$l_arr[3607]="赣州市";
		$sub_arr[3607];
		$sub_arr[3607][0]="请选择";
		$sub_arr[3607][360702]="章贡区";
		$sub_arr[3607][360721]="赣县";
		$sub_arr[3607][360722]="信丰县";
		$sub_arr[3607][360723]="大余县";
		$sub_arr[3607][360724]="上犹县";
		$sub_arr[3607][360725]="崇义县";
		$sub_arr[3607][360726]="安远县";
		$sub_arr[3607][360727]="龙南县";
		$sub_arr[3607][360728]="定南县";
		$sub_arr[3607][360729]="全南县";
		$sub_arr[3607][360730]="宁都县";
		$sub_arr[3607][360731]="于都县";
		$sub_arr[3607][360732]="兴国县";
		$sub_arr[3607][360733]="会昌县";
		$sub_arr[3607][360734]="寻乌县";
		$sub_arr[3607][360735]="石城县";
		$sub_arr[3607][360781]="瑞金市";
		$sub_arr[3607][360782]="南康市";
		$l_arr[3608]="吉安市";
		$sub_arr[3608];
		$sub_arr[3608][0]="请选择";
		$sub_arr[3608][360802]="吉州区";
		$sub_arr[3608][360803]="青原区";
		$sub_arr[3608][360821]="吉安县";
		$sub_arr[3608][360822]="吉水县";
		$sub_arr[3608][360823]="峡江县";
		$sub_arr[3608][360824]="新干县";
		$sub_arr[3608][360825]="永丰县";
		$sub_arr[3608][360826]="泰和县";
		$sub_arr[3608][360827]="遂川县";
		$sub_arr[3608][360828]="万安县";
		$sub_arr[3608][360829]="安福县";
		$sub_arr[3608][360830]="永新县";
		$sub_arr[3608][360881]="井冈山市";
		$l_arr[3609]="宜春市";
		$sub_arr[3609];
		$sub_arr[3609][0]="请选择";
		$sub_arr[3609][360902]="袁州区";
		$sub_arr[3609][360921]="奉新县";
		$sub_arr[3609][360922]="万载县";
		$sub_arr[3609][360923]="上高县";
		$sub_arr[3609][360924]="宜丰县";
		$sub_arr[3609][360925]="靖安县";
		$sub_arr[3609][360926]="铜鼓县";
		$sub_arr[3609][360981]="丰城市";
		$sub_arr[3609][360982]="樟树市";
		$sub_arr[3609][360983]="高安市";
		$l_arr[3610]="抚州市";
		$sub_arr[3610];
		$sub_arr[3610][0]="请选择";
		$sub_arr[3610][361002]="临川区";
		$sub_arr[3610][361021]="南城县";
		$sub_arr[3610][361022]="黎川县";
		$sub_arr[3610][361023]="南丰县";
		$sub_arr[3610][361024]="崇仁县";
		$sub_arr[3610][361025]="乐安县";
		$sub_arr[3610][361026]="宜黄县";
		$sub_arr[3610][361027]="金溪县";
		$sub_arr[3610][361028]="资溪县";
		$sub_arr[3610][361029]="东乡县";
		$sub_arr[3610][361030]="广昌县";
		$l_arr[3611]="上饶市";
		$sub_arr[3611];
		$sub_arr[3611][0]="请选择";
		$sub_arr[3611][361102]="信州区";
		$sub_arr[3611][361121]="上饶县";
		$sub_arr[3611][361122]="广丰县";
		$sub_arr[3611][361123]="玉山县";
		$sub_arr[3611][361124]="铅山县";
		$sub_arr[3611][361125]="横峰县";
		$sub_arr[3611][361126]="弋阳县";
		$sub_arr[3611][361127]="余干县";
		$sub_arr[3611][361128]="鄱阳县";
		$sub_arr[3611][361129]="万年县";
		$sub_arr[3611][361130]="婺源县";
		$sub_arr[3611][361181]="德兴市";
		$l_arr[3701]="济南市";
		$sub_arr[3701];
		$sub_arr[3701][0]="请选择";
		$sub_arr[3701][370102]="历下区";
		$sub_arr[3701][370103]="市中区";
		$sub_arr[3701][370104]="槐荫区";
		$sub_arr[3701][370105]="天桥区";
		$sub_arr[3701][370106]="高新区";
		$sub_arr[3701][370112]="历城区";
		$sub_arr[3701][370113]="长清区";
		$sub_arr[3701][370124]="平阴县";
		$sub_arr[3701][370125]="济阳县";
		$sub_arr[3701][370126]="商河县";
		$sub_arr[3701][370181]="章丘市";
		$l_arr[3702]="青岛市";
		$sub_arr[3702];
		$sub_arr[3702][0]="请选择";
		$sub_arr[3702][370202]="市南区";
		$sub_arr[3702][370203]="市北区";
		$sub_arr[3702][370205]="四方区";
		$sub_arr[3702][370211]="黄岛区";
		$sub_arr[3702][370212]="崂山区";
		$sub_arr[3702][370213]="李沧区";
		$sub_arr[3702][370214]="城阳区";
		$sub_arr[3702][370281]="胶州市";
		$sub_arr[3702][370282]="即墨市";
		$sub_arr[3702][370283]="平度市";
		$sub_arr[3702][370284]="胶南市";
		$sub_arr[3702][370285]="莱西市";
		$l_arr[3703]="淄博市";
		$sub_arr[3703];
		$sub_arr[3703][0]="请选择";
		$sub_arr[3703][370302]="淄川区";
		$sub_arr[3703][370303]="张店区";
		$sub_arr[3703][370304]="博山区";
		$sub_arr[3703][370305]="临淄区";
		$sub_arr[3703][370306]="周村区";
		$sub_arr[3703][370321]="桓台县";
		$sub_arr[3703][370322]="高青县";
		$sub_arr[3703][370323]="沂源县";
		$l_arr[3704]="枣庄市";
		$sub_arr[3704];
		$sub_arr[3704][0]="请选择";
		$sub_arr[3704][370402]="市中区";
		$sub_arr[3704][370403]="薛城区";
		$sub_arr[3704][370404]="峄城区";
		$sub_arr[3704][370405]="台儿庄区";
		$sub_arr[3704][370406]="山亭区";
		$sub_arr[3704][370481]="滕州市";
		$l_arr[3705]="东营市";
		$sub_arr[3705];
		$sub_arr[3705][0]="请选择";
		$sub_arr[3705][370502]="东营区";
		$sub_arr[3705][370503]="河口区";
		$sub_arr[3705][370521]="垦利县";
		$sub_arr[3705][370522]="利津县";
		$sub_arr[3705][370523]="广饶县";
		$l_arr[3706]="烟台市";
		$sub_arr[3706];
		$sub_arr[3706][0]="请选择";
		$sub_arr[3706][370602]="芝罘区";
		$sub_arr[3706][370611]="福山区";
		$sub_arr[3706][370612]="牟平区";
		$sub_arr[3706][370613]="莱山区";
		$sub_arr[3706][370634]="长岛县";
		$sub_arr[3706][370681]="龙口市";
		$sub_arr[3706][370682]="莱阳市";
		$sub_arr[3706][370683]="莱州市";
		$sub_arr[3706][370684]="蓬莱市";
		$sub_arr[3706][370685]="招远市";
		$sub_arr[3706][370686]="栖霞市";
		$sub_arr[3706][370687]="海阳市";
		$l_arr[3707]="潍坊市";
		$sub_arr[3707];
		$sub_arr[3707][0]="请选择";
		$sub_arr[3707][370702]="潍城区";
		$sub_arr[3707][370703]="寒亭区";
		$sub_arr[3707][370704]="坊子区";
		$sub_arr[3707][370705]="奎文区";
		$sub_arr[3707][370724]="临朐县";
		$sub_arr[3707][370725]="昌乐县";
		$sub_arr[3707][370781]="青州市";
		$sub_arr[3707][370782]="诸城市";
		$sub_arr[3707][370783]="寿光市";
		$sub_arr[3707][370784]="安丘市";
		$sub_arr[3707][370785]="高密市";
		$sub_arr[3707][370786]="昌邑市";
		$l_arr[3708]="济宁市";
		$sub_arr[3708];
		$sub_arr[3708][0]="请选择";
		$sub_arr[3708][370802]="市中区";
		$sub_arr[3708][370811]="任城区";
		$sub_arr[3708][370826]="微山县";
		$sub_arr[3708][370827]="鱼台县";
		$sub_arr[3708][370828]="金乡县";
		$sub_arr[3708][370829]="嘉祥县";
		$sub_arr[3708][370830]="汶上县";
		$sub_arr[3708][370831]="泗水县";
		$sub_arr[3708][370832]="梁山县";
		$sub_arr[3708][370881]="曲阜市";
		$sub_arr[3708][370882]="兖州市";
		$sub_arr[3708][370883]="邹城市";
		$l_arr[3709]="泰安市";
		$sub_arr[3709];
		$sub_arr[3709][0]="请选择";
		$sub_arr[3709][370902]="泰山区";
		$sub_arr[3709][370911]="岱岳区";
		$sub_arr[3709][370921]="宁阳县";
		$sub_arr[3709][370923]="东平县";
		$sub_arr[3709][370982]="新泰市";
		$sub_arr[3709][370983]="肥城市";
		$l_arr[3710]="威海市";
		$sub_arr[3710];
		$sub_arr[3710][0]="请选择";
		$sub_arr[3710][371002]="环翠区";
		$sub_arr[3710][371081]="文登市";
		$sub_arr[3710][371082]="荣成市";
		$sub_arr[3710][371083]="乳山市";
		$l_arr[3711]="日照市";
		$sub_arr[3711];
		$sub_arr[3711][0]="请选择";
		$sub_arr[3711][371102]="东港区";
		$sub_arr[3711][371103]="岚山区";
		$sub_arr[3711][371121]="五莲县";
		$sub_arr[3711][371122]="莒县";
		$l_arr[3712]="莱芜市";
		$sub_arr[3712];
		$sub_arr[3712][0]="请选择";
		$sub_arr[3712][371202]="莱城区";
		$sub_arr[3712][371203]="钢城区";
		$l_arr[3713]="临沂市";
		$sub_arr[3713];
		$sub_arr[3713][0]="请选择";
		$sub_arr[3713][371302]="兰山区";
		$sub_arr[3713][371311]="罗庄区";
		$sub_arr[3713][371312]="河东区";
		$sub_arr[3713][371321]="沂南县";
		$sub_arr[3713][371322]="郯城县";
		$sub_arr[3713][371323]="沂水县";
		$sub_arr[3713][371324]="苍山县";
		$sub_arr[3713][371325]="费县";
		$sub_arr[3713][371326]="平邑县";
		$sub_arr[3713][371327]="莒南县";
		$sub_arr[3713][371328]="蒙阴县";
		$sub_arr[3713][371329]="临沭县";
		$l_arr[3714]="德州市";
		$sub_arr[3714];
		$sub_arr[3714][0]="请选择";
		$sub_arr[3714][371402]="德城区";
		$sub_arr[3714][371421]="陵县";
		$sub_arr[3714][371422]="宁津县";
		$sub_arr[3714][371423]="庆云县";
		$sub_arr[3714][371424]="临邑县";
		$sub_arr[3714][371425]="齐河县";
		$sub_arr[3714][371426]="平原县";
		$sub_arr[3714][371427]="夏津县";
		$sub_arr[3714][371428]="武城县";
		$sub_arr[3714][371481]="乐陵市";
		$sub_arr[3714][371482]="禹城市";
		$l_arr[3715]="聊城市";
		$sub_arr[3715];
		$sub_arr[3715][0]="请选择";
		$sub_arr[3715][371502]="东昌府区";
		$sub_arr[3715][371521]="阳谷县";
		$sub_arr[3715][371522]="莘县";
		$sub_arr[3715][371523]="茌平县";
		$sub_arr[3715][371524]="东阿县";
		$sub_arr[3715][371525]="冠县";
		$sub_arr[3715][371526]="高唐县";
		$sub_arr[3715][371581]="临清市";
		$l_arr[3716]="滨州市";
		$sub_arr[3716];
		$sub_arr[3716][0]="请选择";
		$sub_arr[3716][371602]="滨城区";
		$sub_arr[3716][371621]="惠民县";
		$sub_arr[3716][371622]="阳信县";
		$sub_arr[3716][371623]="无棣县";
		$sub_arr[3716][371624]="沾化县";
		$sub_arr[3716][371625]="博兴县";
		$sub_arr[3716][371626]="邹平县";
		$l_arr[3717]="菏泽市";
		$sub_arr[3717];
		$sub_arr[3717][0]="请选择";
		$sub_arr[3717][371702]="牡丹区";
		$sub_arr[3717][371721]="曹县";
		$sub_arr[3717][371722]="单县";
		$sub_arr[3717][371723]="成武县";
		$sub_arr[3717][371724]="巨野县";
		$sub_arr[3717][371725]="郓城县";
		$sub_arr[3717][371726]="鄄城县";
		$sub_arr[3717][371727]="定陶县";
		$sub_arr[3717][371728]="东明县";
		$l_arr[4101]="郑州市";
		$sub_arr[4101];
		$sub_arr[4101][0]="请选择";
		$sub_arr[4101][410102]="中原区";
		$sub_arr[4101][410103]="二七区";
		$sub_arr[4101][410104]="管城";
		$sub_arr[4101][410105]="金水区";
		$sub_arr[4101][410106]="上街区";
		$sub_arr[4101][410108]="惠济区";
		$sub_arr[4101][410109]="高新区";
		$sub_arr[4101][410122]="中牟县";
		$sub_arr[4101][410181]="巩义市";
		$sub_arr[4101][410182]="荥阳市";
		$sub_arr[4101][410183]="新密市";
		$sub_arr[4101][410184]="新郑市";
		$sub_arr[4101][410185]="登封市";
		$l_arr[4102]="开封市";
		$sub_arr[4102];
		$sub_arr[4102][0]="请选择";
		$sub_arr[4102][410202]="龙亭区";
		$sub_arr[4102][410203]="顺河回族区";
		$sub_arr[4102][410204]="鼓楼区";
		$sub_arr[4102][410205]="禹王台区";
		$sub_arr[4102][410211]="金明区";
		$sub_arr[4102][410221]="杞县";
		$sub_arr[4102][410222]="通许县";
		$sub_arr[4102][410223]="尉氏县";
		$sub_arr[4102][410224]="开封县";
		$sub_arr[4102][410225]="兰考县";
		$l_arr[4103]="洛阳市";
		$sub_arr[4103];
		$sub_arr[4103][0]="请选择";
		$sub_arr[4103][410302]="老城区";
		$sub_arr[4103][410303]="西工区";
		$sub_arr[4103][410304]="瀍河回族区";
		$sub_arr[4103][410305]="涧西区";
		$sub_arr[4103][410306]="吉利区";
		$sub_arr[4103][410311]="洛龙区";
		$sub_arr[4103][410322]="孟津县";
		$sub_arr[4103][410323]="新安县";
		$sub_arr[4103][410324]="栾川县";
		$sub_arr[4103][410325]="嵩县";
		$sub_arr[4103][410326]="汝阳县";
		$sub_arr[4103][410327]="宜阳县";
		$sub_arr[4103][410328]="洛宁县";
		$sub_arr[4103][410329]="伊川县";
		$sub_arr[4103][410381]="偃师市";
		$l_arr[4104]="平顶山市";
		$sub_arr[4104];
		$sub_arr[4104][0]="请选择";
		$sub_arr[4104][410402]="新华区";
		$sub_arr[4104][410403]="卫东区";
		$sub_arr[4104][410404]="石龙区";
		$sub_arr[4104][410411]="湛河区";
		$sub_arr[4104][410421]="宝丰县";
		$sub_arr[4104][410422]="叶县";
		$sub_arr[4104][410423]="鲁山县";
		$sub_arr[4104][410425]="郏县";
		$sub_arr[4104][410481]="舞钢市";
		$sub_arr[4104][410482]="汝州市";
		$l_arr[4105]="安阳市";
		$sub_arr[4105];
		$sub_arr[4105][0]="请选择";
		$sub_arr[4105][410502]="文峰区";
		$sub_arr[4105][410503]="北关区";
		$sub_arr[4105][410505]="殷都区";
		$sub_arr[4105][410506]="龙安区";
		$sub_arr[4105][410522]="安阳县";
		$sub_arr[4105][410523]="汤阴县";
		$sub_arr[4105][410526]="滑县";
		$sub_arr[4105][410527]="内黄县";
		$sub_arr[4105][410581]="林州市";
		$l_arr[4106]="鹤壁市";
		$sub_arr[4106];
		$sub_arr[4106][0]="请选择";
		$sub_arr[4106][410602]="鹤山区";
		$sub_arr[4106][410603]="山城区";
		$sub_arr[4106][410611]="淇滨区";
		$sub_arr[4106][410621]="浚县";
		$sub_arr[4106][410622]="淇县";
		$l_arr[4107]="新乡市";
		$sub_arr[4107];
		$sub_arr[4107][0]="请选择";
		$sub_arr[4107][410702]="红旗区";
		$sub_arr[4107][410703]="卫滨区";
		$sub_arr[4107][410704]="凤泉区";
		$sub_arr[4107][410711]="牧野区";
		$sub_arr[4107][410721]="新乡县";
		$sub_arr[4107][410724]="获嘉县";
		$sub_arr[4107][410725]="原阳县";
		$sub_arr[4107][410726]="延津县";
		$sub_arr[4107][410727]="封丘县";
		$sub_arr[4107][410728]="长垣县";
		$sub_arr[4107][410781]="卫辉市";
		$sub_arr[4107][410782]="辉县市";
		$l_arr[4108]="焦作市";
		$sub_arr[4108];
		$sub_arr[4108][0]="请选择";
		$sub_arr[4108][410802]="解放区";
		$sub_arr[4108][410803]="中站区";
		$sub_arr[4108][410804]="马村区";
		$sub_arr[4108][410811]="山阳区";
		$sub_arr[4108][410821]="修武县";
		$sub_arr[4108][410822]="博爱县";
		$sub_arr[4108][410823]="武陟县";
		$sub_arr[4108][410825]="温县";
		$sub_arr[4108][410882]="沁阳市";
		$sub_arr[4108][410883]="孟州市";
		$l_arr[4109]="濮阳市";
		$sub_arr[4109];
		$sub_arr[4109][0]="请选择";
		$sub_arr[4109][410902]="华龙区";
		$sub_arr[4109][410922]="清丰县";
		$sub_arr[4109][410923]="南乐县";
		$sub_arr[4109][410926]="范县";
		$sub_arr[4109][410927]="台前县";
		$sub_arr[4109][410928]="濮阳县";
		$l_arr[4110]="许昌市";
		$sub_arr[4110];
		$sub_arr[4110][0]="请选择";
		$sub_arr[4110][411002]="魏都区";
		$sub_arr[4110][411023]="许昌县";
		$sub_arr[4110][411024]="鄢陵县";
		$sub_arr[4110][411025]="襄城县";
		$sub_arr[4110][411081]="禹州市";
		$sub_arr[4110][411082]="长葛市";
		$l_arr[4111]="漯河市";
		$sub_arr[4111];
		$sub_arr[4111][0]="请选择";
		$sub_arr[4111][411102]="源汇区";
		$sub_arr[4111][411103]="郾城区";
		$sub_arr[4111][411104]="召陵区";
		$sub_arr[4111][411121]="舞阳县";
		$sub_arr[4111][411122]="临颍县";
		$l_arr[4112]="三门峡市";
		$sub_arr[4112];
		$sub_arr[4112][0]="请选择";
		$sub_arr[4112][411202]="湖滨区";
		$sub_arr[4112][411221]="渑池县";
		$sub_arr[4112][411222]="陕县";
		$sub_arr[4112][411224]="卢氏县";
		$sub_arr[4112][411281]="义马市";
		$sub_arr[4112][411282]="灵宝市";
		$l_arr[4113]="南阳市";
		$sub_arr[4113];
		$sub_arr[4113][0]="请选择";
		$sub_arr[4113][411302]="宛城区";
		$sub_arr[4113][411303]="卧龙区";
		$sub_arr[4113][411321]="南召县";
		$sub_arr[4113][411322]="方城县";
		$sub_arr[4113][411323]="西峡县";
		$sub_arr[4113][411324]="镇平县";
		$sub_arr[4113][411325]="内乡县";
		$sub_arr[4113][411326]="淅川县";
		$sub_arr[4113][411327]="社旗县";
		$sub_arr[4113][411328]="唐河县";
		$sub_arr[4113][411329]="新野县";
		$sub_arr[4113][411330]="桐柏县";
		$sub_arr[4113][411381]="邓州市";
		$l_arr[4114]="商丘市";
		$sub_arr[4114];
		$sub_arr[4114][0]="请选择";
		$sub_arr[4114][411402]="梁园区";
		$sub_arr[4114][411403]="睢阳区";
		$sub_arr[4114][411421]="民权县";
		$sub_arr[4114][411422]="睢县";
		$sub_arr[4114][411423]="宁陵县";
		$sub_arr[4114][411424]="柘城县";
		$sub_arr[4114][411425]="虞城县";
		$sub_arr[4114][411426]="夏邑县";
		$sub_arr[4114][411481]="永城市";
		$l_arr[4115]="信阳市";
		$sub_arr[4115];
		$sub_arr[4115][0]="请选择";
		$sub_arr[4115][411502]="浉河区";
		$sub_arr[4115][411503]="平桥区";
		$sub_arr[4115][411521]="罗山县";
		$sub_arr[4115][411522]="光山县";
		$sub_arr[4115][411523]="新县";
		$sub_arr[4115][411524]="商城县";
		$sub_arr[4115][411525]="固始县";
		$sub_arr[4115][411526]="潢川县";
		$sub_arr[4115][411527]="淮滨县";
		$sub_arr[4115][411528]="息县";
		$l_arr[4116]="周口市";
		$sub_arr[4116];
		$sub_arr[4116][0]="请选择";
		$sub_arr[4116][411602]="川汇区";
		$sub_arr[4116][411621]="扶沟县";
		$sub_arr[4116][411622]="西华县";
		$sub_arr[4116][411623]="商水县";
		$sub_arr[4116][411624]="沈丘县";
		$sub_arr[4116][411625]="郸城县";
		$sub_arr[4116][411626]="淮阳县";
		$sub_arr[4116][411627]="太康县";
		$sub_arr[4116][411628]="鹿邑县";
		$sub_arr[4116][411681]="项城市";
		$l_arr[4117]="驻马店市";
		$sub_arr[4117];
		$sub_arr[4117][0]="请选择";
		$sub_arr[4117][411702]="驿城区";
		$sub_arr[4117][411721]="西平县";
		$sub_arr[4117][411722]="上蔡县";
		$sub_arr[4117][411723]="平舆县";
		$sub_arr[4117][411724]="正阳县";
		$sub_arr[4117][411725]="确山县";
		$sub_arr[4117][411726]="泌阳县";
		$sub_arr[4117][411727]="汝南县";
		$sub_arr[4117][411728]="遂平县";
		$sub_arr[4117][411729]="新蔡县";
		$l_arr[4201]="武汉市";
		$sub_arr[4201];
		$sub_arr[4201][0]="请选择";
		$sub_arr[4201][420102]="江岸区";
		$sub_arr[4201][420103]="江汉区";
		$sub_arr[4201][420104]="硚口区";
		$sub_arr[4201][420105]="汉阳区";
		$sub_arr[4201][420106]="武昌区";
		$sub_arr[4201][420107]="青山区";
		$sub_arr[4201][420111]="洪山区";
		$sub_arr[4201][420112]="东西湖区";
		$sub_arr[4201][420113]="汉南区";
		$sub_arr[4201][420114]="蔡甸区";
		$sub_arr[4201][420115]="江夏区";
		$sub_arr[4201][420116]="黄陂区";
		$sub_arr[4201][420117]="新洲区";
		$sub_arr[4201][420118]="东湖开发区";
		$sub_arr[4201][420191]="武汉经济开发区";
		$l_arr[4202]="黄石市";
		$sub_arr[4202];
		$sub_arr[4202][0]="请选择";
		$sub_arr[4202][420202]="黄石港区";
		$sub_arr[4202][420203]="西塞山区";
		$sub_arr[4202][420204]="下陆区";
		$sub_arr[4202][420205]="铁山区";
		$sub_arr[4202][420222]="阳新县";
		$sub_arr[4202][420223]="黄石经济开发区";
		$sub_arr[4202][420281]="大冶市";
		$l_arr[4203]="十堰市";
		$sub_arr[4203];
		$sub_arr[4203][0]="请选择";
		$sub_arr[4203][420302]="茅箭区";
		$sub_arr[4203][420303]="张湾区";
		$sub_arr[4203][420321]="郧县";
		$sub_arr[4203][420322]="郧西县";
		$sub_arr[4203][420323]="竹山县";
		$sub_arr[4203][420324]="竹溪县";
		$sub_arr[4203][420325]="房县";
		$sub_arr[4203][420326]="十堰经济开发区";
		$sub_arr[4203][420327]="武当山旅游经济特区";
		$sub_arr[4203][420381]="丹江口市";
		$l_arr[4205]="宜昌市";
		$sub_arr[4205];
		$sub_arr[4205][0]="请选择";
		$sub_arr[4205][420502]="西陵区";
		$sub_arr[4205][420503]="伍家岗区";
		$sub_arr[4205][420504]="点军区";
		$sub_arr[4205][420505]="猇亭区";
		$sub_arr[4205][420506]="夷陵区";
		$sub_arr[4205][420525]="远安县";
		$sub_arr[4205][420526]="兴山县";
		$sub_arr[4205][420527]="秭归县";
		$sub_arr[4205][420528]="长阳县";
		$sub_arr[4205][420529]="五峰县";
		$sub_arr[4205][420581]="宜都市";
		$sub_arr[4205][420582]="当阳市";
		$sub_arr[4205][420583]="枝江市";
		$l_arr[4206]="襄阳市";
		$sub_arr[4206];
		$sub_arr[4206][0]="请选择";
		$sub_arr[4206][420602]="襄城区";
		$sub_arr[4206][420606]="樊城区";
		$sub_arr[4206][420607]="襄阳区";
		$sub_arr[4206][420624]="南漳县";
		$sub_arr[4206][420625]="谷城县";
		$sub_arr[4206][420626]="保康县";
		$sub_arr[4206][420682]="老河口市";
		$sub_arr[4206][420683]="枣阳市";
		$sub_arr[4206][420684]="宜城市";
		$sub_arr[4206][420685]="隆中风景区";
		$sub_arr[4206][420686]="高新开发区";
		$sub_arr[4206][420687]="鱼梁洲开发区";
		$l_arr[4207]="鄂州市";
		$sub_arr[4207];
		$sub_arr[4207][0]="请选择";
		$sub_arr[4207][420702]="梁子湖区";
		$sub_arr[4207][420703]="华容区";
		$sub_arr[4207][420704]="鄂城区";
		$sub_arr[4207][420791]="葛店开发区";
		$sub_arr[4207][420792]="鄂州经济开发区";
		$l_arr[4208]="荆门市";
		$sub_arr[4208];
		$sub_arr[4208][0]="请选择";
		$sub_arr[4208][420802]="东宝区";
		$sub_arr[4208][420804]="掇刀区";
		$sub_arr[4208][420821]="京山县";
		$sub_arr[4208][420822]="沙洋县";
		$sub_arr[4208][420881]="钟祥市";
		$sub_arr[4208][420891]="屈家岭";
		$sub_arr[4208][420892]="荆门经济开发区";
		$l_arr[4209]="孝感市";
		$sub_arr[4209];
		$sub_arr[4209][0]="请选择";
		$sub_arr[4209][420902]="孝南区";
		$sub_arr[4209][420921]="孝昌县";
		$sub_arr[4209][420922]="大悟县";
		$sub_arr[4209][420923]="云梦县";
		$sub_arr[4209][420981]="应城市";
		$sub_arr[4209][420982]="安陆市";
		$sub_arr[4209][420984]="汉川市";
		$l_arr[4210]="荆州市";
		$sub_arr[4210];
		$sub_arr[4210][0]="请选择";
		$sub_arr[4210][421002]="沙市区";
		$sub_arr[4210][421003]="荆州区";
		$sub_arr[4210][421022]="公安县";
		$sub_arr[4210][421023]="监利县";
		$sub_arr[4210][421024]="江陵县";
		$sub_arr[4210][421081]="石首市";
		$sub_arr[4210][421083]="洪湖市";
		$sub_arr[4210][421087]="松滋市";
		$sub_arr[4210][421091]="荆州经济开发区";
		$l_arr[4211]="黄冈市";
		$sub_arr[4211];
		$sub_arr[4211][0]="请选择";
		$sub_arr[4211][421102]="黄州区";
		$sub_arr[4211][421121]="团风县";
		$sub_arr[4211][421122]="红安县";
		$sub_arr[4211][421123]="罗田县";
		$sub_arr[4211][421124]="英山县";
		$sub_arr[4211][421125]="浠水县";
		$sub_arr[4211][421126]="蕲春县";
		$sub_arr[4211][421127]="黄梅县";
		$sub_arr[4211][421181]="麻城市";
		$sub_arr[4211][421182]="武穴市";
		$sub_arr[4211][421191]="龙感湖管理区";
		$l_arr[4212]="咸宁市";
		$sub_arr[4212];
		$sub_arr[4212][0]="请选择";
		$sub_arr[4212][421202]="咸安区";
		$sub_arr[4212][421221]="嘉鱼县";
		$sub_arr[4212][421222]="通城县";
		$sub_arr[4212][421223]="崇阳县";
		$sub_arr[4212][421224]="通山县";
		$sub_arr[4212][421281]="赤壁市";
		$sub_arr[4212][421291]="湖北省咸宁市咸宁经济开发区";
		$l_arr[4213]="随州市";
		$sub_arr[4213];
		$sub_arr[4213][0]="请选择";
		$sub_arr[4213][421302]="曾都区";
		$sub_arr[4213][421321]="随县";
		$sub_arr[4213][421381]="广水市";
		$l_arr[4228]="恩施州";
		$sub_arr[4228];
		$sub_arr[4228][0]="请选择";
		$sub_arr[4228][422801]="恩施市";
		$sub_arr[4228][422802]="利川市";
		$sub_arr[4228][422822]="建始县";
		$sub_arr[4228][422823]="巴东县";
		$sub_arr[4228][422825]="宣恩县";
		$sub_arr[4228][422826]="咸丰县";
		$sub_arr[4228][422827]="来凤县";
		$sub_arr[4228][422828]="鹤峰县";
		$l_arr[4301]="长沙市";
		$sub_arr[4301];
		$sub_arr[4301][0]="请选择";
		$sub_arr[4301][430102]="芙蓉区";
		$sub_arr[4301][430103]="天心区";
		$sub_arr[4301][430104]="岳麓区";
		$sub_arr[4301][430105]="开福区";
		$sub_arr[4301][430111]="雨花区";
		$sub_arr[4301][430121]="长沙县";
		$sub_arr[4301][430122]="望城县";
		$sub_arr[4301][430124]="宁乡县";
		$sub_arr[4301][430181]="浏阳市";
		$l_arr[4302]="株洲市";
		$sub_arr[4302];
		$sub_arr[4302][0]="请选择";
		$sub_arr[4302][430202]="荷塘区";
		$sub_arr[4302][430203]="芦淞区";
		$sub_arr[4302][430204]="石峰区";
		$sub_arr[4302][430211]="天元区";
		$sub_arr[4302][430221]="株洲县";
		$sub_arr[4302][430223]="攸县";
		$sub_arr[4302][430224]="茶陵县";
		$sub_arr[4302][430225]="炎陵县";
		$sub_arr[4302][430281]="醴陵市";
		$l_arr[4303]="湘潭市";
		$sub_arr[4303];
		$sub_arr[4303][0]="请选择";
		$sub_arr[4303][430302]="雨湖区";
		$sub_arr[4303][430304]="岳塘区";
		$sub_arr[4303][430321]="湘潭县";
		$sub_arr[4303][430381]="湘乡市";
		$sub_arr[4303][430382]="韶山市";
		$l_arr[4304]="衡阳市";
		$sub_arr[4304];
		$sub_arr[4304][0]="请选择";
		$sub_arr[4304][430405]="珠晖区";
		$sub_arr[4304][430406]="雁峰区";
		$sub_arr[4304][430407]="石鼓区";
		$sub_arr[4304][430408]="蒸湘区";
		$sub_arr[4304][430412]="南岳区";
		$sub_arr[4304][430421]="衡阳县";
		$sub_arr[4304][430422]="衡南县";
		$sub_arr[4304][430423]="衡山县";
		$sub_arr[4304][430424]="衡东县";
		$sub_arr[4304][430426]="祁东县";
		$sub_arr[4304][430481]="耒阳市";
		$sub_arr[4304][430482]="常宁市";
		$l_arr[4305]="邵阳市";
		$sub_arr[4305];
		$sub_arr[4305][0]="请选择";
		$sub_arr[4305][430502]="双清区";
		$sub_arr[4305][430503]="大祥区";
		$sub_arr[4305][430511]="北塔区";
		$sub_arr[4305][430521]="邵东县";
		$sub_arr[4305][430522]="新邵县";
		$sub_arr[4305][430523]="邵阳县";
		$sub_arr[4305][430524]="隆回县";
		$sub_arr[4305][430525]="洞口县";
		$sub_arr[4305][430527]="绥宁县";
		$sub_arr[4305][430528]="新宁县";
		$sub_arr[4305][430529]="城步";
		$sub_arr[4305][430581]="武冈市";
		$l_arr[4306]="岳阳市";
		$sub_arr[4306];
		$sub_arr[4306][0]="请选择";
		$sub_arr[4306][430602]="岳阳楼区";
		$sub_arr[4306][430603]="云溪区";
		$sub_arr[4306][430611]="君山区";
		$sub_arr[4306][430621]="岳阳县";
		$sub_arr[4306][430623]="华容县";
		$sub_arr[4306][430624]="湘阴县";
		$sub_arr[4306][430626]="平江县";
		$sub_arr[4306][430681]="汨罗市";
		$sub_arr[4306][430682]="临湘市";
		$l_arr[4307]="常德市";
		$sub_arr[4307];
		$sub_arr[4307][0]="请选择";
		$sub_arr[4307][430702]="武陵区";
		$sub_arr[4307][430703]="鼎城区";
		$sub_arr[4307][430721]="安乡县";
		$sub_arr[4307][430722]="汉寿县";
		$sub_arr[4307][430723]="澧县";
		$sub_arr[4307][430724]="临澧县";
		$sub_arr[4307][430725]="桃源县";
		$sub_arr[4307][430726]="石门县";
		$sub_arr[4307][430781]="津市市";
		$l_arr[4308]="张家界市";
		$sub_arr[4308];
		$sub_arr[4308][0]="请选择";
		$sub_arr[4308][430802]="永定区";
		$sub_arr[4308][430811]="武陵源区";
		$sub_arr[4308][430821]="慈利县";
		$sub_arr[4308][430822]="桑植县";
		$l_arr[4309]="益阳市";
		$sub_arr[4309];
		$sub_arr[4309][0]="请选择";
		$sub_arr[4309][430902]="资阳区";
		$sub_arr[4309][430903]="赫山区";
		$sub_arr[4309][430921]="南县";
		$sub_arr[4309][430922]="桃江县";
		$sub_arr[4309][430923]="安化县";
		$sub_arr[4309][430981]="沅江市";
		$l_arr[4310]="郴州市";
		$sub_arr[4310];
		$sub_arr[4310][0]="请选择";
		$sub_arr[4310][431002]="北湖区";
		$sub_arr[4310][431003]="苏仙区";
		$sub_arr[4310][431021]="桂阳县";
		$sub_arr[4310][431022]="宜章县";
		$sub_arr[4310][431023]="永兴县";
		$sub_arr[4310][431024]="嘉禾县";
		$sub_arr[4310][431025]="临武县";
		$sub_arr[4310][431026]="汝城县";
		$sub_arr[4310][431027]="桂东县";
		$sub_arr[4310][431028]="安仁县";
		$sub_arr[4310][431081]="资兴市";
		$l_arr[4311]="永州市";
		$sub_arr[4311];
		$sub_arr[4311][0]="请选择";
		$sub_arr[4311][431102]="零陵区";
		$sub_arr[4311][431103]="冷水滩区";
		$sub_arr[4311][431121]="祁阳县";
		$sub_arr[4311][431122]="东安县";
		$sub_arr[4311][431123]="双牌县";
		$sub_arr[4311][431124]="道县";
		$sub_arr[4311][431125]="江永县";
		$sub_arr[4311][431126]="宁远县";
		$sub_arr[4311][431127]="蓝山县";
		$sub_arr[4311][431128]="新田县";
		$sub_arr[4311][431129]="江华";
		$l_arr[4312]="怀化市";
		$sub_arr[4312];
		$sub_arr[4312][0]="请选择";
		$sub_arr[4312][431202]="鹤城区";
		$sub_arr[4312][431221]="中方县";
		$sub_arr[4312][431222]="沅陵县";
		$sub_arr[4312][431223]="辰溪县";
		$sub_arr[4312][431224]="溆浦县";
		$sub_arr[4312][431225]="会同县";
		$sub_arr[4312][431226]="麻阳";
		$sub_arr[4312][431227]="新晃";
		$sub_arr[4312][431228]="芷江";
		$sub_arr[4312][431229]="靖州";
		$sub_arr[4312][431230]="通道";
		$sub_arr[4312][431281]="洪江市";
		$l_arr[4313]="娄底市";
		$sub_arr[4313];
		$sub_arr[4313][0]="请选择";
		$sub_arr[4313][431302]="娄星区";
		$sub_arr[4313][431321]="双峰县";
		$sub_arr[4313][431322]="新化县";
		$sub_arr[4313][431381]="冷水江市";
		$sub_arr[4313][431382]="涟源市";
		$l_arr[4331]="湘西";
		$sub_arr[4331];
		$sub_arr[4331][0]="请选择";
		$sub_arr[4331][433101]="吉首市";
		$sub_arr[4331][433122]="泸溪县";
		$sub_arr[4331][433123]="凤凰县";
		$sub_arr[4331][433124]="花垣县";
		$sub_arr[4331][433125]="保靖县";
		$sub_arr[4331][433126]="古丈县";
		$sub_arr[4331][433127]="永顺县";
		$sub_arr[4331][433130]="龙山县";
		$l_arr[4401]="广州市";
		$sub_arr[4401];
		$sub_arr[4401][0]="请选择";
		$sub_arr[4401][440103]="荔湾区";
		$sub_arr[4401][440104]="越秀区";
		$sub_arr[4401][440105]="海珠区";
		$sub_arr[4401][440106]="天河区";
		$sub_arr[4401][440111]="白云区";
		$sub_arr[4401][440112]="黄埔区";
		$sub_arr[4401][440113]="番禺区";
		$sub_arr[4401][440114]="花都区";
		$sub_arr[4401][440115]="南沙区";
		$sub_arr[4401][440116]="萝岗区";
		$sub_arr[4401][440183]="增城市";
		$sub_arr[4401][440184]="从化市";
		$l_arr[4402]="韶关市";
		$sub_arr[4402];
		$sub_arr[4402][0]="请选择";
		$sub_arr[4402][440203]="武江区";
		$sub_arr[4402][440204]="浈江区";
		$sub_arr[4402][440205]="曲江区";
		$sub_arr[4402][440222]="始兴县";
		$sub_arr[4402][440224]="仁化县";
		$sub_arr[4402][440229]="翁源县";
		$sub_arr[4402][440232]="乳源";
		$sub_arr[4402][440233]="新丰县";
		$sub_arr[4402][440281]="乐昌市";
		$sub_arr[4402][440282]="南雄市";
		$l_arr[4403]="深圳市";
		$sub_arr[4403];
		$sub_arr[4403][0]="请选择";
		$sub_arr[4403][440303]="罗湖区";
		$sub_arr[4403][440304]="福田区";
		$sub_arr[4403][440305]="南山区";
		$sub_arr[4403][440306]="宝安区";
		$sub_arr[4403][440307]="龙岗区";
		$sub_arr[4403][440308]="盐田区";
		$l_arr[4404]="珠海市";
		$sub_arr[4404];
		$sub_arr[4404][0]="请选择";
		$sub_arr[4404][440402]="香洲区";
		$sub_arr[4404][440403]="斗门区";
		$sub_arr[4404][440404]="金湾区";
		$l_arr[4405]="汕头市";
		$sub_arr[4405];
		$sub_arr[4405][0]="请选择";
		$sub_arr[4405][440507]="龙湖区";
		$sub_arr[4405][440511]="金平区";
		$sub_arr[4405][440512]="濠江区";
		$sub_arr[4405][440513]="潮阳区";
		$sub_arr[4405][440514]="潮南区";
		$sub_arr[4405][440515]="澄海区";
		$sub_arr[4405][440523]="南澳县";
		$l_arr[4406]="佛山市";
		$sub_arr[4406];
		$sub_arr[4406][0]="请选择";
		$sub_arr[4406][440604]="禅城区";
		$sub_arr[4406][440605]="南海区";
		$sub_arr[4406][440606]="顺德区";
		$sub_arr[4406][440607]="三水区";
		$sub_arr[4406][440608]="高明区";
		$l_arr[4407]="江门市";
		$sub_arr[4407];
		$sub_arr[4407][0]="请选择";
		$sub_arr[4407][440703]="蓬江区";
		$sub_arr[4407][440704]="江海区";
		$sub_arr[4407][440705]="新会区";
		$sub_arr[4407][440781]="台山市";
		$sub_arr[4407][440783]="开平市";
		$sub_arr[4407][440784]="鹤山市";
		$sub_arr[4407][440785]="恩平市";
		$l_arr[4408]="湛江市";
		$sub_arr[4408];
		$sub_arr[4408][0]="请选择";
		$sub_arr[4408][440802]="赤坎区";
		$sub_arr[4408][440803]="霞山区";
		$sub_arr[4408][440804]="坡头区";
		$sub_arr[4408][440811]="麻章区";
		$sub_arr[4408][440823]="遂溪县";
		$sub_arr[4408][440825]="徐闻县";
		$sub_arr[4408][440881]="廉江市";
		$sub_arr[4408][440882]="雷州市";
		$sub_arr[4408][440883]="吴川市";
		$l_arr[4409]="茂名市";
		$sub_arr[4409];
		$sub_arr[4409][0]="请选择";
		$sub_arr[4409][440902]="茂南区";
		$sub_arr[4409][440903]="茂港区";
		$sub_arr[4409][440923]="电白县";
		$sub_arr[4409][440981]="高州市";
		$sub_arr[4409][440982]="化州市";
		$sub_arr[4409][440983]="信宜市";
		$l_arr[4412]="肇庆市";
		$sub_arr[4412];
		$sub_arr[4412][0]="请选择";
		$sub_arr[4412][441202]="端州区";
		$sub_arr[4412][441203]="鼎湖区";
		$sub_arr[4412][441223]="广宁县";
		$sub_arr[4412][441224]="怀集县";
		$sub_arr[4412][441225]="封开县";
		$sub_arr[4412][441226]="德庆县";
		$sub_arr[4412][441283]="高要市";
		$sub_arr[4412][441284]="四会市";
		$l_arr[4413]="惠州市";
		$sub_arr[4413];
		$sub_arr[4413][0]="请选择";
		$sub_arr[4413][441302]="惠城区";
		$sub_arr[4413][441303]="惠阳区";
		$sub_arr[4413][441322]="博罗县";
		$sub_arr[4413][441323]="惠东县";
		$sub_arr[4413][441324]="龙门县";
		$l_arr[4414]="梅州市";
		$sub_arr[4414];
		$sub_arr[4414][0]="请选择";
		$sub_arr[4414][441402]="梅江区";
		$sub_arr[4414][441421]="梅县";
		$sub_arr[4414][441422]="大埔县";
		$sub_arr[4414][441423]="丰顺县";
		$sub_arr[4414][441424]="五华县";
		$sub_arr[4414][441426]="平远县";
		$sub_arr[4414][441427]="蕉岭县";
		$sub_arr[4414][441481]="兴宁市";
		$l_arr[4415]="汕尾市";
		$sub_arr[4415];
		$sub_arr[4415][0]="请选择";
		$sub_arr[4415][441502]="城区";
		$sub_arr[4415][441521]="海丰县";
		$sub_arr[4415][441523]="陆河县";
		$sub_arr[4415][441581]="陆丰市";
		$l_arr[4416]="河源市";
		$sub_arr[4416];
		$sub_arr[4416][0]="请选择";
		$sub_arr[4416][441602]="源城区";
		$sub_arr[4416][441621]="紫金县";
		$sub_arr[4416][441622]="龙川县";
		$sub_arr[4416][441623]="连平县";
		$sub_arr[4416][441624]="和平县";
		$sub_arr[4416][441625]="东源县";
		$l_arr[4417]="阳江市";
		$sub_arr[4417];
		$sub_arr[4417][0]="请选择";
		$sub_arr[4417][441702]="江城区";
		$sub_arr[4417][441721]="阳西县";
		$sub_arr[4417][441723]="阳东县";
		$sub_arr[4417][441781]="阳春市";
		$l_arr[4418]="清远市";
		$sub_arr[4418];
		$sub_arr[4418][0]="请选择";
		$sub_arr[4418][441802]="清城区";
		$sub_arr[4418][441821]="佛冈县";
		$sub_arr[4418][441823]="阳山县";
		$sub_arr[4418][441825]="连山";
		$sub_arr[4418][441826]="连南";
		$sub_arr[4418][441827]="清新县";
		$sub_arr[4418][441881]="英德市";
		$sub_arr[4418][441882]="连州市";
		$l_arr[4451]="潮州市";
		$sub_arr[4451];
		$sub_arr[4451][0]="请选择";
		$sub_arr[4451][445101]="枫溪区";
		$sub_arr[4451][445102]="湘桥区";
		$sub_arr[4451][445121]="潮安县";
		$sub_arr[4451][445122]="饶平县";
		$l_arr[4452]="揭阳市";
		$sub_arr[4452];
		$sub_arr[4452][0]="请选择";
		$sub_arr[4452][445202]="榕城区";
		$sub_arr[4452][445221]="揭东县";
		$sub_arr[4452][445222]="揭西县";
		$sub_arr[4452][445224]="惠来县";
		$sub_arr[4452][445281]="普宁市";
		$l_arr[4453]="云浮市";
		$sub_arr[4453];
		$sub_arr[4453][0]="请选择";
		$sub_arr[4453][445302]="云城区";
		$sub_arr[4453][445321]="新兴县";
		$sub_arr[4453][445322]="郁南县";
		$sub_arr[4453][445323]="云安县";
		$sub_arr[4453][445381]="罗定市";
		$l_arr[4501]="南宁市";
		$sub_arr[4501];
		$sub_arr[4501][0]="请选择";
		$sub_arr[4501][450102]="兴宁区";
		$sub_arr[4501][450103]="青秀区";
		$sub_arr[4501][450105]="江南区";
		$sub_arr[4501][450107]="西乡塘区";
		$sub_arr[4501][450108]="良庆区";
		$sub_arr[4501][450109]="邕宁区";
		$sub_arr[4501][450122]="武鸣县";
		$sub_arr[4501][450123]="隆安县";
		$sub_arr[4501][450124]="马山县";
		$sub_arr[4501][450125]="上林县";
		$sub_arr[4501][450126]="宾阳县";
		$sub_arr[4501][450127]="横县";
		$l_arr[4502]="柳州市";
		$sub_arr[4502];
		$sub_arr[4502][0]="请选择";
		$sub_arr[4502][450202]="城中区";
		$sub_arr[4502][450203]="鱼峰区";
		$sub_arr[4502][450204]="柳南区";
		$sub_arr[4502][450205]="柳北区";
		$sub_arr[4502][450221]="柳江县";
		$sub_arr[4502][450222]="柳城县";
		$sub_arr[4502][450223]="鹿寨县";
		$sub_arr[4502][450224]="融安县";
		$sub_arr[4502][450225]="融水";
		$sub_arr[4502][450226]="三江";
		$l_arr[4503]="桂林市";
		$sub_arr[4503];
		$sub_arr[4503][0]="请选择";
		$sub_arr[4503][450302]="秀峰区";
		$sub_arr[4503][450303]="叠彩区";
		$sub_arr[4503][450304]="象山区";
		$sub_arr[4503][450305]="七星区";
		$sub_arr[4503][450311]="雁山区";
		$sub_arr[4503][450321]="阳朔县";
		$sub_arr[4503][450322]="临桂县";
		$sub_arr[4503][450323]="灵川县";
		$sub_arr[4503][450324]="全州县";
		$sub_arr[4503][450325]="兴安县";
		$sub_arr[4503][450326]="永福县";
		$sub_arr[4503][450327]="灌阳县";
		$sub_arr[4503][450328]="龙胜";
		$sub_arr[4503][450329]="资源县";
		$sub_arr[4503][450330]="平乐县";
		$sub_arr[4503][450331]="荔蒲县";
		$sub_arr[4503][450332]="恭城";
		$l_arr[4504]="梧州市";
		$sub_arr[4504];
		$sub_arr[4504][0]="请选择";
		$sub_arr[4504][450403]="万秀区";
		$sub_arr[4504][450404]="蝶山区";
		$sub_arr[4504][450405]="长洲区";
		$sub_arr[4504][450421]="苍梧县";
		$sub_arr[4504][450422]="藤县";
		$sub_arr[4504][450423]="蒙山县";
		$sub_arr[4504][450481]="岑溪市";
		$l_arr[4505]="北海市";
		$sub_arr[4505];
		$sub_arr[4505][0]="请选择";
		$sub_arr[4505][450502]="海城区";
		$sub_arr[4505][450503]="银海区";
		$sub_arr[4505][450512]="铁山港区";
		$sub_arr[4505][450521]="合浦县";
		$l_arr[4506]="防城港市";
		$sub_arr[4506];
		$sub_arr[4506][0]="请选择";
		$sub_arr[4506][450602]="港口区";
		$sub_arr[4506][450603]="防城区";
		$sub_arr[4506][450621]="上思县";
		$sub_arr[4506][450681]="东兴市";
		$l_arr[4507]="钦州市";
		$sub_arr[4507];
		$sub_arr[4507][0]="请选择";
		$sub_arr[4507][450702]="钦南区";
		$sub_arr[4507][450703]="钦北区";
		$sub_arr[4507][450721]="灵山县";
		$sub_arr[4507][450722]="浦北县";
		$l_arr[4508]="贵港市";
		$sub_arr[4508];
		$sub_arr[4508][0]="请选择";
		$sub_arr[4508][450802]="港北区";
		$sub_arr[4508][450803]="港南区";
		$sub_arr[4508][450804]="覃塘区";
		$sub_arr[4508][450821]="平南县";
		$sub_arr[4508][450881]="桂平市";
		$l_arr[4509]="玉林市";
		$sub_arr[4509];
		$sub_arr[4509][0]="请选择";
		$sub_arr[4509][450902]="玉州区";
		$sub_arr[4509][450921]="容县";
		$sub_arr[4509][450922]="陆川县";
		$sub_arr[4509][450923]="博白县";
		$sub_arr[4509][450924]="兴业县";
		$sub_arr[4509][450981]="北流市";
		$l_arr[4510]="百色市";
		$sub_arr[4510];
		$sub_arr[4510][0]="请选择";
		$sub_arr[4510][451002]="右江区";
		$sub_arr[4510][451021]="田阳县";
		$sub_arr[4510][451022]="田东县";
		$sub_arr[4510][451023]="平果县";
		$sub_arr[4510][451024]="德保县";
		$sub_arr[4510][451025]="靖西县";
		$sub_arr[4510][451026]="那坡县";
		$sub_arr[4510][451027]="凌云县";
		$sub_arr[4510][451028]="乐业县";
		$sub_arr[4510][451029]="田林县";
		$sub_arr[4510][451030]="西林县";
		$sub_arr[4510][451031]="隆林";
		$l_arr[4511]="贺州市";
		$sub_arr[4511];
		$sub_arr[4511][0]="请选择";
		$sub_arr[4511][451102]="八步区";
		$sub_arr[4511][451121]="昭平县";
		$sub_arr[4511][451122]="钟山县";
		$sub_arr[4511][451123]="富川";
		$l_arr[4512]="河池市";
		$sub_arr[4512];
		$sub_arr[4512][0]="请选择";
		$sub_arr[4512][451202]="金城江区";
		$sub_arr[4512][451221]="南丹县";
		$sub_arr[4512][451222]="天峨县";
		$sub_arr[4512][451223]="凤山县";
		$sub_arr[4512][451224]="东兰县";
		$sub_arr[4512][451225]="罗城";
		$sub_arr[4512][451226]="环江";
		$sub_arr[4512][451227]="巴马";
		$sub_arr[4512][451228]="都安";
		$sub_arr[4512][451229]="大化";
		$sub_arr[4512][451281]="宜州市";
		$l_arr[4513]="来宾市";
		$sub_arr[4513];
		$sub_arr[4513][0]="请选择";
		$sub_arr[4513][451302]="兴宾区";
		$sub_arr[4513][451321]="忻城县";
		$sub_arr[4513][451322]="象州县";
		$sub_arr[4513][451323]="武宣县";
		$sub_arr[4513][451324]="金秀";
		$sub_arr[4513][451381]="合山市";
		$l_arr[4514]="崇左市";
		$sub_arr[4514];
		$sub_arr[4514][0]="请选择";
		$sub_arr[4514][451402]="江洲区";
		$sub_arr[4514][451421]="扶绥县";
		$sub_arr[4514][451422]="宁明县";
		$sub_arr[4514][451423]="龙州县";
		$sub_arr[4514][451424]="大新县";
		$sub_arr[4514][451425]="天等县";
		$sub_arr[4514][451481]="凭祥市";
		$l_arr[4601]="海口市";
		$sub_arr[4601];
		$sub_arr[4601][0]="请选择";
		$sub_arr[4601][460105]="秀英区";
		$sub_arr[4601][460106]="龙华区";
		$sub_arr[4601][460107]="琼山区";
		$sub_arr[4601][460108]="美兰区";
		$l_arr[5101]="成都市";
		$sub_arr[5101];
		$sub_arr[5101][0]="请选择";
		$sub_arr[5101][510104]="锦江区";
		$sub_arr[5101][510105]="青羊区";
		$sub_arr[5101][510106]="金牛区";
		$sub_arr[5101][510107]="武侯区";
		$sub_arr[5101][510108]="成华区";
		$sub_arr[5101][510112]="龙泉驿区";
		$sub_arr[5101][510113]="青白江区";
		$sub_arr[5101][510114]="新都区";
		$sub_arr[5101][510115]="温江区";
		$sub_arr[5101][510121]="金堂县";
		$sub_arr[5101][510122]="双流县";
		$sub_arr[5101][510124]="郫县";
		$sub_arr[5101][510129]="大邑县";
		$sub_arr[5101][510131]="蒲江县";
		$sub_arr[5101][510132]="新津县";
		$sub_arr[5101][510181]="都江堰市";
		$sub_arr[5101][510182]="彭州市";
		$sub_arr[5101][510183]="邛崃市";
		$sub_arr[5101][510184]="崇州市";
		$sub_arr[5101][510185]="高新区";
		$l_arr[5103]="自贡市";
		$sub_arr[5103];
		$sub_arr[5103][0]="请选择";
		$sub_arr[5103][510302]="自流井区";
		$sub_arr[5103][510303]="贡井区";
		$sub_arr[5103][510304]="大安区";
		$sub_arr[5103][510311]="沿滩区";
		$sub_arr[5103][510321]="荣县";
		$sub_arr[5103][510322]="富顺县";
		$l_arr[5104]="攀枝花市";
		$sub_arr[5104];
		$sub_arr[5104][0]="请选择";
		$sub_arr[5104][510402]="东区";
		$sub_arr[5104][510403]="西区";
		$sub_arr[5104][510411]="仁和区";
		$sub_arr[5104][510421]="米易县";
		$sub_arr[5104][510422]="盐边县";
		$l_arr[5105]="泸州市";
		$sub_arr[5105];
		$sub_arr[5105][0]="请选择";
		$sub_arr[5105][510502]="江阳区";
		$sub_arr[5105][510503]="纳溪区";
		$sub_arr[5105][510504]="龙马潭区";
		$sub_arr[5105][510521]="泸县";
		$sub_arr[5105][510522]="合江县";
		$sub_arr[5105][510524]="叙永县";
		$sub_arr[5105][510525]="古蔺县";
		$l_arr[5106]="德阳市";
		$sub_arr[5106];
		$sub_arr[5106][0]="请选择";
		$sub_arr[5106][510603]="旌阳区";
		$sub_arr[5106][510623]="中江县";
		$sub_arr[5106][510626]="罗江县";
		$sub_arr[5106][510681]="广汉市";
		$sub_arr[5106][510682]="什邡市";
		$sub_arr[5106][510683]="绵竹市";
		$l_arr[5107]="绵阳市";
		$sub_arr[5107];
		$sub_arr[5107][0]="请选择";
		$sub_arr[5107][510703]="涪城区";
		$sub_arr[5107][510704]="游仙区";
		$sub_arr[5107][510722]="三台县";
		$sub_arr[5107][510723]="盐亭县";
		$sub_arr[5107][510724]="安县";
		$sub_arr[5107][510725]="梓潼县";
		$sub_arr[5107][510726]="北川羌族自治县";
		$sub_arr[5107][510727]="平武县";
		$sub_arr[5107][510781]="江油市";
		$l_arr[5108]="广元市";
		$sub_arr[5108];
		$sub_arr[5108][0]="请选择";
		$sub_arr[5108][510802]="市中区";
		$sub_arr[5108][510811]="元坝区";
		$sub_arr[5108][510812]="朝天区";
		$sub_arr[5108][510821]="旺苍县";
		$sub_arr[5108][510822]="青川县";
		$sub_arr[5108][510823]="剑阁县";
		$sub_arr[5108][510824]="苍溪县";
		$l_arr[5109]="遂宁市";
		$sub_arr[5109];
		$sub_arr[5109][0]="请选择";
		$sub_arr[5109][510903]="船山区";
		$sub_arr[5109][510904]="安居区";
		$sub_arr[5109][510921]="蓬溪县";
		$sub_arr[5109][510922]="射洪县";
		$sub_arr[5109][510923]="大英县";
		$l_arr[5110]="内江市";
		$sub_arr[5110];
		$sub_arr[5110][0]="请选择";
		$sub_arr[5110][511002]="市中区";
		$sub_arr[5110][511011]="东兴区";
		$sub_arr[5110][511024]="威远县";
		$sub_arr[5110][511025]="资中县";
		$sub_arr[5110][511028]="隆昌县";
		$l_arr[5111]="乐山市";
		$sub_arr[5111];
		$sub_arr[5111][0]="请选择";
		$sub_arr[5111][511102]="市中区";
		$sub_arr[5111][511111]="沙湾区";
		$sub_arr[5111][511112]="五通桥区";
		$sub_arr[5111][511113]="金口河区";
		$sub_arr[5111][511123]="犍为县";
		$sub_arr[5111][511124]="井研县";
		$sub_arr[5111][511126]="夹江县";
		$sub_arr[5111][511129]="沐川县";
		$sub_arr[5111][511132]="峨边彝族自治县";
		$sub_arr[5111][511133]="马边彝族自治县";
		$sub_arr[5111][511181]="峨眉山市";
		$l_arr[5113]="南充市";
		$sub_arr[5113];
		$sub_arr[5113][0]="请选择";
		$sub_arr[5113][511302]="顺庆区";
		$sub_arr[5113][511303]="高坪区";
		$sub_arr[5113][511304]="嘉陵区";
		$sub_arr[5113][511321]="南部县";
		$sub_arr[5113][511322]="营山县";
		$sub_arr[5113][511323]="蓬安县";
		$sub_arr[5113][511324]="仪陇县";
		$sub_arr[5113][511325]="西充县";
		$sub_arr[5113][511381]="阆中市";
		$l_arr[5114]="眉山市";
		$sub_arr[5114];
		$sub_arr[5114][0]="请选择";
		$sub_arr[5114][511402]="东坡区";
		$sub_arr[5114][511421]="仁寿县";
		$sub_arr[5114][511422]="彭山县";
		$sub_arr[5114][511423]="洪雅县";
		$sub_arr[5114][511424]="丹棱县";
		$sub_arr[5114][511425]="青神县";
		$l_arr[5115]="宜宾市";
		$sub_arr[5115];
		$sub_arr[5115][0]="请选择";
		$sub_arr[5115][511502]="翠屏区";
		$sub_arr[5115][511521]="宜宾县";
		$sub_arr[5115][511522]="南溪县";
		$sub_arr[5115][511523]="江安县";
		$sub_arr[5115][511524]="长宁县";
		$sub_arr[5115][511525]="高县";
		$sub_arr[5115][511526]="珙县";
		$sub_arr[5115][511527]="筠连县";
		$sub_arr[5115][511528]="兴文县";
		$sub_arr[5115][511529]="屏山县";
		$l_arr[5116]="广安市";
		$sub_arr[5116];
		$sub_arr[5116][0]="请选择";
		$sub_arr[5116][511602]="广安区";
		$sub_arr[5116][511621]="岳池县";
		$sub_arr[5116][511622]="武胜县";
		$sub_arr[5116][511623]="邻水县";
		$sub_arr[5116][511681]="华蓥市";
		$l_arr[5117]="达州市";
		$sub_arr[5117];
		$sub_arr[5117][0]="请选择";
		$sub_arr[5117][511702]="通川区";
		$sub_arr[5117][511721]="达县";
		$sub_arr[5117][511722]="宣汉县";
		$sub_arr[5117][511723]="开江县";
		$sub_arr[5117][511724]="大竹县";
		$sub_arr[5117][511725]="渠县";
		$sub_arr[5117][511781]="万源市";
		$l_arr[5118]="雅安市";
		$sub_arr[5118];
		$sub_arr[5118][0]="请选择";
		$sub_arr[5118][511802]="雨城区";
		$sub_arr[5118][511821]="名山县";
		$sub_arr[5118][511822]="荥经县";
		$sub_arr[5118][511823]="汉源县";
		$sub_arr[5118][511824]="石棉县";
		$sub_arr[5118][511825]="天全县";
		$sub_arr[5118][511826]="芦山县";
		$sub_arr[5118][511827]="宝兴县";
		$l_arr[5119]="巴中市";
		$sub_arr[5119];
		$sub_arr[5119][0]="请选择";
		$sub_arr[5119][511902]="巴州区";
		$sub_arr[5119][511921]="通江县";
		$sub_arr[5119][511922]="南江县";
		$sub_arr[5119][511923]="平昌县";
		$l_arr[5120]="资阳市";
		$sub_arr[5120];
		$sub_arr[5120][0]="请选择";
		$sub_arr[5120][512002]="雁江区";
		$sub_arr[5120][512021]="安岳县";
		$sub_arr[5120][512022]="乐至县";
		$sub_arr[5120][512081]="简阳市";
		$l_arr[5132]="阿坝州";
		$sub_arr[5132];
		$sub_arr[5132][0]="请选择";
		$sub_arr[5132][513221]="汶川县";
		$sub_arr[5132][513222]="理县";
		$sub_arr[5132][513223]="茂县";
		$sub_arr[5132][513224]="松潘县";
		$sub_arr[5132][513225]="九寨沟县";
		$sub_arr[5132][513226]="金川县";
		$sub_arr[5132][513227]="小金县";
		$sub_arr[5132][513228]="黑水县";
		$sub_arr[5132][513229]="马尔康县";
		$sub_arr[5132][513230]="壤塘县";
		$sub_arr[5132][513231]="阿坝县";
		$sub_arr[5132][513232]="若尔盖县";
		$sub_arr[5132][513233]="红原县";
		$l_arr[5133]="甘孜";
		$sub_arr[5133];
		$sub_arr[5133][0]="请选择";
		$sub_arr[5133][513321]="康定县";
		$sub_arr[5133][513322]="泸定县";
		$sub_arr[5133][513323]="丹巴县";
		$sub_arr[5133][513324]="九龙县";
		$sub_arr[5133][513325]="雅江县";
		$sub_arr[5133][513326]="道孚县";
		$sub_arr[5133][513327]="炉霍县";
		$sub_arr[5133][513328]="甘孜县";
		$sub_arr[5133][513329]="新龙县";
		$sub_arr[5133][513330]="德格县";
		$sub_arr[5133][513331]="白玉县";
		$sub_arr[5133][513332]="石渠县";
		$sub_arr[5133][513333]="色达县";
		$sub_arr[5133][513334]="理塘县";
		$sub_arr[5133][513335]="巴塘县";
		$sub_arr[5133][513336]="乡城县";
		$sub_arr[5133][513337]="稻城县";
		$sub_arr[5133][513338]="得荣县";
		$l_arr[5134]="凉山";
		$sub_arr[5134];
		$sub_arr[5134][0]="请选择";
		$sub_arr[5134][513401]="西昌市";
		$sub_arr[5134][513422]="木里";
		$sub_arr[5134][513423]="盐源县";
		$sub_arr[5134][513424]="德昌县";
		$sub_arr[5134][513425]="会理县";
		$sub_arr[5134][513426]="会东县";
		$sub_arr[5134][513427]="宁南县";
		$sub_arr[5134][513428]="普格县";
		$sub_arr[5134][513429]="布拖县";
		$sub_arr[5134][513430]="金阳县";
		$sub_arr[5134][513431]="昭觉县";
		$sub_arr[5134][513432]="喜德县";
		$sub_arr[5134][513433]="冕宁县";
		$sub_arr[5134][513434]="越西县";
		$sub_arr[5134][513435]="甘洛县";
		$sub_arr[5134][513436]="美姑县";
		$sub_arr[5134][513437]="雷波县";
		$l_arr[5201]="贵阳市";
		$sub_arr[5201];
		$sub_arr[5201][0]="请选择";
		$sub_arr[5201][520102]="南明区";
		$sub_arr[5201][520103]="云岩区";
		$sub_arr[5201][520111]="花溪区";
		$sub_arr[5201][520112]="乌当区";
		$sub_arr[5201][520113]="白云区";
		$sub_arr[5201][520114]="小河区";
		$sub_arr[5201][520115]="金阳新区";
		$sub_arr[5201][520121]="开阳县";
		$sub_arr[5201][520122]="息烽县";
		$sub_arr[5201][520123]="修文县";
		$sub_arr[5201][520181]="清镇市";
		$l_arr[5202]="六盘水市";
		$sub_arr[5202];
		$sub_arr[5202][0]="请选择";
		$sub_arr[5202][520201]="钟山区";
		$sub_arr[5202][520203]="六枝特区";
		$sub_arr[5202][520221]="水城县";
		$sub_arr[5202][520222]="盘县";
		$l_arr[5203]="遵义市";
		$sub_arr[5203];
		$sub_arr[5203][0]="请选择";
		$sub_arr[5203][520302]="红花岗区";
		$sub_arr[5203][520303]="汇川区";
		$sub_arr[5203][520304]="新浦新区";
		$sub_arr[5203][520321]="遵义县";
		$sub_arr[5203][520322]="桐梓县";
		$sub_arr[5203][520323]="绥阳县";
		$sub_arr[5203][520324]="正安县";
		$sub_arr[5203][520325]="道真县";
		$sub_arr[5203][520326]="务川县";
		$sub_arr[5203][520327]="凤冈县";
		$sub_arr[5203][520328]="湄潭县";
		$sub_arr[5203][520329]="余庆县";
		$sub_arr[5203][520330]="习水县";
		$sub_arr[5203][520381]="赤水市";
		$sub_arr[5203][520382]="仁怀市";
		$l_arr[5204]="安顺市";
		$sub_arr[5204];
		$sub_arr[5204][0]="请选择";
		$sub_arr[5204][520402]="西秀区";
		$sub_arr[5204][520403]="黄果树开发区";
		$sub_arr[5204][520421]="平坝县";
		$sub_arr[5204][520422]="普定县";
		$sub_arr[5204][520423]="镇宁县";
		$sub_arr[5204][520424]="关岭县";
		$sub_arr[5204][520425]="紫云县";
		$l_arr[5205]="毕节市";
		$sub_arr[5205];
		$sub_arr[5205][0]="请选择";
		$sub_arr[5205][520501]="七星关区";
		$sub_arr[5205][520522]="大方县";
		$sub_arr[5205][520523]="黔西县";
		$sub_arr[5205][520524]="金沙县";
		$sub_arr[5205][520525]="织金县";
		$sub_arr[5205][520526]="纳雍县";
		$sub_arr[5205][520527]="威宁";
		$sub_arr[5205][520528]="赫章县";
		$l_arr[5206]="铜仁市";
		$sub_arr[5206];
		$sub_arr[5206][0]="请选择";
		$sub_arr[5206][520601]="碧江区";
		$sub_arr[5206][520622]="江口县";
		$sub_arr[5206][520623]="玉屏县";
		$sub_arr[5206][520624]="石阡县";
		$sub_arr[5206][520625]="思南县";
		$sub_arr[5206][520626]="印江县";
		$sub_arr[5206][520627]="德江县";
		$sub_arr[5206][520628]="沿河县";
		$sub_arr[5206][520629]="松桃";
		$sub_arr[5206][520630]="万山特区";
		$l_arr[5223]="黔西南";
		$sub_arr[5223];
		$sub_arr[5223][0]="请选择";
		$sub_arr[5223][522301]="兴义市";
		$sub_arr[5223][522322]="兴仁县";
		$sub_arr[5223][522323]="普安县";
		$sub_arr[5223][522324]="晴隆县";
		$sub_arr[5223][522325]="贞丰县";
		$sub_arr[5223][522326]="望谟县";
		$sub_arr[5223][522327]="册亨县";
		$sub_arr[5223][522328]="安龙县";
		$l_arr[5226]="黔东南";
		$sub_arr[5226];
		$sub_arr[5226][0]="请选择";
		$sub_arr[5226][522601]="凯里市";
		$sub_arr[5226][522602]="凯里经济开发区";
		$sub_arr[5226][522622]="黄平县";
		$sub_arr[5226][522623]="施秉县";
		$sub_arr[5226][522624]="三穗县";
		$sub_arr[5226][522625]="镇远县";
		$sub_arr[5226][522626]="岑巩县";
		$sub_arr[5226][522627]="天柱县";
		$sub_arr[5226][522628]="锦屏县";
		$sub_arr[5226][522629]="剑河县";
		$sub_arr[5226][522630]="台江县";
		$sub_arr[5226][522631]="黎平县";
		$sub_arr[5226][522632]="榕江县";
		$sub_arr[5226][522633]="从江县";
		$sub_arr[5226][522634]="雷山县";
		$sub_arr[5226][522635]="麻江县";
		$sub_arr[5226][522636]="丹寨县";
		$l_arr[5227]="黔南布";
		$sub_arr[5227];
		$sub_arr[5227][0]="请选择";
		$sub_arr[5227][522701]="都匀市";
		$sub_arr[5227][522702]="福泉市";
		$sub_arr[5227][522722]="荔波县";
		$sub_arr[5227][522723]="贵定县";
		$sub_arr[5227][522725]="瓮安县";
		$sub_arr[5227][522726]="独山县";
		$sub_arr[5227][522727]="平塘县";
		$sub_arr[5227][522728]="罗甸县";
		$sub_arr[5227][522729]="长顺县";
		$sub_arr[5227][522730]="龙里县";
		$sub_arr[5227][522731]="惠水县";
		$sub_arr[5227][522732]="三都";
		$l_arr[5301]="昆明市";
		$sub_arr[5301];
		$sub_arr[5301][0]="请选择";
		$sub_arr[5301][530102]="五华区";
		$sub_arr[5301][530103]="盘龙区";
		$sub_arr[5301][530111]="官渡区";
		$sub_arr[5301][530112]="西山区";
		$sub_arr[5301][530113]="东川区";
		$sub_arr[5301][530121]="呈贡县";
		$sub_arr[5301][530122]="晋宁县";
		$sub_arr[5301][530124]="富民县";
		$sub_arr[5301][530125]="宜良县";
		$sub_arr[5301][530126]="石林";
		$sub_arr[5301][530127]="嵩明县";
		$sub_arr[5301][530128]="禄劝";
		$sub_arr[5301][530129]="寻甸";
		$sub_arr[5301][530181]="安宁市";
		$l_arr[5303]="曲靖市";
		$sub_arr[5303];
		$sub_arr[5303][0]="请选择";
		$sub_arr[5303][530302]="麒麟区";
		$sub_arr[5303][530321]="马龙县";
		$sub_arr[5303][530322]="陆良县";
		$sub_arr[5303][530323]="师宗县";
		$sub_arr[5303][530324]="罗平县";
		$sub_arr[5303][530325]="富源县";
		$sub_arr[5303][530326]="会泽县";
		$sub_arr[5303][530328]="沾益县";
		$sub_arr[5303][530381]="宣威市";
		$l_arr[5304]="玉溪市";
		$sub_arr[5304];
		$sub_arr[5304][0]="请选择";
		$sub_arr[5304][530402]="红塔区";
		$sub_arr[5304][530421]="江川县";
		$sub_arr[5304][530422]="澄江县";
		$sub_arr[5304][530423]="通海县";
		$sub_arr[5304][530424]="华宁县";
		$sub_arr[5304][530425]="易门县";
		$sub_arr[5304][530426]="峨山";
		$sub_arr[5304][530427]="新平";
		$sub_arr[5304][530428]="元江县";
		$l_arr[5305]="保山市";
		$sub_arr[5305];
		$sub_arr[5305][0]="请选择";
		$sub_arr[5305][530502]="隆阳区";
		$sub_arr[5305][530521]="施甸县";
		$sub_arr[5305][530522]="腾冲县";
		$sub_arr[5305][530523]="龙陵县";
		$sub_arr[5305][530524]="昌宁县";
		$l_arr[5306]="昭通市";
		$sub_arr[5306];
		$sub_arr[5306][0]="请选择";
		$sub_arr[5306][530602]="昭阳区";
		$sub_arr[5306][530621]="鲁甸县";
		$sub_arr[5306][530622]="巧家县";
		$sub_arr[5306][530623]="盐津县";
		$sub_arr[5306][530624]="大关县";
		$sub_arr[5306][530625]="永善县";
		$sub_arr[5306][530626]="绥江县";
		$sub_arr[5306][530627]="镇雄县";
		$sub_arr[5306][530628]="彝良县";
		$sub_arr[5306][530629]="威信县";
		$sub_arr[5306][530630]="水富县";
		$l_arr[5307]="丽江市";
		$sub_arr[5307];
		$sub_arr[5307][0]="请选择";
		$sub_arr[5307][530702]="古城区";
		$sub_arr[5307][530721]="玉龙县";
		$sub_arr[5307][530722]="永胜县";
		$sub_arr[5307][530723]="华坪县";
		$sub_arr[5307][530724]="宁蒗";
		$l_arr[5308]="普洱市(*)";
		$sub_arr[5308];
		$sub_arr[5308][0]="请选择";
		$sub_arr[5308][530802]="思茅区(*)";
		$sub_arr[5308][530821]="宁洱";
		$sub_arr[5308][530822]="墨江";
		$sub_arr[5308][530823]="景东";
		$sub_arr[5308][530824]="景谷";
		$sub_arr[5308][530825]="镇沅";
		$sub_arr[5308][530826]="江城县";
		$sub_arr[5308][530827]="孟连县";
		$sub_arr[5308][530828]="澜沧县";
		$sub_arr[5308][530829]="西盟";
		$l_arr[5309]="临沧市";
		$sub_arr[5309];
		$sub_arr[5309][0]="请选择";
		$sub_arr[5309][530902]="临翔区";
		$sub_arr[5309][530921]="凤庆县";
		$sub_arr[5309][530922]="云县";
		$sub_arr[5309][530923]="永德县";
		$sub_arr[5309][530924]="镇康县";
		$sub_arr[5309][530925]="双江县";
		$sub_arr[5309][530926]="耿马";
		$sub_arr[5309][530927]="沧源";
		$l_arr[5323]="楚雄";
		$sub_arr[5323];
		$sub_arr[5323][0]="请选择";
		$sub_arr[5323][532301]="楚雄市";
		$sub_arr[5323][532322]="双柏县";
		$sub_arr[5323][532323]="牟定县";
		$sub_arr[5323][532324]="南华县";
		$sub_arr[5323][532325]="姚安县";
		$sub_arr[5323][532326]="大姚县";
		$sub_arr[5323][532327]="永仁县";
		$sub_arr[5323][532328]="元谋县";
		$sub_arr[5323][532329]="武定县";
		$sub_arr[5323][532331]="禄丰县";
		$l_arr[5325]="红河";
		$sub_arr[5325];
		$sub_arr[5325][0]="请选择";
		$sub_arr[5325][532501]="个旧市";
		$sub_arr[5325][532502]="开远市";
		$sub_arr[5325][532522]="蒙自县";
		$sub_arr[5325][532523]="屏边";
		$sub_arr[5325][532524]="建水县";
		$sub_arr[5325][532525]="石屏县";
		$sub_arr[5325][532526]="弥勒县";
		$sub_arr[5325][532527]="泸西县";
		$sub_arr[5325][532528]="元阳县";
		$sub_arr[5325][532529]="红河县";
		$sub_arr[5325][532530]="金平";
		$sub_arr[5325][532531]="绿春县";
		$sub_arr[5325][532532]="河口";
		$l_arr[5326]="文山";
		$sub_arr[5326];
		$sub_arr[5326][0]="请选择";
		$sub_arr[5326][532621]="文山县";
		$sub_arr[5326][532622]="砚山县";
		$sub_arr[5326][532623]="西畴县";
		$sub_arr[5326][532624]="麻栗坡县";
		$sub_arr[5326][532625]="马关县";
		$sub_arr[5326][532626]="丘北县";
		$sub_arr[5326][532627]="广南县";
		$sub_arr[5326][532628]="富宁县";
		$l_arr[5328]="西双版纳";
		$sub_arr[5328];
		$sub_arr[5328][0]="请选择";
		$sub_arr[5328][532801]="景洪市";
		$sub_arr[5328][532822]="勐海县";
		$sub_arr[5328][532823]="勐腊县";
		$l_arr[5329]="大理";
		$sub_arr[5329];
		$sub_arr[5329][0]="请选择";
		$sub_arr[5329][532901]="大理市";
		$sub_arr[5329][532922]="漾濞";
		$sub_arr[5329][532923]="祥云县";
		$sub_arr[5329][532924]="宾川县";
		$sub_arr[5329][532925]="弥渡县";
		$sub_arr[5329][532926]="南涧";
		$sub_arr[5329][532927]="巍山";
		$sub_arr[5329][532928]="永平县";
		$sub_arr[5329][532929]="云龙县";
		$sub_arr[5329][532930]="洱源县";
		$sub_arr[5329][532931]="剑川县";
		$sub_arr[5329][532932]="鹤庆县";
		$l_arr[5331]="德宏";
		$sub_arr[5331];
		$sub_arr[5331][0]="请选择";
		$sub_arr[5331][533102]="瑞丽市";
		$sub_arr[5331][533103]="潞西市";
		$sub_arr[5331][533122]="梁河县";
		$sub_arr[5331][533123]="盈江县";
		$sub_arr[5331][533124]="陇川县";
		$l_arr[5333]="怒江";
		$sub_arr[5333];
		$sub_arr[5333][0]="请选择";
		$sub_arr[5333][533321]="泸水县";
		$sub_arr[5333][533323]="福贡县";
		$sub_arr[5333][533324]="贡山";
		$sub_arr[5333][533325]="兰坪";
		$l_arr[5334]="迪庆";
		$sub_arr[5334];
		$sub_arr[5334][0]="请选择";
		$sub_arr[5334][533421]="香格里拉县";
		$sub_arr[5334][533422]="德钦县";
		$sub_arr[5334][533423]="维西";
		$l_arr[5401]="拉萨市";
		$sub_arr[5401];
		$sub_arr[5401][0]="请选择";
		$sub_arr[5401][540102]="城关区";
		$sub_arr[5401][540121]="林周县";
		$sub_arr[5401][540122]="当雄县";
		$sub_arr[5401][540123]="尼木县";
		$sub_arr[5401][540124]="曲水县";
		$sub_arr[5401][540125]="堆龙德庆县";
		$sub_arr[5401][540126]="达孜县";
		$sub_arr[5401][540127]="墨竹工卡县";
		$l_arr[5421]="昌都地区";
		$sub_arr[5421];
		$sub_arr[5421][0]="请选择";
		$sub_arr[5421][542121]="昌都县";
		$sub_arr[5421][542122]="江达县";
		$sub_arr[5421][542123]="贡觉县";
		$sub_arr[5421][542124]="类乌齐县";
		$sub_arr[5421][542125]="丁青县";
		$sub_arr[5421][542126]="察雅县";
		$sub_arr[5421][542127]="八宿县";
		$sub_arr[5421][542128]="左贡县";
		$sub_arr[5421][542129]="芒康县";
		$sub_arr[5421][542132]="洛隆县";
		$sub_arr[5421][542133]="边坝县";
		$l_arr[5422]="山南地区";
		$sub_arr[5422];
		$sub_arr[5422][0]="请选择";
		$sub_arr[5422][542221]="乃东县";
		$sub_arr[5422][542222]="扎囊县";
		$sub_arr[5422][542223]="贡嘎县";
		$sub_arr[5422][542224]="桑日县";
		$sub_arr[5422][542225]="琼结县";
		$sub_arr[5422][542226]="曲松县";
		$sub_arr[5422][542227]="措美县";
		$sub_arr[5422][542228]="洛扎县";
		$sub_arr[5422][542229]="加查县";
		$sub_arr[5422][542231]="隆子县";
		$sub_arr[5422][542232]="错那县";
		$sub_arr[5422][542233]="浪卡子县";
		$l_arr[5423]="日喀则地区";
		$sub_arr[5423];
		$sub_arr[5423][0]="请选择";
		$sub_arr[5423][542301]="日喀则市";
		$sub_arr[5423][542322]="南木林县";
		$sub_arr[5423][542323]="江孜县";
		$sub_arr[5423][542324]="定日县";
		$sub_arr[5423][542325]="萨迦县";
		$sub_arr[5423][542326]="拉孜县";
		$sub_arr[5423][542327]="昂仁县";
		$sub_arr[5423][542328]="谢通门县";
		$sub_arr[5423][542329]="白朗县";
		$sub_arr[5423][542330]="仁布县";
		$sub_arr[5423][542331]="康马县";
		$sub_arr[5423][542332]="定结县";
		$sub_arr[5423][542333]="仲巴县";
		$sub_arr[5423][542334]="亚东县";
		$sub_arr[5423][542335]="吉隆县";
		$sub_arr[5423][542336]="聂拉木县";
		$sub_arr[5423][542337]="萨嘎县";
		$sub_arr[5423][542338]="岗巴县";
		$l_arr[5424]="那曲地区";
		$sub_arr[5424];
		$sub_arr[5424][0]="请选择";
		$sub_arr[5424][542421]="那曲县";
		$sub_arr[5424][542422]="嘉黎县";
		$sub_arr[5424][542423]="比如县";
		$sub_arr[5424][542424]="聂荣县";
		$sub_arr[5424][542425]="安多县";
		$sub_arr[5424][542426]="申扎县";
		$sub_arr[5424][542427]="索县";
		$sub_arr[5424][542428]="班戈县";
		$sub_arr[5424][542429]="巴青县";
		$sub_arr[5424][542430]="尼玛县";
		$l_arr[5425]="阿里地区";
		$sub_arr[5425];
		$sub_arr[5425][0]="请选择";
		$sub_arr[5425][542521]="普兰县";
		$sub_arr[5425][542522]="札达县";
		$sub_arr[5425][542523]="噶尔县";
		$sub_arr[5425][542524]="日土县";
		$sub_arr[5425][542525]="革吉县";
		$sub_arr[5425][542526]="改则县";
		$sub_arr[5425][542527]="措勤县";
		$l_arr[5426]="林芝地区";
		$sub_arr[5426];
		$sub_arr[5426][0]="请选择";
		$sub_arr[5426][542621]="林芝县";
		$sub_arr[5426][542622]="工布江达县";
		$sub_arr[5426][542623]="米林县";
		$sub_arr[5426][542624]="墨脱县";
		$sub_arr[5426][542625]="波密县";
		$sub_arr[5426][542626]="察隅县";
		$sub_arr[5426][542627]="朗县";
		$l_arr[6101]="西安市";
		$sub_arr[6101];
		$sub_arr[6101][0]="请选择";
		$sub_arr[6101][610102]="新城区";
		$sub_arr[6101][610103]="碑林区";
		$sub_arr[6101][610104]="莲湖区";
		$sub_arr[6101][610111]="灞桥区";
		$sub_arr[6101][610112]="未央区";
		$sub_arr[6101][610113]="雁塔区";
		$sub_arr[6101][610114]="阎良区";
		$sub_arr[6101][610115]="临潼区";
		$sub_arr[6101][610116]="长安区";
		$sub_arr[6101][610117]="沣渭新区";
		$sub_arr[6101][610122]="蓝田县";
		$sub_arr[6101][610124]="周至县";
		$sub_arr[6101][610125]="户县";
		$sub_arr[6101][610126]="高陵县";
		$l_arr[6102]="铜川市";
		$sub_arr[6102];
		$sub_arr[6102][0]="请选择";
		$sub_arr[6102][610202]="王益区";
		$sub_arr[6102][610203]="印台区";
		$sub_arr[6102][610204]="耀州区";
		$sub_arr[6102][610205]="新区";
		$sub_arr[6102][610222]="宜君县";
		$l_arr[6103]="宝鸡市";
		$sub_arr[6103];
		$sub_arr[6103][0]="请选择";
		$sub_arr[6103][610302]="渭滨区";
		$sub_arr[6103][610303]="金台区";
		$sub_arr[6103][610304]="陈仓区";
		$sub_arr[6103][610322]="凤翔县";
		$sub_arr[6103][610323]="岐山县";
		$sub_arr[6103][610324]="扶风县";
		$sub_arr[6103][610326]="眉县";
		$sub_arr[6103][610327]="陇县";
		$sub_arr[6103][610328]="千阳县";
		$sub_arr[6103][610329]="麟游县";
		$sub_arr[6103][610330]="凤县";
		$sub_arr[6103][610331]="太白县";
		$l_arr[6104]="咸阳市";
		$sub_arr[6104];
		$sub_arr[6104][0]="请选择";
		$sub_arr[6104][610402]="秦都区";
		$sub_arr[6104][610403]="杨凌区";
		$sub_arr[6104][610404]="渭城区";
		$sub_arr[6104][610422]="三原县";
		$sub_arr[6104][610423]="泾阳县";
		$sub_arr[6104][610424]="乾县";
		$sub_arr[6104][610425]="礼泉县";
		$sub_arr[6104][610426]="永寿县";
		$sub_arr[6104][610427]="彬县";
		$sub_arr[6104][610428]="长武县";
		$sub_arr[6104][610429]="旬邑县";
		$sub_arr[6104][610430]="淳化县";
		$sub_arr[6104][610431]="武功县";
		$sub_arr[6104][610481]="兴平市";
		$l_arr[6105]="渭南市";
		$sub_arr[6105];
		$sub_arr[6105][0]="请选择";
		$sub_arr[6105][610502]="临渭区";
		$sub_arr[6105][610521]="华县";
		$sub_arr[6105][610522]="潼关县";
		$sub_arr[6105][610523]="大荔县";
		$sub_arr[6105][610524]="合阳县";
		$sub_arr[6105][610525]="澄城县";
		$sub_arr[6105][610526]="蒲城县";
		$sub_arr[6105][610527]="白水县";
		$sub_arr[6105][610528]="富平县";
		$sub_arr[6105][610551]="高新区";
		$sub_arr[6105][610581]="韩城市";
		$sub_arr[6105][610582]="华阴市";
		$l_arr[6106]="延安市";
		$sub_arr[6106];
		$sub_arr[6106][0]="请选择";
		$sub_arr[6106][610602]="宝塔区";
		$sub_arr[6106][610621]="延长县";
		$sub_arr[6106][610622]="延川县";
		$sub_arr[6106][610623]="子长县";
		$sub_arr[6106][610624]="安塞县";
		$sub_arr[6106][610625]="志丹县";
		$sub_arr[6106][610626]="吴起县";
		$sub_arr[6106][610627]="甘泉县";
		$sub_arr[6106][610628]="富县";
		$sub_arr[6106][610629]="洛川县";
		$sub_arr[6106][610630]="宜川县";
		$sub_arr[6106][610631]="黄龙县";
		$sub_arr[6106][610632]="黄陵县";
		$l_arr[6107]="汉中市";
		$sub_arr[6107];
		$sub_arr[6107][0]="请选择";
		$sub_arr[6107][610702]="汉台区";
		$sub_arr[6107][610721]="南郑县";
		$sub_arr[6107][610722]="城固县";
		$sub_arr[6107][610723]="洋县";
		$sub_arr[6107][610724]="西乡县";
		$sub_arr[6107][610725]="勉县";
		$sub_arr[6107][610726]="宁强县";
		$sub_arr[6107][610727]="略阳县";
		$sub_arr[6107][610728]="镇巴县";
		$sub_arr[6107][610729]="留坝县";
		$sub_arr[6107][610730]="佛坪县";
		$sub_arr[6107][610751]="经济开发区";
		$l_arr[6108]="榆林市";
		$sub_arr[6108];
		$sub_arr[6108][0]="请选择";
		$sub_arr[6108][610802]="榆阳区";
		$sub_arr[6108][610821]="神木县";
		$sub_arr[6108][610822]="府谷县";
		$sub_arr[6108][610823]="横山县";
		$sub_arr[6108][610824]="靖边县";
		$sub_arr[6108][610825]="定边县";
		$sub_arr[6108][610826]="绥德县";
		$sub_arr[6108][610827]="米脂县";
		$sub_arr[6108][610828]="佳县";
		$sub_arr[6108][610829]="吴堡县";
		$sub_arr[6108][610830]="清涧县";
		$sub_arr[6108][610831]="子洲县";
		$l_arr[6109]="安康市";
		$sub_arr[6109];
		$sub_arr[6109][0]="请选择";
		$sub_arr[6109][610902]="汉滨区";
		$sub_arr[6109][610921]="汉阴县";
		$sub_arr[6109][610922]="石泉县";
		$sub_arr[6109][610923]="宁陕县";
		$sub_arr[6109][610924]="紫阳县";
		$sub_arr[6109][610925]="岚皋县";
		$sub_arr[6109][610926]="平利县";
		$sub_arr[6109][610927]="镇坪县";
		$sub_arr[6109][610928]="旬阳县";
		$sub_arr[6109][610929]="白河县";
		$l_arr[6110]="商洛市";
		$sub_arr[6110];
		$sub_arr[6110][0]="请选择";
		$sub_arr[6110][611002]="商州区";
		$sub_arr[6110][611021]="洛南县";
		$sub_arr[6110][611022]="丹凤县";
		$sub_arr[6110][611023]="商南县";
		$sub_arr[6110][611024]="山阳县";
		$sub_arr[6110][611025]="镇安县";
		$sub_arr[6110][611026]="柞水县";
		$l_arr[6151]="杨凌示范区";
		$sub_arr[6151];
		$sub_arr[6151][0]="请选择";
		$sub_arr[6151][615101]="杨凌区";
		$l_arr[6201]="兰州市";
		$sub_arr[6201];
		$sub_arr[6201][0]="请选择";
		$sub_arr[6201][620102]="城关区";
		$sub_arr[6201][620103]="七里河区";
		$sub_arr[6201][620104]="西固区";
		$sub_arr[6201][620105]="安宁区";
		$sub_arr[6201][620111]="红古区";
		$sub_arr[6201][620121]="永登县";
		$sub_arr[6201][620122]="皋兰县";
		$sub_arr[6201][620123]="榆中县";
		$l_arr[6203]="金昌市";
		$sub_arr[6203];
		$sub_arr[6203][0]="请选择";
		$sub_arr[6203][620302]="金川区";
		$sub_arr[6203][620321]="永昌县";
		$l_arr[6204]="白银市";
		$sub_arr[6204];
		$sub_arr[6204][0]="请选择";
		$sub_arr[6204][620402]="白银区";
		$sub_arr[6204][620403]="平川区";
		$sub_arr[6204][620421]="靖远县";
		$sub_arr[6204][620422]="会宁县";
		$sub_arr[6204][620423]="景泰县";
		$l_arr[6205]="天水市";
		$sub_arr[6205];
		$sub_arr[6205][0]="请选择";
		$sub_arr[6205][620502]="秦州区";
		$sub_arr[6205][620503]="麦积区";
		$sub_arr[6205][620521]="清水县";
		$sub_arr[6205][620522]="秦安县";
		$sub_arr[6205][620523]="甘谷县";
		$sub_arr[6205][620524]="武山县";
		$sub_arr[6205][620525]="张家川";
		$l_arr[6206]="武威市";
		$sub_arr[6206];
		$sub_arr[6206][0]="请选择";
		$sub_arr[6206][620602]="凉州区";
		$sub_arr[6206][620621]="民勤县";
		$sub_arr[6206][620622]="古浪县";
		$sub_arr[6206][620623]="天祝";
		$l_arr[6207]="张掖市";
		$sub_arr[6207];
		$sub_arr[6207][0]="请选择";
		$sub_arr[6207][620702]="甘州区";
		$sub_arr[6207][620721]="肃南县";
		$sub_arr[6207][620722]="民乐县";
		$sub_arr[6207][620723]="临泽县";
		$sub_arr[6207][620724]="高台县";
		$sub_arr[6207][620725]="山丹县";
		$l_arr[6208]="平凉市";
		$sub_arr[6208];
		$sub_arr[6208][0]="请选择";
		$sub_arr[6208][620802]="崆峒区";
		$sub_arr[6208][620821]="泾川县";
		$sub_arr[6208][620822]="灵台县";
		$sub_arr[6208][620823]="崇信县";
		$sub_arr[6208][620824]="华亭县";
		$sub_arr[6208][620825]="庄浪县";
		$sub_arr[6208][620826]="静宁县";
		$l_arr[6209]="酒泉市";
		$sub_arr[6209];
		$sub_arr[6209][0]="请选择";
		$sub_arr[6209][620902]="肃州区";
		$sub_arr[6209][620921]="金塔县";
		$sub_arr[6209][620922]="瓜州县";
		$sub_arr[6209][620923]="肃北";
		$sub_arr[6209][620924]="阿克塞";
		$sub_arr[6209][620981]="玉门市";
		$sub_arr[6209][620982]="敦煌市";
		$l_arr[6210]="庆阳市";
		$sub_arr[6210];
		$sub_arr[6210][0]="请选择";
		$sub_arr[6210][621002]="西峰区";
		$sub_arr[6210][621021]="庆城县";
		$sub_arr[6210][621022]="环县";
		$sub_arr[6210][621023]="华池县";
		$sub_arr[6210][621024]="合水县";
		$sub_arr[6210][621025]="正宁县";
		$sub_arr[6210][621026]="宁县";
		$sub_arr[6210][621027]="镇原县";
		$l_arr[6211]="定西市";
		$sub_arr[6211];
		$sub_arr[6211][0]="请选择";
		$sub_arr[6211][621102]="安定区";
		$sub_arr[6211][621121]="通渭县";
		$sub_arr[6211][621122]="陇西县";
		$sub_arr[6211][621123]="渭源县";
		$sub_arr[6211][621124]="临洮县";
		$sub_arr[6211][621125]="漳县";
		$sub_arr[6211][621126]="岷县";
		$l_arr[6212]="陇南市";
		$sub_arr[6212];
		$sub_arr[6212][0]="请选择";
		$sub_arr[6212][621202]="武都区";
		$sub_arr[6212][621221]="成县";
		$sub_arr[6212][621222]="文县";
		$sub_arr[6212][621223]="宕昌县";
		$sub_arr[6212][621224]="康县";
		$sub_arr[6212][621225]="西和县";
		$sub_arr[6212][621226]="礼县";
		$sub_arr[6212][621227]="徽县";
		$sub_arr[6212][621228]="两当县";
		$l_arr[6229]="临夏";
		$sub_arr[6229];
		$sub_arr[6229][0]="请选择";
		$sub_arr[6229][622901]="临夏市";
		$sub_arr[6229][622921]="临夏县";
		$sub_arr[6229][622922]="康乐县";
		$sub_arr[6229][622923]="永靖县";
		$sub_arr[6229][622924]="广河县";
		$sub_arr[6229][622925]="和政县";
		$sub_arr[6229][622926]="东乡";
		$sub_arr[6229][622927]="积石山";
		$l_arr[6230]="甘南";
		$sub_arr[6230];
		$sub_arr[6230][0]="请选择";
		$sub_arr[6230][623001]="合作市";
		$sub_arr[6230][623021]="临潭县";
		$sub_arr[6230][623022]="卓尼县";
		$sub_arr[6230][623023]="舟曲县";
		$sub_arr[6230][623024]="迭部县";
		$sub_arr[6230][623025]="玛曲县";
		$sub_arr[6230][623026]="碌曲县";
		$sub_arr[6230][623027]="夏河县";
		$l_arr[6301]="西宁市";
		$sub_arr[6301];
		$sub_arr[6301][0]="请选择";
		$sub_arr[6301][630102]="城东区";
		$sub_arr[6301][630103]="城中区";
		$sub_arr[6301][630104]="城西区";
		$sub_arr[6301][630105]="城北区";
		$sub_arr[6301][630121]="大通";
		$sub_arr[6301][630122]="湟中县";
		$sub_arr[6301][630123]="湟源县";
		$l_arr[6321]="海东地区";
		$sub_arr[6321];
		$sub_arr[6321][0]="请选择";
		$sub_arr[6321][632121]="平安县";
		$sub_arr[6321][632122]="民和";
		$sub_arr[6321][632123]="乐都县";
		$sub_arr[6321][632126]="互助";
		$sub_arr[6321][632127]="化隆";
		$sub_arr[6321][632128]="循化";
		$l_arr[6322]="海北";
		$sub_arr[6322];
		$sub_arr[6322][0]="请选择";
		$sub_arr[6322][632221]="门源";
		$sub_arr[6322][632222]="祁连县";
		$sub_arr[6322][632223]="海晏县";
		$sub_arr[6322][632224]="刚察县";
		$l_arr[6323]="黄南";
		$sub_arr[6323];
		$sub_arr[6323][0]="请选择";
		$sub_arr[6323][632321]="同仁县";
		$sub_arr[6323][632322]="尖扎县";
		$sub_arr[6323][632323]="泽库县";
		$sub_arr[6323][632324]="河南";
		$l_arr[6325]="海南";
		$sub_arr[6325];
		$sub_arr[6325][0]="请选择";
		$sub_arr[6325][632521]="共和县";
		$sub_arr[6325][632522]="同德县";
		$sub_arr[6325][632523]="贵德县";
		$sub_arr[6325][632524]="兴海县";
		$sub_arr[6325][632525]="贵南县";
		$l_arr[6326]="果洛";
		$sub_arr[6326];
		$sub_arr[6326][0]="请选择";
		$sub_arr[6326][632621]="玛沁县";
		$sub_arr[6326][632622]="班玛县";
		$sub_arr[6326][632623]="甘德县";
		$sub_arr[6326][632624]="达日县";
		$sub_arr[6326][632625]="久治县";
		$sub_arr[6326][632626]="玛多县";
		$l_arr[6327]="玉树";
		$sub_arr[6327];
		$sub_arr[6327][0]="请选择";
		$sub_arr[6327][632721]="玉树县";
		$sub_arr[6327][632722]="杂多县";
		$sub_arr[6327][632723]="称多县";
		$sub_arr[6327][632724]="治多县";
		$sub_arr[6327][632725]="囊谦县";
		$sub_arr[6327][632726]="曲麻莱县";
		$l_arr[6328]="海西";
		$sub_arr[6328];
		$sub_arr[6328][0]="请选择";
		$sub_arr[6328][632801]="格尔木市";
		$sub_arr[6328][632802]="德令哈市";
		$sub_arr[6328][632821]="乌兰县";
		$sub_arr[6328][632822]="都兰县";
		$sub_arr[6328][632823]="天峻县";
		$l_arr[6401]="银川市";
		$sub_arr[6401];
		$sub_arr[6401][0]="请选择";
		$sub_arr[6401][640104]="兴庆区";
		$sub_arr[6401][640105]="西夏区";
		$sub_arr[6401][640106]="金凤区";
		$sub_arr[6401][640121]="永宁县";
		$sub_arr[6401][640122]="贺兰县";
		$sub_arr[6401][640181]="灵武市";
		$l_arr[6402]="石嘴山市";
		$sub_arr[6402];
		$sub_arr[6402][0]="请选择";
		$sub_arr[6402][640202]="大武口区";
		$sub_arr[6402][640205]="惠农区";
		$sub_arr[6402][640221]="平罗县";
		$l_arr[6403]="吴忠市";
		$sub_arr[6403];
		$sub_arr[6403][0]="请选择";
		$sub_arr[6403][640302]="利通区";
		$sub_arr[6403][640303]="红寺堡区";
		$sub_arr[6403][640323]="盐池县";
		$sub_arr[6403][640324]="同心县";
		$sub_arr[6403][640381]="青铜峡市";
		$l_arr[6404]="固原市";
		$sub_arr[6404];
		$sub_arr[6404][0]="请选择";
		$sub_arr[6404][640402]="原州区";
		$sub_arr[6404][640422]="西吉县";
		$sub_arr[6404][640423]="隆德县";
		$sub_arr[6404][640424]="泾源县";
		$sub_arr[6404][640425]="彭阳县";
		$l_arr[6405]="中卫市";
		$sub_arr[6405];
		$sub_arr[6405][0]="请选择";
		$sub_arr[6405][640502]="沙坡头区";
		$sub_arr[6405][640521]="中宁县";
		$sub_arr[6405][640522]="海原县";
		$l_arr[6501]="乌鲁木齐市";
		$sub_arr[6501];
		$sub_arr[6501][0]="请选择";
		$sub_arr[6501][650102]="天山区";
		$sub_arr[6501][650103]="沙依巴克区";
		$sub_arr[6501][650104]="新市区";
		$sub_arr[6501][650105]="水磨沟区";
		$sub_arr[6501][650106]="头屯河区";
		$sub_arr[6501][650107]="达坂城区";
		$sub_arr[6501][650109]="米东区(*)";
		$sub_arr[6501][650121]="乌鲁木齐县";
		$l_arr[6502]="克拉玛依市";
		$sub_arr[6502];
		$sub_arr[6502][0]="请选择";
		$sub_arr[6502][650202]="独山子区";
		$sub_arr[6502][650203]="克拉玛依区";
		$sub_arr[6502][650204]="白碱滩区";
		$sub_arr[6502][650205]="乌尔禾区";
		$l_arr[6521]="吐鲁番地区";
		$sub_arr[6521];
		$sub_arr[6521][0]="请选择";
		$sub_arr[6521][652101]="吐鲁番市";
		$sub_arr[6521][652122]="鄯善县";
		$sub_arr[6521][652123]="托克逊县";
		$l_arr[6522]="哈密地区";
		$sub_arr[6522];
		$sub_arr[6522][0]="请选择";
		$sub_arr[6522][652201]="哈密市";
		$sub_arr[6522][652222]="巴里坤";
		$sub_arr[6522][652223]="伊吾县";
		$l_arr[6523]="昌吉";
		$sub_arr[6523];
		$sub_arr[6523][0]="请选择";
		$sub_arr[6523][652301]="昌吉市";
		$sub_arr[6523][652302]="阜康市";
		$sub_arr[6523][652323]="呼图壁县";
		$sub_arr[6523][652324]="玛纳斯县";
		$sub_arr[6523][652325]="奇台县";
		$sub_arr[6523][652327]="吉木萨尔县";
		$sub_arr[6523][652328]="木垒哈萨克";
		$l_arr[6527]="博尔塔拉";
		$sub_arr[6527];
		$sub_arr[6527][0]="请选择";
		$sub_arr[6527][652701]="博乐市";
		$sub_arr[6527][652722]="精河县";
		$sub_arr[6527][652723]="温泉县";
		$l_arr[6528]="巴音郭楞";
		$sub_arr[6528];
		$sub_arr[6528][0]="请选择";
		$sub_arr[6528][652801]="库尔勒市";
		$sub_arr[6528][652822]="轮台县";
		$sub_arr[6528][652823]="尉犁县";
		$sub_arr[6528][652824]="若羌县";
		$sub_arr[6528][652825]="且末县";
		$sub_arr[6528][652826]="焉耆";
		$sub_arr[6528][652827]="和静县";
		$sub_arr[6528][652828]="和硕县";
		$sub_arr[6528][652829]="博湖县";
		$l_arr[6529]="阿克苏地区";
		$sub_arr[6529];
		$sub_arr[6529][0]="请选择";
		$sub_arr[6529][652901]="阿克苏市";
		$sub_arr[6529][652922]="温宿县";
		$sub_arr[6529][652923]="库车县";
		$sub_arr[6529][652924]="沙雅县";
		$sub_arr[6529][652925]="新和县";
		$sub_arr[6529][652926]="拜城县";
		$sub_arr[6529][652927]="乌什县";
		$sub_arr[6529][652928]="阿瓦提县";
		$sub_arr[6529][652929]="柯坪县";
		$l_arr[6530]="克孜勒";
		$sub_arr[6530];
		$sub_arr[6530][0]="请选择";
		$sub_arr[6530][653001]="阿图什市";
		$sub_arr[6530][653022]="阿克陶县";
		$sub_arr[6530][653023]="阿合奇县";
		$sub_arr[6530][653024]="乌恰县";
		$l_arr[6531]="喀什地区";
		$sub_arr[6531];
		$sub_arr[6531][0]="请选择";
		$sub_arr[6531][653101]="喀什市";
		$sub_arr[6531][653121]="疏附县";
		$sub_arr[6531][653122]="疏勒县";
		$sub_arr[6531][653123]="英吉沙县";
		$sub_arr[6531][653124]="泽普县";
		$sub_arr[6531][653125]="莎车县";
		$sub_arr[6531][653126]="叶城县";
		$sub_arr[6531][653127]="麦盖提县";
		$sub_arr[6531][653128]="岳普湖县";
		$sub_arr[6531][653129]="伽师县";
		$sub_arr[6531][653130]="巴楚县";
		$sub_arr[6531][653131]="塔什";
		$l_arr[6532]="和田地区";
		$sub_arr[6532];
		$sub_arr[6532][0]="请选择";
		$sub_arr[6532][653201]="和田市";
		$sub_arr[6532][653221]="和田县";
		$sub_arr[6532][653222]="墨玉县";
		$sub_arr[6532][653223]="皮山县";
		$sub_arr[6532][653224]="洛浦县";
		$sub_arr[6532][653225]="策勒县";
		$sub_arr[6532][653226]="于田县";
		$sub_arr[6532][653227]="民丰县";
		$l_arr[6540]="伊犁";
		$sub_arr[6540];
		$sub_arr[6540][0]="请选择";
		$sub_arr[6540][654002]="伊宁市";
		$sub_arr[6540][654003]="奎屯市";
		$sub_arr[6540][654021]="伊宁县";
		$sub_arr[6540][654022]="察布查尔锡伯";
		$sub_arr[6540][654023]="霍城县";
		$sub_arr[6540][654024]="巩留县";
		$sub_arr[6540][654025]="新源县";
		$sub_arr[6540][654026]="昭苏县";
		$sub_arr[6540][654027]="特克斯县";
		$sub_arr[6540][654028]="尼勒克县";
		$l_arr[6542]="塔城地区";
		$sub_arr[6542];
		$sub_arr[6542][0]="请选择";
		$sub_arr[6542][654201]="塔城市";
		$sub_arr[6542][654202]="乌苏市";
		$sub_arr[6542][654221]="额敏县";
		$sub_arr[6542][654223]="沙湾县";
		$sub_arr[6542][654224]="托里县";
		$sub_arr[6542][654225]="裕民县";
		$sub_arr[6542][654226]="和布克赛尔";
		$l_arr[6543]="阿勒泰地区";
		$sub_arr[6543];
		$sub_arr[6543][0]="请选择";
		$sub_arr[6543][654301]="阿勒泰市";
		$sub_arr[6543][654321]="布尔津县";
		$sub_arr[6543][654322]="富蕴县";
		$sub_arr[6543][654323]="福海县";
		$sub_arr[6543][654324]="哈巴河县";
		$sub_arr[6543][654325]="青河县";
		$sub_arr[6543][654326]="吉木乃县";
		$l_arr[6590]="自治区直辖县级行政单位";
		$sub_arr[6590];
		$sub_arr[6590][0]="请选择";
		$sub_arr[6590][659001]="石河子市";
		$sub_arr[6590][659002]="阿拉尔市";
		$sub_arr[6590][659003]="图木舒克市";
		$sub_arr[6590][659004]="五家渠市";
		$good=M('address')->find($id);
		
		$address=$area_array[$good['prov']].' '.$sub_array[$good['prov']][$good['city']].' '.$sub_arr[$good['city']][$good['district']];
		$address.=' '.$good['address'].' 邮编:'.$good['zipcode'];
		return $address;
	}
	
	function sendtime($id){
		$send=M('send')->where(array('oderid'=>$id))->find();
		return date('Y-m-d h:s:i',$send['date']);
	}
	/**
	 * [php2class 转换成Think默认命名规则类]
	 * e.g:
	 * 修改文件夹下所有的php文件:.php --> .class.php
	 * php2class(__FILE__,'Action\MemberAction.class.php','Tool');
	 * @param [type] $path     		[文件夹路劲]
	 * @param [type] $reg_path 		[要替换文件夹]
	 * @param [type] $sea_path 		[待替换文件夹]
	 * @param  boolean $print    	[是否输出]
	 * @return [type]            	[description]
	 */
	function php2class($path,$reg_path,$sea_path,$print=false){
		$hostdir=!empty($path)?$path:__FILE__;

        if(!empty($reg_path) && !empty($sea_path)){
        	 $hostdir=str_replace($reg_path,$sea_path,$hostdir);
        } 

        $filesnames = scandir($hostdir);
        foreach ($filesnames as $k => $v) {
            if($k>1){ //修改类名
                if(strpos($v,'class')===false){
                    $temp=explode('.', $v);
                    $n=$hostdir.'\\'.$temp[0].'.class.php';
                    $o=$hostdir.'\\'.$v;
                    rename($o,$n);
                    if($print){
                    	p($n);
                    }
                }else{
                	if($print){
                		p($v);
                	}
                }
            }
         }     
	}

	/**
	 * [gameName 获取游戏名称]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function gameName($id){
		if($id==-1){
			return '通用道具';
		}else{
			//$model=$this->_marketDB('game');
			//
			
			return '专有道具';
		}
	}
