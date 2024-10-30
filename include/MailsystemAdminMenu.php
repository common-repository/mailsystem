<?php

class MailsystemAdminMenu
{
    public function admin_menu()
    {
        global $menu;

        add_menu_page(
            'Mailsystem',
            'Mailsystem',
            'manage_options',
            'mailsystem_statistics',
            array($this, 'admin_mailsystem_statistics'),
            '', //plugins_url() . '/' . basename( dirname(__FILE__) ) .'/images/statistics.png',
            52
        );
        $menu[51] = array('', 'exist', 'separator', '', 'wp-menu-separator');

        global $submenu;

        // Letters
        add_submenu_page(
            'mailsystem_statistics',
            'Letters',
            'Letters',
            'manage_options',
            'mailsystem_letters',
            array($this, 'admin_mailsystem_letters')
        );

        // Settings
        add_submenu_page(
            'mailsystem_statistics',
            __('Settings', 'mailsystem_statistics'),
            __('Settings', 'mailsystem_statistics'),
            'manage_options',
            'mailsystem_settings',
            array($this, 'admin_mailsystem_settings')
        );

        //if (isset($submenu['mailsystem_statistics']))
        $submenu['mailsystem_statistics'][0][0] = __('Statistics', 'mailsystem_statistics');
    }

    /**
     * View : letters
     */
    function admin_mailsystem_letters()
    {
        $ApiClient = new MailsystemApiClient();
        $PostManager = new PostManager();
        if (isset($_POST['mailsystem_post_category_import'])) {
            if (wp_verify_nonce($_POST['_wpnonce'], MailsystemOptionsManager::OPTIONS_NAME . '_config')) {
                $categoryId = isset($_POST['cat']) ? (int)$_POST['cat'] : 0;
                $posts = $PostManager->getPostsByCategory($categoryId);
                if (!empty($posts)) {
                    $userData = $ApiClient->getUserId();
                    $user_id = (int)$userData->data->id;
                    $send_from_id = isset($_POST['send_from']) ? (int)$_POST['send_from'] : 0;

                    foreach ($posts as $post) {
                        $PostManager->importPost($user_id, $send_from_id, $post, $ApiClient);
                        sleep(1);
                    }
                }
                echo '<div class="updated"><p>Success! Post"' . $post->post_title . ' successfully imported to MailSystem!</p></div>';
            }
        }

        if (isset($_POST['mailsystem_post_import'])) {
            if (wp_verify_nonce($_POST['_wpnonce'], MailsystemOptionsManager::OPTIONS_NAME . '_config')) {
                $postId = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
                $post = $PostManager->getPostById($postId);
                $userData = $ApiClient->getUserId();
                $user_id = (int)$userData->data->id;
                $send_from_id = isset($_POST['send_from']) ? (int)$_POST['send_from'] : 0;
                if ($post) {
                    $PostManager->importPost($user_id, $send_from_id, $post, $ApiClient);
                }
                echo '<div class="updated"><p>Success! Selected Post successfully imported to MailSystem!</p></div>';
            }
        }

        $oSendFrom = $ApiClient->getSendFrom();
        $aSendFrom = $oSendFrom->data[0];

        $allPosts = PostManager::getAllPosts();
        require_once 'views/admin_mailsystem_letters.php';
    }

    /**
     * View : settings
     */
    function admin_mailsystem_settings()
    {
        global $mailsystem;
        if (isset($_POST[MailsystemOptionsManager::OPTIONS_NAME . '_config_save'])) {
            if (wp_verify_nonce($_POST['_wpnonce'], MailsystemOptionsManager::OPTIONS_NAME . '_config')) {
                $options = [];
                $options['plugin']['version'] = MAILSYSTEM_VERSION;
                $options['api']['end_point'] = $_POST['api_end_point'];
                $options['api']['token'] = $_POST['api_token'];
                $options['statistics']['cache'] = $_POST['statistics_cache'];
                $mailsystem->optionsManager->set($options)->save();
                echo '<div class="updated"><p>' . __('Success! Your changes were successfully saved!', MailsystemOptionsManager::OPTIONS_NAME) . '</p></div>';
            } else {
                echo '<div class="error"><p>' . __('Whoops! There was a problem with the data you posted. Please try again.', MailsystemOptionsManager::OPTIONS_NAME) . '</p></div>';
            }
        }
        $options = $mailsystem->optionsManager->get();
        require_once 'views/admin_mailsystem_settings.php';
    }

    /**
     * View : statistics
     */
    function admin_mailsystem_statistics()
    {
        $ApiClient = new MailsystemApiClient();
        $lettersData = $ApiClient->getLetters();
        $letters = $lettersData->data;
        require_once 'views/admin_mailsystem_statistics.php';
    }

}