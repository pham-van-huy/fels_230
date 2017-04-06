<?php
namespace App\Repositories;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class UserRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($request)
    {
        $fileName = isset($request['avatar'])
            ? $this->uploadAvatar()
            : config('settings.user.avatar_default');
        $is_admin = config('settings.user.member');

        $user = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'avatar' => $fileName,
            'is_admin' => $is_admin,
        ];

        $createUser = $this->model->create($user);

        if (!$createUser) {
            throw new Exception('message.create_error');
        }

        return $createUser;
    }

    public function uploadAvatar($oldImage = null)
    {
        $fileAvatar = Input::file('avatar');
        $destinationPath = config('settings.user.avatar_path');
        $fileName = time() . '.' . $fileAvatar->getClientOriginalExtension();
        Input::file('avatar')->move($destinationPath, $fileName);
        $imageOldDestinationPath = $destinationPath.$oldImage;

        if (!empty($oldImage) && file_exists($imageOldDestinationPath)) {
            File::delete($imageOldDestinationPath);
        }
        return $fileName;
    }
}
