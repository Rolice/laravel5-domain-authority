<?php
namespace DomainAuthority;

use App;
use Config;

class DomainAuthority {

    const EXPIRATION_INTERVAL = 300;
    
    protected $access_id = null;
    protected $secret_key = null;

    public function __construct()
    {
        $this->access_id = $this->access_id ?: Config::get('domainauthority.moz-access-id');
        $this->secret_key = $this->secret_key ?: Config::get('domainauthority.moz-secret-key');
    }

    public static function get($url, $cols = Column::DomainAuthority)
    {
        $self = App::make('DomainAuthority');
        $expires = time() + self::EXPIRATION_INTERVAL;

        $signature = hash_hmac('sha1', "{$self->access_id}\n{$expires}", $self->secret_key, true);
        $signature = urlencode(base64_encode($signature));

        $qs = [
            'Cols'      => $cols,
            'AccessID'  => $self->access_id,
            'Expires'   => $expires,
            'Signature' => $signature,
        ];

        $url = 'http://lsapi.seomoz.com/linkscape/url-metrics/' . urlencode($url);
        $url = $url . '?' . implode('&', array_map(function($value, $key) {
            return "$key=$value";
        }, $qs, array_keys($qs)));

        $options = [
            CURLOPT_RETURNTRANSFER      => true
        ];

        $ch = curl_init($url);
        
        curl_setopt_array($ch, $options);
        
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

    }

}