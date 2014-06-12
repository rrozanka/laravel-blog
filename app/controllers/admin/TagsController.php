<?php namespace App\Controllers\Admin;

use Acme\Tag;
use App\Controllers\BaseController;
use Acme\Repositories\TagRepositoryInterface;

/**
 * Class TagsController
 *
 */
class TagsController extends BaseController {

    /**
     * @var \Acme\Repositories\TagRepositoryInterface
     *
     */
    protected $tag;

    /**
     * function construct
     *
     */
    public function __construct(TagRepositoryInterface $tag)
    {
        $this->tag = $tag;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $tags = $this->tag->getAll();

        return \View::make('admin.tags.index')
            ->withTags($tags);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return \View::make('admin.tags.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = \Validator::make(\Input::all(), Tag::$rules);

        if ($validator->passes())
        {
            $this->tag->create(\Input::all());

            return \Redirect::route('admin.tags.index')
                ->with('flash_message', 'Tag został dodany pomyślnie.')
                ->with('flash_type', 'success');
        }
        else
        {
            return \Redirect::route('admin.tags.create')
                ->with('flash_message', 'Wystąpiły błędy w formularzu!')
                ->with('flash_type', 'error')
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
        $record = Tag::findOrFail($id);

        return \View::make('admin.tags.edit')
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
        $record = Tag::findOrFail($id);
        $validator = \Validator::make(\Input::all(), Tag::$rules);

        if ($validator->passes())
        {
            $this->tag->update($record, \Input::all());

            return \Redirect::route('admin.tags.index')
                ->with('flash_message', 'Tag został zedytowany pomyślnie.')
                ->with('flash_type', 'success');
        }
        else
        {
            return \Redirect::route('admin.tags.edit', $record->id)
                ->with('flash_message', 'Wystąpiły błędy w formularzu!')
                ->with('flash_type', 'error')
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
        $record = Tag::findOrFail($id);
        $record->delete();
	}

}
