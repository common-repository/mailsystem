<?php

/*
Plugin Name: Mailsystem
Description: mailsystem integration with wordpress
Version: 1.1.0
Stable tag: 1.1.0
Author: Vladimir Drizheruk
Author URI: http://www.dvsoftware.com.ua
*/

define('MAILSYSTEM_VERSION', '1.0.0');
define('MAILSYSTEM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MAILSYSTEM_PLUGIN_URL', plugin_dir_url(__FILE__));
ini_set('include_path', ini_get('include_path') . ':' . __DIR__);

spl_autoload_register(function ($className) {
    if (file_exists($fileName = __DIR__ . '/include/' . $className . '.php')) {
        require_once $fileName;
    }
    if (file_exists($fileName = __DIR__ . '/lib/' . $className . '.php')) {
        require_once $fileName;
    }
});

global $mailsystem;
$mailsystem = new Mailsystem();

class Mailsystem
{
    public $optionsManager = null;
    public $adminMenu = null;

    function __construct()
    {
        $this->optionsManager = new MailsystemOptionsManager();
        $this->optionsManager->get();
        $this->adminMenu = new MailsystemAdminMenu();

        add_action('admin_menu', [$this->adminMenu, 'admin_menu']);
    }
}

new MailsystemApiClient();