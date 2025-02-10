<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommandesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Charts\CommandesChart;
use App\Models\Commandes;
use Carbon\Carbon;



/**
 * Class CommandesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommandesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Commandes::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/commandes');
        CRUD::setEntityNameStrings('commandes', 'commandes');
        $this->crud->addClause('where','mailClient',backpack_user()->email);
        CRUD::denyAccess('delete');
        CRUD::denyAccess('update');
        CRUD::denyAccess('create');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.


        // var_dump(backpack_user() );

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
        CRUD::setValidation(CommandesRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

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


    public function getCommandesChartData()
    {
        $commandesParMois = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $mois = Carbon::now()->subMonths($i)->format('Y-m');
            $commandes = Commandes::whereRaw("DATE_FORMAT(dateCreation, '%Y-%m') = ?", [$mois])->count();

            $commandesParMois[] = $commandes;
            $labels[] = Carbon::now()->subMonths($i)->translatedFormat('M Y');
        }

        return response()->json([
            'labels'   => $labels,
            'commandes' => $commandesParMois,
        ]);
    }
   

    
}
