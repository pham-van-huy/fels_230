<?php
namespace App\Repositories\User;

use Auth;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class UserRepository extends BaseRepository implements UserInterface
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

        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'avatar' => $fileName,
            'password' => $request['password'],
        ];

        return $this->model->create($input);
    }

    protected function uploadAvatar($oldImage = null)
    {
        $fileAvatar = Input::file('avatar');
        $destinationPath = public_path(config('settings.user.avatar_path'));
        $fileName = uniqid(time(), true) . '_' . $fileAvatar->getClientOriginalName();
        Input::file('avatar')->move($destinationPath, $fileName);
        $imageOldDestinationPath = $destinationPath . $oldImage;

        if (!empty($oldImage) && File::exists($imageOldDestinationPath)) {
            File::delete($imageOldDestinationPath);
        }

        return $fileName;
    }
}
