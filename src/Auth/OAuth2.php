<?php

namespace GorkaLaucirica\HipchatAPIv2Client\Auth;

class OAuth2 implements AuthInterface
{
    protected $authToken;

    /**
     * OAuth2 constructor that receives an auth token. You can get one here: https://yourCompany.hipchat.com/account/api
     *
     * @param string $authToken Your OAuth2 auth token
     *
     * @return self
     */
    public function __construct($authToken)
    {
        $this->authToken = $authToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredential()
    {
        return "Bearer ".$this->authToken;
    }
}
