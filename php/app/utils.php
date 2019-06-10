<?php
class Obj{ 
    function __construct(Array $n=[]) { 
        if(is_array($n)){
            foreach( $n as $key=>$val) { 
                $this->{$key} = $val ; 
            }
        }
    } 
}
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$chars .= '!@#$%^&*()';
if(class_exists("Thread")){
	class AsyncOperation extends Thread{
		public function __construct($callable=null,$args=[]){
			if(func_num_args()>2){
				$this->args=func_get_args();
				$this->callback=$this->args[0];
				$this->args=array_shift($this->args);
			}else{
				func_get_args();
				$this->callback=$callable;
				if(is_array($args)){
					$this->args=$args;
				}else{
					$this->args=[$args];
				}		
			}
		}
		public function run(){
			if(is_callable($this->callback)){
				call_user_func_array($this->callback, $this->args);
			}
		}
	}
}
function randaval($min,$max){
	if(isset($GLOBALS['wp_rand_val'])){
		$newrand=random_int( $min, $max );
		if($GLOBALS['wp_rand_val']==$newrand){
			$GLOBALS['wp_rand_val']=randaval( $min, $max );
		}else{
			$GLOBALS['wp_rand_val']=random_int( $min, $max );
		}
	}else{
		$GLOBALS['wp_rand_val']=random_int( $min, $max );
	}
	return $GLOBALS['wp_rand_val'];
}
function wp_rand($min,$max){
	$min=(int) $min;
	$max=(int) $max;
	return randaval($min,$max);
	
}
function wp_generate_password($length = 12, $special_chars = true, $extra_special_chars = false ) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	if ( $special_chars ) {
		$chars .= '!@#$%^&*()';
	}
	if ( $extra_special_chars ) {
		$chars .= '-_ []{}<>~`+=,.;:/?|';
	}

	$password = '';
	for ( $i = 0; $i < $length; $i++ ) {
		$password .= substr( $chars, wp_rand( 0, strlen( $chars ) - 1 ), 1 );
	}

	/**
	 * Filters the randomly-generated password.
	 *
	 * @since 3.0.0
	 *
	 * @param string $password The generated password.
	 */
	// $password=str_shuffle($password);
	// $password=str_split($password);
	// $password=implode("",$password);
	if(isset($GLOBALS['wp_gen_pass_val'])){
		if(@$GLOBALS['wp_gen_pass_val'][$password]==1){
			return wp_generate_password($length,$special_chars,$extra_special_chars);
		}else{
			$GLOBALS['wp_gen_pass_val'][$password]=1;
			return $password;
		}
	}else{
		$GLOBALS['wp_gen_pass_val']=[$password=>1];
		return $password;
	}
}
function nextout($check='',$chars=[]){
	if(!in_array($check, $chars)){
		return $chars[0];
	}else{
		for ($i = count($chars) - 1; $i >= 0; $i--) {
			if($chars[count($chars)-1]==$check){
				return $chars[0];
			}
			else if($chars[$i]==$check){
				return $chars[$i+1];
			}
		}
	}
}
function checkifismax($str="",$chars=[]){
	if($str!=""){
		$chr="";
		foreach(str_split($str) as $s){
			$chr.=$chars[count($chars)-1];
		}
		if($str==$chr){
			return true;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}
function ismax($str="",$chars=[]){
	$chr="";
	if($str!=""){
		if(checkifismax($str,$chars)){
			foreach(str_split($str) as $s){
				$chr.=$chars[0];
			}
			return $chr.$chars[0];
		}else{
			return $str;
		}
	}else{
		return $str;
	}

}
function chars_increment($word='',$use_lowercase=true,$use_uppercase=true,$use_number=true,$use_special_chars = true, $use_extra_special_chars = false){
	$result=[];
	static $chars =[];
	$chars_lowercase= array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
    'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	$chars_uppercase= array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
    'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	$chars_number=array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	$chars_special=array("!","@","#","$","%","^","&","*","(",")");
	$chars_extra_special=array("-","_"," ","[","]","{","}","<",">","~","`","+","=",",",".",";",":","/","?","|");
	if($use_lowercase){
		foreach ($chars_lowercase as $value) {
			# code...
			$chars[]=$value;
		}
	}
	if($use_uppercase){
		foreach ($chars_uppercase as $value) {
			# code...
			$chars[]=$value;
		}
	}
	if($use_number){
		foreach ($chars_number as $value) {
			# code...
			$chars[]=$value;
		}
	}
	if($use_special_chars){
		foreach ($chars_special as $value) {
			# code...
			$chars[]=$value;
		}
	}
	if($use_extra_special_chars){
		foreach ($chars_extra_special as $value) {
			# code...
			$chars[]=$value;
		}
	}
	// code continues here
	if(is_string($word)){
		if(checkifismax($word,$chars)){
			return ismax($word,$chars);
		}
		$word=str_split($word);
		for($f=count($word)-1;$f>=0;$f--) {
			# code...
			if($word[$f]==$chars[count($chars)-1]){
				$word[$f]=nextout($word[$f],$chars);
			}else{
				$word[$f]=nextout($word[$f],$chars);
				break;
			}		
		}
		return implode("",$word);
	}else{
		return $word;
	}
}
function readline_terminal($prompt = '') {
    $prompt && print $prompt;
    $terminal_device = '/dev/tty';
    $h = fopen($terminal_device, 'r');
    if ($h === false) {
        #throw new RuntimeException("Failed to open terminal device $terminal_device");
        return false; # probably not running in a terminal.
    }
    $line = rtrim(fgets($h),"\r\n");
    fclose($h);
    return $line;
}
function  get_file($where,$line=null){
	static $r;
	if ($stream = fopen($where, 'r')) {
		$r= stream_get_contents($stream);
		fclose($stream);
		if(is_int($line) and $stream || is_string($line) and $stream){
			$r=preg_split("/\r\n|\n|\r/", $r);
			print_r($r);
			if(is_string($line)){
				if($line=="all"){
					return $r;
				}
				elseif($line=="first"){
					return isset($r[0])?$r[0]:'';
				}elseif($line=="middle"){
					return isset($r[(count($r)-1)/2])?$r[(count($r)-1)/2]:'';
				}elseif($line=="last"){
					return isset($r[count($r)-1])?$r[count($r)-1]:'';
				}else{
					return "";
				}
			}else{
				if(@$r[$line]){
					return $r[$line];
				}else{
					return "";
				}
			}
		}
		else{
			return $r;
		}
	}
	else{
		return '';
	}
}
function get_json($where=null,$ary=false){
	if(!is_null($where)){
		if ($stream = fopen($where, 'r')) {
		    return json_decode(stream_get_contents($stream),$ary);
		    fclose($stream);
		}
	}else{
		return json_decode("{}",$ary);
	}
}
function write_new_line($name,$EOL="\n"){
	if(!is_null($name)){
		$fp = fopen($name, 'a+');
		if($fp){
			fwrite($fp, $txt);
			fclose($fp);
		}
	}
}
function write_to_file($name=null,$txt=null,$ftr=false){
	if(!is_null($name)){
		$fp = fopen($name, 'a+');
		if(flock($fp, LOCK_EX)){
			if(!is_null($txt) and $fp){
				if($ftr)ftruncate($fp, 0);
				fwrite($fp, $txt);
			}
			else{
				ftruncate($fp, 0);
			}
			flock($fp, LOCK_UN);
		}else{
			echo "$name file in use\r\n";
		}
		fclose($fp);
		return true;
	}
	return false;
}
function increment($string){
    $last_char=substr($string,-1);
    $rest=substr($string, 0, -1);
    switch ($last_char) {
    case '':
        $next= 'a';
        break;
    case 'z':
        $next= 'A';
        break;
    case 'Z':
        $next= '0';
        break;
    case '9':
        $rest=increment($rest);
        $next= 'a';
        break;
    default:
        $next= ++$last_char;
    }
    $string=$rest.$next;
    return $string;
}
function key_dictionary($length=1,$function=null,$start=1){
	$array=[];
	$word="";
	if($start=="use:dictionary"){
		$json=get_json("../database/words_dictionary.json");
		foreach ($json as $key => $value) {
			if($function){
				$r=[$key];
			    $function($key,$r);
			}
		}
	}else{
		if(is_int($start)){
		for($i=1;$i<=$start;$i++){
			$word.="a";
			}
		}
		else{
			$word=$start;
		}
		if($start==0){
			$add=1;
		}else{
			$add=0;
		}
		while($length>=strlen($word)){
			$array[]=$word;
			if($function){
		    	$function($word,$array);
		    }
			$word=increment($word);	
		}
	}
	
}
function matrix_possible($arr){
	$return=[];
	if(is_array($arr)){
		$a=[];
		for($h=0;$h<count($arr);$h++){
			$a[]=0;
		}
		$count=count($a)-1;
		while($a[0]<count($arr[0])){
			$res='';
			for($n=0;$n<count($a);$n++){	
				$res.=$arr[$n][$a[$n]];
			}
			$res."\n";
			if($res){
				$return[]=$res;
			}
			// echo($arr[0][$a].$arr[1][$b].$arr[2][$c]."\n");
			// if($c==count($arr[2])-1){
			// 	$b++;
			// 	$c=0;
			// }
			// if($b==count($arr[1])-1){
			// 	$a++;
			// 	$b=0;
			// }
			for($key=0;$key<count($a);$key++) {
				$value=$a[$key];		
				# code...
				// print($a[$count]." ss\n");
				// print($key." $value\n");
				// print_r($arr[count($a)-1]);
				if($count>0 and $a[$count]==count($arr[$count])-1){
					$a[$count]=0;
					$a[$count-1]++;
				}
				if($key!=$count and $key!=0 and $value==count($arr[$key])-1){
					$a[$key-1]++;
					$a[$key]=0;
				}
				
			}	
			$a[$count]++;	 
		}
	}else{
		return [];
	}
	return $return;
}
function substrwords($text, $maxchar=100, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);      
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } 
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } 
    else {
        $output = $text;
    }
    return $output;
}
class tweet{
	protected $tweets=[];
	public $hashtag=null;
	public function set ($json){
		$decode=json_decode($json);
		foreach ($decode as $key=>$value) {
			# code...
			$this->tweets[$key]=$value;
		}
	}
	public function get (){
		return $this->tweets;
	}
	protected function find ($id){
		$id=trim($id);
		if(count($this->tweets)<0){
			echo "no tweet to check from";
		}
		else{
			$found=false;
			foreach ($this->tweets as $key => $value) {
    			# code...
				// loop through all data from json
    			if(preg_match("/^\#/i", $id)){
    				// check if input has hash if dont add
    				if(preg_match("/".$id."[^a-z0-9]/i", $value)){
    					echo "\n\n";
    					echo $key ." tweeted:\n";
	    				echo preg_replace("/(".$id.")[^a-z0-9]/i", "<b>$1</b>", $value)."\n";
	    				$found=true;
	    			}
    			}else{
					if(preg_match("/\#".$id."[^a-z0-9]/i", $value)){
						// check if input doesn\'t have hash if add
						echo "\n\n";
						echo $key ." tweeted:\n";
	    				echo preg_replace("/(\#".$id.")[^a-z0-9]/i", "<b>$1</b>", $value)."\n";
	    				$found=true;
	    			}
    			}
    		}
    		if($found==false){
    			// this will be called only if tweet is not found
    			echo "hashtag: ";
    			echo preg_match("/^\#/i", $id)? $id:"#".$id	;
    			echo " was not found on the tweets list\n";
    		}
		}
		
	}
	public function run(){
		// because find is  protected , only run can call it from within
		$this->find($this->hashtag);
	}
}
/**
 * fakebrowser
 */
