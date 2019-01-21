<?php

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
        session_start();
		$this->load->model(['mhome','mpinjaman','mnotification','Mmember','mdana']);
	}
	public function index(){
		$data=[];
		$pesan = 0;
		$pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1]);
		if(isset($_SESSION['id_member'])){
			$member = $this->Mmember->ambilSemuaMember(['id_member'=>$_SESSION['id_member']])[0];
			if($member->statusverifikasi==0){
				$pesan = 1;
			}
		}
		$data['pesan']=$pesan;
		$data['pinjaman'] =$pinjaman;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('home/index',$data);
        $this->load->view('partials/footerhome');
	}
	public function pinjaman(){
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('home/pinjaman');
        $this->load->view('partials/footerhome');
	}
	
	
	public function tentang(){
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('home/tentang');
        $this->load->view('partials/footerhome');
	}
}

