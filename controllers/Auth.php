<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {


  public function __construct(){
    parent::__construct();
    $this->load->model('UserModel'); //load model 
  }

/// @see index()
/// @note Load halaman dashboard/login 
/// @attention apabila userdata ditemukan masuk ke dashboard
public function index(){
    if($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
      redirect('auth'); // Redirect ke page home
     // function render_login tersebut dari file core/MY_Controller.php
     $this->render_login('login/V_Login'); // Load view login.php
  }
  
/// @see login()
/// @note Validasi username,password
/// @attention cari username dan password di database
  public function login(){

    $username = $this->input->post('username'); // Ambil isi dari inputan username pada form login
    $password = md5($this->input->post('password')); // Ambil isi dari inputan password pada form login dan encrypt dengan md5
    $user = $this->UserModel->get($username); // Ambil dari database central
    $email= $this->UserModel->getemployeedetail($username); // Ambil dari database HRSS

    // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    // <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    // <span class="sr-only">Error:</span>
    // <i class="fa fa-exclamation-triangle"> </i> Hello
    // </div>'); 
    
    // Buat session flashdata

    if(empty($user)){ // Jika hasilnya kosong atau user tidak ditemukan
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      <i class="fa fa-exclamation-triangle"> </i> User ID not found
      </div>'); // Buat session flashdata
      redirect('auth'); // Redirect ke halaman login
      
    }else{

      if($password == $user->password){ // Jika password yang diinput sama dengan password yang didatabase

        // $NameUser = $this->UserModel->getNameUser($username); // Ambil data nama user from DB central
        // $PersonalData = $this->UserModel->getPersonalData($username); // Ambil data nama user from DB central
               
        $role_id=$this->UserModel->getroleid($username);

        // Batasi user access by user system
        if(empty($role_id)){

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          <i class="fa fa-exclamation-triangle"> </i> Anda belum punya access disystem ini
          </div>'); // Buat session flashdata
          redirect('C_dashboard'); // Redirect ke halaman login

        }


        // $rolename=$this->UserModel->getrolename($role_id->roleid);
                        
        $session = array(

          'authenticated'=>true, // Buat session authenticated dengan value true      
          
           // Ambil dari database central
          'user_name'=>$user->user_name, // Buat session nama          
          'nama'=>$user->name, // Buat session nama
          'dept_id'=>$user->kode_department, // Buat session nama
          'dept_name'=>$user->department_name, // Buat session nama

          //  Ambil dari tabel role
          'role_id'=>$role_id->role_id, // Buat session role
          'rolename'=>$role_id->role_name, // Buat session role

          //  Ambil dari database central user
          'email'=>$email->email, // Buat session role

          // Ambil dari database central user
           'officeemail'=>$email->office_email, // Buat session role

          // 'ImageData'=>$PersonalData->PhotoObj         

        );


        // $Menuaccess = $this->UserModel->getuseraccess($role_id->role_id);  // Ambil menu access

        // /* Tambah access menu */
        // foreach($Menuaccess as $role):     

        //   // $session += [ $role->id_menu => true ];
        //   $session += [ $role->menu_name => true ];
          
        //   /* Tambah ADD/Edit/Delete */
        //   if($role->allow_add=='on'){
        //     // $session += [ String($role->id_menu) . 'Add' => true ];
        //     $session += [ String($role->menu_name) . 'Add' => true ];
        //   };

        //   if($role->allow_edit=='on'){
        //     // $session += [ String($role->id_menu) . 'Edit' => true ];
        //     $session += [ String($role->menu_name) . 'Edit' => true ];
        //   };

        //   if($role->allow_delete=='on'){
        //     // $session += [ String($role->id_menu) . 'Delete' => true ];
        //     $session += [ String($role->menu_name) . 'Delete' => true ];
        //   };

        // endforeach;
                
        $this->session->set_userdata($session); // Buat session sesuai $session

        /* redirect('auth'); // Redirect ke halaman home */
        redirect('C_dashboard');

      }else{

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <i class="fa fa-exclamation-triangle"> </i> Password is wrong
      </div>'); // Buat session flashdata
        redirect('C_dashboard'); // Redirect ke halaman login
      }
    }
  }

  

  /// @see logout()
  /// @note Logout
  /// @attention Menghapus semua session user
  public function logout(){
    
    $this->session->sess_destroy(); // Hapus semua session
    redirect('C_dashboard'); // Redirect ke halaman login

  }

  /// @see forgotpassword()
  /// @note Forgot password
  /// @attention load halaman forgot password
  public function forgotpassword(){    

    $this->load->view('login/V_Forgot_Password'); //Tampil halaman forgot password     
          
  }

  /// @see get_user_request()
  /// @note 
  /// @attention
  function get_user_request(){
          
    $nik=$this->input->get('nik');   // Ambil data nik 
    $data = $this->UserModel->get2($nik); // Ambil dari database central
    echo json_encode($data); // Mengubah data menjadi JSON
    
  }
  
  /// @see changepassword()
  /// @note Validasi change password
  /// @attention Apabila userdata diverifikasi maka load halaman change password else load halaman auth
  public function changepassword(){    
    
    if($this->session->userdata('authenticated')){ // Jika user sudah login (Session authenticated ditemukan)  

          $this->load->view('login/V_Change_Password'); // Tampil Halaman change password      

          }else{

          redirect('auth'); // Kembali ke halaman auth

          }
      
  }

  /// @see ConfirmPassword()
  /// @note Confirm Password
  /// @attention Menyamakan isi input field password new dan confirm password
  public function ConfirmPassword(){
        
    //Compare password old dengan inputan password all
    $user = $this->UserModel->get($this->session->userdata('user_name'));
    $passwordold = $user->password;
    
    //$passwordold = "dddd";
    $passwordoldconfirm = md5($this->input->post('passwordoldconfirm'));
    $passwordnew = md5($this->input->post('passwordnew'));
    $passwordnewconfirm = md5($this->input->post('passwordnewconfirm'));

     //Compare password old dengan inputan password all
    if($passwordold == $passwordoldconfirm){     

       //Bandingkan password baru dengan retype password baru         
        if($passwordnew == $passwordnewconfirm){

          //Control update data
          //$user = $this->UserModel->get($username)
           
          $username= $user->user_name;;
                
          $this->UserModel->update_password($username,$passwordnew,'ess_sec_user');
         
          //Pesan berhasil atau tidak
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <span class="sr-only">Error:</span>
                          <i class="fa fa-exclamation-triangle"> </i> Success change password
                          </div>'); // Buat session flashdata

          //Update password
          redirect('auth/changepassword'); // Redirect ke halaman login

        }
        
        else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>
                                        <i class="fa fa-exclamation-triangle"> </i> Confirmation new password not match
                                        </div>'); // Buat session flashdata
                                        redirect('auth/changepassword'); // Redirect ke halaman login
        }

    }

    else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <i class="fa fa-exclamation-triangle"> </i> Old password is wrong
        </div>'); // Buat session flashdata
        redirect('auth/changepassword'); // Redirect ke halaman login
    }
    
  }



}
