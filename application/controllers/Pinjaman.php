<?php
class Pinjaman extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();
		$this->load->model(['mhome','mpinjaman','mnotification','Mmember','mtagihan','mdana','mrating','mdana']);

	}
	public function ajukanpinjaman(){
		if(empty($_SESSION['nama_member'])){
			redirect('login');
		}
		$data=[];
		$error='';
		$member= $this->Mmember->ambilSemuaMember(['id_member'=>$_SESSION['id_member']])[0];
		if($member->statusverifikasi==0){
			$error='Akun anda belum diverifikasi sehingga tidak bisa mengajukan atau meminjamkan.Segera update profil agar akun diverifikasi';
			setcookie('pesan_pinjaman',$error,time()+60,'/');
			redirect('/home/pinjaman');
		}
		$pinjaman1 = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pengajuan'=>1,'status_pinjaman'=>0]);
		if(count($pinjaman1)>0){
			$error='Anda masih punya pinjaman berlangsung jadi tidak bisa mengajukan sampai pinjaman selesai';
			setcookie('pesan_pinjaman',$error,time()+60,'/');
			redirect('/home/pinjaman');
		}
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->load->library('pdf');
			$data = $this->input->post();
			$filename=$_SESSION['nama_member']."_dokumenperjanjian_".$data['judul']."_".Date("dmYis").".pdf";
			$this->pdf->setPaper('A4','portrait');
			$this->pdf->filename = $filename;
			$data['filename'] = $filename;
			$data['kode_pinjaman']=$this->mpinjaman->getKodePinjaman();
			$this->pdf->load_view('member/dokumenperjanjian',$data);
			$save = $this->mpinjaman->ajukanPinjaman($data);
			redirect('/pinjaman/infopinjaman/'.$save);
		}
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/ajukanpinjaman',$data);
        $this->load->view('partials/footerhome');
	}
	public function beripinjaman(){
		$pinjaman = $this->mpinjaman->ambilPinjaman(array('status_pengajuan'=>1));
		$data['pinjaman'] = $pinjaman;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/beripinjaman',$data);
        $this->load->view('partials/footerhome');
	}

	public function infopinjaman($id){
		// print_r($id);
		$data['id'] =$id;
		$pinjaman = $this->mpinjaman->ambilPinjaman(array('id'=>$id))[0];
		$data['pinjaman']=$pinjaman;
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data= $this->input->post();
			$data['id']=$id;
			$data['kategori_pinjaman'] =$pinjaman->kategori_pinjaman;
			$this->mpinjaman->infoPinjaman($data);
			$msg='Detail berhasil dikirim.Akan ada notifikasi jika diterima oleh admin';
			setcookie('pesan_listpinjaman',$msg,time()+60,'/');
			redirect('/pinjaman/listpinjaman');
		}
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/infopinjaman',$data);
        $this->load->view('partials/footerhome');
	}
	public function detailpemindahan($id){
		$pindah= $this->mdana->ambilPemindahan(['id_pinjaman'=>$id]);
		$data['pindah'] = $pindah;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/detailpemindahan',$data);
        $this->load->view('partials/footerhome');
	}
	public function listpinjaman(){
		$pinjaman1 = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pengajuan'=>1,'status_pinjaman'=>0]);
		$pinjaman2 = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pinjaman'=>1]);
		$pinjaman3 = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pengajuan'=>0]);
		$data['pinjaman1']=$pinjaman1;
		$data['pinjaman2']=$pinjaman2;
		$data['pinjaman3']=$pinjaman3;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/listpinjaman',$data);
        $this->load->view('partials/footerhome');
	}
	public function detailpinjaman($id){
		@$pinjaman = $this->mpinjaman->ambilPinjaman(['id'=>$id])[0];
		@$detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$id])[0];
		@$detailusaha = $this->mpinjaman->detailUsaha(['id_pinjaman'=>$id])[0];
		$data['pinjaman'] = $pinjaman;
		$data['detail'] = $detail;
		$data['detailusaha'] = $detailusaha;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/detailpinjaman',$data);
        $this->load->view('partials/footerhome');
	}
	public function investasi(){
		$dana = $this->mdana->ambilPemindahan(['id_member'=>$_SESSION['id_member']]);
		$data['dana']= $dana;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/investasi',$data);
        $this->load->view('partials/footerhome');
	}
	public function detail($id){
		@$pinjaman = $this->mpinjaman->ambilPinjaman(['id'=>$id])[0];
		@$detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$id])[0];
		@$detailusaha = $this->mpinjaman->detailUsaha(['id_pinjaman'=>$id])[0];
		@$member = $this->Mmember->ambilSemuaMember(['id_member'=>$_SESSION['id_member']])[0];
		$penawaran = $this->mpinjaman->ambilPinjaman(['id_member'=>$pinjaman->id_member,'status_pengajuan'=>0,'status_pinjaman'=>0]);
		$aktif = $this->mpinjaman->ambilPinjaman(['id_member'=>$pinjaman->id_member,'status_pengajuan'=>1,'status_pinjaman'=>0]);
		$lunas = $this->mpinjaman->ambilPinjaman(['id_member'=>$pinjaman->id_member,'status_pengajuan'=>1,'status_pinjaman'=>1]);
		$rating = $this->mrating->ambilRating(['id_pinjaman'=>$id]);
		$totalpenawaran = 0;
		$totalaktif = 0;
		$totallunas = 0;
		foreach($penawaran as $p){
			$totalpenawaran += $p->jumlah_pinjaman;
		}
		foreach($aktif as $p){
			$totalaktif += $p->jumlah_pinjaman;
		}
		foreach($lunas as $p){
			$totallunas += $p->jumlah_pinjaman;
		}
		$totalrating=0;
		foreach($rating as $r){
			$totalrating += $r->rating;
		}
		if($this->input->server('REQUEST_METHOD') == 'POST'){

			$data= $this->input->post();

			if(!isset($data['kirimrating'])){			
				$data['id'] = $id;
				$this->mdana->beriDana($data);
				redirect('/pinjaman/investasi');
			}
			
		}
		$data['pinjaman'] = $pinjaman;
		$data['detail'] = $detail;
		$data['detailusaha'] = $detailusaha;
		$data['penawaran'] =$penawaran;
		$data['totalpenawaran'] = $totalpenawaran;
		$data['aktif'] =$aktif;
		$data['totalaktif'] = $totalaktif;
		$data['lunas'] =$lunas;
		$data['totallunas'] = $totallunas;
		$data['rating']=$rating;
		$data['totalrating'] = $totalrating;
		$data['member'] = $member;
		$this->load->view('partials/headerhome');
		$this->load->view('partials/navbar');
        $this->load->view('member/detail',$data);
        $this->load->view('partials/footerhome');
	}
	public function tagihan($id){
		$tagih = $this->mtagihan->ambilTagihan(['id_pinjaman'=>$id]);
		$data['tagih'] = $tagih;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/detailtagihan',$data);
        $this->load->view('partials/footerhome');
    }
    public function bayartagihan($id){
        $data=[];
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $data['id'] = $id;
            $this->mtagihan->uploadBukti($data);
            redirect('/pinjaman/tagihan/'.$id);
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/bayartagihan',$data);
        $this->load->view('partials/footerhome');
    }
}