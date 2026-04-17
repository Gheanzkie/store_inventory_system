<?php

namespace App\Controllers;

use App\Models\SalesItemModel;
use App\Models\ProductModel;
use App\Models\SalesModel;
use App\Models\LogModel;

class Sales_Items extends BaseController
{
    protected $salesItemModel;
    protected $productModel;
    protected $salesModel;
    protected $logModel;

    public function __construct()
    {
        $this->salesItemModel = new SalesItemModel();
        $this->productModel   = new ProductModel();
        $this->salesModel     = new SalesModel();
        $this->logModel       = new LogModel();
    }

    public function index()
    {
        $userId = session()->get('id') ?? 12;
        $activeSale = $this->salesModel->where(['user_id' => $userId, 'status' => 'pending'])->first();
        
        $sale_id = $activeSale ? $activeSale['id'] : $this->salesModel->insert([
            'user_id' => $userId, 'total' => 0, 'date' => date('Y-m-d H:i:s'), 'status' => 'pending'
        ], true);

        $db = \Config\Database::connect();
        $category_id = $this->request->getGet('category');
        $products = $category_id ? $this->productModel->where('category_id', $category_id)->findAll() : $this->productModel->findAll();

        return view('sales_items/index', [
            'products'    => $products,
            'categories'  => $db->table('categories')->get()->getResultArray(),
            'activeSale'  => $sale_id,
            'salesItems'  => $this->getItems($sale_id),
            'total'       => $this->getTotal($sale_id),
            'selectedCategory' => $category_id
        ]);
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
        if (!$product || $product['stock'] < $quantity) {
            return redirect()->back()->with('msg', !$product ? 'Product not found' : 'Not enough stock');
        }

        $existing = $this->salesItemModel->where(['sale_id' => $sale_id, 'product_id' => $product_id])->first();

        if ($existing) {
            $newQty = $existing['quantity'] + $quantity;
            $this->salesItemModel->update($existing['id'], ['quantity' => $newQty, 'subtotal' => $product['price'] * $newQty]);
        } else {
            $this->salesItemModel->insert(['sale_id' => $sale_id, 'product_id' => $product_id, 'quantity' => $quantity, 'subtotal' => $product['price'] * $quantity, 'created_at' => date('Y-m-d H:i:s')]);
        }

        $this->productModel->update($product_id, ['stock' => $product['stock'] - $quantity]);
        
        // ✅ LOG ACTIVITY
        $this->logModel->addLog('Added to cart: ' . $product['name'] . ' x' . $quantity, 'CART');
        
        return redirect()->to('/sales_items?sale_id=' . $sale_id)->with('msg', 'Item added');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $quantity = (int)$this->request->getPost('quantity');

        if (!$id || $quantity < 1) return redirect()->back()->with('msg', 'Invalid data');

        $item = $this->salesItemModel->find($id);
        if (!$item) return redirect()->back()->with('msg', 'Item not found');

        $product = $this->productModel->find($item['product_id']);
        $qtyDiff = $quantity - $item['quantity'];

        if ($qtyDiff > 0 && $product['stock'] < $qtyDiff) return redirect()->back()->with('msg', 'Not enough stock');

        $this->salesItemModel->update($id, ['quantity' => $quantity, 'subtotal' => $product['price'] * $quantity]);
        $this->productModel->update($item['product_id'], ['stock' => $product['stock'] - $qtyDiff]);
        
        // ✅ LOG ACTIVITY
        $this->logModel->addLog('Updated cart quantity: ' . $product['name'] . ' to ' . $quantity, 'CART');

        return redirect()->back()->with('msg', 'Quantity updated');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $item = $this->salesItemModel->find($id);
        
        if ($item) {
            $product = $this->productModel->find($item['product_id']);
            if ($product) {
                $this->productModel->update($item['product_id'], ['stock' => $product['stock'] + $item['quantity']]);
                
                // ✅ LOG ACTIVITY
                $this->logModel->addLog('Removed from cart: ' . $product['name'], 'CART');
            }
            $this->salesItemModel->delete($id);
        }
        return redirect()->back()->with('msg', 'Item removed');
    }

    public function checkout()
    {
        $sale_id = $this->request->getPost('sale_id');
        $amount_received = (float)$this->request->getPost('amount_received');

        if (!$sale_id) return redirect()->back()->with('msg', 'No sale selected');

        $items = $this->getItems($sale_id);
        if (empty($items)) return redirect()->back()->with('msg', 'Cart is empty');

        $total = array_sum(array_column($items, 'subtotal'));
        if ($amount_received < $total) return redirect()->back()->with('msg', 'Insufficient payment');

        $this->salesModel->update($sale_id, [
            'total' => $total, 'status' => 'completed',
            'payment_method' => $this->request->getPost('payment_method') ?? 'cash',
            'amount_received' => $amount_received, 'change_amount' => $amount_received - $total
        ]);

        // ✅ LOG ACTIVITY
        $this->logModel->addLog('Completed sale #' . $sale_id . ' - Total: ₱' . number_format($total, 2), 'SALE');

        return redirect()->to('/sales_items/receipt_page/' . $sale_id);
    }

    public function newTransaction()
    {
        $userId = session()->get('id') ?? 12;
        $sale_id = $this->salesModel->insert(['user_id' => $userId, 'total' => 0, 'date' => date('Y-m-d H:i:s'), 'status' => 'pending'], true);
        
        // ✅ LOG ACTIVITY
        $this->logModel->addLog('Started new transaction #' . $sale_id, 'TRANSACTION');
        
        return redirect()->to('/sales_items?sale_id=' . $sale_id)->with('msg', 'New transaction started');
    }

    public function receipt_page($id = null)
    {
        if (!$id || !$sale = $this->salesModel->find($id)) {
            return redirect()->to('/sales_items')->with('msg', 'Receipt not found');
        }
        $items = $this->getItems($id);
        return view('sales/receipt_view', ['sale' => $sale, 'items' => $items, 'total' => array_sum(array_column($items, 'subtotal'))]);
    }

    public function receipt($id = null)
    {
        if (!$id) return $this->response->setJSON(['error' => 'Invalid ID']);
        $sale = $this->salesModel->find($id);
        if (!$sale) return $this->response->setJSON(['error' => 'Sale not found']);
        $items = $this->getItems($id);
        return view('sales/receipt_view', ['sale' => $sale, 'items' => $items, 'total' => array_sum(array_column($items, 'subtotal'))]);
    }

    private function getItems($sale_id)
    {
        return $this->salesItemModel
            ->select('sales_items.id, sales_items.quantity, sales_items.subtotal, product.name, product.price')
            ->join('product', 'product.id = sales_items.product_id')
            ->where('sales_items.sale_id', $sale_id)
            ->findAll();
    }
    
    private function getTotal($sale_id)
    {
        return $this->salesItemModel->selectSum('subtotal')->where('sale_id', $sale_id)->first()['subtotal'] ?? 0;
    }
}