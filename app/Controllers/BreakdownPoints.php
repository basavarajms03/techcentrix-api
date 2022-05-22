<?php

namespace App\Controllers;

use App\Models\BreakdownPointsModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use phpDocumentor\Reflection\DocBlock\Description;

class BreakdownPoints extends ResourceController
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
        echo view('breakdownpoints');
    }

    public function getAllBreakDownPoints()
    {
        $model = new BreakdownPointsModel();
        $data = $model->findAll();
        return $this->respond([
            'status' => 200,
            'result' => $data,
            'message' => 'Break down point created successfully!',
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function createBreakDownPoints()
    {

        helper(['form', 'url']);

        $filesInfo = [];
        $rules = [
            'SINO' => 'required',
            'RMUName' => 'required',
            'date' => 'required',
            'namePlatePhoto' => 'required',
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                'max_size[file,1024]',
            ],
            'paint_job_done' => 'required',
            'SF6_gas_filled' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            if ($this->request->getFileMultiple('file')) {
                foreach ($this->request->getFileMultiple('file') as $img) {
                    $img->move(ROOTPATH . 'public/uploads');
                    array_push($filesInfo, 'public/uploads/' . $img->getName());
                }
            }

            $data =  [
                'SINO' => $this->request->getVar('SINO'),
                'RMUName' => $this->request->getVar('RMUName'),
                'date' => $this->request->getVar('date'),
                'namePlatePhoto' => $this->request->getVar('namePlatePhoto'),
                'Before_work_photo' =>  implode(",", $filesInfo),
                'paint_job_done' => $this->request->getVar('paint_job_done'),
                'sq_mtrs_painted' => $this->request->getVar('sq_mtrs_painted'),
                'SF6_gas_filled' => $this->request->getVar('SF6_gas_filled'),
                'gas_filled_in_kgs' => $this->request->getVar('gas_filled_in_kgs')
            ];
            $model = new BreakdownPointsModel();
            $model->save($data);
            $data['Before_work_photo'] = explode(',', $data['Before_work_photo']);
            return $this->respondCreated([
                'status' => 200,
                'result' => $data,
                'message' => 'Break down point created successfully!'
            ]);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function getBreakDownPoint($serialNumber = null)
    {
        //
        if (!$serialNumber) {
            return $this->fail('Serial number is required!');
        }

        $DB = \Config\Database::connect();
        $queryBuilder = $DB->table('breakdown_points');
        $result = $queryBuilder->where('SINO', $serialNumber)->get()->getResult();
        if (count($result) > 0) {
            $result[0]->Before_work_photo = explode(',', $result[0]->Before_work_photo);
            return $this->respond([
                'status' => 200,
                'result' => $result,
                'message' => 'Break down point fetched successfully!',
            ]);
        } else {
            return $this->respond([
                'status' => 201,
                'result' => $result,
                'message' => 'No breakdown pont found for the serial number entered!',
            ]);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function updatebreakdownpoints($serialNumber = null)
    {

        $DB = \Config\Database::connect();
        $queryBuilder = $DB->table('breakdown_points');

        $after_work_photo_progress = [];
        $work_completes_photo = [];

        if (!$serialNumber) {
            return $this->fail('Serial number is required!');
        }

        if ($this->request->getFileMultiple('after_work_photo_progress')) {
            foreach ($this->request->getFileMultiple('after_work_photo_progress') as $img) {
                $img->move(ROOTPATH . 'public/uploads');
                array_push($after_work_photo_progress, 'public/uploads/' . $img->getName());
            }
            $queryBuilder->set('after_work_photo_progress', implode(",", $after_work_photo_progress));
            $queryBuilder->where('SINO', $serialNumber);
            $queryBuilder->update();
        }

        if ($this->request->getFileMultiple('work_completes_photo')) {
            foreach ($this->request->getFileMultiple('work_completes_photo') as $imges) {
                $imges->move(ROOTPATH . 'public/uploads');
                array_push($work_completes_photo, 'public/uploads/' . $imges->getName());
            }
            $queryBuilder->set('work_completes_photo', implode(",", $work_completes_photo));
            $queryBuilder->where('SINO', $serialNumber);
            $queryBuilder->update();
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Break down point updated successfully!',
        ]);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
