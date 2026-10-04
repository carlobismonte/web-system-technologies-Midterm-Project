<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;

class Sales extends BaseController
{
    public function index()
{
    $db = \Config\Database::connect();

    $sales = $db->table('sales')
        ->select('
            sales.*,
            products.name AS product_name,
            customers.full_name AS customer_name,
            users.full_name AS staff_name
        ')
        ->join('products', 'products.id = sales.product_id')
        ->join('customers', 'customers.id = sales.customer_id', 'left')
        ->join('users', 'users.id = sales.sold_by')
        ->orderBy('sales.id', 'DESC')
        ->get()
        ->getResultArray();

    return view('sales/index', [
        'sales' => $sales
    ]);
}



    public function create()
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        $data = [
            'products'  => $productModel->findAll(),
            'customers' => $customerModel->findAll()
        ];

        return view('sales/create', $data);
    }

    public function store()
    {
        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        $productId = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id');
        $quantity = (int) $this->request->getPost('quantity');

        // Find selected product
        $product = $productModel->find($productId);

        if (!$product) {
            return redirect()->back()
                ->with('error', 'Product not found.');
        }

        // Quantity must be at least 1
        if ($quantity < 1) {
            return redirect()->back()
                ->with('error', 'Quantity must be at least 1.');
        }

        // Prevent selling more than available stock
        if ($quantity > $product['stock_quantity']) {
            return redirect()->back()
                ->with('error', 'Not enough stock available.');
        }

        // Calculate total price
        $totalPrice = $product['price'] * $quantity;

        // Record the sale
        $saleModel->insert([
            'product_id'  => $productId,
            'customer_id' => $customerId ?: null,
            'sold_by'     => session()->get('user_id'),
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        // Reduce product stock
        $newStock = $product['stock_quantity'] - $quantity;

        $productModel->update($productId, [
            'stock_quantity' => $newStock
        ]);

        return redirect()->to('/sales')
            ->with('success', 'Sale recorded successfully.');
    }
}