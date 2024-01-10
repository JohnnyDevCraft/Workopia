<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
class ListingsController
{
    private $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index(){
        $listings = $this->db->Query('SELECT * FROM listings LIMIT 6')->fetchAll();


        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    public function create(){
        loadView('listings/create');
    }


    public function store() {
        $allowedFields = ['title', 'description', 'salary',
        'tags', 'company', 'address', 'city', 'state',
        'phone', 'email', 'requirements', 'benefits'];

        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
        $newListingData['user_id'] = 1;

        $newListingData = array_map('sanitizeData', $newListingData);

        $requiredFields = [
            'title', 'description', 'email', 'city', 'state'
        ];

        $errors = [];

        foreach ($requiredFields as $field) {
            $value = $newListingData[$field];
            if(empty($value) || !Validation::String($value)){
                $errors[$field] = ucfirst($field) . " is required.";
            }
        }

        if(!empty($errors)){
            //reload view with errors
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        } else {
            // TODO: Finish Logic
        }
    }

    public function show($params){
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


}