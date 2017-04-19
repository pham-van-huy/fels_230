<?php
namespace App\Http\Controllers\User;

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

    public function show($id)
    {
        return view('user.profile.show');
    }

    public function edit($id)
    {
        return view('user.profile.edit');
    }

    public function update(UserRequest $request)
    {
        $inputs = $request->only('name', 'email', 'password', 'avatar');
        $update = $this->useRepository->update(auth()->id(), $inputs);

        if (!$update) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.update_fail'));
        }

        return redirect()->action('User\UserController@show', auth()->id())
            ->with('status', 'success')
            ->with('message', trans('settings.text.user.update_success'));
    }
}
