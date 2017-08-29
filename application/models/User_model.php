<?php
	class User_model extends CI_Model{
		public function register($enc_password){
			
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $enc_password,
        'zipcode' => $this->input->post('zipcode')
			);
			return $this->db->insert('users', $data);
		}
        
    public function login($username, $password){
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$result = $this->db->get('users');
			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
		}
    
    public function logout(){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			$this->session->set_flashdata('user_loggedout', 'You are now logged out');
			redirect('users/login');
		}
        
    public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
		  $var = $query->row_array();
			if(empty($var)){
				return true;
			} else {
				return false;
			}
		}
		
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
      $var = $query->row_array();
			if(empty($var)){
				return true;
			} else {
				return false;
			}
		}
    
	}         