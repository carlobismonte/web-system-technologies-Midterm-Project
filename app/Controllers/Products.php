<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $model = new ProductModel();

        $data['products'] = $model->findAll();

        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $model = new ProductModel();

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && ! $image->hasMoved()) {

            if (! $this->validate([
                'image' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]'
            ])) {
                 return redirect()->back()
                    ->withInput()
                    ->with('error', $this->validator->listErrors());
}

            $uploadPath = FCPATH . 'uploads/products/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $image->getRandomName();
            $image->move($uploadPath, $newName);

            $data['image'] = $newName;
        }

        $model->insert($data);

        return redirect()->to('/products')
            ->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $model = new ProductModel();

        $product = $model->find($id);

        if (! $product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        return view('products/edit', [
            'product' => $product
        ]);
    }

    public function update($id)
{
    $model = new ProductModel();

    $product = $model->find($id);

    if (! $product) {
        return redirect()->to('/products')
            ->with('error', 'Product not found.');
    }

    $data = [
        'name'           => $this->request->getPost('name'),
        'price'          => $this->request->getPost('price'),
        'stock_quantity' => $this->request->getPost('stock_quantity')
    ];

    $rules = [
        'name'           => 'required|min_length[2]|max_length[100]',
        'price'          => 'required|decimal',
        'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
    ];

    if (! $this->validateData($data, $rules)) {
        return redirect()->back()
            ->withInput()
            ->with('error', $this->validator->listErrors());
    }

    $image = $this->request->getFile('image');

    if ($image && $image->isValid() && ! $image->hasMoved()) {

        if (! $this->validate([
            'image' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]'
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        $uploadPath = FCPATH . 'uploads/products/';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $newName = $image->getRandomName();
        $image->move($uploadPath, $newName);

        if (! empty($product['image'])) {
            $oldImage = $uploadPath . $product['image'];

            if (is_file($oldImage)) {
                unlink($oldImage);
            }
        }

        $data['image'] = $newName;
    }

    $model->update($id, $data);

    return redirect()->to('/products')
        ->with('success', 'Product updated successfully.');
}

    public function delete($id)
    {
        $model = new ProductModel();

        $product = $model->find($id);

        if (! $product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        // Do not delete a product that already has sales
        $db = \Config\Database::connect();

        $saleExists = $db->table('sales')
            ->where('product_id', $id)
            ->countAllResults();

        if ($saleExists > 0) {
            return redirect()->to('/products')
                ->with('error', 'This product cannot be deleted because it has sales history.');
        }

        if (! empty($product['image'])) {
            $imagePath = FCPATH . 'uploads/products/' . $product['image'];

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $model->delete($id);

        return redirect()->to('/products')
            ->with('success', 'Product deleted successfully.');
    }
}