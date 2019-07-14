<?php

class myUser extends sfGuardSecurityUser
{

    public function setIpAddress($ip)
    {
        $this->setAttribute('IpAddress', $ip);
    }

    public function getIpAddress()
    {
        return $this->getAttribute('IpAddress', null);
    }

    public function setUserAgent($userAgent)
    {
        $this->setAttribute('UserAgent', $userAgent);
    }

    public function getUserAgent()
    {
        return $this->getAttribute('UserAgent', null);
    }

    public function setUserPermission($userPermission)
    {
        $this->setAttribute('UserPermission', $userPermission);
    }

    public function getUserPermission()
    {
        return $this->getAttribute('UserPermission', null);
    }

}
