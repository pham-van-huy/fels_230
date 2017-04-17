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

    public function update($request, $id)
    {
        $inputs = [
            'name' => $request['name'],
            'email' => $request['email'],
        ];

        if (!empty($request['avatar'])) {
            $avatar = $this->uploadAvatar(Auth::user()->avatar);
            $inputs['avatar'] = $avatar;
        }

        if (!empty($request['password'])) {
            $inputs['password'] = $request['password'];
        }

        return $this->model->find($id)->update($inputs);
    }

    protected function uploadAvatar($oldImage = null)
    {
        $fileAvatar = Input::file('avatar');
        $destinationPath = public_path(config('settings.user.avatar_path'));
        $fileName = uniqid(time(), true) . '_' . $fileAvatar->getClientOriginalName();
        Input::file('avatar')->move($destinationPath, $fileName);

        if (!empty($oldImage) && File::exists($oldImage)
            && !preg_match('#^https?#', $oldImage)
            && !preg_match('#' . config('settings.user.avatar_default') . '?$#', $oldImage)) {
            File::delete($oldImage);
        }

        return $fileName;
    }
}
