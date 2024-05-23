<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{

	function __construct(){
		parent::__construct();
		$db = \Config\Database::connect();
	}
   
	

   public function registerUser(){
	// $db = \Config\Database::connect();
   	 $this->db->table('v_members');
   	 return [
            'news'  => $this->paginate(4),
            'pager' => $this->pager,
        ];
   }
    // ...
}