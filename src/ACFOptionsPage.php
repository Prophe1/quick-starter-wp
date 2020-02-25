<?php

namespace Prophe1\QuickStarter;

final class ACFOptionsPage
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * ACFOptionsPage constructor.
     * @param array $new_params[]
     */
    public function __construct(array $new_params = [])
    {
        $this->updateParams($new_params);

        add_action('init', [$this, 'page']);
    }

    private function getPageSlug(): string
    {
        return $this->slug;
    }

    private function getPageTitle(): string
    {
        return $this->title;
    }

    private function updateParams(array $params = []): void
    {
        $default = [
            'title' => 'TSettings',
            'slug' => 't-settings'
        ];

        $settings = array_replace($default, $params);

        foreach ($settings as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Create page
     */
    public function page(): void
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'menu_title' => $this->getPageTitle(),
                'page_title' => $this->getPageTitle(),
                'menu_slug' => $this->getPageSlug(),
            ]);
        }
    }
}
