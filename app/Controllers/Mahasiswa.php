<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MahasiswaModel;
use CodeIgniter\API\ResponseTrait;

class Mahasiswa extends ResourceController
{
    use ResponseTrait;

    function __construct() {
        $this->model = new MahasiswaModel;
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        // menampilkan semua data mahasiswa
        return $this->respond([
            'status' => 200,
            'error' => null,
            'data' => $this->model->orderBy('nama','asc')->findAll(),
        ],200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        // menampilkan data mahasiswa berdasarkan id
        if($this->model->find($id))
        {
            return $this->respond([
            'status' => 200,
            'error' => null,
            'data' => $this->model->find($id),
            ],200);
        } else {
            return $this->failNotFound('Data not found!');
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // menambah data mahasiswa
        $data = [
            'nrp' => $this->request->getVar('nrp'),
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'jurusan' => $this->request->getVar('jurusan'),
        ];

        if($this->model->save($data))
        {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data mahasiswa berhasil disimpan.',
                ],
            ],200);
        } else {
            return $this->fail($this->model->errors());
        }

    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        // mengedit data mahasiswa berdasarkan id
        $dataOld = $this->model->find($id);

        if(!$dataOld)
        {
            return $this->failNotFound('Data not found!');
        }

        $data = [
            'nrp' => $this->request->getVar('nrp'),
            'nama' => $this->request->getVar('nama'),
            'jurusan' => $this->request->getVar('jurusan'),
        ];

        if($this->model->update($id, $data))
        {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data mahasiswa berhasil diubah',
                ],
            ],200);
        } else {
            return $this->fail($this->model->errors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        // menghapus data mahasiswa berdasarkan id
        if($this->model->find($id))
        {
            $this->model->delete($id);
            
            return $this->respondDeleted([
                'status' => 200,
                'error' => null,
                'message' => 'Data mahasiswa berhasil dihapus.'
            ],200);
        } else {
            return $this->failNotFound('Data not found!');
        }
    }
}
