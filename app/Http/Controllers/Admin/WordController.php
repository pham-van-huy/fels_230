<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Word\WordInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Answer\AnswerInterface;

class WordController extends Controller
{
    protected $wordRepository;
    protected $categoryRepository;
    protected $AnswerRepository;

    public function __construct(
        WordInterface $wordRepository,
        CategoryInterface $categoryRepository,
        AnswerInterface $answerRepository,
    )
    {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
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
