<?php
namespace App\Repositories\SocialAccount;

use Laravel\Socialite\Contracts\Provider;

interface SocialAccountInterface
{
    public function createOrGetUser(Provider $provider);
}
