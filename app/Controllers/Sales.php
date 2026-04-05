<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogModel;
use App\Models\SalesModel;

class Sales extends Controller
{
    protected $salesModel;
    protected $logModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->logModel = new LogModel();
    }

    // Add Sale
    public function save()
    {
        $data = [
            'user_id' => session()->get('user_id'),
            'total'   => $this->request->getPost('total'),
            'date'    => date('Y-m-d H:i:s')
        ];

        if ($this->salesModel->insert($data)) {
            $this->logModel->addLog('New Sale added: ₱' . $data['total'], 'ADD');
            return redirect()->back()->with('success', 'Sale added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to save sale.');
        }
    }

    // Update Sale (Admin Only)
    public function update()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $id = $this->request->getPost('id');
        $total = $this->request->getPost('total');

        $this->salesModel->update($id, ['total' => $total]);
        $this->logModel->addLog('Sale updated ID: ' . $id, 'UPDATE');

        return redirect()->back()->with('success', 'Sale updated');
    }

    // Delete Sale (Admin Only)
    public function delete()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $id = $this->request->getPost('id');

        $this->salesModel->delete($id);
        $this->logModel->addLog('Sale deleted ID: ' . $id, 'DELETE');

        return redirect()->back()->with('success', 'Sale deleted');
    }
}