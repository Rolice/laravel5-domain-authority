<?php
namespace DomainAuthority;

use App;
use Config;

class DomainAuthority {

    const EXPIRATION_INTERVAL = 300;
    const STATUS_OK           = 200;
    
    /**
     * Moz API Access ID to be used in API requests
     * @var string
     */
    protected $access_id = null;

    /**
     * Moz API secret key to be used with API requests
     * @var string
     */
    protected $secret_key = null;

    /**
     * Constructor that sets up a new instance with API credentials from config
     */
    public function __construct()
    {
        $this->access_id = $this->access_id ?: Config::get('domainauthority.moz-access-id');
        $this->secret_key = $this->secret_key ?: Config::get('domainauthority.moz-secret-key');
    }

    /**
     * Executes URL Metrics API Request
     * @param  string $url        The URL which is target of examinaiton
     * @param  int|bitfield $cols URL Metrics columns with data to retrieve
     * @return UrlMetrics         An UrlMetrics wrapper object with resulting data
     */
    public static function urlMetrics($url, $cols = UrlMetrics::DomainAuthority)
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

        if(self::STATUS_OK !== $status || ! $result)
            throw new DomainAuthorityException($status);

        $result = json_decode($result);

        if( ! $result)
            throw new DomainAuthorityException(DomainAuthorityException::NonJson);

        return new UrlMetrics($result);
    }

    public static function linkMetrics(
        $sourceCols,
        $targetCols,
        $scope = LinkMetrics::ScopeDomainToDomain,
        $sort = LinkMetrics::SortDomainAuthority,
        $filter = [ LinkMetrics::FilterFollow, LinkMetrics::FilterExternal ])
    {

    }

}