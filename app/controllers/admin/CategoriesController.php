<?php namespace App\Controllers\Admin;

use Acme\Category;
use App\Controllers\BaseController;
use Acme\Repositories\CategoryRepositoryInterface;

/**
 * Class CategoriesController
 *
 */
class CategoriesController extends BaseController
{

    /**
     * @var \Acme\Repositories\CategoryRepositoryInterface
     *
     */
    protected $category;

    /**
     * function construct
     *
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->category->getAll();

        return \View::make('admin.categories.index')
            ->withCategories($categories);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return \View::make('admin.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), Category::$rules);

        if ($validator->passes())
        {
            $this->category->create(\Input::all());

            return \Redirect::route('admin.categories.index')
                ->with('message', 'Category has been saved successfully');
        }
        else
        {
            return \Redirect::route('admin.categories.create')
                ->with('message', 'The following errors occurred')
                ->with('messageType', 'danger')
                ->withErrors($validator)
                ->withInput();
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $record = Category::findOrFail($id);

        return \View::make('admin.categories.edit')
            ->with('record', $record);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $record = Category::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Category::$rules);

        if ($validator->passes())
        {
            $this->category->update($record, \Input::all());

            return \Redirect::route('admin.categories.index')
                ->with('message', 'Category has been edited successfully');
        }
        else
        {
            return \Redirect::route('admin.categories.edit', $record->id)
                ->with('message', 'The following errors occurred')
                ->with('messageType', 'danger')
                ->withErrors($validator)
                ->withInput();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $record = Category::findOrFail($id);
        $record->delete();
	}

}
