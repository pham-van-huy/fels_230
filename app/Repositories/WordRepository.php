<?php
namespace App\Repositories;

use Auth;
use App\Models\Word;
use App\Models\Answer;
use Illuminate\Support\Facades\Input;
use App\Http\Request\WordRequest;
use Exception;
use File;
use DB;

class WordRepository
{
    public function __construct(Word $word)
    {
        $this->model = $word;
    }

    public function index()
    {
        return $this->model->paginate(20);
    }

    public function createWordWithAnswer($inputWord, $inputAnswers)
    {
        if (!$inputWord || !$inputAnswers) {
            return false;
        }

        try {
            DB::beginTransaction();
            return $this->model->create($inputWord)->answers()
            ->createMany($inputAnswers);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
    }
}