class FakeBrowser
{
	protected $brosername;
	protected $head;
	protected $url;
	protected $methods;
	protected $response=[];
	protected $options=[];
	protected $robotname="Robot/MichaelPiper Niarablasted Goldpack";
	function __construct($args="Robot",$url="http://google.com"){
		# code...
		// "Accept-Encoding"=>"Accept-Encoding: deflate, br",
		$this->options['http']=[];
		$headgettmpl=[
			"header"=>[
				"Host"=>"Host: google.com",
				"User-Agent"=> "User-Agent: {$this->robotname} Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36",
				"Accept"=>"Accept: text/xml,text/csv,text/json,text/html,text/plain,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
				"Connection"=>"Connection: keep-alive",
				"Upgrade-Insecure-Requests"=>"Upgrade-Insecure-Requests: 1",
				"Accept-Language"=>"Accept-Language: en-US,en;q=0.9",
			],
			"method"=>"GET",
			"ignore_errors"=>1,
			"follow_location"=>1,
			"max_redirects"=>1
		];
		$headposttmpl=[
			"header"=>[
				"Host"=>"Host: google.com",
				"User-Agent"=> "User-Agent: {$this->robotname} Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36",
				"Accept"=>"Accept: text/xml,text/csv,text/json,text/html,text/plain,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
				"Connection"=>"Connection: keep-alive",
				"Upgrade-Insecure-Requests"=>"Upgrade-Insecure-Requests: 1",
				"Accept-Language"=>"Accept-Language: en-US,en;q=0.9",
				"Cache-Control"=>"Cache-Control: max-age=0",
				"Origin"=>"Origin: null",
				"Content-Type"=>"Content-Type: application/x-www-form-urlencoded",
				"Content-Length"=>"Content-Length: 0"
			],
			"method"=>"POST",
			"content"=>"",
			"ignore_errors"=>1,
			"follow_location"=>1,
			"max_redirects"=>1
		];
		$headdeletetmpl=[
			"method"=>"DELETE",
			"content"=>"",
			"ignore_errors"=>1,
			"follow_location"=>1,
			"max_redirects"=>1
		];
		$headputtmpl=[
			"method"=>"PUT",
			"content"=>"",
			"ignore_errors"=>1,
			"follow_location"=>1,
			"max_redirects"=>1
		];
		$this->methods['GET']=$headgettmpl;
		$this->methods['POST']=$headposttmpl;
		$this->methods['DELETE']=$headdeletetmpl;
		$this->methods['PUT']=$headputtmpl;
		if(is_array($args)){
			if(isset($args['url'])){
				$this->url=$args['url'];
			}
			if(isset($args['method'])){
				$this->setBrowserMethod($args['method']);
			}
			if(isset($args['brosername'])){
				$this->setBrowserAgent($args['brosername']);
			}
			if(isset($args['host'])){
				$this->setBrowserHost($args['host']);
			}
			if(isset($args['content'])){
				$this->setBrowserContent($args['content']);
			}
		}
		elseif(is_string($args)){
			$this->setURL($url);
			$this->setBrowserMethod("GET");
			$this->setBrowserAgent($args);
		}
		else{
			$this->setBrowserMethod("GET");
		}
	}
	public function setURL($url=""){
		if(!empty($url)){
			$this->url=$url;
			return "url set";
		}
		else {
			return "url can\'t be empty";
		}
	}
	public function getURL(){
		if(!empty($this->url)){
			return "{$this->url}";
		}
		else {
			return "url not set";
		}
	}
	public function setBrowserAgent($agent=null){
		if(!is_null($agent)){
			$agent=strtoupper($agent);
			// echo $agent;
			if($agent=="CHROME"){
				$a="User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36";
				$this->options['http']['header']["User-Agent"]=$a;
			}
			elseif($agent=="FIREFOX"){
				$a="User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:67.0) Gecko/20100101 Firefox/67.0";
				$this->options['http']['header']["User-Agent"]=$a;
				$this->options['http']['header']["Cache-Control"]="Cache-Control: max-age=0";
			}		
		}
	}
	public function formatCookies($cookiesjar=null){
		static $arr,$cookie,$key;
		if(is_string($cookiesjar)){
			$arr = [];
			// print($cookiesjar);
			foreach (explode(" ", substr($cookiesjar, 7)) as $cookie) {
				# code...
				if($cookie !="" and $cookie!=" "){
					$key=explode("=",$cookie);
					$arr[$key[0]]=$cookie;
				}
			}
			return "Cookie: ".implode(" ", $arr);
		}else{
			return "Cookie:";
		}

	}
	public function setBrowserCookies($cookiesjar=null){
		static $Cookie_me,$value,$cval;
		$Cookie_me='';
		if(is_array($cookiesjar)){	
			foreach ($cookiesjar as $value) {
				# code...
				if(is_array($value)){
					foreach ($value as $cval) {
						$Cookie_me.=" {$key}={$cval};";
					}
				}else{
					$Cookie_me.=" ".$value;	
				}
			}
		}elseif(is_string($cookiesjar)){
			$Cookie_me=" ".$cookiesjar;
		}

		if(@preg_match("/Cookie: (.*)/i", $this->options['http']['header']["Cookie"])){
			$this->options['http']['header']["Cookie"].=$Cookie_me;
		}
		else{
			$this->options['http']['header']["Cookie"]="Cookie: {$Cookie_me}";
		}
		$this->options['http']['header']["Cookie"]=$this->formatCookies($this->options['http']['header']["Cookie"]);
	}
	public function clearCookiesjar($cookiename=null){
		static $key,$value;
		if(is_null($cookiename)){		
			$this->options['http']['header']["Cookie"]="Cookie:";
		}else{
			static $opCookie;
			$opCookie=$this->options['http']['header']["Cookie"];
			$opCookie= explode(" ", substr($opCookie, 7));
			foreach($opCookie as $key=>$value) {
				if(preg_match("/{$cookiename}\s*=(.*)/i",$value)){
					unset($opCookie[$key]);
				}
			}
			$this->options['http']['header']["Cookie"]="Cookie: ".implode("", $opCookie);
		}
	}
	public function getCookie($cookiename=null){
		static $value,$ra,$opCookie;
		$ra=[];
		if(is_null($cookiename)){	
			if(isset($this->options['http']['header']["Cookie"])){	
				$opCookie=$this->options['http']['header']["Cookie"];
				$opCookie= explode(" ", substr($opCookie, 7));
				$ra=$opCookie;
			}
			return $ra;
		}
		else{
			$opCookie=$this->options['http']['header']["Cookie"];
			$opCookie= explode(" ", substr($opCookie, 7));
			foreach($opCookie as $key=>$value) {
				if(preg_match("/{$cookiename}\s*=(.*)/i",$value)){
					return $opCookie[$key];
				}
			}
			return $ra;
		}
	}
	public function getSet_Cookie($array=null,$cookiename=null,$forBrowser=true){
		static $value,$ra,$found;
		if(is_array($array)){
			$ra=[];
			if(is_null($cookiename)){		
				foreach($array as $value) {
					if(preg_match("/Set-Cookie: (.*)/i",$value,$found)){
						if($forBrowser)
							$ra[]=explode(" ",$found[1])[0];
						else
							$ra[]= explode(" ",$found[1]); 
					}
				}
				return $ra;
			}
			else{
				foreach($array as $value) {
					# code...
					if(preg_match("/Set-Cookie: ({$cookiename}\s*=.*)/i",$value,$found)){
						if($forBrowser)
							return explode(" ",$found[1])[0];
						else
							return explode(" ",$found[1]); 
					}			
				}
				return $ra;
			}
		}else{
			return [];
		}
	}
	public function setBrowserHost($host=null){
		if(!is_null($host)){
			$a="Host: {$host}";
			$this->options['http']['header']["Host"]=$a;
		}
	}
	public function setBrowserMethod($method=null,$ctype=null){
		if(!is_null($method)){
			$method=strtoupper($method);
			if($method=="POST" || $method=="DELETE" || $method=="PUT" || $method=="GET"){
				$this->options['http']=$this->methods[$method];
			}else{
				$this->options['http']=$this->methods['POST'];
				$this->options['http']['method']=$method;
			}
		}else{
			$this->options['http']=$this->methods["GET"];
		}
		if(!is_null($ctype)){
			$this->options['http']['header']["Content-Type"]="Content-Type: {$ctype}";
		}
	}
	public function setBrowserConnection($type="keep-alive"){
		if(!is_null($type)){
			$this->options['http']['header']["Connection"]="Connection: {$type}";
		}
	}
	public function setBrowserContent($content=null){
		if(!is_null($content)){
			$cont=http_build_query($content);
			$this->options['http']['content'] =isset($cont)? $cont:$content;
			$this->options['http']['header']["Content-Length"]= "Content-Length: ".strlen($this->options['http']['content']);
		}
	}
	public function setBrowserRedirect($max=0){
		if(is_integer($max)){
			$this->options['http']['max_redirects'] =$max;
		}elseif(is_bool($max)){
			$this->options['http']['max_redirects'] =$max?20:1;
		}else{
			$this->options['http']['max_redirects'] =20;
		}
	}
	public function getResponse($what="all"){
		if($what=="all"){
			return $this->response;
		}
		elseif($what=="text"){
			return $this->response['text'];
		}
		elseif($what=="header"){
			return $this->response['header'];
		}
		elseif($what=="status"){
			return $this->response['status'];
		}else{
			return "keyword not understood";
		}
	}
	public function getBrowser($what="all"){
		if($what=="all"){
			return $this->options;
		}
		elseif($what=="http"){
			return  $this->options['http'];
		}
		elseif($what=="http:header"){
			return  $this->options['http']['header'];
		}
		elseif($what=="http:content"){
			return  $this->options['http']['content'];
		}else{
			return "keyword not understood";
		}
	}
	protected function browse(){
		$options=[];
		// if(preg_match("/^http[^s]\:\/\//i",$this->url)){
		// 	$options['http']=$this->options['http'];
		// }else{
		// 	$options['https']=$this->options['https'];
		// }

		$options['http']=$this->options['http'];
		$context=stream_context_create($options);
		$result=@file_get_contents($this->url,false,$context);
		if($result){
			$this->response['text']=$result;
			$this->response['header']=$http_response_header;
			$this->response['status']=$http_response_header[0];
		}elseif(@$http_response_header){
			$this->response['text']="";
			$this->response['header']=$http_response_header;
			$this->response['status']=$http_response_header[0];
		}else{
			$this->response['text']="";
			$this->response['header']="";
			$this->response['status']="404 Not Found";
		}
	}
	protected function callback($callback=null){
		if (is_callable($callback)){
			$callback($this->response);
		}
	}
	public function run($callback=null){
		// because find is  protected , only run can call it from within
		$this->browse();
		if($callback){
			$this->callback($callback);
		}
	}
}
// $string="a";
// echo increment($string);
// echo $string;
?>