<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Framework\Session;
use Framework\Validation;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->allowedFields = [
            'name', 'email', 'city', 'state', 'password', 'password_confirmation'
        ];

        $this->requiredFields = [
            'name', 'email', 'password', 'password_confirmation'
        ];

        parent::__construct();
    }


    /**
     * Loads the login view
     *
     * @return void
     */
    public function login() {
        loadView('auth/login');
    }

    /**
     * Loads the registration view
     *
     * @return void
     */
    public function register() {
        loadView('auth/register');
    }

    public function attemptLogin(){
        $errors = [];

        $user = $this->db->Query("SELECT * FROM users WHERE email = :email", [
            'email' => $_POST['email']
        ])->fetch();

        if(!$user) {
            $errors['login'] = 'Invalid Credentials, Please try again';
            loadView('/auth/login', [
                'login' => ['email' => $_POST['email']],
                'errors' => $errors
            ]);
        }

        if(password_verify($_POST['password'], $user->password)){
            $_SESSION['success_message'] = 'Login Successful';
            redirect('/');
            exit;
        }

        $errors['login'] = 'Invalid Credentials, Please try again';
        loadView('/auth/login', [
            'login' => ['email' => $_POST['email']],
            'errors' => $errors
        ]);
    }


    /**
     * Save new user to database
     * @return void
     */
    public function store() {
        $newUser = $this->GetListingDataFromPost();
        $errors = $this->ValidateData($newUser);

        if(!empty($errors)){
            loadView('auth/register', [
                'registration' => (object)$newUser,
                'errors' => $errors
            ]);
        } else {
            unset($newUser['password_confirmation']);
            $newUser['password'] = password_hash($newUser['password'], PASSWORD_DEFAULT);
            $this->db->Insert($newUser, 'users');

            $userId = $this->db->Connection->lastInsertId();

            Session::Set('user', (object)[
                'id'=> $userId,
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'city' => $newUser['city'],
                'state' => $newUser['state']
            ]);

            redirect('/');
        }
    }



    protected function ValidateData(array $data): array
    {
        $errors = parent::ValidateData($data);

        if(!Validation::Email($data['email'])){
            $errors['email'] = 'Email must be a valid email';
        }

        if(!Validation::String($data['password'], 8 , 255)){
            $errors['password'] = "Passwords must be at least 8 characters long";
        }

        if(!Validation::Match($data['password'], $data['password_confirmation'])){
            $errors['password'] = 'Passwords must match';
        }

        //Validate user is not already in the Database
        $existing = $this->db->Query("SELECT * FROM users WHERE email = :email", [
            'email' => $data['email']
        ])->fetch();


        if($existing){
            $errors['user'] = "User already exists in database!  Please try to login!";
        }

        return $errors;
    }
}