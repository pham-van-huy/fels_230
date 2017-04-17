<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;

class UserController extends Controller
{
    protected $useRepository;
    public function __construct(UserInterface $useRepository)
    {
        $this->useRepository = $useRepository;
    }

    public function showProfile()
    {
        return view('user.profile.show');
    }

    public function editProfile()
    {
        return view('user.profile.edit');
    }

    public function updateProfile(UserRequest $request)
    {
        $inputs = $request->only('name', 'email', 'password', 'avatar');
        $update = $this->useRepository->update($inputs, Auth::user()->id);

        if (!$update) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.update_fail'));
        }

        return redirect()->action('User\UserController@showProfile')
                ->with('status', 'success')
                ->with('message', trans('settings.text.user.update_success'));
    }
}
