<?php

namespace Prophe1\QuickStarter;

final class ACFFieldsGroupSaver
{
    /**
     * ACFFieldsGroupSaver constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'filters'], 4);
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
    public function loadGroups(array $paths): array
    {
        unset($paths[0]);

        $paths[] = $this->getGroupPath();

        return $paths;
    }

    public function getGroupPath(): string
    {
        $base_path = QUICKS_UPL_DIR . '/field-groups';

        if (! file_exists($base_path)) {
            mkdir($base_path);
        }

        return $base_path;
    }
}
