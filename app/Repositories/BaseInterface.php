<?php
namespace App\Repositories;

interface BaseInterface
{
    public function all();

    //get list value of colunm
    public function fluck($column, $key = null);

    public function paginate($limit = null, $columns = ['*']);

    public function find($id);

    public function where($conditions, $operator = null, $value = null);

    public function whereIn($column, $value);

    public function create($input);

    public function update($id, $input);

    public function getCurrentUser();

    public function delete($id);

    public function search($column, $value);
}
