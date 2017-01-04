<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TagCrudRequest as StoreRequest;
use App\Http\Requests\TagCrudRequest as UpdateRequest;

class TagCrudController extends CrudController {

	public function setup() {
        $this->crud->setModel("App\Models\Tag");
        $this->crud->setRoute("admin/tag");
        $this->crud->setEntityNameStrings('tag', 'tags');

        $this->crud->setColumns(['name']);
        $this->crud->addField([
	'name' => 'name',
	'label' => "Tag name"
	]);
    }

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
