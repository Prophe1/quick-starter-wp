<?php
/**
 * Plugin Name: QuickStarter
 * Plugin URI:  https://github.com/Prophe1/quick-starter-wp
 * Description: Package of important package library
 * Author:      Prophe1
 * Author URI:  https://github.com/Prophe1/
 * Version:     0.0.0
 */

namespace Prophe1\QuickStarter;

/**
 * Class QuickStarter
 *
 * @since 0.0.0
 *
 * @package Prophe1\QuickStarter
 */
final class QuickStarter
{
    /**
     * QuickStarter constructor.
     *
     * @since 0.0.0
     */
    public function __construct()
    {
        $this->constants();
        $this->autoloader();
        $this->init();
    }

    /**
     * Define constants
     *
     * @since 0.0.0
     */
    private function constants(): void
    {
        $this->define('QUICKS_DIR', plugin_dir_path(__FILE__));
        $this->define('QUICKS_SLUG', 'QSS');
    }

    /**
     * Define constants if doesn't exists
     *
     * @since 0.0.0
     *
     * @param $name string
     * @param $value bool
     */
    private function define($name, $value = true): void
    {
        if (! defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Autoload with composer autoloader or spl
     *
     * @since 0.0.0
     */
    private function autoloader(): void
    {
        if (file_exists(QUICKS_DIR . '/vendor/autoload.php')) {
            require_once QUICKS_DIR . '/vendor/autoload.php';
        } else {
            spl_autoload_register([$this, 'autoload']);
        }
    }

    /**
     * This function is called by spl_autoload_register
     *
     * @param $class string
     */
    private function autoload($class): void
    {
        // base directory for the namespace prefix
        $base_dir = __DIR__ . '/src/';

        // does the class use the namespace prefix?
        $len = strlen(__NAMESPACE__);
        if (strncmp(__NAMESPACE__, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }

        $file = $base_dir . str_replace('\\', '/', substr($class, $len)) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }

    /**
     * Initialize blocks
     *
     * @since 0.0.0
     */
    public function init(): void
    {
        new ACFOptionsPage();
        new ACFFieldsGroupSaver();
    }
}

new QuickStarter();
