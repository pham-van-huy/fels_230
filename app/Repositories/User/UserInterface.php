<?php
namespace App\Repositories\User;

interface UserInterface
{
    public function create($request);

    public function paginate($limit = null, $columns = ['*']);

    public function addOrRemoveFollow($userId);
}
