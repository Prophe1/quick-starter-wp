<?php

namespace Prophe1\QuickStarter;

final class ACFFieldsGroupSaver
{
    /**
     * ACFFieldsGroupSaver constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'filters']);
    }

    public function filters(): void
    {
        /**
         * Place ACF JSON in field-groups directory
         */
        add_filter('acf/settings/save_json', [$this, 'getGroupPath']);

        /**
         * Load ACJ JSON from field-groups
         */
        add_filter('acf/settings/load_json', [$this, 'loadGroups']);
    }

    /**
     * @return array
     */
    private function loadGroups(array $paths): array
    {
        $paths[] = self::getGroupPath();

        return $paths;
    }

    private static function getGroupPath(): string
    {
        return QUICKS_DIR . '/field-groups';
    }
}
