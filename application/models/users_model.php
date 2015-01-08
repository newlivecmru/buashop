<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function _checkuser($username, $password) {

        $result = $this->db->where('username', $username)
                ->where('password', $password)
                ->count_all_results('employee');
        return $result>0 ?TRUE:FALSE;
    }

}