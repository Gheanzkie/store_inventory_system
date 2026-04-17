<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\LogModel;

class Users extends Controller
{
    public function index(){
        $model = new UserModel();
        $data= [
            'users' => $model->findAll(),
            'pageName' => 'Users'
        ];
        return view('users/index', $data);
    }

    public function save(){
        $name = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');
        $phone = $this->request->getPost('phone');

        if (!$username || !$password) {
            return $this->response->setJSON(['success' => false, 'message' => 'Username and password are required']);
        }

        $userModel = new \App\Models\UserModel();
        $logModel = new LogModel();

        // Check if username already exists
        $existingUser = $userModel->where('username', $username)->first();
        if ($existingUser) {
            return $this->response->setJSON(['success' => false, 'message' => 'Username is already in use']);
        }

        $data = [
            'name'       => $name,
            'username'   => $username,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'role'       => $role,
            'status'     => $status,
            'phone'      => $phone,
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null // ← DAPAT NULL ITO, HINDI DATE
        ];

        if ($userModel->insert($data)) {
            $logModel->addLog('New User has been added: ' . $name, 'ADD');
            return $this->response->setJSON(['success' => true, 'message' => 'User added successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to save user']);
        }
    }

    public function update(){
        $model = new UserModel();
        $logModel = new LogModel();
        $userId = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');
        $phone = $this->request->getPost('phone');

        // Validate the input
        if (empty($username)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Username is required']);
        }

        // Check if username already exists for another user
        $existingUser = $model->where('username', $username)
                              ->where('id !=', $userId)
                              ->first();

        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Username is already in use by another user.'
            ]);
        }

        $userData = [
            'name'       => $name,
            'username'   => $username,
            'role'       => $role,
            'status'     => $status,
            'phone'      => $phone,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!empty($password)) {
            $userData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $updated = $model->update($userId, $userData);

        if ($updated) {
            $logModel->addLog('User has been updated: ' . $name, 'UPDATED');
            return $this->response->setJSON([
                'success' => true,
                'message' => 'User updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error updating user.'
            ]);
        }
    }

    public function edit($id){
        $model = new UserModel();
        $user = $model->find($id);

        if ($user) {
            return $this->response->setJSON(['success' => true, 'data' => $user]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
    }

    public function delete($id){
        $model = new UserModel();
        $logModel = new LogModel();
        $user = $model->find($id);
        
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found.']);
        }

        $deleted = $model->delete($id);

        if ($deleted) {
            $logModel->addLog('User deleted: ' . $user['name'], 'DELETED');
            return $this->response->setJSON(['success' => true, 'message' => 'User deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete user.']);
        }
    }

    public function fetchRecords()
    {
        $request = service('request');
        $model = new \App\Models\UserModel();

        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;
        $searchValue = $request->getPost('search')['value'] ?? '';

        $totalRecords = $model->countAll();
        $result = $model->getRecords($start, $length, $searchValue);

        $data = [];
        $counter = $start + 1;
        foreach ($result['data'] as $row) {
            $row['row_number'] = $counter++;
            $data[] = $row;
        }

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $result['filtered'],
            'data' => $data,
        ]);
    }
}