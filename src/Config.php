<?php

namespace Prodvnet\UnifiedSearch;

class Config
{
    private $login;

    private $password;

    private $serviceUrl;

    public function __construct($params)
    {
        $this->setParams($params);
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    /**
     * @param mixed $serviceUrl
     */
    public function setServiceUrl($serviceUrl)
    {
        $this->serviceUrl = $serviceUrl;
    }

    private function setParams($params) {
        foreach ($params as $name => $param) {
            $this->{'set' . $name}($param);
        }
    }
}
