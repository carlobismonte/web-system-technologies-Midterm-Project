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
        $model = new UserModel();

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            
        ];

        if (! $this->validateData($data, $model->getValidationRules())) {
            return view('users/create', [
                'errors' => $this->validator->getErrors(),
                'data'   => $data
            ]);
        }

        // Get uploaded avatar
        $avatar = $this->request->getFile('avatar');

        // Only process if a file was selected
        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {

            $avatarRules = [
                'avatar' => [
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpeg,image/png]',
                    'max_size[avatar,2048]',
                ],
            ];

            if (! $this->validateData([], $avatarRules)) {
                return view('users/create', [
                    'errors' => $this->validator->getErrors(),
                    'data'   => $data
                ]);
            }

            $uploadPath = FCPATH . 'uploads/avatars/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $newName = $avatar->getRandomName();

            $avatar->move($uploadPath, $newName);

            service('image')
                ->withFile($uploadPath . $newName)
                ->fit(150, 150, 'center')
                ->save($uploadPath . $newName);

            $data['avatar'] = $newName;
        }

        $model->insert($data);

        return redirect()->to('/users')
            ->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        $model = new UserModel();

        $user = $model->find($id);

        if (! $user) {
            return redirect()->to('/users')
                ->with('error', 'User not found.');
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $model = new UserModel();

        $user = $model->find($id);

        if (! $user) {
            return redirect()->to('/users')
                ->with('error', 'User not found.');
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

        if (! $this->validateData($data, $rules)) {
            return view('users/edit', [
                'errors' => $this->validator->getErrors(),
                'user'   => array_merge($user, $data)
            ]);
        }

        // Optional password change
        $password = $this->request->getPost('password');

        if (! empty($password)) {
            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        // Get uploaded avatar
        $avatar = $this->request->getFile('avatar');

        // Only process if the user selected a new file
        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {

            $avatarRules = [
                'avatar' => [
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpeg,image/png]',
                    'max_size[avatar,2048]',
                ],
            ];

            if (! $this->validateData([], $avatarRules)) {
                return view('users/edit', [
                    'errors' => $this->validator->getErrors(),
                    'user'   => array_merge($user, $data)
                ]);
            }

            $uploadPath = FCPATH . 'uploads/avatars/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $newName = $avatar->getRandomName();

            $avatar->move($uploadPath, $newName);

            service('image')
                ->withFile($uploadPath . $newName)
                ->fit(150, 150, 'center')
                ->save($uploadPath . $newName);

            // Delete old avatar
            if (! empty($user['avatar'])) {
                $oldAvatar = $uploadPath . $user['avatar'];

                if (is_file($oldAvatar)) {
                    unlink($oldAvatar);
                }
            }

            // Save only the filename
            $data['avatar'] = $newName;
        }

        $model->skipValidation();

        $model->update($id, $data);

        return redirect()->to('/users')
            ->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $model = new UserModel();

        $user = $model->find($id);

        if (! $user) {
            return redirect()->to('/users')
                ->with('error', 'User not found.');
        }

        // Prevent deleting the currently logged-in user
        if ((int) session()->get('user_id') === (int) $id) {
            return redirect()->to('/users')
                ->with(
                    'error',
                    'You cannot delete the account you are currently using.'
                );
        }

        // Prevent deleting a user who has sales
        $db = \Config\Database::connect();

        $hasSales = $db->table('sales')
            ->where('sold_by', $id)
            ->countAllResults();

        if ($hasSales > 0) {
            return redirect()->to('/users')
                ->with(
                    'error',
                    'This user cannot be deleted because they have sales history.'
                );
        }

        // Delete avatar file
        if (! empty($user['avatar'])) {
            $avatarPath = FCPATH . 'uploads/avatars/' . $user['avatar'];

            if (is_file($avatarPath)) {
                unlink($avatarPath);
            }
        }

        $model->delete($id);

        return redirect()->to('/users')
            ->with('success', 'User deleted successfully.');
    }
}