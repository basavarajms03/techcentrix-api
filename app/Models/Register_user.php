<?php

namespace App\Models;

use CodeIgniter\Model;

class Register_user extends Model
{
    protected $table = 'register';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fname', 'lname', 'phoneNumber', 'password', 'division', 'subDivision', 'section'];
}
