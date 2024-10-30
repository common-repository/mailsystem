<?php

/**
 * Class MailsystemOptionsManager
 */
class MailsystemOptionsManager
{
    const OPTIONS_NAME = 'mailsystem_options';

    protected $options = [];

    /**
     * get options
     * @return array|mixed|void
     */
    public function get()
    {
        if (!$options = get_option(self::OPTIONS_NAME)) {
            $options = [
                'plugin' =>[
                    'version' => MAILSYSTEM_VERSION,
                ],
                'api' => [
                    'end_point' => '',
                    'token'
                ],
                'statistics' => [
                    'cache' => 0
                ],
            ];
            update_option(self::OPTIONS_NAME, $options);
        }
        $this->options = $options;
        return $this->options;
    }

    /**
     * set options
     * @param $options
     */
    public function set($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * save options
     * @return bool
     */
    function save()
    {
        return update_option(self::OPTIONS_NAME, $this->options);
    }

}