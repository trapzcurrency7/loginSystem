<?php

namespace App\Controllers;
use App\Models\HomeModel;
use CodeIgniter\HTTP\RequestInterface;
class HomeController extends BaseController
{
   
    public function loginPage(){
        session()->destroy();
        return view('login');
       
    }
    public function registerUser(){

        $data = json_decode(file_get_contents('php://input'),true);
        $response ="";
        try{

            $errors = array();

            $password = $data['password'];
            $email = $data['email'];
            $username = str_replace(" ", "", $data['username']);

            if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/', $password)){
                $errors[]="Please include at least one uppercase letter, one lowercase letter, one number, and special characters.";
            }
            if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)){
                $errors[]="Please enter a valid email.";
            }
            if(!empty($errors)){
                 $response = array('success'=>false,'message'=>implode('<br>',$errors));
            }else{
                
                $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
               
                $insertArray = array(
                                    'user_name'=>$username,
                                    'user_email'=>$data['email'],
                                    'password'=>$encryptedPassword,
                                    );

                $homeModel = new HomeModel();
                $userExistCheck = $homeModel->userExistCheck($insertArray);
                
                if($userExistCheck){

                     $response = array('success'=>false,'message'=>'User already exists with the following username or email');
                }else{

                    $insertData = $homeModel->registerUser($insertArray);

                    if($insertData){
                        $response = array('success'=>true,'message'=>'Registered succesfully');

                    }else{
                        $response = array('success'=>false,'message'=>'Failed to register user');

                    }
                }
            }

        }catch(Exception $e){
            $response = array('success'=>false,'message'=>'Somwthing went wrong');
        }

        return json_encode($response);
   }

   public function login(){

        helper('form');
        $request = request();
        $validation =  \Config\Services::validation();
        $encrypter = \Config\Services::encrypter();
        $homeModel = new HomeModel();
        $creddentials = $request->getPost();

        $validation->setRules([
            "username" => ["label" => "Username/Email", "rules" => "required|min_length[3]"],
            "password" => ["label" => "Password", "rules" => "required|min_length[3]"],
            
        ]);

        try{

            if($validation->withRequest(request())->run()){

                $username =$creddentials['username'];
                $password =$creddentials['password'];

                $userData = $homeModel->getUserCredentials($username,$password);

                if($userData){

                    if(password_verify($password, $userData['password'])){

                        $session = session();
                        $session->set(['username'=>$userData['user_name'],'email'=>$userData['user_email'],'id'=>$userData['user_id']]);
                        $userData['userData'] = $homeModel->getUserDataById($userData['user_id']);
                        $userData['content'] = empty($userData['name'])?"editView.php":"homePage.php";
                        return view('mainLayout',$userData);
                    }
                    $data['invalidPassword'] = "Please enter a valid password";
                    return view('login',$data);

                }
                $data['notFound'] = "User not found";
                return view('login',$data);
            }
            $data["validation"] = $validation->getErrors();
            return view('login',$data);
        }catch(Exception $e){
            return view('/');
        }

    }
    public function editProfileView(){
        $session = session();
        $data = $session->get();
        $homeModel = new HomeModel();

        if(isset($data['id'])&& !empty($data['id'])){
            $userData['userData'] = $homeModel->getUserDataById($data['id']);
            $userData['content'] = "editView.php";
            return view('mainLayout',$userData);

        }else{
            return redirect('/');
        }
      
    }

    public function homeView(){

        $session = session();
        $data = $session->get();

        $homeModel = new HomeModel();

        if(isset($data['id']) && !empty($data['id'])){
            $userData['userData'] = $homeModel->getUserDataById($data['id']);

            $userData['content'] = "homePage.php";
            return view('mainLayout',$userData);
        }else{
            return redirect('/');
        }

    }
    public function changePasswordView(){
        $session = session();
        $data = $session->get();

        $homeModel = new HomeModel();

        if(isset($data['id']) && !empty($data['id'])){


            $userData['userData'] = $homeModel->getUserDataById($data['id']);

            $userData['content'] = "changePasswordView.php";
            return view('mainLayout',$userData);
        }else{
            return redirect('/');
        }
    }

    public function editUserData(){
        $data = json_decode(file_get_contents('php://input'),true);
        $response = "";
        try{
            $homeModel = new HomeModel();
            $username = str_replace(" ", "", $data['username']);
            $email = $data['email'];
            $getExistingUsername = $homeModel->getExistingUsername($username);
            $getExistingUserEmail = $homeModel->getExistingUserEmail($email);
            $errors = array();


            if(!empty($getExistingUsername) && $getExistingUsername['user_id']!=$data['id']){
                $response = array('success'=>false,"message"=>"Username already exists");

                $errors[]=("Username already exists");
            }

            if(!empty($getExistingUserEmail) && $getExistingUserEmail['user_id']!=$data['id']){
                $response = array('success'=>false,"message"=>"Email already exists");
                 $errors[]=("Email already exists");
            }

            if(!empty($errors)){
                 $response = array('success'=>false,"message"=>implode("<br>", $errors));

               
            }else{

                 $updateArray = array(
                                    "user_name"=>$username,
                                    "user_email"=>$data['email'],
                                    "name"=>$data['name'],
                                    "age"=>$data['age'],
                                    "gender"=>$data['gender'],
                                    "address"=>$data['address'],
                                    "gender_others"=>$data['others'],
                                );
                $updateUser = $homeModel->updateUser($updateArray,$data['id']);
                if($updateUser){
                    $response = array('success'=>true,"message"=>"succesfully updated");
                }else{
                     $response = array('success'=>false,"message"=>"Somwthing went wrong");
                }
            }
        }catch(Exception $e){
             $response = array('success'=>false,"message"=>"Somwthing went wrong");

        }
        return json_encode($response);
    }

    public function changePassword(){
        $data = json_decode(file_get_contents('php://input'),true);
        try{

            $id = $data['id'];
            $confirmPassword = $data['confirmPassword'];
            $newPassword = $data['newPassword'];
            $oldPassowrd = $data['oldPassowrd'];
            $homeModel = new HomeModel();

            $errors=array();
            if($newPassword!=$confirmPassword){
                $errors[]="Password does not match with confirm Password";
            }
            if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/', $newPassword)){
                $errors[]="Please include at least one uppercase letter, one lowercase letter, one number, and special characters.";
            }
            if(!empty($errors)){
                 $response = array('success'=>false,"message"=>implode('<br>',$errors));
            }else{
                $checkPassword = $homeModel->getUserDataById($id);
                if(password_verify($oldPassowrd,$checkPassword['password'])){
                    $newPassword =password_hash($newPassword,PASSWORD_DEFAULT);
                    $updatePassword = $homeModel->updatePassword($id,$newPassword);
                    if($updatePassword){
                        $response = array('success'=>true,"message"=>"Password changed succesfully");
                    }else{
                        $response = array('success'=>false,"message"=>"Something went wrong");

                    }
                }else{
                    $response = array('success'=>false,"message"=>"Old password does not match");
                }
            }
           
        }catch(Exception $e){

            $response = array('success'=>false,"message"=>"Somwthing went wrong");

        }
        $session = session();
        $data = $session->destroy();
        return json_encode($response);
    }

}
