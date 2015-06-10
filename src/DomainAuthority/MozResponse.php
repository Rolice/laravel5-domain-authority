<?php
namespace DomainAuthority;

abstract class MozResponse {

    use Util;

    protected $response = null;
    protected static $mapping = [];

    public function __construct($response)
    {
        if(!is_object($response))
            throw new DomainAuthorityException(DomainAuthorityException::InvalidResponse);

        $this->response = $response;
    }

    public function __get($name)
    {
        if( ! is_object($this->response))
            return NULL;

        if( ! isset(self::$mapping[$name]))
            return NULL;

        foreach(self::$mapping[$name] as $key)
            if(isset($this->response->$key) || property_exists($this->response, $key))
                return $this->response->$key;

        return NULL;
    }

}