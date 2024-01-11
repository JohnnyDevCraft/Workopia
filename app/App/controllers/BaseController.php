<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

abstract class BaseController
{
    protected $db;
    protected $allowedFields = [];
    protected $requiredFields = [];

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Validates data in array for entry / update
     *
     * @param array $data
     * @return array
     */
    protected function ValidateData(array $data): array
    {
        $errors = [];

        foreach ($this->requiredFields as $field) {
            $value = $data[$field];
            if(empty($value) || !Validation::String($value)){
                $errors[$field] = ucfirst($field) . " is required.";
            }
        }

        return $errors;
    }

    /**
     * Get data from post,and cleans it for entry
     *
     * @param array $additiveData
     * @return array
     */
    protected function GetListingDataFromPost(array $additiveData = []): array
    {
        $newListingData = array_intersect_key($_POST, array_flip($this->allowedFields));

        foreach ($additiveData as $field => $value){
            $newListingData[$field] = $value;
        }

        return array_map('sanitizeData', $newListingData);
    }
}