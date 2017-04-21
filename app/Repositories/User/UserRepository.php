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

    public function update($id, $inputs)
    {
        $dateUpdate = [
            'name' => $inputs['name'],
            'email' => $inputs['email'],
        ];

        if (!empty($inputs['password'])) {
            $dateUpdate['password'] = $inputs['password'];
        }

        if (!empty($inputs['avatar'])) {
            $dateUpdate['avatar'] = $this->uploadAvatar(Auth::user()->avatar);
        }

        return Auth::user()->update($dateUpdate);
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

    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = $limit ?: config('settings.user.paginate');
        return $this->model->with('lessons', 'followers', 'followings')
            ->orderBy('name')->where('id', '!=', auth()->id())
            ->paginate($limit, $columns);
    }

    public function addOrRemoveFollow($userId)
    {
        if (!$userId) {
            return false;
        }

        $userCurrent = Auth::user();
        $listUserFollowing = $userCurrent->followings();

        if ($listUserFollowing->get()->contains('id', $userId)) {
            $listUserFollowing->detach($userId);
            $result = config('settings.action.remove');
        } else {
            $listUserFollowing->attach($userId);
            $result = config('settings.action.add');
        }

        return $result;
    }
}
