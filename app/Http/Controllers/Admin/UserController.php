<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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

        return view('admin.user.index', ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->delete($id);

        if (!$user) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.delete_fail'));
        }

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', trans('settings.text.user.delete_success'));
    }
}
