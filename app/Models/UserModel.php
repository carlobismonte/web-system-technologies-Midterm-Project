<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'full_name',
        'email',
        'avatar',
        'created_at'
    ];
    protected $validationRules = [
        'username'  => 'required|min_length[3]|max_length[30]|is_unique[users.username]',
        'full_name' => 'required|min_length[3]|max_length[100]',
        'email'     => 'required|valid_email|max_length[254]|is_unique[users.email]',
    ];
}