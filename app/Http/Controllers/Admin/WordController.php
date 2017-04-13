<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\WordRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Word\WordInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Answer\AnswerInterface;

class WordController extends Controller
{
    protected $wordRepository;
    protected $categoryRepository;
    protected $answerRepository;

    public function __construct(
        WordInterface $wordRepository,
        CategoryInterface $categoryRepository,
        AnswerInterface $answerRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {

    }

    public function create()
    {
        $categories = $this->categoryRepository->pluck('name', 'id')->toArray();
        $categories = ['default' => trans('settings.text.category.choice')] + $categories;

        return view('admin.word.create', ['categories' => $categories]);
    }

    public function store(WordRequest $request)
    {
        $input = $request->only('word', 'category_id', 'ans');

        $result = $this->wordRepository->storeWordAndAnswers($input);

        if (!$result) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.word.add_fail'));
        }

        return redirect()->action('Admin\WordController@index')
                ->with('status', 'success')
                ->with('message', trans('settings.text.word.add_success'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
