<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\TestimonialModel;
use CodeIgniter\HTTP\ResponseInterface;

class TestimonialController extends BaseController
{
    protected $testimonialModel;
    protected $validation;

    public function __construct()
    {
        $this->testimonialModel = new TestimonialModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Testimonial',
            'testimonial' => $this->testimonialModel->getTestimonial()
        ];

        return view('admin/testimonial_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'link_instagram' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Link Instagram Tidak Boleh Kosong !'
                    ]
                ],

                'foto_1' => [
                    'rules' => 'uploaded[foto_1]|max_size[foto_1,5048]|is_image[foto_1]|mime_in[foto_1,image/png,image/jpeg,image.jpg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],
                'foto_2' => [
                    'rules' => 'uploaded[foto_2]|max_size[foto_2,5048]|is_image[foto_2]|mime_in[foto_2,image/png,image/jpeg,image.jpg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],
                'foto_3' => [
                    'rules' => 'uploaded[foto_3]|max_size[foto_3,5048]|is_image[foto_3]|mime_in[foto_3,image/png,image/jpeg,image.jpg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'link_instagram' => $this->validation->getError('link_instagram'),
                        'foto_1' => $this->validation->getError('foto_1'),
                        'foto_2' => $this->validation->getError('foto_2'),
                        'foto_3' => $this->validation->getError('foto_3'),
                    ]
                ];
            } else {

                $link_instagram = $this->request->getPost('link_instagram');

                $foto_1 = $this->request->getFile('foto_1');
                $nama_foto_1 = $foto_1->getRandomName();
                $foto_1->move('testimoni', $nama_foto_1);

                $foto_2 = $this->request->getFile('foto_2');
                $nama_foto_2 = $foto_2->getRandomName();
                $foto_2->move('testimoni', $nama_foto_2);

                $foto_3 = $this->request->getFile('foto_3');
                $nama_foto_3 = $foto_3->getRandomName();
                $foto_3->move('testimoni', $nama_foto_3);

                $this->testimonialModel->save([
                    'link_instagram' => $link_instagram,
                    'foto_1' => $nama_foto_1,
                    'foto_2' => $nama_foto_2,
                    'foto_3' => $nama_foto_3,

                ]);

                $alert = [
                    'success' => 'Testimonial Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }
}
