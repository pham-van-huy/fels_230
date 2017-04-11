<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\WordRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\AnswerRepository;
use App\Http\Requests\WordRequest;

class WordController extends Controller
{

    protected $wordRepository;
    protected $categoryRepository;
    protected $answerRepository;

    public function __construct(
        WordRepository $wordRepository,
        CategoryRepository $categoryRepository,
        AnswerRepository $answerRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->answerRepository = $answerRepository;
        $listCategory = $categoryRepository->all();
        view()->share('listCategory', $listCategory);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.word.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.word.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request)
    {
        $inputAnswers = $this->answerRepository->getAnswerFromInput($request->get('answer'));
        $inputWord = $request->only('category_id', 'word');
        $result = $this->wordRepository->createWordWithAnswer($inputWord, $inputAnswers);

        if ($result) {
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Create Successfuly');
        }
        return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Create Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
