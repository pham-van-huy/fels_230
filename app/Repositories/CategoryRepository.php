<?php
namespace App\Repositories;

use Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class CategoryRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function create($request)
    {
        $inputs = [
            'name' => $request->name,
        ];
        $createCategory = $this->model->create($inputs);

        if (!$createCategory) {
            throw new Exception('message.create_error');
        }

        return $createCategory;
    }

    public function show()
    {
        return $this->model->paginate(20);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function edit($id)
    {
        return $this->model->find($id);
    }

    public function update($request, $id)
    {
        $result = $this->model->find($id)->update($request);
        if (!$result) {
            throw new Exception(trans('message.update_error'));
        }
        return $result;
    }
}
