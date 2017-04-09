<?php
namespace App\Repositories;

use Auth;
use App\Models\Answer;
use Illuminate\Support\Facades\Input;
use App\Http\Request\WordRequest;
use Exception;
use File;

class AnswerRepository
{
    public function __contruct(Answer $answer)
    {
        $this->model = $answer;
    }

    public function index()
    {
        return $this->model->paginate(20);
    }
}
