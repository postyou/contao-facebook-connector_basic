<?php
namespace postyou;

use Facebook\PersistentData\PersistentDataInterface;
use Contao\Session;

class ContaoPersistentDataHandler implements PersistentDataInterface
{

    /**
     *
     * @var string Prefix to use for session variables.
     */
    protected $sessionPrefix = 'FBRLH_';

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return $_SESSION['BE_DATA'][$this->sessionPrefix . $key];
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        $_SESSION['BE_DATA'][$this->sessionPrefix . $key] = $value;
    }
}