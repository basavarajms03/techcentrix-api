<?php

namespace App\Models;

use CodeIgniter\Model;

class BreakdownPointsModel extends Model
{
    protected $table = 'breakdown_points';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'date', 'RMUName', 'SINO',
        'namePlatePhoto', 'Before_work_photo', 'after_work_photo_progress', 'work_completes_photo', 'paint_job_done', 'sq_mtrs_painted',
        'SF6_gas_filled', 'gas_filled_in_kgs'
    ];
}
