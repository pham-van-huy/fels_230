<?php
namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Word\WordInterface;
use App\Repositories\User\UserInterface;

class HomeController extends Controller
{
    protected $wordRepository;
    protected $userRepository;

    public function __construct(
        WordInterface $wordRepository,
        UserInterface $userRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $numberWordsLearned = count($this->wordRepository->listWordIdLearned());
        $numberFollowers = Auth::user()->followers()->count();
        $numberFollowings = Auth::user()->followings()->count();

        return view('user.home', [
            'numberWordsLearned' => $numberWordsLearned,
            'numberFollowers' => $numberFollowers,
            'numberFollowings' => $numberFollowings,
        ]);
    }
}
