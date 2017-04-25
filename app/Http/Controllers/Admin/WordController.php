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

        $categories = $this->categoryRepository->pluck('name', 'id');
        $categories->prepend(trans('settings.text.category.choice'), 'default');
        $categories->toArray();
        view()->share(['categories' => $categories]);
    }

    public function filerWord(Request $request)
    {
        $inputFilter = $request->only('key', 'categoryId');
        $words = $this->wordRepository->getWordByFilter($inputFilter);

        return view('admin.word.index', [
            'words' => $words,
            'oldKey' => $inputFilter['key'],
            'oldCategory' => $inputFilter['categoryId'],
        ]);
    }

    public function index()
    {
        $words = $this->wordRepository->paginate();
        $oldCategory = 'default';
        $oldKey = '';

        return view('admin.word.index', [
            'words' => $words,
            'oldKey' => $oldKey,
            'oldCategory' => $oldCategory,
        ]);
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

        if (!$word) {
            return view('errors.404');
        }

        return view('admin.word.edit', ['word' => $word]);
    }

    public function update(WordRequest $request, $id)
    {
        $inputs = $request->only('category_id', 'word', 'ans');
        $inputsWord = array_only($inputs, ['category_id', 'word']);
        $inputAnswer = $inputs['ans'];

        DB::beginTransaction();
        try {
            $deleteAnswer = $this->answerRepository->deleteAnswers($id, $inputAnswer);
            $updateWord = $this->wordRepository->update($id, $inputsWord);
            $updateAnswer = $this->answerRepository->updateOrCreateAnswer($id, $inputAnswer);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        if (!$updateWord || !$updateAnswer || !$deleteAnswer) {
            return redirect()->action('Admin\WordController@index')
                ->with('status', 'danger')
                ->with('message', trans('settings.text.word.update_fail'));
        }

        return redirect()->action('Admin\WordController@index')
            ->with('status', 'success')
            ->with('message', trans('settings.text.word.update_success'));
    }

    public function destroy($id)
    {
        $result = $this->wordRepository->delete($id);

        if (!$result) {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', trans('settings.text.word.delete_fail'));
        }

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', trans('settings.text.word.delete_success'));
    }
}
