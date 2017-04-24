<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $update = $this->userRepository->update(auth()->id(), $inputs);

        if (!$update) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.user.update_fail'));
        }

        return redirect()->action('User\UserController@show', auth()->id())
            ->with('status', 'success')
            ->with('message', trans('settings.text.user.update_success'));
    }

    public function listMember(Request $request)
    {
        $options = [
            config('settings.user.all') => trans('settings.text.all_member'),
            config('settings.user.follow') => trans('settings.text.follow_member'),
            config('settings.user.un_follow') => trans('settings.text.un_follow_member'),
        ];

        if ($request->isMethod('get')) {
            $members = $this->userRepository->paginate();

            return view('user.follow.members', [
                'members' => $members,
                'options' => $options,
                'oldOption' => 'all',
                'oldKeyName' => null,
            ]);
        }

        if ($request->isMethod('post')) {
            $inputs = $request->only('notOrFollow', 'keyName');
            $members = $this->userRepository->filterMember($inputs);

            return view('user.follow.members', [
                'members' => $members,
                'options' => $options,
                'oldOption' => $inputs['notOrFollow'],
                'oldKeyName' => $inputs['keyName'],
            ]);
        }
    }

    public function addRelationship($userId)
    {
        $result = $this->userRepository->addOrRemoveFollow($userId);

        if (!$result) {
            return response()->json(['status' => config('settings.status.fail')]);
        }

        return response()->json([
            'result' => $result,
            'status' => config('settings.status.success'),
        ]);
    }
}
