<?php

namespace App\Controllers;

use App\Models\SalesItemModel;
use App\Models\ProductModel;
use App\Models\SalesModel;

class Sales_Items extends BaseController
{
    protected $salesItemModel;
    protected $productModel;
    protected $salesModel;

    public function __construct()
    {
        $this->salesItemModel = new SalesItemModel();
        $this->productModel   = new ProductModel();
        $this->salesModel     = new SalesModel();
    }

    
    
    
    public function index()
    {
        $sale_id = $this->request->getGet('sale_id');

        $data = [
            'products'   => $this->productModel->findAll(),
            'salesList'  => $this->salesModel->where('status', 'pending')->orderBy('id', 'DESC')->findAll(),
            'activeSale' => $sale_id,
            'salesItems' => $sale_id ? $this->getItems($sale_id) : [],
            'total'      => $sale_id ? $this->getTotal($sale_id) : 0
        ];

        return view('sales_items/index', $data);
    }

    
    
    
    public function create()
    {
        $userId = session()->get('id') ?? 12;
        
        $this->salesModel->insert([
            'user_id' => $userId,
            'total'   => 0.00,
            'date'    => date('Y-m-d H:i:s'),
            'status'  => 'pending'
        ]);
        
        $saleId = $this->salesModel->getInsertID();
        
        return redirect()->to('/sales_items?sale_id=' . $saleId)
            ->with('msg', 'New transaction started');
    }

    
    
    
    public function save()
    {
        $sale_id = $this->request->getPost('sale_id');
        $product_id = $this->request->getPost('product_id');
        $quantity = (int)$this->request->getPost('quantity');

        if (!$sale_id || !$product_id || $quantity < 1) {
            return redirect()->back()->with('msg', 'Invalid data');
        }

        $product = $this->productModel->find($product_id);
        
        if (!$product) {
            return redirect()->back()->with('msg', 'Product not found');
        }

        if ($product['stock'] < $quantity) {
            return redirect()->back()->with('msg', 'Not enough stock');
        }

        $existing = $this->salesItemModel
            ->where('sale_id', $sale_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existing) {
            $newQty = $existing['quantity'] + $quantity;
            $this->salesItemModel->update($existing['id'], [
                'quantity' => $newQty,
                'subtotal' => $product['price'] * $newQty
            ]);
        } else {
            $this->salesItemModel->insert([
                'sale_id' => $sale_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'subtotal' => $product['price'] * $quantity,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        $this->productModel->update($product_id, [
            'stock' => $product['stock'] - $quantity
        ]);

        return redirect()->to('/sales_items?sale_id=' . $sale_id)
            ->with('msg', 'Item added');
    }

    
    
    
    public function update()
    {
        $id = $this->request->getPost('id');
        $quantity = (int)$this->request->getPost('quantity');

        if (!$id || $quantity < 1) {
            return redirect()->back()->with('msg', 'Invalid data');
        }

        $item = $this->salesItemModel->find($id);
        if (!$item) {
            return redirect()->back()->with('msg', 'Item not found');
        }

        $product = $this->productModel->find($item['product_id']);
        $qtyDiff = $quantity - $item['quantity'];

        if ($qtyDiff > 0 && $product['stock'] < $qtyDiff) {
            return redirect()->back()->with('msg', 'Not enough stock');
        }

        $this->salesItemModel->update($id, [
            'quantity' => $quantity,
            'subtotal' => $product['price'] * $quantity
        ]);

        $this->productModel->update($item['product_id'], [
            'stock' => $product['stock'] - $qtyDiff
        ]);

        return redirect()->back()->with('msg', 'Quantity updated');
    }

    
    
    
    public function delete()
    {
        $id = $this->request->getPost('id');
        
        $item = $this->salesItemModel->find($id);
        
        if ($item) {
            $product = $this->productModel->find($item['product_id']);
            if ($product) {
                $this->productModel->update($item['product_id'], [
                    'stock' => $product['stock'] + $item['quantity']
                ]);
            }
            $this->salesItemModel->delete($id);
        }

        return redirect()->back()->with('msg', 'Item removed');
    }

    
    
    
 
            public function checkout()
            {
                $sale_id = $this->request->getPost('sale_id');
                $payment_method = $this->request->getPost('payment_method') ?? 'cash';
                $amount_received = (float) $this->request->getPost('amount_received');

                if (!$sale_id) {
                    return redirect()->back()->with('msg', 'Select a sale first');
                }

                $items = $this->getItems($sale_id);
                
                if (empty($items)) {
                    return redirect()->back()->with('msg', 'No items to checkout');
                }

                $total = 0;
                foreach ($items as $item) {
                    $total += $item['subtotal'];
                }

                if ($amount_received < $total) {
                    return redirect()->back()->with('msg', 'Insufficient payment amount');
                }

                $change = $amount_received - $total;

                
                $this->salesModel->update($sale_id, [
                    'total' => $total,
                    'status' => 'completed',
                    'payment_method' => $payment_method,
                    'amount_received' => $amount_received,
                    'change_amount' => $change
                ]);

                
                $userId = session()->get('id') ?? 12;
                $this->salesModel->insert([
                    'user_id' => $userId,
                    'total'   => 0,
                    'date'    => date('Y-m-d H:i:s'),
                    'status'  => 'pending'
                ]);

                
                return redirect()->to('/sales_items/receipt_page/' . $sale_id);
            }

    
    
    
        public function receipt($id = null)
        {
            if (!$id) {
                return $this->response->setJSON(['error' => 'Invalid ID']);
            }

            $sale = $this->salesModel->find($id);
            
            if (!$sale) {
                return $this->response->setJSON(['error' => 'Sale not found']);
            }

            $items = $this->getItems($id);
            
            $total = 0;
            foreach ($items as $item) {
                $total += $item['subtotal'];
            }

            $data = [
                'sale' => $sale,
                'items' => $items,
                'total' => $total
            ];

            return view('sales_items/receipt_table', $data);
        }

    
    
    
    private function getItems($sale_id)
    {
        $db = \Config\Database::connect();
        return $db->table('sales_items si')
            ->select('si.id, si.quantity, si.subtotal, p.name, p.price')
            ->join('product p', 'p.id = si.product_id')
            ->where('si.sale_id', $sale_id)
            ->get()
            ->getResultArray();
    }
    
    private function getTotal($sale_id)
    {
        $db = \Config\Database::connect();
        $result = $db->table('sales_items')
            ->selectSum('subtotal')
            ->where('sale_id', $sale_id)
            ->get()
            ->getRow();
            
        return $result->subtotal ?? 0;
    }

    
public function receipt_page($id = null)
{
    if (!$id) {
        return redirect()->to('/sales_items')->with('msg', 'Invalid receipt');
    }

    $sale = $this->salesModel->find($id);
    
    if (!$sale) {
        return redirect()->to('/sales_items')->with('msg', 'Receipt not found');
    }

    $items = $this->getItems($id);
    
    $total = 0;
    foreach ($items as $item) {
        $total += $item['subtotal'];
    }

    $data = [
        'sale' => $sale,
        'items' => $items,
        'total' => $total
    ];

    return view('sales/receipt_view', $data);
}
}