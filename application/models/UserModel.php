<?php

class UserModel extends CI_Model {

	public function insert_user($data) {
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}	

    public function login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return array(
                    'id' => $user->id,
                    'nama' => $user->nama,
                    'email' => $user->email
                );
            }
        }

        return false;
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }

    public function get_name($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            return $user->name;
        }

        return false;
    }
}

