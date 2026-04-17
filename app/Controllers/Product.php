<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogModel;
use App\Models\ProductModel;

class Product extends Controller
{
    protected $productModel;
    protected $logModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->logModel = new LogModel();
    }

    public function index()
    {
        $data = [
            'product' => $this->productModel->findAll(),
            'pageName' => 'Product'  
        ];
        return view('product/index', $data);
    }
 
    public function save()
    {
        $category_id = $this->request->getPost('category_id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');

        $data = [
            'category_id' => $category_id,
            'name'        => $name,
            'price'       => $price,
            'stock'       => $stock
        ];

        if ($this->productModel->insert($data)) {
            // ✅ LOG ACTIVITY
            $this->logModel->addLog('Added product: ' . $name, 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save Product']);
        }
    }

    public function update()
    {
        $userId = $this->request->getPost('id');
        $category_id = $this->request->getPost('category_id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');

        $userData = [
            'category_id' => $category_id,
            'name'        => $name,
            'price'       => $price,
            'stock'       => $stock
        ];

        $updated = $this->productModel->update($userId, $userData);

        if ($updated) {
            // ✅ LOG ACTIVITY
            $this->logModel->addLog('Updated product: ' . $name, 'UPDATE');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating product.'
            ]);
        }
    }

    public function edit($id)
    {
        $user = $this->productModel->find($id);

        if ($user) {
            return $this->response->setJSON(['data' => $user]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Product not found']);
        }
    }

    public function delete($id)
    {
        $user = $this->productModel->find($id);
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Product not found.']);
        }

        $deleted = $this->productModel->delete($id);

        if ($deleted) {
            // ✅ LOG ACTIVITY
            $this->logModel->addLog('Deleted product: ' . $user['name'], 'DELETE');
            return $this->response->setJSON(['success' => true, 'message' => 'Product deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete Product.']);
        }
    }

    public function fetchRecords()
    {
        $request = service('request');
        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;
        $searchValue = $request->getPost('search')['value'] ?? '';

        $totalRecords = $this->productModel->countAll();
        $result = $this->getRecords($start, $length, $searchValue);

        $data = [];
        $counter = $start + 1;
        foreach ($result['data'] as $row) {
            $row['row_number'] = $counter++;
            $data[] = $row;
        }

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $result['filtered'],
            'data' => $data,
        ]);
    }

    private function getRecords($start, $length, $searchValue)
    {
        $builder = $this->productModel->builder();
        $builder->select('product.*, categories.category_name');
        $builder->join('categories', 'categories.id = product.category_id', 'left');
        
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('product.name', $searchValue)
                ->orLike('product.price', $searchValue)
                ->orLike('categories.category_name', $searchValue)
                ->groupEnd();
        }
        
        $filtered = $builder->countAllResults(false);
        $builder->orderBy('product.id', 'DESC');
        $data = $builder->get($length, $start)->getResultArray();
        
        return ['data' => $data, 'filtered' => $filtered];
    }
}