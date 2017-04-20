<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Word\WordInterface;
use App\Repositories\Category\CategoryInterface;

class WordController extends Controller
{
    protected $wordRepository;
    protected $categoryRepository;

    public function __construct(
        WordInterface $wordRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $categories = $this->categoryRepository->pluck('name', 'id');
        $categories->prepend(trans('settings.text.category.choice'), 'default');
        $categories->toArray();
        view()->share(['categories' => $categories]);
    }

    public function showList()
    {
        $wordsPaginate = $this->wordRepository->getWordList();
        $wordsGroupByAlpha = $this->wordRepository->groupWordByAlpha($wordsPaginate);

        return view('user.word.list', [
            'wordsGroupByAlpha' => $wordsGroupByAlpha,
            'wordsPaginate' => $wordsPaginate,
        ]);
    }

    public function wordsFilter(Request $request)
    {
        $inputs = $request->only('categoryId', 'rdOption');
        $oldCategory = $inputs['categoryId'];
        $oldRdOption = $inputs['rdOption'];
        $wordsPaginate = $this->wordRepository->getWordByFilter($inputs);
        $wordsGroup = $this->wordRepository->groupWordByAlpha($wordsPaginate);

        return view('user.word.filter', [
            'oldCategory' => $oldCategory,
            'oldRdOption' => $oldRdOption,
            'wordsPaginate' => $wordsPaginate,
            'wordsGroup' => $wordsGroup,
        ]);
    }
}
