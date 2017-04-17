<?php
namespace App\Repositories\Word;

use DB;
use Auth;
use App\Models\Word;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class WordRepository extends BaseRepository implements WordInterface
{
    protected $model;

    public function __construct(Word $word)
    {
        $this->model = $word;
    }

    public function storeWordAndAnswers($input)
    {
        try {
            DB::beginTransaction();
            $data = $this->model
                ->create(array_only($input, ['word', 'category_id']))
                ->answers()->createMany($input['ans']);
            DB::commit();

            return $data;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function all()
    {
        return $this->model->with('category')->paginate(config('settings.user.paginate'));
    }

    public function getWordForLesson($idCategory)
    {

    }
}
