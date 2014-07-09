<?php

namespace GorkaLaucirica\HipchatAPIv2Client\Auth;

interface AuthInterface
{
    /**
     * Returns the credential string that is used to connect the API
     *
     * @return string Credential to be used to connect the API
     */
    public function getCredential();
}
