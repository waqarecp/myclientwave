<?php
return [
    /**
     * The page size for Google Ads API requests.
     *
     * @var int
     */
    'page_size' => 1000,

    /**
     * The authorization URI for Google Ads OAuth2 authentication.
     *
     * @var string
     */
    'authorization_uri' => 'https://accounts.google.com/o/oauth2/v2/auth',

    /**
     * The scope for Google Ads OAuth2 authentication.
     *
     * @var string
     */
    'scope' => 'https://www.googleapis.com/auth/adwords',

    /**
     * Additional access parameters for Google Ads OAuth2 authentication.
     *
     * @var array
     */
    'access' => [
        'access_type' => 'offline',
        'prompt' => 'consent'
    ]
];
