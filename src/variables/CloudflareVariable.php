<?php
/**
 * Cloudflare plugin for Craft CMS 3.x
 *
 * Purge Cloudflare caches from Craft.
 *
 * @link      https://workingconcept.com
 * @copyright Copyright (c) 2017 Working Concept
 */

namespace workingconcept\cloudflare\variables;

use craft\base\Model;
use workingconcept\cloudflare\Cloudflare;

/**
 * @author    Working Concept
 * @package   Cloudflare
 * @since     1.0.0
 */
class CloudflareVariable
{
    /**
     * Returns the zones.
     *
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getZones(): ?array
    {
        return Cloudflare::getInstance()->api->getZones();
    }

    /**
     * Returns the zone options.
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getZoneOptions(): array
    {
        $options = [];

        if ($zones = $this->getZones()) {
            foreach ($zones as $zone) {
                $options[$zone->id] = $zone->name;
            }
        }

        return $options;
    }

    /**
     * Returns the rules.
     *
     * @return array
     */
    public function getRulesForTable(): array
    {
        return Cloudflare::getInstance()->rules->getRulesForTable();
    }

    /**
     * @return Model|null
     */
    public function getSettings(): ?Model
    {
        return Cloudflare::getInstance()->getSettings();
    }
}
