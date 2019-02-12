<?php

class Member extends CI_Controller {

	public function __construct() {
		parent::__construct();
        session_start();
		$this->load->model(['Mmember','mnotification','mpinjaman','mdokumen','msaldo','mrating']);
	}
    public function profile(){
        $active =  $this->router->fetch_method();
        $member  = $this->Mmember->ambilSemuaMember(array('id_member'=>$_SESSION['id_member']))[0];
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $now  = time();
            $age = strtotime('-18 years', $now);
            $minage=date("Y-m-d",$age);
            if(strtotime($data['tgllahir'])<strtotime($age)){
                $data['msgtgllahir'] = 'Usia harus 17 tahun atau lebih untuk bisa meminjam';
            }else{
                if($member->nama_member==''){
                    $this->Mmember->updateProfile($data);
                    redirect('/login/logout');                    
                }else{
                    $this->Mmember->updateProfile($data);
                    redirect('/member/profile');                                        
                }

            }
        }
        $data['active'] = $active;
        $data['member'] =$member;
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
        $totalinvestasi = 0;
        foreach($pinjam as $p){
            $totaldana = $this->db->query("select sum(jumlah) as total from pemindahandana where id_member=".$_SESSION['id_member']." and status=1 and id_pinjaman=".$p->id)->result()[0]->total;

            $totalinvestasi+=$totaldana;
        }
        $totalcair=0;
        $pinjamcair = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pengajuan'=>1]);
        foreach($pinjamcair as $p){
            $totaldana = $this->db->query("select sum(jumlah) as total from pemindahandana where status=1 and id_pinjaman=".$p->id)->result()[0]->total;
            $totalcair+=$totaldana;
        }

        $totalpencairan=0;
        $cair = $this->msaldo->ambilPencairan(['id_member'=>$_SESSION['id_member'],'jenis'=>1,'status'=>1]);
        foreach($cair as $c){
            $totalpencairan += ($c->jumlah);
        }
        $totalbunga = $this->db->query("select sum(bunga) as total from historybungapencairan where id_member = ".$_SESSION['id_member'])->result()[0]->total;
        $data['banyakcair']= count($cair);
        $data['totalbunga']=$totalbunga;
        $data['totalinvestasi'] = $totalinvestasi;
        $data['totalcair'] = ($totalcair-$totalpencairan)-$totalbunga;
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
        $totalcair=0;
        $pinjamcair = $this->mpinjaman->ambilPinjaman(['id_member'=>$_SESSION['id_member'],'status_pengajuan'=>1]);
        $totalpinjaman = 0;
        foreach($pinjamcair as $p){
            $totaldana = $this->db->query("select sum(jumlah) as total from pemindahandana where id_pinjaman=".$p->id." and status=1")->result()[0]->total;
            $totalcair+=$totaldana;
            $totalpinjaman = $p->jumlah_pinjaman;
        }
        $cair = $this->msaldo->ambilPencairan(['id_member'=>$_SESSION['id_member'],'jenis'=>1,'status'=>1]);
        $totalpencairan=0;
        $totalbunga = $this->db->query("select sum(bunga) as total from historybungapencairan where id_member = ".$_SESSION['id_member'])->result()[0]->total;
        foreach($cair as $c){
            $totalpencairan += $c->jumlah;
        }
        $data['maxcair'] = ($totalcair-$totalpencairan)-$totalbunga;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            // $data['totalcair'] = $totalcair;
            if($totalcair<$totalpinjaman){
                $msg='Pencairan pinjaman bisa dilakukan setelah semua dana telah terkumpul.Atau saat masa berakhir pinjaman mencapai  80% dari jumlah pinjaman';
                setcookie('pesan_pencairanpinjaman',$msg,time()+60,'/');
                redirect('/member/pencairanpinjaman');
            }
            $check = $this->msaldo->ambilPencairan(['id_member'=>$_SESSION['id_member'],'jenis'=>1,'status'=>0]);
            if(count($check)>0){
                $msg='Pencairan sebelumnya masih pending.Harus menunggu pencairan diverifikasi.';
                setcookie('pesan_pencairanpinjaman',$msg,time()+60,'/');
                redirect('/member/pencairanpinjaman');
            }
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

