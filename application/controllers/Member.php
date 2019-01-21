<?php

class Member extends CI_Controller {

	public function __construct() {
		parent::__construct();
        session_start();
		$this->load->model(['Mmember','mnotification','mpinjaman','mdokumen','msaldo','mrating']);
	}
    public function profile(){
        $active =  $this->router->fetch_method();
        $data['active'] = $active;
        $member  = $this->Mmember->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
        $data['member'] =$member;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $this->Mmember->updateProfile($data);
            redirect('/member/profile');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/profile',$data);
        $this->load->view('partials/footerhome');
    }
    public function notification(){
        $this->mnotification->updateNotification($_SESSION['id_member']);
        $notification = $this->mnotification->userNotification(array('id_member'=>$_SESSION['id_member']));
        $data['notification'] = $notification;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/notification',$data);
        $this->load->view('partials/footerhome');
    }

    public function dokumen(){
        $dokumen = $this->mdokumen->getDokumen(['id_member'=>$_SESSION['id_member']]);
        $data['dokumen']=$dokumen;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/dokumen',$data);
        $this->load->view('partials/footerhome');
    }
    public function berirating($id){
        $data= $this->input->post();
        $data['id'] = $id;
        $this->mrating->beriRating($data);
        redirect('/pinjaman/detail/'.$id);
    }
    public function rekeningbank(){
        $data=[];
        $active =  $this->router->fetch_method();
        $data['active'] = $active;
        $member  = $this->Mmember->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
        $data['member'] =$member;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $this->Mmember->updateRekening($data);
            redirect('/member/rekeningbank');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/rekeningbank',$data);
        $this->load->view('partials/footerhome');
    }

    public function gantiemail(){
        $data=[];
        $active =  $this->router->fetch_method();
        $data['active'] = $active;
        $member  = $this->Mmember->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
        $data['member'] =$member;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $this->Mmember->updateEmail($data);
            redirect('/member/gantiemail');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/gantiemail',$data);
        $this->load->view('partials/footerhome');
    }
    public function gantipassword(){
        $data['error']='';
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $save = $this->Mmember->updatePassword($data);
            // if($save=='sukses')
            //     redirect('/member/gantipassword');
            // else
            $data['error']=$save;
        }
        $active =  $this->router->fetch_method();
        $data['active'] = $active;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/gantipassword',$data);
        $this->load->view('partials/footerhome');
    }
    public function detailsaldo(){
        $data=[];
        $member = $this->Mmember->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
        $totalTopup = $this->msaldo->totalTopup($_SESSION['id_member']);
        $data['totalTopup'] =$totalTopup->saldo==''?0:$totalTopup->saldo;
        $pinjam = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0]);
        $pinjamcair = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pengajuan'=>1,'status_pinjaman'=>0]);
        $totalinvestasi = 0;
        $totalcair=0;
        foreach($pinjam as $p){
            $totaldana = $this->db->query("select sum(jumlah) as total from pemindahandana where id_member=".$_SESSION['id_member']." and id_pinjaman=".$p->id)->result()[0]->total;
            $totalinvestasi+=$totaldana;
        }
        foreach($pinjamcair as $p){
            $totaldana = $this->db->query("select sum(jumlah) as total from pemindahandana where id_pinjaman=".$p->id)->result()[0]->total;
            $totalcair+=$totaldana;
        }
        $totalpencairan=0;
        $cair = $this->msaldo->ambilPencairan(['id_member'=>$_SESSION['id_member'],'jenis'=>1,'status'=>1]);
        foreach($cair as $c){
            $totalpencairan += $c->jumlah;
        }
        $data['totalinvestasi'] = $totalinvestasi;
        $data['totalcair'] = $totalcair-$totalpencairan;
        $data['member']=$member;
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/detailsaldo',$data);
        $this->load->view('partials/footerhome');
    }
    public function topup(){
        $topup=$this->msaldo->ambilSaldo(array('id_member'=>$_SESSION['id_member']));
        $data['topup'] =$topup;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $save = $this->msaldo->topup($data);
            redirect('/member/topup');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/topup',$data);
        $this->load->view('partials/footerhome');
    }

    public function uploadbukti($id){
        $detail = $this->msaldo->ambilSaldo(array('id_saldo'=>$id))[0];
        $data['detail'] =$detail;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $data['id'] = $id;
            $this->msaldo->uploadBukti($data);
            redirect('/member/topup');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/uploadbukti',$data);
        $this->load->view('partials/footerhome');
    }
    public function detailtopup(){
        $data=[];
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/detailtopup',$data);
        $this->load->view('partials/footerhome');
    }
    public function pencairansaldo(){
        $data=[];
        $member = $this->Mmember->ambilSemuaMember(['id_member'=>$_SESSION['id_member']])[0];
        $data['member']=$member;
        $pencairan = $this->msaldo->ambilPencairan(['id_member'=>$_SESSION['id_member'],'jenis'=>0]);
        $data['pencairan']=$pencairan;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $data['jenis']=0;
            $save = $this->msaldo->pencairan($data);
            redirect('/member/pencairansaldo');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/pencairansaldo',$data);
        $this->load->view('partials/footerhome');
    }
    public function pencairanpinjaman(){
        $data=[];
        $member = $this->Mmember->ambilSemuaMember(['id_member'=>$_SESSION['id_member']])[0];
        $data['member']=$member;
        $pencairan = $this->msaldo->ambilPencairan(['id_member'=>$_SESSION['id_member'],'jenis'=>1]);
        $data['pencairan']=$pencairan;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $data['jenis']=1;
            $data['id_member'] = $member->id_member;
            $save = $this->msaldo->pencairan($data);
            redirect('/member/pencairanpinjaman');
        }
        $this->load->view('partials/headerhome');
        $this->load->view('partials/navbar');
        $this->load->view('member/pencairanpinjaman',$data);
        $this->load->view('partials/footerhome');
    }
    //tagihan
    
}

