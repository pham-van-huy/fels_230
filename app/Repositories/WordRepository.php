<?php
namespace App\Repositories;

use Auth;
use App\Models\Word;
use Illuminate\Support\Facades\Input;
use App\Http\Request\WordRequest;
use Exception;
use File;

class WordRepository
{
    public function __contruct(Word $word)
    {
        $this->model = $word;
    }

    public function index()
    {
        return $this->model->paginate(20);
    }
}
