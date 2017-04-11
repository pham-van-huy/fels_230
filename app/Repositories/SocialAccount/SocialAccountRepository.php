<?php
namespace App\Repositories\SocialAccount;

use App\Models\User;
use App\Models\SocialAccount;
use Laravel\Socialite\Contracts\Provider;

class SocialAccountRepository implements SocialAccountInterface
{
    protected $model;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->model = $socialAccount;
    }

    public function createOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $account = $this->model->whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $this->model->provider_user_id = $providerUser->getId();

            $this->model->provider = $providerName;

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'avatar' => $providerUser->getAvatar(),
                ]);
            }

            $this->model->user()->associate($user);
            $this->model->save();

            return $user;
        }
    }
}
