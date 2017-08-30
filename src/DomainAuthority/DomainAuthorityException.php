<?php
namespace DomainAuthority;

use \Exception;

class DomainAuthorityException extends Exception {

    const InvalidResponse                   = -4;
    const EmptyResponse                     = -3;
    const NonJson                           = -2;
    const Unknown                           = -1;

    const NotCrawled                        = 0;
    const NetworkError                      = 1;
    const TranscodeFailure                  = 2;
    const BinaryContent                     = 3;
    const InvalidHttpStatus                 = 4;
    const BlockedByRobots                   = 5;
    const FailedToFetchRobots               = 6;
    const InternalStatusCode                = 7;
    const InternalStatusCode2               = 8;
    const MetaNoIndex                       = 9;

    const AuthorizationRequired             = 401;
    const Forbidden                         = 403;
    const NotFound                          = 404;
    const InternalServerError               = 500;
    const ServiceUnavailable                = 503;

    private static $messages = [
        -4              => 'Invalid Response',
        -3              => 'Empty Response',
        -2              => 'Non-JSON Response',
        -1              => 'Unknown',

        0               => 'Not Crawled',
        1               => 'Network Error',
        2               => 'Transcode failure (failure detecting content type)',
        3               => 'Binary Content',
        4               => 'Invalid HTTP status code',
        5               => 'Blocked by robots.txt',
        6               => 'Failed to fetch robots.txt',
        7               => 'Internal status code to crawler',
        8               => 'Internal status code to crawler',
        9               => 'Page has a meta no-index tag',

        401             => 'Authorization Required',
        403             => 'Forbidden',
        404             => 'Not Found',
        500             => 'Internal Server Error',
        503             => 'Service Unavailable',
    ];

    public function __construct($code)
    {
        if(!isset(self::$messages[$code]))
            $code = -1;

        $this->code = $code;
        $this->message = self::$messages[$code];
    }

}
