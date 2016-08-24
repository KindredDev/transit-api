<?php

class Helper {

  static function getUID($len=8) {
	    global $salt;

	    $hex = md5($salt . uniqid());
	    $pack = pack('H*', $hex);
	    $uid = base64_encode($pack);
	    $uid = preg_replace('/[^\da-z]/i', '', $uid);
	    if ($len<4)
	        $len=4;
	    if ($len>128)
	        $len=128;
	    while (strlen($uid)<$len)
	        $uid = $uid . getUID(22);
	    return substr($uid, 0, $len);
	}

}

?>
