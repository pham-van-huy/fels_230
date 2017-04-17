<?php
namespace App\Repositories\Result;

use Auth;
use App\Models\Result;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class ResultRepository extends BaseRepository implements ResultInterface
{
    protected $model;

    public function __construct(Result $result)
    {
        $this->model = $result;
    }
}
