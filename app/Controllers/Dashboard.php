<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\ProductModel;
use App\Models\UserModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $salesModel   = new SalesModel();
        $productModel = new ProductModel();
        $userModel = new UserModel();

        // total sales
        $totalSales = $salesModel
            ->selectSum('total')
            ->first()['total'] ?? 0;

        // total products
        $totalProducts = $productModel->countAll();
        $totalStaff = $userModel->countAll();
        

        // recent sales
        $recentSales = $salesModel
            ->orderBy('date', 'DESC')
            ->limit(5)
            ->findAll();

        return view('dashboard', [
            'totalSales'    => $totalSales,
            'totalProducts' => $totalProducts,
            'recentSales'   => $recentSales,
            'totalStaff'   => $totalStaff,
        ]);
    }
}