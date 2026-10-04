<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();

        $data['customers'] = $model->findAll();

        return view('customers/index', $data);
    }
     public function create()
    {
        return view('customers/create');
    }

    public function store()
    {
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ];

        $model = new CustomerModel();

        if (! $this->validateData($data, $model->getValidationRules())) {
            return view('customers/create', [
                'errors' => $this->validator->getErrors(),
                'data'   => $data
            ]);
        }

        $model->insert($data);

        return redirect()->to('/customers');
    }
    public function edit($id)
{
    $model = new CustomerModel();

    $data['customer'] = $model->find($id);

    return view('customers/edit', $data);
}

    public function update($id)
    {
       $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ];

        $model = new CustomerModel();

        if (! $this->validateData($data, $model->getValidationRules())) {
            return view('customers/edit', [
                'customer' => array_merge(
                $model->find($id),
                $data
            ),
            'errors' => $this->validator->getErrors(),
            ]);    
         }

        $model->update($id, $data);

        return redirect()->to('/customers');
    }
}