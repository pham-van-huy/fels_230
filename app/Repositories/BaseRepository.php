<?php
/**
* Base Repository
*/
namespace App\Repositories;

use Exception;
use DB;
use Auth;
use Carbon\Carbon;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('settings.user.paginate') : $limit;

        return $this->model->paginate($limit, $columns);
    }

    public function find($id)
    {
        return $data = $this->model->find($id);
    }

    public function where($conditions, $operator = null, $value = null)
    {
        return $this->model->where($conditions, $operator, $value)->get();
    }

    public function whereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];

        return $this->model->whereIn($column, $values);
    }

    public function create($inputs)
    {
        return $this->model->create($inputs);
    }

    public function update($id, $input)
    {
        return $this->model->find($id)->update($inputs);
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function delete($ids)
    {
        return $this->model->destroy($ids);
    }

    public function search($column, $value)
    {
        return $this->model->where('$column LIKE $value');
    }
}
