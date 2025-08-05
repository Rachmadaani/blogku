<?php

namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        $postModel = new PostModel();
        $data['posts'] = $postModel->orderBy('created_at', 'DESC')->findAll();

        return view('user/user_dashboard', $data);
    }
}
