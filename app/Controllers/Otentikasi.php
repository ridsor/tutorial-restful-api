<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\ModelOtentikasi;
use Exception;

class Otentikasi extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ModelOtentikasi();
    }

    public function index()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Silahkan masukan email',
                    'valid_email' => 'Silahkan masukan email yang valid',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukan password',
                ]
            ]
        ];
        $validation->setRules($aturan);
        if(!$validation->withRequest($this->request)->run())
        {
            return $this->fail($validation->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        try {
            $data = $this->model->getEmail($email);
        } catch(Exception $e) {
            return $this->fail($e->getMessage());
        }

        if($data['password'] !== md5($password))
        {
            return $this->fail('Password tidak sesuai');
        }

        
        helper('jwt'); 
        return $this->respond([
            'message' => 'Otentikasi berhasil dilakukan',
            'data' => $data,
            'access_token' => createJWT($email),
        ]);
    }
}
