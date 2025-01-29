<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InquiryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InquiryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InquiryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Inquiry::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/inquiry');
        CRUD::setEntityNameStrings('inquiry', 'inquiries');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::column('name')->label('Name');
        CRUD::column('email')->label('Email');
        CRUD::column('phone')->label('Phone');
        CRUD::column('visit_date')->label('Visit Date');
        CRUD::column('visit_time')->label('Visit Time');
        CRUD::column('message')->label('Message');
        CRUD::column('payment_status')->type('select_from_array')
            ->options(['pending' => 'Pending', 'paid' => 'Paid']);
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        //CRUD::setValidation(InquiryRequest::class);
       // CRUD::setFromDb(); // set fields from db columns.
       CRUD::field('name')->label('Name');
       CRUD::field('email')->label('Email');
       CRUD::field('phone')->label('Phone');
       CRUD::field('visit_date')->type('date')->label('Visit Date');
       CRUD::field('visit_time')->type('time')->label('Visit Time');
       CRUD::field('message')->type('textarea')->label('Message');
       CRUD::field('payment_status')->type('select_from_array')
           ->options(['pending' => 'Pending', 'paid' => 'Paid'])
           ->label('Payment Status');
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
