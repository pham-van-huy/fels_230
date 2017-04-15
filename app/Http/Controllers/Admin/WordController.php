<?php
namespace App\Http\Controllers\Admin;

use DB;
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

        $categories = $this->categoryRepository->pluck('name', 'id')->toArray();
        $categories = ['default' => trans('settings.text.category.choice')] + $categories;
        view()->share(['categories' => $categories]);
    }

    public function index()
    {
        $words = $this->wordRepository->all();
        return view('admin.word.index', ['words' => $words]);
    }

    public function create()
    {
        return view('admin.word.create');
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

    public function edit($id)
    {
        $word = $this->wordRepository->find($id);
        return view('admin.word.edit', ['word' => $word]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only('category_id', 'word', 'ans');
        $inputsWord = array_only($inputs, ['category_id', 'word']);
        $inputAnswer = $inputs['ans'];

        try {
            DB::beginTransaction();
            $updateWord = $this->wordRepository->update($inputsWord, $id);
            $updateAnswer = $this->answerRepository->updateAnswer($inputAnswer);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        if (!$updateWord || !$updateAnswer) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.word.update_fail'));
        }

        return redirect()->action('Admin\WordController@index')
                ->with('status', 'success')
                ->with('message', trans('settings.text.word.update_success'));
    }

    public function destroy($id)
    {
        $delete = $this->wordRepository->delete($id);

        if (!$delete) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.word.delete_fail'));
        }

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', trans('settings.text.word.delete_success'));
    }
}
