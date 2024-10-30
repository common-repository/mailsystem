<?php

class MailsystemApiClient
{
    private $options;
    private $callUrl = '';

    function __construct()
    {
        global $mailsystem;

        $this->options = $mailsystem->optionsManager->get();
        $this->callUrl = $this->options['api']['end_point'] . '/token/' . $this->options['api']['token'];
    }


    /**
     * get user
     * @return array|mixed
     */
    public function getUser()
    {
        $url = $this->callUrl . '/user';
        $out = $this->call($url);
        if (!empty($out)) {
            $out = json_decode($out);
        }
        return $out;
    }

    /**
     * get user id
     * @return array|mixed
     */
    public function getUserId()
    {
        $url = $this->callUrl . '/user/id';
        $out = $this->call($url);
        if (!empty($out)) {
            $out = json_decode($out);
        }
        return $out;
    }

    /**
     * get last letters
     * @return array|mixed
     */
    public function getLetters()
    {
        $url = $this->callUrl . '/letter';
        $out = $this->call($url);
        if (!empty($out)) {
            $out = json_decode($out);
        }
        return $out;
    }

    /**
     * create letter
     * @param array $data
     */
    public function createLetter(array $data)
    {
        $url = $this->callUrl . '/letter';
        $out = $this->call($url, 'post', $data);
        if (!empty($out)) {
            $out = json_decode($out);
        }
        return $out;
    }

    /**
     * get send From's
     * @return array|mixed
     */
    public function getSendFrom()
    {
        $url = $this->callUrl . '/sendFrom';
        $out = $this->call($url);
        if (!empty($out)) {
            $out = json_decode($out);
        }
        return $out;
    }

    protected function call($url, $method = 'get', $data = [])
    {
        if (empty($this->options['api']['token'])) return [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ('get' != $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        }

        if (!empty($data)) {
            $fields_string = http_build_query($data);
            if ('post' === $method) {
                curl_setopt($ch, CURLOPT_POST, count($data));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            }
        }
        $out = curl_exec($ch);
        curl_close($ch);
        return $out;
    }
}