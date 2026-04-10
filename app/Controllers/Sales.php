<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SalesModel;

class Sales extends Controller
{
    protected $salesModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
    }

    // Show all sales
    public function index()
    {
        $data = [
            'allSales' => $this->salesModel->orderBy('date', 'DESC')->findAll(),
            'pageName' => 'Sales'
        ];

        return view('sales/index', $data);
    }

    // Optional: Show recent sales for dashboard
    public function recentSales($limit = 5)
    {
        return $this->salesModel
            ->orderBy('date', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}