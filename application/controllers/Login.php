<?php

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
        session_start();
		$this->load->model(['mlogin','madmin']);
	}
	public function index(){
		@$id_member = $_SESSION['id_member'];
        if(!empty($id_member)){
    		redirect('home');
        }
        $error = '';
        if($this->input->server('REQUEST_METHOD') == 'POST'){
        	$data = $this->input->post();
        	$member = $this->mlogin->verifyLogin($data['email'],$data['password']);
        	if(!empty($member)){
                if($member->statuspengguna==0){
                    $error='Verifikasi email terlebih dahulu klik link yang dikirimkan';
                }else if($member->statuspengguna==2){
                    $error = 'Akun anda dibanned alasan => '.$member->alasanbanned." segera hubungi admin";
                }else{
                    $_SESSION['nama_member'] = $member->nama_member;
                    $_SESSION['id_member'] = $member->id_member;
                    $_SESSION['saldo'] = $member->saldo;                    
                    redirect("home");
                }

        	}else{
        		$error = 'Email atau password salah';
        	}
        }
        $data['error']=$error;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('login',$data);
        $this->load->view('partials/footerhome');
	}
    public function admin(){
        @$role = $_SESSION['role_admin'];
        if(!empty($role)){
            redirect('admin');
        }
        $error = '';
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $dataadmin = $this->madmin->ambilAdmin($data['email']);
            if(empty($dataadmin)){
                $error = 'Admin tidak ditemukan';
            }else if($dataadmin->password_admin==$data['password']){
                $_SESSION['nama_admin'] = $dataadmin->nama_admin;
                $_SESSION['logged_admin'] = 1;
                redirect('admin');     
            }else{     
                $error = 'Password salah';
            }
        }
        $data['error']=$error;
        $this->load->view('partials/header');
        $this->load->view('admin/login',$data);
    }
    public function register(){
        $msg='';
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $register = $this->mlogin->register($data);
            if($register){
                $msg = 'Berhasil Daftar Silahkan Login';
                setcookie('pesan_register',$msg,time()+60,'/');
                redirect('/login/register');
            }else{
                $msg = 'Terjadi Kesalahan coba lagi';
                setcookie('pesan_register',$msg,time()+60,'/');
                redirect('/login/register');
            }
        }
        $data['msg']=$msg;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('register',$data);
        $this->load->view('partials/footerhome');
    }
    public function forgot(){
        $msg='';
        if($this->input->server('REQUEST_METHOD') == 'POST'){
        }
        $data['msg']=$msg;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('forgot',$data);
        $this->load->view('partials/footerhome');
    }
	public function logout(){
        unset($_SESSION['nama_member']);
        unset($_SESSION['id_member']);
        redirect('login');
	}
}

