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
        $userModel    = new UserModel();
        $db           = \Config\Database::connect();


  
        $totalSales = $salesModel
            ->selectSum('total')
            ->where('status', 'completed')
            ->first()['total'] ?? 0;

    
        $totalProducts = $productModel->countAll();

        $totalStaff = $userModel->countAll();

        $recentSales = $salesModel
            ->orderBy('date', 'DESC')
            ->limit(5)
            ->findAll();


        $today = date('Y-m-d');
        $todaySales = $salesModel
            ->selectSum('total')
            ->where('DATE(date)', $today)
            ->where('status', 'completed')
            ->first()['total'] ?? 0;


        $monthSales = $salesModel
            ->selectSum('total')
            ->where('MONTH(date)', date('m'))
            ->where('YEAR(date)', date('Y'))
            ->where('status', 'completed')
            ->first()['total'] ?? 0;

        $totalTransactions = $salesModel
            ->where('status', 'completed')
            ->countAllResults();

    
        $pendingTransactions = $salesModel
            ->where('status', 'pending')
            ->countAllResults();

   
        $lowStock = $productModel
            ->where('stock <=', 10)
            ->where('stock >', 0)
            ->countAllResults();

        $outOfStock = $productModel
            ->where('stock', 0)
            ->countAllResults();

   
        $recentTransactions = $salesModel
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->findAll();


        $topProducts = $db->table('sales_items si')
            ->select('p.name, SUM(si.quantity) as total_quantity, SUM(si.subtotal) as total_sales')
            ->join('product p', 'p.id = si.product_id')
            ->join('sales s', 's.id = si.sale_id')
            ->where('s.status', 'completed')
            ->where('MONTH(s.date)', date('m'))
            ->where('YEAR(s.date)', date('Y'))
            ->groupBy('si.product_id')
            ->orderBy('total_quantity', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();


        $lowStockProducts = $productModel
            ->where('stock <=', 10)
            ->orderBy('stock', 'ASC')
            ->limit(5)
            ->findAll();


        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $chartLabels[] = date('M d', strtotime($date));
            
            $daySales = $salesModel
                ->selectSum('total')
                ->where('DATE(date)', $date)
                ->where('status', 'completed')
                ->first()['total'] ?? 0;
                
            $chartData[] = floatval($daySales);
        }

        $avgSaleValue = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;
        
 
        $todayTransactions = $salesModel
            ->where('DATE(date)', $today)
            ->where('status', 'completed')
            ->countAllResults();

    
        $todayItemsQuery = $db->table('sales_items si')
            ->selectSum('si.quantity')
            ->join('sales s', 's.id = si.sale_id')
            ->where('DATE(s.date)', $today)
            ->where('s.status', 'completed')
            ->get()
            ->getRow();
        $todayItemsSold = $todayItemsQuery->quantity ?? 0;

     
        return view('dashboard', [
      
            'totalSales'          => $totalSales,
            'totalProducts'       => $totalProducts,
            'recentSales'         => $recentSales,
            'totalStaff'          => $totalStaff,
      
            'todaySales'          => $todaySales,
            'monthSales'          => $monthSales,
            'totalTransactions'   => $totalTransactions,
            'pendingTransactions' => $pendingTransactions,
            'lowStock'            => $lowStock,
            'outOfStock'          => $outOfStock,
            'recentTransactions'  => $recentTransactions,
            'topProducts'         => $topProducts,
            'lowStockProducts'    => $lowStockProducts,
            'chartLabels'         => $chartLabels,
            'chartData'           => $chartData,
            'avgSaleValue'        => $avgSaleValue,
            'todayTransactions'   => $todayTransactions,
            'todayItemsSold'      => $todayItemsSold,
        ]);
    }
}