<?php
namespace DomainAuthority;

class Column {

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
    const MozTrustSubdomain                         = 262144;               // 
    const MozTrustRootDomain                        = 524288;               // 
    const MozRankExternalEquity                     = 1048576;              // 
    const MozRankSubdomainExternalEquity            = 2097152;              // 
    const MozRankRootDomainExternalEquity           = 4194304;              // 
    const MozRankSubdomainCombined                  = 8388608;              // 
    const MozRankRootDomainCombined                 = 16777216;             // 
    const SubdomainSpamScore                        = 67108864;             // 
    const Social                                    = 134217728;            // 
    const HTTPStatusCode                            = 536870912;            // 
    const LinksToSubdomain                          = 4294967296;           // 
    const LinksToRootDomain                         = 8589934592;           // 
    const RootDomainsLinkingToSubdomain             = 17179869184;          // 
    const PageAuthority                             = 34359738368;          // 
    const DomainAuthority                           = 68719476736;          // 
    const ExternalLinks                             = 549755813888;         // 
    const ExternalLinksToSubdomain                  = 140737488355328;      // 
    const ExternalLinksToRootDomain                 = 2251799813685248;     // 
    const LinkingCBlocks                            = 36028797018963968;    // 
    const TimeLastCrawled                           = 144115188075855872;   // 
    
}