<?php
/** Premium request class */

class PremiumRequest
{
    private $username, $curl, $names;
    /** @inheritdoc Constuctor */
    public function  __construct($name) {
        $this->username = $name;
        if(empty($name)){
            die("Empty name");
        }else {
            $this->curl = curl_init();
            curl_setopt_array($this->curl, [
                CURLOPT_URL => "https://api.mojang.com/users/profiles/minecraft/" . urlencode($this->username)
            ]);
        }
    }
    /** Curl request */
    public function curl_request() {
        curl_setopt_array($this->curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FORBID_REUSE => true]);
        return curl_exec($this->curl);
    }
    /** UUID Pickup */
    public function getUUID() {
        $r = json_decode(self::curl_request(), true);
        if($r!=null) {
            return $r['id'];
        }else{return "Not found";}
    }
    /** GetNames */
    public function getName() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.mojang.com/user/profiles/".self::getUUID()."/names",
            CURLOPT_RETURNTRANSFER => true
        ]);
        $r = json_decode(curl_exec($curl), true);
        if($r!=null) {
            foreach ($r as $n) {
                $this->names .= " " . $n['name'];
            }
            return $this->names;
        }else{return "Not found";}
    }
    /** Validator */
    public function validPremium() {
        $r = json_decode(self::curl_request(), true);
        if($r!=null){
            return "OK";
        }else{
            return "NO";
        }
    }
}