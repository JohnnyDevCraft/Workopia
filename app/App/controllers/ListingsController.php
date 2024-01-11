<?php

namespace App\Controllers;

use Exception;
use Framework\Validation;

class ListingsController extends BaseController
{


    public function __construct()
    {
        parent::__construct();

        $this->allowedFields = ['title', 'description', 'salary',
        'tags', 'company', 'address', 'city', 'state',
        'phone', 'email', 'requirements', 'benefits'];

        $this->requiredFields = [
        'title', 'description', 'email', 'city', 'state',
        'salary'
    ];
    }


    /**
     * Show all listings in the system.
     *
     * @return void
     * @throws Exception
     */
    public function index(){
        $listings = $this->db->Query('SELECT * FROM listings LIMIT 6')->fetchAll();


        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    /**
     * Shows page to create a new listing
     *
     * @return void
     */
    public function create(){
        loadView('listings/create');
    }


    /**
     * Stores a new listing in the database
     *
     * @return void
     * @throws Exception
     */
    public function store() {

        $newListingData = $this->GetListingDataFromPost();

        $errors = $this->ValidateData($newListingData);

        if(!empty($errors)){
            //reload view with errors
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        } else {

            $this->db->Insert($newListingData, "listings");

            redirect('/listings');
        }
    }

    /**
     * Shows a single listing
     *
     * @param array $params -Stores the id of the listing to show
     * @return void
     * @throws Exception
     */
    public function show(array $params){
        $id = $params['id'] ?? '' ;

        $params = [
            'id' => $id
        ];

        $listing = $this->db->Query('SELECT * FROM listings WHERE id = :id' , $params )->fetch();

        if(!$listing){
            ErrorController::NotFound("Listing #{$id}");
        }

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }

    /**
     * deletes a listing from the database.
     *
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function destroy(array $params){
        $id = $params['id'];

        if($this->EnsureRecordExists($id)) {

            $query = "DELETE FROM listings WHERE id=:id";
            $this->db->Query($query, $params);

            $_SESSION['success_message'] = "listing deleted";

            redirect('/listings');
        }
    }

    /**
     * Edits a single listing
     *
     * @param array $params -Stores the id of the listing to show
     * @return void
     * @throws Exception
     */
    public function edit(array $params){
        $id = $params['id'] ?? '' ;

        $params = [
            'id' => $id
        ];

        $listing = $this->db->Query('SELECT * FROM listings WHERE id = :id' , $params )->fetch();

        if(!$listing){
            ErrorController::NotFound("Listing #{$id}");
            return;
        }

        loadView('listings/edit', [
            'listing' => $listing
        ]);
    }


    /**
     * Updates the record in the database
     *
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function update(array $params){
        $id = $params['id'] ?? '' ;

        if($this->EnsureRecordExists($id)){
            $updatedValues = $this->GetListingDataFromPost();
            $updatedValues['id'] = $id;

            $errors = $this->ValidateData($updatedValues);

            if(!empty($errors)){
                loadView('listings/edit', [
                    'listing' => (object)$updatedValues,
                    'errors' => $errors
                ]);
                exit;
            } else {
                $updateFields = [];

                foreach (array_keys($updatedValues) as $field){
                    $updateFields[] = "{$field} = :{$field}";
                }

                $updateFields = implode(', ', $updateFields);

                $this->db->Query("UPDATE listings SET {$updateFields} WHERE id=:id", $updatedValues);

                $_SESSION['success_message'] = 'Listing Updated';

                redirect('/listings/' . $id);
            }
        }
    }





    /**
     * Validates that the record selected exists in database.
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    private function EnsureRecordExists(int $id): bool{
        $params['id'] = $id;
        //Verify Exists
        $query = "SELECT * FROM listings WHERE id=:id";
        $data = $this->db->Query($query, $params)->fetch();

        if(!isset($data)){
            ErrorController::NotFound("listing with id [{$id}]");
            return false;
        }

        return true;
    }

    protected function GetListingDataFromPost(array $additiveData = []): array
    {
        $additiveData['user_id'] = 1;
        return parent::GetListingDataFromPost($additiveData);
    }


}