<?php
namespace DomainAuthority;

use \ReflectionClass;

class UrlMetrics {

    const Title                                     = 1;                    // ut
    const CanonicalUrl                              = 4;                    // uu
    const Subdomain                                 = 8;                    // ufq
    const RootDomain                                = 16;                   // upl
    const ExternalEquityLinks                       = 32;                   // ueid
    const SubdomainExternalLinks                    = 64;                   // feid
    const RootDomainExternalLinks                   = 128;                  // peid
    const EquityLinks                               = 256;                  // ujid
    const SubdomainLinking                          = 512;                  // uifq
    const RootDomainsLinking                        = 1024;                 // uipl
    const Links                                     = 2048;                 // uid
    const SubdomainSubdomainLinking                 = 4096;                 // fid
    const RootDomainRootDomainLinking               = 8192;                 // pid
    const MozRankUrl                                = 16384;                // umrp, umrr
    const MozRankSubdomain                          = 32768;                // fmrp, fmrr
    const MozRankRootDomain                         = 65536;                // pmrp, pmrr
    const MozTrust                                  = 131072;               // utrp, utrr
    const MozTrustSubdomain                         = 262144;               // ftrp, ftrr
    const MozTrustRootDomain                        = 524288;               // ptrp, ptrr
    const MozRankExternalEquity                     = 1048576;              // uemrp, uemrr
    const MozRankSubdomainExternalEquity            = 2097152;              // fejp, fejr
    const MozRankRootDomainExternalEquity           = 4194304;              // pejp, pejr
    const MozRankSubdomainCombined                  = 8388608;              // pjp, pjr
    const MozRankRootDomainCombined                 = 16777216;             // fjp, fjr
    const SubdomainSpamScore                        = 67108864;             // fspsc, fspf, flan, fsps, fsplc, fspp
    const Social                                    = 134217728;            // ffb, ftw, fg+, fem*
    const HTTPStatusCode                            = 536870912;            // us
    const LinksToSubdomain                          = 4294967296;           // fuid
    const LinksToRootDomain                         = 8589934592;           // puid
    const RootDomainsLinkingToSubdomain             = 17179869184;          // fipl
    const PageAuthority                             = 34359738368;          // upa
    const DomainAuthority                           = 68719476736;          // pda
    const ExternalLinks                             = 549755813888;         // ued
    const ExternalLinksToSubdomain                  = 140737488355328;      // fed
    const ExternalLinksToRootDomain                 = 2251799813685248;     // ped
    const LinkingCBlocks                            = 36028797018963968;    // pib
    const TimeLastCrawled                           = 144115188075855872;   // ulc

    private $response = null;

    private static $consts = [];

    private static $mapping = [
        self::Title                               => [ 'ut' ],
        self::CanonicalUrl                        => [ 'uu' ],
        self::Subdomain                           => [ 'ufq' ],
        self::RootDomain                          => [ 'upl' ],
        self:: ExternalEquityLinks                 => [ 'ueid' ],
        self:: SubdomainExternalLinks              => [ 'feid' ],
        self:: RootDomainExternalLinks             => [ 'peid' ],
        self:: EquityLinks                         => [ 'ujid' ],
        self:: SubdomainLinking                    => [ 'uifq' ],
        self:: RootDomainsLinking                  => [ 'uipl' ],
        self:: Links                               => [ 'uid' ],
        self:: SubdomainSubdomainLinking           => [ 'fid' ],
        self:: RootDomainRootDomainLinking         => [ 'pid' ],
        self:: MozRankUrl                          => [ 'umrp', 'umrr' ],
        self:: MozRankSubdomain                    => [ 'fmrp', 'fmrr' ],
        self:: MozRankRootDomain                   => [ 'pmrp', 'pmrr' ],
        self:: MozTrust                            => [ 'utrp', 'utrr' ],
        self:: MozTrustSubdomain                   => [ 'ftrp', 'ftrr' ],
        self:: MozTrustRootDomain                  => [ 'ptrp', 'ptrr' ],
        self:: MozRankExternalEquity               => [ 'uemrp', 'uemrr' ],
        self:: MozRankSubdomainExternalEquity      => [ 'fejp', 'fejr' ],
        self:: MozRankRootDomainExternalEquity     => [ 'pejp', 'pejr' ],
        self:: MozRankSubdomainCombined            => [ 'pjp', 'pjr' ],
        self:: MozRankRootDomainCombined           => [ 'fjp', 'fjr' ],
        self:: SubdomainSpamScore                  => [ 'fspsc', 'fspf', 'flan', 'fsps', 'fsplc', 'fspp' ],
        self:: Social                              => [ 'ffb', 'ftw', 'fg+', 'fem*' ],
        self:: HTTPStatusCode                      => [ 'us' ],
        self:: LinksToSubdomain                    => [ 'fuid' ],
        self:: LinksToRootDomain                   => [ 'puid' ],
        self:: RootDomainsLinkingToSubdomain       => [ 'fipl' ],
        self:: PageAuthority                       => [ 'upa' ],
        self:: DomainAuthority                     => [ 'pda' ],
        self:: ExternalLinks                       => [ 'ued' ],
        self:: ExternalLinksToSubdomain            => [ 'fed' ],
        self:: ExternalLinksToRootDomain           => [ 'ped' ],
        self:: LinkingCBlocks                      => [ 'pib' ],
        self:: TimeLastCrawled                     => [ 'ulc' ],
    ];

    public function __construct($response)
    {
        if( ! self::$consts)
            self::$consts = (new ReflectionClass($this))->getConstants();

        if(!is_object($response))
            throw new DomainAuthorityException(DomainAuthorityException::InvalidResponse);

        $this->response = $response;
    }

    public function __get($name)
    {
        if( ! is_object($this->response) || ! isset(self::$consts[$name]))
            return NULL;

        if( ! isset(self::$mapping[self::$consts[$name]]))
            return NULL;

        foreach(self::$mapping[self::$consts[$name]] as $key)
            if(isset($this->response->$key) || property_exists($this->response, $key))
                return $this->response->$key;

        return NULL;
    }
}