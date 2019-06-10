var toArray = function(obj={}){
	var arr=[]
	for(const r in obj) 
		arr.push(obj[r]);
	return arr;
}
var $chars = new Array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
    'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
    'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
var httpRequest=require('request'),
	urlParser=require("url");
function FakeBrowser(args="Robot",url="http://google.com"){
	this.brosername;
	this.head;
	this._url;
	this._hostname="google.com";
	this._port=null;
	this._agent=false;
	this.methods={};
	this.response={};
	this.options={};
	this._robotname="Robot/MichaelPiper Niarablasted Goldpack";
	this.options['http']={};
	var headgettmpl={
		"header":{
			"Host":"google.com",
			"User-Agent":`${this._robotname} Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36",
			"Accept":"text/xml,text/csv,text/json,text/html,text/plain,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
			"Connection":"keep-alive`,
			"Upgrade-Insecure-Requests":"1",
			"Accept-Language":"en-US,en;q=0.9",
		},
		"method":"GET",
		"hostname":this._hostname,
		"port":this._port,
		"agent":this._agent,
		"ignoreErrors":1,
		"followRedirect":false,
		"maxRedirects":1
	};
	var headposttmpl={
		"header":{
			"Host":"google.com",
			"User-Agent":`${this._robotname} Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36",
			"Accept":"text/xml,text/csv,text/json,text/html,text/plain,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
			"Connection":"keep-alive`,
			"Origin":null,
			"Upgrade-Insecure-Requests":"1",
			"Accept-Language":"en-US,en;q=0.9",
		},
		"method":"POST",
		"hostname":this._hostname,
		"port":this._port,
		"agent":this._agent,
		"followRedirect":false,
		"maxRedirects":1
		// "formData":{}
	}
	var headputtmpl={
		"header":{
			"Host":"google.com",
			"User-Agent":`${this._robotname} Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36",
			"Accept":"text/xml,text/csv,text/json,text/html,text/plain,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
			"Connection":"keep-alive`,
			"Upgrade-Insecure-Requests":"1",
			"Accept-Language":"en-US,en;q=0.9",
		},
		"method":"PUT",
		"hostname":this._hostname,
		"port":this._port,
		"agent":this._agent,
		"followRedirect":false,
		"maxRedirects":1
	}
	var headdeletetmpl={
		"header":{
			"Host":"google.com",
			"User-Agent":`${this._robotname} Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36",
			"Accept":"text/xml,text/csv,text/json,text/html,text/plain,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
			"Connection":"keep-alive`,
			"Upgrade-Insecure-Requests":"1",
			"Accept-Language":"en-US,en;q=0.9",
		},
		"method":"DELETE",
		"hostname":this._hostname,
		"port":this._port,
		"agent":this._agent,
		"followRedirect":false,
		"maxRedirects":1
	}
	this.methods['GET']=headgettmpl;
	this.methods['POST']=headposttmpl;
	this.methods['DELETE']=headdeletetmpl;
	this.methods['PUT']=headputtmpl;
	if(typeof args=="object"){
		if("undefined" != typeof args['url'] ){
			this._url=args['url'];
		}
		if("undefined" != typeof args['method']){
			this.setBrowserMethod(args['method']);
		}
		if("undefined" != typeof args['brosername']){
			this.setBrowserAgent(args['brosername']);
		}
		if("undefined" != typeof args['host']){
			this.setBrowserHost(args['host']);
		}
		if("undefined" != typeof args['content']){
			this.setBrowserContent(args['content']);
		}
	}
	else if("string" == typeof args){
		this.setURL(url);
		this.setBrowserMethod("GET");
		this.setBrowserAgent(args);
	}
	else{
		this.setBrowserMethod("GET");
	}
}
FakeBrowser.prototype={
	setURL:function(url=''){
		var fbr=this;
		if(url!=""){
			fbr._url=url;
		}
	},
	getURL:function(){
		var fbr=this;
		if(fbr._url!='')
			return fbr._url;
		else 
			return "url not set";
	},
	setBrowserMethod:function(method='',ctype=null){
		var fbr=this;
		if(method !=null){
			method=method.toUpperCase();
			if(method=="POST" || method=="DELETE" || method=="PUT" || method=="GET"){
				fbr.options['http']=fbr.methods[method];
			}else{
				fbr.options['http']=fbr.methods['POST'];
				fbr.options['http']['method']=method;
			}
		}else{
			fbr.options['http']=fbr.methods["GET"];
		}
		if(ctype!=null){
			fbr.options['http']['header']["Content-Type"]=ctype;
		}
	},
	setBrowserAgent:function(agent=""){
		var fbr=this;
		var a;
		if(agent !=null){
			agent=agent.toUpperCase();
			if(agent=="CHROME"){
				a="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) snap Chromium/74.0.3729.169 Chrome/74.0.3729.169 Safari/537.36";
				fbr.options['http']['header']["User-Agent"]=a;
			}
			else if(agent=="FIREFOX"){
				a="Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:67.0) Gecko/20100101 Firefox/67.0";
				fbr.options['http']['header']["User-Agent"]=a;
				fbr.options['http']['header']["Cache-Control"]="max-age=0";
			}		
		}
	},
	setBrowserConnection:function (type="keep-alive"){
		var fbr=this;
		if(type!=null){
			fbr.options['http']['header']["Connection"]=type;
		}
	},setBrowserContent:function (content=null){
		var fbr=this;
		if(content!=null){
			fbr.options['http']['form'] = content;
			fbr.options['http']['header']["Content-Length"]= JSON.stringify(content).length;
		}
	},
	setBrowserQueryString:function (qs=null){
		var fbr=this;
		if(qs!=null){
			fbr.options['http']['qs'] = qs;
			fbr.options['http']['header']["Content-Length"]= JSON.stringify(qs).length;
		}
	},
	setBrowserHost :function (host=null){
		var fbr=this;
		if(host !=null){
			fbr.options['http']['header']["Host"]=host;
			fbr.options.http.hostname=host;
		}
	},
	setBrowserPort:function(port=80){
		var fbr=this;
		if(port!=null){
			fbr._port=port;
		}
	},
	setBrowserCookies:function (cookiesjar=null){
		var fbr=this;
		var Cookie_me,value,cval;
		Cookie_me='';
		if("object" == typeof cookiesjar){	
			for (const $k in cookiesjar) {
				// code...
				value=cookiesjar[$k];
				if("object" == typeof value){
					for (const key in value){
						cval=value[key];
						Cookie_me+=` ${key}=${cval};`;
					}
				}else{
					Cookie_me+=" "+value;	
				}
			}
		}else if("string" == typeof cookiesjar){
			Cookie_me=" "+cookiesjar;
		}
		if(fbr.options['http']['header']["Cookie"] && fbr.options['http']['header']["Cookie"].match(/Cookie: (.*)/i)){
			fbr.options['http']['header']["Cookie"]+=Cookie_me;
		}
		else{
			fbr.options['http']['header']["Cookie"]=Cookie_me;
		}
		fbr.formatCookies();
	},
	formatCookies:function (){
		var fbr=this;
		var cookiesjar,arr,cookie,key;
		cookiesjar=fbr.options['http']['header']["Cookie"];
		if(typeof cookiesjar =="string"){
			arr = {};
			// print($cookiesjar);
			var newcjar=cookiesjar.split(" ");
			for(const cokey in newcjar) {
				// code...
				cookie = newcjar[cokey];
				if(cookie !="" && cookie!=" " && cookie!=null){
					key = cookie.split("=");
					arr[key[0]]=cookie;
				}
			}
			fbr.options['http']['header']["Cookie"]=toArray(arr).join(" ");
		}else{
			fbr.options['http']['header']["Cookie"]="";
		}

	},
	clearCookiesjar:function (cookiename=null){
		var fbr=this;
		var key,value,opCookie;
		if(cookiename ==null){		
			fbr.options['http']['header']["Cookie"]="";
		}else{
			opCookie=fbr.options['http']['header']["Cookie"];
			opCookie= opCookie.split(" ");
			for(key in opCookie) {
				if(opCookie[key].match(new RegExp("/"+cookiename+"\s*=(.*)/"))){
					delete opCookie[key];
				}
			}
			fbr.options['http']['header']["Cookie"]=opCookie.join("");
		}
	},
	getCookie: function (cookiename=null){
		var fbr=this;
		var value,ra,opCookie;
		ra=[];
		if(cookiename == null){	
			if("undefined" != typeof fbr.options['http']['header']["Cookie"]){	
				opCookie=fbr.options['http']['header']["Cookie"];
				opCookie= opCookie.split(" ");
				ra=opCookie;
			}
			return ra;
		}
		else{
			opCookie=fbr.options['http']['header']["Cookie"];
			opCookie= opCookie.split(" ");
			for(const $k in opCookie) {
				value=opCookie[$k];
				if(value.match(new RegExp("/"+cookiename+"\s*=(.*)/"))){
					return opCookie[$k];
				}
			}
			return ra;
		}
	},
	getSet_Cookie: function (array=null,cookiename=null,forBrowser=true){
		var value,ra,found;
		if("object"==typeof array){
			ra=[];
			if(cookiename ==null){		
				for(const  valkey in array ) {
					value = array[valkey];
					found = value;
					if(found){
						if(forBrowser)
							ra.push(found.split(" ")[0]);
						else
							ra.push(found.split(" "));
					}
				}
				return ra;
			}
			else{
				for(const $k in array) {
					// code...
					value = array[$k];
					found =value.match(new RegExp("/("+cookiename+"\s*=.*)/","ig"));
					if(found){
						if(forBrowser)
							return found[0].split(" ")[0];
						else
							return found[0].split(" "); 
					}			
				}
				return ra;
			}
		}else{
			return [];
		}
	},
	getResponse :function (what="all"){
		var fbr=this;
		if(what=="all"){
			return fbr.response;
		}
		else if(what=="text"){
			return fbr.response['text'];
		}
		else if(what=="header"){
			return fbr.response['header'];
		}
		else if(what=="status"){
			return fbr.response['status'];
		}else{
			return "keyword not understood";
		}
	}
	,getBrowser: function(what="all"){
		var fbr=this;
		if(what=="all"){
			return fbr.options;
		}
		else if(what=="http"){
			return  fbr.options['http'];
		}
		else if(what=="http:header"){
			return  fbr.options['http']['header'];
		}
		else if(what=="http:content"){
			return  fbr.options['http']['content'];
		}else{
			return "keyword not understood";
		}
	},browse:function(callback=null){
		var fbr=this,options={},httpRequest=require('request');
		options=fbr.options['http'];
		options.url=fbr._url;
		if(options.port =="" && options.url.match(/https/i))
		options.port=443;
		else if (options.port =="")
			options.port=80;
		// 80 || 443
		httpRequest(options,function(error,response,body){
			if(error)
				console.error("Error:",error);
			if(body){
				fbr.response['text']=body;
				fbr.response['header']=response.headers;
				fbr.response['status']="HTTP/"+response.httpVersion +" "+response.statusCode+" "+response.statusMessage;
			}else if(response){
				fbr.response['text']="";
				fbr.response['header']=response.headers;
				fbr.response['status']="HTTP/"+response.httpVersion +" "+response.statusCode+" "+response.statusMessage;
			}else{
				fbr.response['text']="";
				fbr.response['header']="";
				fbr.response['status']="404 Not Found";
			}
			if(typeof callback =="function"){
				callback(fbr.response);
			}
			else if (fbr.hasOwnProperty("callback") && typeof fbr.callback=="function"){
				fbr.callback(fbr.response);
			}
		});
		
	},run:function(callback=null){
		var fbr=this;
		fbr.browse(callback);	
	}
}
var fn={
	FakeBrowser:FakeBrowser,
	toArray:toArray,
	sleep:function(ms=1000){
		var $start=Date.now();
		var $end=Date.now()+ms;
		while ($start< $end) {
			$start=Date.now();

		}
		return ms+"ms";
	},
	get_json:function (url=null,callback=null){
		if(url==null){
			if(typeof callback=="function"){
				callback({});
			}
		}else{
			var fs=require("fs");
			fs.readFile(url,function(err,fd){
				if(err) console.log(err);
				if(typeof callback=="function"){
					var json;
					if(err) json={};
					else json= JSON.parse(fd);
					callback(json);
					
				}
			});
		}
	},
	powerof:function(number,power){
		var res=0;
		for (var i = power - 1; i >= 0; i--) {
			if(res==0)res=number;
			else res=res*number;
		}
		return String(res);
	},
	random_int:function($min,$max){
		var result=Math.floor(Math.random()*($max+1));
		while(result < $min){
			result=Math.floor(Math.random()*($max+1));
		}
		return result;
	},
	randaval:function ($min,$max){
		if(global.wp_rand_val !== undefined){
			var newrand=fn.random_int( $min, $max );
			if(global.wp_rand_val==newrand){
				global.wp_rand_val=fn.randaval( $min, $max );
			}else{
				global.wp_rand_val=newrand;
			}
		}else{
			global.wp_rand_val=fn.random_int( $min, $max );
		}
		return global.wp_rand_val;
	},
	wp_rand:function ($min,$max){
		$min=parseInt ($min);
		$max=parseInt ($max);
		return fn.randaval($min,$max);	
	},
	wp_generate_password:function (length = 12, special_chars = true, extra_special_chars = false ) {
		var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		if ( special_chars ) {
			chars += '!@#$%^&*()';
		}
		if ( extra_special_chars ) {
			chars += '-_ []{}<>~`+=,.;:/?|';
		}

		var password = '';
		for (var i = 0; i < length; i++ ) {
			password += chars.substr(fn.wp_rand( 0, chars.length - 1 ), 1 );
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
		if(global.wp_gen_pass_val){
			if(global.wp_gen_pass_val[password]==1){
				return fn.wp_generate_password(length,special_chars,extra_special_chars);
			}else{
				global.wp_gen_pass_val[password]=1;
				return password;
			}
		}else{
			global.wp_gen_pass_val={};
			global.wp_gen_pass_val[password]=1;
			return password;
		}
	},
	increment:function($word=""){
		function nextout($check=''){
			if(!$check in $chars){
				return $chars[0];
			}else{
				for (var i = $chars.length - 1; i >= 0; i--) {
					if($chars[$chars.length-1]==$check){
						return $chars[0];
					}
					else if($chars[i]==$check){
						return $chars[i+1];
					}
				}
			}
		}
		function checkifismax($str=""){
			if($str!=""){
				$chr="";
				for(var s in $str.split("")){
					$chr+=$chars[$chars.length-1];
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
		function ismax($str=""){
			var $chr='';
			if($str!=""){
				if(checkifismax($str)){
					// return $str.substr(0,$str.length-1)+$chars[0]+$chars[0];
					for(var s in $str.split("")){
						$chr+=$chars[0];
					}
					return $chr+$chars[0];
				}else{
					return $str;
				}
			}else{
				return $str;
			}

		}
		if(typeof $word=="string"){
			if(checkifismax($word)){
				return ismax($word);
			}
			$word=$word.split("");
			for (var k = $word.length - 1; k >= 0; k--) {
				if($word[k]==$chars[$chars.length-1]){
					$word[k]=nextout($word[k]);
				}
				else{
					$word[k]=nextout($word[k]);
					break;
				}
			}
			return $word.join("");
		}else{
			return $word;
		}
	},
	word_matrix:function (arr){
		var willreturn=[],a;
		if(typeof arr == "object"){
			a=[];
			for(var h=0;h<arr.length;h++){
				a.push(0);
			}
			count=a.length-1;
			while(a[0]<arr[0].length){
				var res='';
				for(var n=0;n<a.length;n++){	
					res+=arr[n][a[n]];
				}
				// console.log(res+" fff\n");
				if(res){
					willreturn.push(res);
				}
				// echo(arr[0][a].arr[1][b].arr[2][c]."\n");
				// if(c==count(arr[2])-1){
				// 	b++;
				// 	c=0;
				// }
				// if(b==count(arr[1])-1){
				// 	a++;
				// 	b=0;
				// }
				for(var key=0;key<a.length;key++) {
					var value=a[key];		
					// code...
					// print(a[count]." ss\n");
					// print(key." value\n");
					// print_r(arr[count(a)-1]);
					if(count>0 && a[count]==arr[count].length-1){
						a[count]=0;
						a[count-1]++;
					}
					if(key!=count && key!=0 && value==arr[key].length-1){
						a[key-1]++;
						a[key]=0;
					}
					
				}	
				a[count]++;	 
			}
		}else{
			return [];
		}
		return willreturn;
	},
	key_dictionary: function(length=1,callback=null,start=''){
		var str="";
		if(start=="use:dictionary"){
			var fs=require("fs");
			fs.readFile("../database/words_dictionary.json",function(err,fd){
				if(err) console.log(err);
				if(typeof callback=="function"){
					var json= JSON.parse(fd);
					for (var i in json) {
						callback(i);
					}
				}
			});
		}else{
			if(typeof start=="string"){
				str=start;
			}
			else if(typeof start=="number"){
				for(var i=0;i<start;i++){
					str+=$chars[0];
				}
			}
			while(length>= str.length){
				if(typeof callback=="function"){
					callback(str);
				}
				str=fn.increment(str);
			}
		}
	}
}
module.exports =fn;