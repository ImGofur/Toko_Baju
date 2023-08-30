<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
       parent::__construct();
	   $this->load->model('m_user');
       
	}

	public function index()
	{
        $data = array (
            'title' => 'User',
			'user' => $this->m_user->get_all_data(),
            'isi' => 'v_user',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

    // Add a new item
    public function add()
    {
     $data =array(
        'nama'=>$this->input->post('nama'),
        'username'=>$this->input->post('username'),
        'password'=>$this->input->post('password'),
        'level'=>$this->input->post('level'),
     );
     $this->m_user->add($data);
     $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah');
     redirect('user');
    }

    //Update one item
    public function edit( $id_user = NULL )
    {
        $data =array(
            'id_user'=> $id_user,
            'nama'=>$this->input->post('nama'),
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password'),
            'level'=>$this->input->post('level'),
         );
         $this->m_user->edit($data);
         $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
         redirect('user');
    }

    //Delete one item
    public function delete( $id_user = NULL )
    {
    $data = array('id_user' => $id_user);
    $this->m_user->delete($data);
    $this->session->set_flashdata('pesan', 'Data Berhasil DiDelete');
    redirect('user');
    }
}

/* End of file User.php */

