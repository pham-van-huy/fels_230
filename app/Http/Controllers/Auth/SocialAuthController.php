<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SocialAccount\SocialAccountInterface;
use Socialite;
use Auth;

class SocialAuthController extends Controller
{
    protected $socialAccount;

    public function __construct(SocialAccountInterface $service)
    {
        $this->socialAccount = $service;
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = $this->socialAccount->createOrGetUser(Socialite::driver($provider));
        Auth::login($user);

        return redirect()->to('/home');
    }
}
