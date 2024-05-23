<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class HomeModel extends Model
{
    
    public function registerUser($array){

        $builder = $this->db->table('users')
                    ->insert($array);
        if($builder){
            return true;
        }else {
            return false;
        }

    }

    public function userExistCheck($array){

        $builder = $this->db->table('users')
                    ->where('user_name',$array['user_name'])
                    ->orWhere('user_email',$array['user_email'])
                    ->get()->getResultArray();
        return $builder;
      

    }

    public function getUserCredentials($username,$password){

        $builder = $this->db->table('users')
                    ->where('user_name', $username)
                    ->orWhere('user_email', $username);
        $user = $builder->get()->getRowArray();
        return $user;
       
    }
    public function getUserDataById($id){

        $builder = $this->db->table('users')
                    ->where('user_id',$id)
                    ->get()->getRowArray();
        return $builder;
        
    }
    public function getExistingUsername($username){

        $builder = $this->db->table('users')
                    ->where('user_name',$username)
                    ->get()->getRowArray();
        return $builder;
        
    }
    public function getExistingUserEmail($email){

        $builder = $this->db->table('users')
                    ->where('user_email',$email)
                    ->get()->getRowArray();
        return $builder;
        
    }
    public function updateUser($updateArray,$id){

         $builder = $this->db->table('users')
                    ->where('user_id',$id)
                    ->update($updateArray);
        if($builder){
            return true;
        }
        return false;
                    
    }
    public function updatePassword($id,$password){
        $updateArray = array("password"=>$password);
         $builder = $this->db->table('users')
                ->where('user_id',$id)
                ->update($updateArray);
        if($builder){
            return true;
        }
        return false;
    }
}