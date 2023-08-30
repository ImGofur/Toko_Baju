<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login_user()
    {
        $data = array(
            'tite'=> 'Login User',
          
        );
        $this->load->view('v_login_user', $data, FALSE);
    }

}

/* End of file Controllername.php */
