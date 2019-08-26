<?php
namespace postyou;

class FbConnector
{
    protected $arrConfig = array();

    protected static $arrInstances = array();

    protected $accesstoken;

    protected $limit = null;

    protected $since = null;

    protected function __construct(array $arrConfig)
    {
        $this->arrConfig = $arrConfig;
        $this->initFacebookPhpSdk();
    }

    public static function getInstance(array $arrCustomOpt = null)
    {
        $arrConfig = array(
            'baseUrl' => 'https://graph.facebook.com',
            'version' => \Config::get('facebookApiVersion'),
            'appID' => \Config::get('appID'),
            'appSecret' => \Config::get('appSecret'),
            'userAccessToken' => \Config::get('userAccessToken'),
            'connectionType' => ConnectionType::POST_GET
        );

        if (is_array($arrCustomOpt)) {
            $arrConfig = array_merge($arrConfig, $arrCustomOpt);
        }

        ksort($arrConfig);
        $strKey = md5(implode(' ', $arrConfig));

        if (! isset(static::$arrInstances[$strKey])) {
            $strClass = '\FbConnector' .
                 str_replace(' ', '_', ucwords(str_replace('_', ' ', $arrConfig['connectionType'])));

            static::$arrInstances[$strKey] = new $strClass($arrConfig);
        }
        return static::$arrInstances[$strKey];
    }

    protected function getAppID()
    {
        return $this->arrConfig['appID'];
    }

    protected function getAppSecret()
    {
        return $this->arrConfig['appSecret'];
    }

    public function getBaseUrl()
    {
        return $this->arrConfig['baseUrl'];
    }

    public function getVersion()
    {
        return $this->arrConfig['version'];
    }

    public function getAccessTokenQuery()
    {
//        return 'access_token=' . $this->arrConfig['appID'] . '|' . $this->arrConfig['appSecret'];
        return 'access_token=' . $this->arrConfig['userAccessToken'];
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function setSince($timestamp)
    {
        $this->since = $timestamp;
    }

    protected function fetchData($url, $header = false)
    {
        $ch = $this->initCurl($url, $header);
        return json_decode(curl_exec($ch), true);
    }

    protected function initCurl($url, $header = false)
    {
        $ch = curl_init($url);
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        return $ch;
    }

    protected function initFacebookPhpSdk()
    {
        return;
    }
}
