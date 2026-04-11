<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\SalesItemModel;

class Sales extends BaseController
{
    protected $salesModel;
    protected $salesItemModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->salesItemModel = new SalesItemModel();
    }

    // CREATE NEW SALE
    public function create()
    {
        $this->salesModel->insert([
            'user_id' => 1,
            'total'   => 0,
            'date'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('msg','New sale created');
    }

    // CHECKOUT
    public function checkout()
    {
        $sale_id = $this->request->getPost('sale_id');

        if(!$sale_id){
            return redirect()->back()->with('msg','Select a sale first');
        }

        $items = $this->salesItemModel->getSalesItems($sale_id);

        if(empty($items)){
            return redirect()->back()->with('msg','No items to checkout');
        }

        $total = 0;
        foreach($items as $item){
            $total += $item['subtotal'];
        }

        $this->salesModel->update($sale_id, [
            'total' => $total
        ]);

        return redirect()->to('/sales_items?sale_id='.$sale_id)
            ->with('msg','Checkout completed');
    }

    public function index()
    {
        $data = [
            'allSales' => $this->salesModel->orderBy('id','DESC')->findAll()
        ];

        return view('sales/index',$data);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $this->salesModel->delete($id);

        return redirect()->back()->with('msg', 'Sale deleted');
    }
}