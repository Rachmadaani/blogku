<?php

namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\Controller;

class Post extends Controller
{
    public function index()
    {
        $model = new PostModel();
        $data['posts'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('posts/index', $data);
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        $postModel = new \App\Models\PostModel();

        $file = $this->request->getFile('image');
        $imageName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName(); // Bisa pakai getName() juga
            $file->move('uploads/', $imageName);
        }

        $slug = url_title($this->request->getPost('title'), '-', true);

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'content' => $this->request->getPost('content'),
            'image' => $imageName, // <- pastikan ini diset
            'created_at' => date('Y-m-d H:i:s')
        ];

        $postModel->insert($data);
        return redirect()->to('/post');
    }

    public function view($slug)
    {
        $model = new PostModel();
        $post = $model->where('slug', $slug)->first();

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artikel tidak ditemukan");
        }

        return view('posts/view', ['post' => $post]);
    }

    public function edit($id)
    {
        $model = new \App\Models\PostModel();
        $data['post'] = $model->find($id);
        return view('posts/edit', $data);
    }

    public function update($id)
    {
        $model = new \App\Models\PostModel();
        $post = $model->find($id);

        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $slug = url_title($title, '-', true);

        // Cek jika ada file baru diupload
        $image = $this->request->getFile('image');
        $imageName = $post['image']; // default: tetap pakai gambar lama

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Hapus gambar lama jika ada
            if (!empty($post['image']) && file_exists('uploads/' . $post['image'])) {
                unlink('uploads/' . $post['image']);
            }

            // Upload gambar baru
            $imageName = $image->getRandomName();
            $image->move('uploads', $imageName);
        }

        $model->update($id, [
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'image' => $imageName,
        ]);

        return redirect()->to(base_url('post/view/' . $slug));
    }

    public function delete($id)
    {
        $model = new \App\Models\PostModel();
        $model->delete($id);
        return redirect()->to(base_url('post'));
    }
}
