<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';


    protected $allowedFields = [
        'full_name',
        'email',
        'phone',
        'created_at'
    ];

    protected $validationRules = [
        'full_name' => 'required|min_length[3]|max_length[100]',
        'email'     => 'required|valid_email|max_length[254]|is_unique[customers.email]',
        'phone'     => 'required|numeric|min_length[10]|max_length[15]',
    ];
}