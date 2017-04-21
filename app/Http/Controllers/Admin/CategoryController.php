<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->paginate();

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->only('name');
        $category = $this->categoryRepository->create($input);

        if (!$category) {
            return redirect()->back()
               ->with('status', 'danger')
               ->with('message', trans('settings.text.category.add_fail'));
        }

        return redirect()->action('Admin\CategoryController@index')
            ->with('status', 'success')
            ->with('message', trans('settings.text.category.add_success'));
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $inputs = $request->only('name');
        $category = $this->categoryRepository->update($id, $inputs);

        if (!$category) {
            return redirect()->back()
               ->with('status', 'danger')
               ->with('message', trans('settings.text.category.update_fail'));
        }

        return redirect()->action('Admin\CategoryController@index')
            ->with('status', 'success')
            ->with('message', trans('settings.text.category.update_success'));
    }

    public function destroy($id)
    {
        $delete = $this->categoryRepository->delete($id);

        if (!$delete) {
            return redirect()->back()
               ->with('status', 'danger')
               ->with('message', trans('settings.text.category.delete_fail'));
        }

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', trans('settings.text.category.delete_success'));
    }
}
