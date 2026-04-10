<?php
namespace App\Controllers;

use App\Models\SalesItemModel;
use App\Models\ProductModel;

class SalesItems extends BaseController
{
    protected $salesItemModel;
    protected $productModel;

    public function __construct()
    {
        $this->salesItemModel = new SalesItemModel();
        $this->productModel   = new ProductModel();
    }

    public function index()
    {
        $data = [
            'products'    => $this->productModel->findAll(),
            'salesItems'  => $this->salesItemModel->getSalesItems()
        ];
        return view('sales_items/index', $data);
    }

    public function save()
    {
        $productId = $this->request->getPost('product_id');
        $quantity  = (int) $this->request->getPost('quantity');

        $product = $this->productModel->find($productId);
        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Product not found']);
        }

        $this->salesItemModel->insert([
            'product_id' => $productId,
            'quantity'   => $quantity,
            'price'      => $product['price']
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        if ($this->salesItemModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setJSON(['status' => 'error']);
    }
}