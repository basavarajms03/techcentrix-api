<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Division extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $db = \Config\Database::connect();
        $queryBuilder = $db->table('division');
        $queryBuilder->select('division')->distinct(true);
        $data = $queryBuilder->get()->getResult('object');
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function getSubDivisions($division = null)
    {
        //
        if(!$division) {
            return $this->fail('Division is required');
        }
        $db = \Config\Database::connect();
        $queryBuilder = $db->table('division');
        $queryBuilder->select('subDivision')->where('division', $division)->distinct(true);
        $data = $queryBuilder->get()->getResult('object');
        if(empty($data)) {
            return $this->failNotFound('No sub division found');
        }
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function getSections($subDivision = null)
    {
        //
        if(!$subDivision) {
            return $this->fail('Sub Division is required');
        }
        $db = \Config\Database::connect();
        $queryBuilder = $db->table('division');
        $queryBuilder->select('section')->where('subDivision', $subDivision)->distinct(true);
        $data = $queryBuilder->get()->getResult('object');
        if(empty($data)) {
            return $this->failNotFound('No Sections Found');
        }
        return $this->respond($data);
    }
}
