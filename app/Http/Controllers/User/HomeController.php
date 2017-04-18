<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Word\WordInterface;

class HomeController extends Controller
{
    protected $wordRepository;

    public function __construct(WordInterface $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    public function index()
    {
        $numberWordsLearned = count($this->wordRepository->listWordIdLearned());
        return view('user.home', ['numberWordsLearned' => $numberWordsLearned]);
    }
}
