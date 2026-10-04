<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $data['users'] = $model->findAll();

        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
        ];

        $model = new UserModel();

        if (! $this->validateData($data, $model->getValidationRules())) {
            return view('users/create', [
                'errors' => $this->validator->getErrors(),
                'data'   => $data
            ]);
        }

        $model->insert($data);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();

        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/users');
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }
    public function update($id)
{
    $model = new UserModel();

    $user = $model->find($id);

    if (!$user) {
        return redirect()->to('/users');
    }

    $data = [
        'username'  => $this->request->getPost('username'),
        'full_name' => $this->request->getPost('full_name'),
        'email'     => $this->request->getPost('email'),
    ];

    $rules = $model->getValidationRules();

    $rules['username'] =
        'required|min_length[3]|max_length[30]|is_unique[users.username,id,' . $id . ']';

    $rules['email'] =
        'required|valid_email|max_length[254]|is_unique[users.email,id,' . $id . ']';

    if (!$this->validateData($data, $rules)) {
        return view('users/edit', [
            'errors' => $this->validator->getErrors(),
            'user'   => array_merge($user, $data)
        ]);
    }

    // Get uploaded avatar
    $avatar = $this->request->getFile('avatar');

    // Get uploaded avatar
$avatar = $this->request->getFile('avatar');

// Only process if the user selected a file
if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {

    // Validate the uploaded avatar
    $avatarRules = [
        'avatar' => [
            'uploaded[avatar]',
            'is_image[avatar]',
            'mime_in[avatar,image/jpeg,image/png]',
            'max_size[avatar,2048]',
        ],
    ];

    if (!$this->validateData([], $avatarRules)) {
        return view('users/edit', [
            'errors' => $this->validator->getErrors(),
            'user'   => array_merge($user, $data)
        ]);
    }

    $uploadPath = FCPATH . 'uploads/avatars/';

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $newName = $avatar->getRandomName();

    $avatar->move($uploadPath, $newName);

    service('image')
        ->withFile($uploadPath . $newName)
        ->fit(150, 150, 'center')
        ->save($uploadPath . $newName);

    // Save ONLY the filename
    $data['avatar'] = $newName;
}
    

$model->skipValidation();

$result = $model->update($id, $data);

return redirect()->to('/users');
}

 
}