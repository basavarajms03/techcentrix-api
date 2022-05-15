<?php

namespace App\Controllers;

use App\Models\Register_user;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Register extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $model = new Register_user();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function getUser($id = null)
    {
        if (!$id) {
            return $this->fail('User id is required!');
        }
        //
        $model = new Register_user();
        $data = $model->find($id);
        if (empty($data)) {
            return $this->failNotFound('User not found');
        } else {
            return $this->respond($data);
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'phoneNumber' => 'required',
            'password' => 'required',
            'division' => 'required',
            'subDivision' => 'required',
            'section' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'phoneNumber' => $this->request->getVar('phoneNumber'),
                'password' => $this->request->getVar('password'),
                'division' => $this->request->getVar('division'),
                'subDivision' => $this->request->getVar('subDivision'),
                'section' => $this->request->getVar('section'),
            ];

            $model = new Register_user();
            $model->save($data);
            return $this->respondCreated($data);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function updateUser($id = null)
    {
        //
        
        //
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'phoneNumber' => 'required',
            'division' => 'required',
            'subDivision' => 'required',
            'section' => 'required',
        ];
        
        if (!$id) {
            return $this->fail('User id is required!');
        } else if(!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'phoneNumber' => $this->request->getVar('phoneNumber'),
                'division' => $this->request->getVar('division'),
                'subDivision' => $this->request->getVar('subDivision'),
                'section' => $this->request->getVar('section'),
            ];

            if($this->request->getVar('password')) {
                $data['password'] = $this->request->getVar('password');
            }

            $model = new Register_user();
            $exist = $model->find($id);
            if (empty($exist)) {
                return $this->failNotFound('User does not exist!');
            } else {
                $model->update($id, $data);
                return $this->respondUpdated($data);
            }
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function deleteuser($id = null)
    {
        //
        if (!$id) {
            return $this->fail('User id is required!');
        } else {
            $model = new Register_user();
            $data = $model->delete($id);
            return $this->respondDeleted($data);
        }
    }
}
