<?php

namespace workingconcept\cloudflare\models;

use craft\base\Model;

class Settings extends Model
{
    // Constants
    // =========================================================================

    /**
     * REST API calls will be authenticated using older X-Auth-Key and
     * X-Auth-Email headers.
     */
    const AUTH_TYPE_KEY = 'key';

    /**
     * REST API calls will be authenticated using a bearer token.
     */
    const AUTH_TYPE_TOKEN = 'token';


    // Public Properties
    // =========================================================================

    /**
     * @var string  Type of API authentication to use.
     */
    public $authType = 'key';

    /**
     * @var string  Account-level API key.
     */
    public $apiKey = '';

    /**
     * @var string  Primary account email address. Required with $apiKey.
     */
    public $email = '';

    /**
     * @var string  App token. (Alternative to $apiKey + $email.)
     */
    public $apiToken = '';

    /**
     * @var string  This site's related Cloudflare Zone ID.
     */
    public $zone = '';

    /**
     * @var bool  Whether an Entry's URL should be purged after it's saved.
     */
    public $purgeEntryUrls = false;

    /**
     * @var bool  Whether an Asset's URL should be purged after it's saved.
     */
    public $purgeAssetUrls = true;

    /**
     * @var string
     */
    public $userServiceKey = '';

    /**
     * @var string|null  Human-friendly name for the relevant Cloudflare Zone.
     */
    public $zoneName;

    /**
     * Action URI to fetch zones.
     *
     * @var string
     */
    public $fetchZonesActionUri = 'cloudflare/default/fetch-zones';

    /**
     * Action URI to purge URLs.
     *
     * @var string
     */
    public $purgeUrlsActionUri = 'cloudflare/default/purge-urls';

    /**
     * Action URI to purge the entire cache.
     *
     * @var string
     */
    public $purgeAllActionUri = 'cloudflare/default/purge-all';

    /**
     * Action URI to save Craft URL triggers.
     *
     * @var string
     */
    public $saveRulesActionUri = 'cloudflare/default/save-rules';

    /**
     * Action URI to save Craft URL triggers.
     *
     * @var string
     */
    public $verifyCredentialsUri = 'cloudflare/default/verify-connection';


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['authType'], 'in', 'range' => [self::AUTH_TYPE_KEY, self::AUTH_TYPE_TOKEN]],
            [['apiKey', 'email', 'apiToken', 'zone', 'zoneName', 'userServiceKey'], 'string'],
            [['purgeEntryUrls', 'purgeAssetUrls'], 'boolean'],
            ['purgeEntryUrls', 'default', 'value' => false],
            ['purgeAssetUrls', 'default', 'value' => true],
        ];
    }
}
