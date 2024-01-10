<?php

namespace App\Controllers;
use Framework\Database;

class HomeController
{
    private $db;
    public function __construct(){
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index(){
        $listings = $this->db->Query('SELECT * FROM listings LIMIT 6')->fetchAll();

        $view = 'home';
        $data = [
            'listings' => $listings
        ];

        loadView($view, $data);
    }
}