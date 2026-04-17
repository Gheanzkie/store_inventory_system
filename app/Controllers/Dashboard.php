<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $salesModel;
    protected $productModel;
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $today = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        // Summary Cards Data
        $data = [
            'totalSales'          => $this->getTotalSales(),
            'totalProducts'       => $this->productModel->countAll(),
            'totalStaff'          => $this->userModel->countAll(),
            'todaySales'          => $this->getSalesByDate($today),
            'monthSales'          => $this->getSalesByMonth($month, $year),
            'totalTransactions'   => $this->getCompletedCount(),
            'pendingTransactions' => $this->getPendingCount(),
            'lowStock'            => $this->getLowStockCount(),
            'outOfStock'          => $this->getOutOfStockCount(),
            'avgSaleValue'        => $this->getAverageSale(),
            'todayTransactions'   => $this->getTodayTransactionCount($today),
            'todayItemsSold'      => $this->getTodayItemsSold($today),
        ];

        // Table Data
        $data['recentTransactions'] = $this->getRecentTransactions(5);
        $data['topProducts'] = $this->getTopProducts($month, $year, 5);
        $data['lowStockProducts'] = $this->getLowStockProducts(5);

        // Chart Data
        $chart = $this->getChartData(7);
        $data['chartLabels'] = $chart['labels'];
        $data['chartData'] = $chart['data'];

        return view('dashboard', $data);
    }

    // =============================================
    // HELPER METHODS
    // =============================================
    
    private function getTotalSales()
    {
        return $this->salesModel->selectSum('total')->where('status', 'completed')->first()['total'] ?? 0;
    }

    private function getSalesByDate($date)
    {
        return $this->salesModel->selectSum('total')->where('DATE(date)', $date)->where('status', 'completed')->first()['total'] ?? 0;
    }

    private function getSalesByMonth($month, $year)
    {
        return $this->salesModel->selectSum('total')->where('MONTH(date)', $month)->where('YEAR(date)', $year)->where('status', 'completed')->first()['total'] ?? 0;
    }

    private function getCompletedCount()
    {
        return $this->salesModel->where('status', 'completed')->countAllResults();
    }

    private function getPendingCount()
    {
        return $this->salesModel->where('status', 'pending')->countAllResults();
    }

    private function getLowStockCount()
    {
        return $this->productModel->where('stock <=', 10)->where('stock >', 0)->countAllResults();
    }

    private function getOutOfStockCount()
    {
        return $this->productModel->where('stock', 0)->countAllResults();
    }

    private function getAverageSale()
    {
        $total = $this->getTotalSales();
        $count = $this->getCompletedCount();
        return $count > 0 ? $total / $count : 0;
    }

    private function getTodayTransactionCount($today)
    {
        return $this->salesModel->where('DATE(date)', $today)->where('status', 'completed')->countAllResults();
    }

    private function getTodayItemsSold($today)
    {
        $result = $this->db->table('sales_items si')
            ->selectSum('si.quantity')
            ->join('sales s', 's.id = si.sale_id')
            ->where('DATE(s.date)', $today)
            ->where('s.status', 'completed')
            ->get()->getRow();
        return $result->quantity ?? 0;
    }

    private function getRecentTransactions($limit)
    {
        return $this->salesModel->orderBy('id', 'DESC')->limit($limit)->findAll();
    }

    private function getTopProducts($month, $year, $limit)
    {
        return $this->db->table('sales_items si')
            ->select('p.name, SUM(si.quantity) as total_quantity, SUM(si.subtotal) as total_sales')
            ->join('product p', 'p.id = si.product_id')
            ->join('sales s', 's.id = si.sale_id')
            ->where('s.status', 'completed')
            ->where('MONTH(s.date)', $month)
            ->where('YEAR(s.date)', $year)
            ->groupBy('si.product_id')
            ->orderBy('total_quantity', 'DESC')
            ->limit($limit)->get()->getResultArray();
    }

    private function getLowStockProducts($limit)
    {
        return $this->productModel->where('stock <=', 10)->orderBy('stock', 'ASC')->limit($limit)->findAll();
    }

    private function getChartData($days)
    {
        $labels = [];
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $labels[] = date('M d', strtotime($date));
            $data[] = floatval($this->getSalesByDate($date));
        }
        
        return ['labels' => $labels, 'data' => $data];
    }
}