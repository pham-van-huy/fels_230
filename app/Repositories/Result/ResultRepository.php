<?php
namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use App\Repositories\Result\ResultInterface;
use App\Models\Word;

class ResultRepository extends BaseRepository implements ResultInterface
{
    protected $model;

    public function __construct(Result $result)
    {
        $this->model = $result;
    }

    public function create($id)
    {
        $words = Word::inRanDomOrder()->where('category_id', $id)->pluck('id');
        dd($words);
    }
}
