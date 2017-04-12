<?php
namespace App\Repositories\Word;

use Auth;
use App\Models\Word;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    protected $model;

    public function __construct(Word $word)
    {
        $this->model = $word;
    }
}
