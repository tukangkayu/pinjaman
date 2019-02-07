<?php
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();
        @$role = $_SESSION['logged_admin'];
        if(empty($role)){
            redirect('login/admin');
        }
        $this->load->model(['madmin','mmember','msaldo','mpinjaman','mdana','mtagihan','mrating','mnotification']);
        $this->setstartpinjaman();
        $this->kirimtagihanpinjaman();
        $this->kirimdenda();
        $this->cekselesai();
	}
    public function cekselesai(){
        $pinjamanjalan = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0]);
        foreach($pinjamanjalan as $h){
            $day=strtotime(Date("Y-m-d"))-(strtotime($h->updated_at));
            $day = $day / (60 * 60 * 24);
            $day= (int)$day;
              // $enddays = strtotime('+'.(30-$day).' days', strtotime($p->updated_at));
            $enddays = strtotime('+30 days', strtotime($h->updated_at));
            $enddays = strtotime('-'.($day).' days', $enddays);
            $end = $enddays - strtotime($h->updated_at);
            $text = $end<=0?"Berakhir":($end / (60 * 60 * 24))." hari lagi";
            $tagihan = $this->mtagihan->ambilTagihan(['id_pinjaman'=>$h->id,'status'=>1]);
            $tagihan = count($tagihan);
            if($end<=0 && $h->lama_pinjaman==$tagihan){
                $this->madmin->selesai($h->id);
            }
        }
    }
	public function index(){
        $data=[];
        $saldo = $this->msaldo->ambilSaldo(array('status'=>0));
        $member= $this->mmember->ambilSemuaMember(['nama_member !='=>"",'statusverifikasi'=>'0']);
        $pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>0]);
        $dana = $this->mdana->ambilPemindahan(['status'=>0]);
        $pencairan = $this->msaldo->ambilPencairan(['status'=>0]);
        $tagihan = $this->mtagihan->ambilTagihan(['status'=>0,'fotobukti !='=>'']);
        $data['member']= $member;
        $data['dana']=$dana;
        $data['saldo'] =$saldo;
        $data['pencairan']= $pencairan;
        $data['pinjaman']= $pinjaman;
        $data['tagihan'] = $tagihan;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/index',$data);
        $this->load->view('partials/footer');
	}
    public function kirimtagihanpinjaman(){
        $pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0,'start_at != '=>'0000-00-00']);
        foreach($pinjaman as $p){
            // $tagihan = $this->mtagihan->ambilTagihanBulanan($p->id)[0];
            $next = strtotime('+1 month', strtotime($p->start_at));
            $waktu = strtotime('-5 days',$next);
            $waktu_date = date("Y-m-d", $waktu);
            if($waktu_date ==date("Y-m-d")){
                $checknotif = $this->mnotification->userNotification(['id_member'=>$p->id_member,'tgl_dibuat LIKE '=>'%'.$waktu_date.'%','notification LIKE '=>'%tagihan%']);
                if(count($checknotif)==0){
                    $datanotif = array(
                        'id_member'=>$p->id_member,
                        'notification'=>'Segera bayar tagihan anda sebelum terkena denda <a  href="'.base_url().'pinjaman/tagihan/'.$p->id.'">Bayar Tagihan</a>',
                        'id_dokumen'=>0,
                        'is_read'=>0
                    );
                    $this->madmin->kirimtagihan($datanotif);                    
                }
            }
        }
    }
    public function kirimdenda(){
        $pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0,'start_at != '=>'0000-00-00']);
        foreach($pinjaman as $p){
            $tagihan = $this->mtagihan->ambilTagihanBulanan($p->id);
            if(count($tagihan)>0){
                $tagihan= $tagihan[0];
                $start = strtotime($tagihan->tgltagihan);
                // $start = strtotime("-1 days",strtotime(Date("Y-m-d")));
                $now = time();
                $selisih = ($start-$now)/ (60 * 60 * 24);
                $selisih=ceil($selisih); 
                $denda=ceil(abs($selisih)/7)/100*$tagihan->totaltagihan;
                // echo $selisih<0?"habis":"belum";    
                if($selisih<0){
                    $this->madmin->kirimdenda($tagihan->id,$denda);                                
                }                
            }

        }
    }
    // public function kirimtagihan(){
    //     $pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0,'start_at != '=>'0000-00-00']);
    //     foreach($pinjaman as $p){
    //         $next=strtotime('+1 month', strtotime($p->start_at));
    //         $waktu = strtotime('-5 days',$next);
    //         $waktu_date = date("Y-m-d", $waktu);
    //         $tagihan = $this->mtagihan->ambilTagihanBulanan($p->id);
    //         $stagihan = $this->mtagihan->ambilTagihan(['id_pinjaman'=>$p->id]);
    //         if(count($tagihan)==0){
    //             $data=array(
    //                 'id_member'=>$p->id_member,
    //                 'id_pinjaman'=>$p->id,
    //                 'angsuranke'=>count($stagihan)+1,
    //                 'totaltagihan'=>100000,
    //                 'tgltagihan'=>Date("Y-m-d")
    //             );
    //             $this->mtagihan->kirimtagihan($data);
    //         }
    //     }
    // }
    public function setstartpinjaman(){
        $pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0]);
        foreach($pinjaman as $p){
            $lender = $this->mdana->ambilPemindahan(['id_pinjaman'=>$p->id,'status'=>1]);
            $total = 0;
            foreach($lender as $t){
                $total += $t->jumlah;
            }
            if($p->start_at=="0000-00-00"){
                $selisih = $p->jumlah_pinjaman-$total;
                if($selisih==0){
                    
                    $this->madmin->setstart($p->id);
                }           
            }

        }
    }
    //pencairan
    public function verifikasipencairan(){
        $cair= $this->msaldo->ambilPencairan(['status'=>0,'jenis'=>0]);
        $data['cair'] =$cair;

        $cairpinjaman= $this->msaldo->ambilPencairan(['status'=>0,'jenis'=>1]);
        $data['cairpinjaman'] =$cairpinjaman;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/verifikasipencairan',$data);
        $this->load->view('partials/footer');
    }
    public function detailverifikasipencairan($id){
        $cair = $this->msaldo->ambilPencairan(['id'=>$id])[0];
        $member = $this->mmember->ambilSemuaMember(['id_member'=>$cair->id_member])[0];
        $data['cair'] = $cair;
        $data['member']=$member;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $status = isset($data['reject'])?2:1;
            $data['status']=$status;
            $data['id']=$id;
            $data['jenis']=$cair->jenis;
            $data['id_member']=$cair->id_member;
            $this->msaldo->verifikasiPencairan($data);
            redirect('/admin/verifikasipencairan');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailverifikasipencairan',$data);
        $this->load->view('partials/footer');
    }
    //pemindahan dana
    public function verifikasipindahdana(){
        $dana = $this->mdana->ambilPemindahan(['status'=>0]);
        $data['dana'] = $dana;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/verifikasipemindahan',$data);
        $this->load->view('partials/footer');
    }
    public function detailverifikasipindah($id){
        $dana = $this->mdana->ambilPemindahan(['id'=>$id])[0];
        $member= $this->mmember->ambilSemuaMember(['id_member'=>$dana->id_member])[0];
        $pinjam = $this->mpinjaman->ambilPinjaman(['id'=>$dana->id_pinjaman])[0];
        $data['dana'] = $dana;
        $data['member'] = $member;
        $data['pinjam'] = $pinjam;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->load->library('pdf');
            $data = $this->input->post();
            $filename=$member->nama_member."_invoice_".$pinjam->nama_pinjaman."_".Date("dmYis").".pdf";
            $this->pdf->setPaper('A4','portrait');
            $this->pdf->filename = $filename;
            $data['filename'] = $filename;
            $data['kode_pinjaman']=$pinjam->kode_pinjaman;
            $data['pinjam'] = $pinjam;
            $data['dana'] = $dana;
            $this->pdf->load_view('member/invoice',$data);
            $status = isset($data['reject'])?2:1;
            $data['status']=$status;
            $data['id']=$id;
            $data['id_member']=$member->id_member;
            $this->mdana->verifikasiDana($data);
            redirect('/admin/verifikasipindahdana');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailverifikasipemindahan',$data);
        $this->load->view('partials/footer');
    }
    //verifikasi
    //verifikasi member
    public function verifikasimember(){
        $members = $this->mmember->ambilSemuaMember(['statusverifikasi !='=>1]);
        $data['members'] = $members;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/verifikasimember',$data);
        $this->load->view('partials/footer');
    }
    public function detailverifikasimember($id){
        $member = $this->mmember->ambilSemuaMember(['id_member'=>$id])[0];
        $data['member'] = $member;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $status = isset($data['reject'])?2:1;
            $data['status']=$status;
            $data['id']=$id;
            $this->mmember->konfirmasiMember($data);
            redirect('/admin/verifikasimember');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailverifikasimember',$data);
        $this->load->view('partials/footer');
    }
    //verifikasi saldo
    public function verifikasisaldo(){
        $saldo = $this->msaldo->ambilSaldo([]);
        $data['saldo'] = $saldo;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/verifikasisaldo',$data);
        $this->load->view('partials/footer');
    }
    public function detailverifikasisaldo($id){
        $saldo = $this->msaldo->ambilSemuaSaldo(['id_saldo'=>$id])[0];
        $data['saldo'] = $saldo;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $status = isset($data['reject'])?2:1;
            $data['status']=$status;
            $data['id_member'] = $_SESSION['id_member'];
            $data['id']=$id;
            $this->msaldo->updateSaldo($data);
            redirect('/admin/verifikasisaldo');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailverifikasisaldo',$data);
        $this->load->view('partials/footer');
    }//verifikasi pinjaman
    public function historypinjaman($id){
        $pindah = $this->mdana->ambilPemindahan(['id_pinjaman'=>$id]);
        $tagihan = $this->mtagihan->ambilTagihan(['id_pinjaman'=>$id]);
        $pinjam = $this->mpinjaman->ambilPinjaman(['id'=>$id])[0];
        $data['pindah'] = $pindah;
        $data['tagihan'] = $tagihan;
        $data['pinjam'] = $pinjam;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailhistorypinjaman',$data);
        $this->load->view('partials/footer');
    }
    public function kembalikanpinjaman($id){
        $pindah = $this->mdana->ambilPemindahan(['id_pinjaman'=>$id]);
        $data['pindah'] = $pindah;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->mdana->pengembalian($id);
            $msg='Semua dana berhasil dikembalikan ke saldo member';
            setcookie('pesan_kembalidana',$msg,time()+60,'/');
            redirect('/admin/pinjaman');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailkembalipinjaman',$data);
        $this->load->view('partials/footer');
    }
    public function verifikasitagihan(){
        $tagihan = $this->mtagihan->ambilTagihan(['status'=>0,'fotobukti !='=>'']);
        $data['tagihan'] = $tagihan;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/verifikasitagihan',$data);
        $this->load->view('partials/footer');
    }
    public function detailverifikasitagihan($id){
        $tagihan = $this->mtagihan->ambilTagihan(['id'=>$id])[0];
        $member = $this->mmember->ambilSemuaMember(array('id_member'=>$tagihan->id_member))[0];
        $data['tagihan'] = $tagihan;
        $data['member'] = $member;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $status = isset($data['reject'])?2:1;
            $data['status']=$status;
            $data['id']=$id;
            $this->mtagihan->updateTagihan($data);
            redirect('/admin/verifikasitagihan');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailverifikasitagihan',$data);
        $this->load->view('partials/footer');
    }
    public function verifikasipinjaman(){
        $pinjaman = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>0]);
        $data['pinjaman'] = $pinjaman;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/verifikasipinjaman',$data);
        $this->load->view('partials/footer');
    }
    public function detailverifikasipinjaman($id){
        @$pinjaman = $this->mpinjaman->ambilPinjaman(['id'=>$id])[0];
        $member= $this->mmember->ambilSemuaMember(['id_member'=>$pinjaman->id_member])[0];
        @$detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$id])[0];
        @$detailusaha = $this->mpinjaman->detailUsaha(['id_pinjaman'=>$id])[0];
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->input->post();
            $status = isset($data['reject'])?2:1;
            $data['status']=$status;
            $data['id_member'] = $member->id_member;
            $data['id']=$id;
            $this->mpinjaman->verifikasiPinjaman($data);
            redirect('/admin/pinjaman');
        }
        $data['pinjaman'] = $pinjaman;
        $data['detail'] = $detail;
        $data['detailusaha'] = $detailusaha;
        $data['member']=$member;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailverifikasipinjaman',$data);
        $this->load->view('partials/footer');
    }
    public function detailpinjaman($id){
        @$pinjaman = $this->mpinjaman->ambilPinjaman(['id'=>$id])[0];
        $member= $this->mmember->ambilSemuaMember(['id_member'=>$pinjaman->id_member])[0];
        @$detail = $this->mpinjaman->detailPinjaman(['id_pinjaman'=>$id])[0];
        @$detailusaha = $this->mpinjaman->detailUsaha(['id_pinjaman'=>$id])[0];
        $data['pinjaman'] = $pinjaman;
        $data['detail'] = $detail;
        $data['detailusaha'] = $detailusaha;
        $data['member']=$member;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailpinjaman',$data);
        $this->load->view('partials/footer');
    }
    //member
    public function member(){
        $members = $this->mmember->ambilSemuaMember(['statusverifikasi'=>1]);
        $data['members'] = $members;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/member',$data);
        $this->load->view('partials/footer');
    }
    public function banned($id){
        $member = $this->mmember->ambilSemuaMember(['id_member'=>$id]);
        $data['member'] = $member[0];
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data= $this->input->post();
            $data['id_member'] =$id;
            $this->mmember->banned($data);
            redirect('/admin/member');
        }
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/bannedmember',$data);
        $this->load->view('partials/footer');
    }
    public function detailmember($id){
        $member = $this->mmember->ambilSemuaMember(['id_member'=>$id]);
        $data['member'] = $member[0];
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailmember',$data);
        $this->load->view('partials/footer');
    }
    //rating
    public function rating(){
        // $data['ratings']=[];
        $pinjam = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0]);
        $data['pinjam'] = $pinjam;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/rating',$data);
        $this->load->view('partials/footer');
    }
    public function detailrating($id){
        $rating = $this->mrating->ambilRating(['id_pinjaman'=>$id]);
        $data['rating']=$rating;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/detailrating',$data);
        $this->load->view('partials/footer');
    }
     //pinjaman
    public function pinjaman(){
        $pinjamanjalan = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>0]);
        $data['pinjamanjalan'] = $pinjamanjalan;
        $pinjamanselesai = $this->mpinjaman->ambilPinjaman(['status_pengajuan'=>1,'status_pinjaman'=>1]);
        $data['pinjamanselesai'] = $pinjamanselesai;
        $this->load->view('partials/header');
        $this->load->view('admin/partials/topbar');
        $this->load->view('admin/partials/sidebar');
        $this->load->view('admin/pinjaman',$data);
        $this->load->view('partials/footer');
    }
    //login
    public function logout(){
        session_unset();
        session_destroy();
        redirect('login/admin');
    }
}

