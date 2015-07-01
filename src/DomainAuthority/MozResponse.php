<?php
namespace DomainAuthority;

abstract class MozResponse {

    protected $response = null;
    protected $mapping = [];

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

        if( ! isset($this->mapping[$name]))
            return NULL;

        foreach($this->mapping[$name] as $key)
            if(isset($this->response->$key) || property_exists($this->response, $key))
                return $this->response->$key;

        return NULL;
    }

}