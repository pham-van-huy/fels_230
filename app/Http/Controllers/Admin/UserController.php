<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate();

        return view('admin.user.index', [
            'users' => $users,
            'oldKey' => '',
        ]);
    }

    public function destroy($id)
    {
        $result = $this->userRepository->delete($id);

        if (!$result) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.delete_fail'));
        }

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', trans('settings.text.user.delete_success'));
    }

    public function filterUser(Request $request)
    {
        $oldKey = $request->get('key');
        $users = $this->userRepository->findByEmail($oldKey);
        return view('admin.user.index', [
            'users' => $users,
            'oldKey' => $oldKey,
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(AdminUserRequest $request)
    {
        $result = $this->userRepository->create($request);

        if (!$result) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.add_fail'));
        }

        return redirect()->action('Admin\UserController@index')
            ->with('status', 'success')
            ->with('message', trans('settings.text.user.add_success'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(AdminUserRequest $request, $id)
    {
        $inputs = $request->only('name', 'email', 'password', 'avatar');
        $update = $this->userRepository->update($id, $inputs);

        if (!$update) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.update_fail'));
        }

        return redirect()->action('Admin\UserController@index')
            ->with('status', 'success')
            ->with('message', trans('settings.text.user.update_success'));
    }
}
