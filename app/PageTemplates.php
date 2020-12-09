<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */
    private function generic()
    {
        $this->crud->field('name')->tab('Detail');
        $this->crud->field('template')->tab('Detail');
        $this->crud->field('title')->tab('Detail');
        $this->crud->field('slug')->tab('Detail');
        $this->crud->field('is_featured')->tab('Detail');

        $this->crud->addField([
            // select_from_array
            'name'    => 'is_published',
            'label'   => 'Publish',
            'type'    => 'select_from_array',
            'options' => [false => 'Draft (invisible)', true => 'Published (visible)'],
            'tab' => 'Detail'
        ]);
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Meta data'
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Meta data'
                    ]);
        $this->crud->addField([
                        'name' => 'meta_keywords',
                        'type' => 'textarea',
                        'label' => trans('backpack::pagemanager.meta_keywords'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Meta data'
                    ]);

        $this->crud->addField([
                        'name' => 'content',
                        'label' => trans('backpack::pagemanager.content'),
                        'type' => 'ckeditor',
                        'placeholder' => trans('backpack::pagemanager.content_placeholder'),
                        'options' => [
                            //'removeButtons' => 'Image',
                            'contentsCss' => 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
                            'allowedContent' => true

                        ],
                        'tab' => 'Content'
                    ]);

        $user = \Auth::guard('backpack')->user();
        $this->crud->addField([
               // 1-n relationship
               'label'     => 'Author', // Table column heading
                'type'      => 'select',
                'name'      => 'user_id', // the column that contains the ID of that connected entity;
                'entity'    => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\User", // foreign key model
                'tab' => 'Content',
                'default' => $user->id ?? null
           ]);
    }
}
