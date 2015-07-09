<?php
namespace DomainAuthority;

abstract class MozResponse {

    protected $response = null;
    protected $mapping = [];

    /**
     * Constructor of new MozResponse or child instances
     * @param string $response The response of API request to be parsed and populated into class fields
     */
    public function __construct($response)
    {
        if(!is_object($response))
            throw new DomainAuthorityException(DomainAuthorityException::InvalidResponse);

        $this->response = $response;
    }


    /**
     * Override of magic method __get, allowing translation of Moz API response keys to human readable ones
     * @param  string $name Name of a field/member which is currently being resolved
     * @return mixed        Result of moz api response translated by human readable key
     */
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