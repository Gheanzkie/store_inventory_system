<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Controllers\BaseController;

class Logs extends BaseController
{
    public function log()
    {
        $logModel = new LogModel();
        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $filter = $this->request->getGet('filter') ?? 'all';

        // Get logs by date
        $logs = $logModel->getLogsByDate($date);
        
        // Filter by CRUD type if specified
        if ($filter !== 'all') {
            $logs = array_filter($logs, function($log) use ($filter) {
                $action = strtolower($log['ACTION'] ?? '');
                $identifier = strtolower($log['identifier'] ?? '');
                
                switch ($filter) {
                    case 'products':
                        return strpos($action, 'product') !== false || 
                               strpos($identifier, 'product') !== false;
                    case 'staff':
                        return strpos($action, 'staff') !== false || 
                               strpos($action, 'user') !== false ||
                               strpos($identifier, 'staff') !== false;
                    case 'sales':
                        return strpos($action, 'sale') !== false || 
                               strpos($action, 'transaction') !== false ||
                               strpos($identifier, 'sale') !== false;
                    case 'login':
                        return $identifier === 'LOGIN' || $identifier === 'LOGOUT' ||
                               strpos($action, 'login') !== false || 
                               strpos($action, 'logout') !== false;
                    case 'add':
                        return $identifier === 'ADD' || strpos($action, 'added') !== false;
                    case 'update':
                        return $identifier === 'UPDATE' || strpos($action, 'updated') !== false;
                    case 'delete':
                        return $identifier === 'DELETE' || strpos($action, 'deleted') !== false;
                    default:
                        return true;
                }
            });
        }

        $data = [
            'logs' => array_values($logs),
            'selectedDate' => $date,
            'selectedFilter' => $filter
        ];

        return view('log/index', $data);
    }
}