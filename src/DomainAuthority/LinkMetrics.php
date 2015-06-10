<?php
namespace DomainAuthority;

class LinkMetrics extends MozResponse {

    // Scope Parameters
    const ScopePageToPage           = 'page_to_page';
    const ScopePageToSubdomain      = 'page_to_subdomain';
    const ScopePageToDomain         = 'page_to_domain';
    const ScopeSubdomainToPage      = 'subdomain_to_page';
    const ScopeSubdomainToSubdomain = 'subdomain_to_subdomain';
    const ScopeSubdomainToDomain    = 'subdomain_to_domain';
    const ScopeDomainToPage         = 'domain_to_page';
    const ScopeDomaintoSubdomain    = 'domain_to_subdomain';
    const ScopeDomainToDomain       = 'domain_to_domain';

    // Sort Parameters
    const SortPageAuthority         = 'page_authority';
    const SortDomainAuthority       = 'domain_authority';
    const SortDomainsLinkingDomains = 'domains_linking_domains';
    const SortDomainsLinkingPage    = 'domains_linking_page';
    const SortSpamScore             = 'by_spam_score';

    // Filter Parameters
    const FilterInternal            = 'internal';
    const FilterExternal            = 'external';
    const FilterFollow              = 'follow';
    const FilterNoFollow            = 'nofollow';
    const FilterNonEquity           = 'nonqeuity';
    const FilterEquity              = 'equity';
    const FilterRelCanonical        = 'relcanonical';
    const FilterRedirect301         = '301';
    const FilterRedirect302         = '302';

    // Values for LinkCols Parameters
    const Nil                       = 0;
    const Flags                     = 2;
    const AnchorText                = 4;
    const Normalized                = 8;
    const MozRankPassed             = 16;

    // LinkCols Parameters
    const NoFollow                  = 1;
    const SameSubdomain             = 2;
    const MetaRefresh               = 4;
    const SameIPAddress             = 8;
    const SameCBlock                = 16;
    const Spamscore                 = 32;
    const Redirect301               = 64;
    const Redirect302               = 128;
    const NoScript                  = 256;
    const OffScreen                 = 512;
    const MetaNoFollow              = 2048;
    const SameRootDomain            = 4096;
    const Img                       = 8192;
    const FeedAutoDiscovery         = 16384;
    const RelCanonical              = 32768;
    const Via301                    = 65536;

    protected $response = null;
    protected static $mapping = [];

}