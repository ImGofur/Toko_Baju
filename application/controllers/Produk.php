<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
      $this->load->model('m_produk');
      $this->load->model('m_kategori');
      

    }

    // List all your items
    public function index()
    {
        $data = array(
            'title' => ' Add Produk',
             'produk'=> $this->m_produk->get_all_data(),
            'isi' => 'produk/v_produk',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required',
    array('required'=> '%s Harus Di Isi !')
    );
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required',
    array('required'=> '%s Harus Di Isi !')
    );
    $this->form_validation->set_rules('harga', 'Harga', 'required',
    array('required'=> '%s Harus Di Isi !')
    );
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required',
    array('required'=> '%s Harus Di Isi !')
    );

    
    if ($this->form_validation->run() == TRUE ) {
     $config['upload_path'] ='./assets/gambar/';
     $config['allowed_types'] ='gif|jpg|png|jpeg|ico';
     $config['max_size'] ='2000';
     $this->upload->initialize($config);
     $field_name = "gambar";
     if (!$this->upload->do_upload($field_name)) {
        $data = array(
            'title' => 'Add Produk',
            'kategori'=> $this->m_kategori->get_all_data(),
            'error_upload'=> $this->upload->display_errors(),
            'isi' => 'produk/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
     } else {
      $upload_data = array('uploads'=> $this->upload->data());
      $config['image_library'] ='gd2';
      $config['source_image']='./assets/gambar/'.$upload_data['uploads']['file_name'];
      $this->load->library('image_lib',$config);
      $data = array(
        'nama_produk'=> $this->input->post('nama_produk'),
        'id_kategori'=> $this->input->post('id_kategori'),
        'harga'=> $this->input->post('harga'),
        'deskripsi'=> $this->input->post('deskripsi'),
        'gambar' => $upload_data['uploads']['file_name'],
        
      );
      $this->m_produk->add($data);
      $this->session->set_flashdata('pesan', 'Data Berhasil DiTambahkan');
      redirect('produk');
     }

    }
    
        
        $data = array(
            'title' => 'Add Produk',
            'kategori'=> $this->m_kategori->get_all_data(),
            'isi' => 'produk/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Update one item
    public function edit( $id_produk  )
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required',
        array('required'=> '%s Harus Di Isi !')
     );
     $this->form_validation->set_rules('id_kategori', 'Kategori', 'required',
     array('required'=> '%s Harus Di Isi !')
     );
     $this->form_validation->set_rules('harga', 'Harga', 'required',
     array('required'=> '%s Harus Di Isi !')
     );
     $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required',
     array('required'=> '%s Harus Di Isi !')
     );
 
     
     if ($this->form_validation->run() == TRUE ) {
      $config['upload_path'] ='./assets/gambar/';
      $config['allowed_types'] ='gif|jpg|png|jpeg|ico';
      $config['max_size'] ='2000';
      $this->upload->initialize($config);
      $field_name = "gambar";
      if (!$this->upload->do_upload($field_name)) {
         $data = array(
             'title' => 'Edit Produk',
             'kategori'=> $this->m_kategori->get_all_data(),
             'produk'=> $this->m_produk->get_data($id_produk),
             'error_upload'=> $this->upload->display_errors(),
             'isi' => 'produk/v_edit',
         );
         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      } else {
         
         //hapus gambar
         $produk= $this->m_produk->get_data($id_produk);
         if ($produk->gambar!="") {
            unlink('./assets/gambar/'.$produk->gambar);
         }
         //end hapus gambar

       $upload_data = array('uploads'=> $this->upload->data());
       $config['image_library'] ='gd2';
       $config['source_image']='./assets/gambar/'.$upload_data['uploads']['file_name'];
       $this->load->library('image_lib',$config);
       $data = array(
         'id_produk'=> $id_produk,
         'nama_produk'=> $this->input->post('nama_produk'),
         'id_kategori'=> $this->input->post('id_kategori'),
         'harga'=> $this->input->post('harga'),
         'deskripsi'=> $this->input->post('deskripsi'),
         'gambar' => $upload_data['uploads']['file_name'],
         
       );
       $this->m_produk->edit($data);
       $this->session->set_flashdata('pesan', 'Data Berhasil DiEdit');
       redirect('produk');
      }
      //jika tampa gamti gambar
      $data = array(
        'id_produk'=> $id_produk,
        'nama_produk'=> $this->input->post('nama_produk'),
        'id_kategori'=> $this->input->post('id_kategori'),
        'harga'=> $this->input->post('harga'),
        'deskripsi'=> $this->input->post('deskripsi'),
       
        
      );
      $this->m_produk->edit($data);
      $this->session->set_flashdata('pesan', 'Data Berhasil DiEdit');
      redirect('produk');
 
     }
     
         
         $data = array(
             'title' => 'Edit Produk',
             'kategori'=> $this->m_kategori->get_all_data(),
             'produk'=> $this->m_produk->get_data($id_produk),
             'isi' => 'produk/v_edit',
         );
         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Delete one item
    public function delete( $id_produk  )
    {
        //hapus gambar
        $produk= $this->m_produk->get_data($id_produk);
        if ($produk->gambar!="") {
           unlink('./assets/gambar/'.$produk->gambar);
        }
        //end hapus gambar
        $data = array('id_produk' => $id_produk);
        $this->m_produk->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil DiDelete');
        redirect('produk');
    }
}

/* End of file Produk.php */

