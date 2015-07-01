<?php
namespace DomainAuthority;

class UrlMetrics extends MozResponse {

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

    protected $response = null;

    protected $mapping = [
        'Title'                               => [ 'ut' ],
        'CanonicalUrl'                        => [ 'uu' ],
        'Subdomain'                           => [ 'ufq' ],
        'RootDomain'                          => [ 'upl' ],
        'ExternalEquityLinks'                 => [ 'ueid' ],
        'SubdomainExternalLinks'              => [ 'feid' ],
        'RootDomainExternalLinks'             => [ 'peid' ],
        'EquityLinks'                         => [ 'ujid' ],
        'SubdomainLinking'                    => [ 'uifq' ],
        'RootDomainsLinking'                  => [ 'uipl' ],
        'Links'                               => [ 'uid' ],
        'SubdomainSubdomainLinking'           => [ 'fid' ],
        'RootDomainRootDomainLinking'         => [ 'pid' ],
        'MozRankUrl'                          => [ 'umrp', 'umrr' ],
        'MozRankSubdomain'                    => [ 'fmrp', 'fmrr' ],
        'MozRankRootDomain'                   => [ 'pmrp', 'pmrr' ],
        'MozTrust'                            => [ 'utrp', 'utrr' ],
        'MozTrustSubdomain'                   => [ 'ftrp', 'ftrr' ],
        'MozTrustRootDomain'                  => [ 'ptrp', 'ptrr' ],
        'MozRankExternalEquity'               => [ 'uemrp', 'uemrr' ],
        'MozRankSubdomainExternalEquity'      => [ 'fejp', 'fejr' ],
        'MozRankRootDomainExternalEquity'     => [ 'pejp', 'pejr' ],
        'MozRankSubdomainCombined'            => [ 'pjp', 'pjr' ],
        'MozRankRootDomainCombined'           => [ 'fjp', 'fjr' ],
        'SubdomainSpamScore'                  => [ 'fspsc', 'fspf', 'flan', 'fsps', 'fsplc', 'fspp' ],
        'Social'                              => [ 'ffb', 'ftw', 'fg+', 'fem*' ],
        'HTTPStatusCode'                      => [ 'us' ],
        'LinksToSubdomain'                    => [ 'fuid' ],
        'LinksToRootDomain'                   => [ 'puid' ],
        'RootDomainsLinkingToSubdomain'       => [ 'fipl' ],
        'PageAuthority'                       => [ 'upa' ],
        'DomainAuthority'                     => [ 'pda' ],
        'ExternalLinks'                       => [ 'ued' ],
        'ExternalLinksToSubdomain'            => [ 'fed' ],
        'ExternalLinksToRootDomain'           => [ 'ped' ],
        'LinkingCBlocks'                      => [ 'pib' ],
        'TimeLastCrawled'                     => [ 'ulc' ],
    ];

}