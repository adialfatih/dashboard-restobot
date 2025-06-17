<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        if($this->session->userdata('login_form') != "bot-as1563sd1123sfasda2389asff53afhafaf670fa"){
            redirect(base_url('login'));
        }
    }
    
    function index(){ 
        
    } //end
    function batalkanPembayaranCash(){
        $tipe2      = "Cash";
        $kodeOrder  = $this->input->post('kodeOrder', TRUE);
        $kodeOrder  = strtoupper($kodeOrder);
        $html       = "";
        if (is_numeric($kodeOrder)) {
            $kodeOrder = 'OR' . str_pad($kodeOrder, 3, '0', STR_PAD_LEFT); // 3 digit
        }
        $sql        = "SELECT kode_pesanan,nomor_wa,metode_pembayaran,total_harga,status FROM pesanan WHERE kode_pesanan = ? AND metode_pembayaran = ?";
        $data       = $this->db->query($sql, [$kodeOrder, $tipe2]);
        if($data->num_rows() == 1){
            $id       = $data->row("kode_pesanan");
            $total    = $data->row("total_harga");
            $nomor_wa = $data->row("nomor_wa");
            $status   = $data->row("status");
            //if($status=="Menunggu Pembayaran"){
                $this->data_model->updatedata('kode_pesanan',$id,'pesanan', ['status' => 'Dibatalkan']);
                $this->db->query("DELETE FROM pembayaran_masuk WHERE kode_pesanan='$id'");
                $response = [
                    'status' => 'success',
                    'message' => 'Pesanan Telah Dibatalkan',
                    'kode_pesanan' => $kode_pesanan,
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            $isi_pesan = "❌ Pesanan dibatalkan\n\nID Pesanan *#".$id."* \n\nKetik *Pesan* untuk kembali memesan makanan.";
            $this->data_model->kirim_notif_ke_wa($nomor_wa,$isi_pesan,'');
            
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Kode Pesanan Tidak Ditemukan',
                'kode_pesanan' => 'null',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
    }
    function batalkanPembayaranQris(){
        $kodeUnik = $this->input->post('kodeUnik', TRUE);
        $cek = $this->db->query("SELECT * FROM pembayaran_kodeunik WHERE kode_unik='$kodeUnik' AND DATE(tanggal_code) = CURDATE()");
        if($cek->num_rows() == 1){
            $id = $cek->row("kode_pesanan");
            $nomor_wa = $this->db->query("SELECT nomor_wa FROM pesanan WHERE kode_pesanan='$id'")->row("nomor_wa");
            $this->data_model->updatedata('kode_pesanan',$id,'pembayaran_kodeunik', ['status' => 'Dibatalkan']);
            $this->data_model->updatedata('kode_pesanan',$id,'pesanan', ['status' => 'Dibatalkan']);
            $this->db->query("DELETE FROM pembayaran_masuk WHERE kode_pesanan='$id'");
            $response = [
                    'status' => 'success',
                    'message' => 'Pesanan Telah Dibatalkan',
                    'kode_pesanan' => $kode_pesanan,
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            $isi_pesan = "❌ Pesanan dibatalkan\n\nID Pesanan *#".$id."* \n\nKetik *Pesan* untuk kembali memesan makan.";
            $this->data_model->kirim_notif_ke_wa($nomor_wa,$isi_pesan,'');
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Kode unik tidak ditemukan',
                'kode_pesanan' => 'null',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
    }

    function updatePembayaranQris(){
        $kodeUnik = $this->input->post('kodeUnik', TRUE);
        $cek = $this->db->query("SELECT * FROM pembayaran_kodeunik WHERE kode_unik='$kodeUnik' AND DATE(tanggal_code) = CURDATE()");
        if($cek->num_rows() == 1){
            $id       = $cek->row("kode_pesanan");
            $tt       = $cek->row("total_asli");
            $th       = $cek->row("kode_unik");
            $td       = $cek->row("total_tagihan");
            $status2  = $cek->row("status");
            $nomor_wa = $this->db->query("SELECT nomor_wa FROM pesanan WHERE kode_pesanan='$id'")->row("nomor_wa");
            if($status2=="Menunggu Pembayaran"){
                $this->data_model->updatedata('kode_pesanan',$id,'pembayaran_kodeunik', ['status' => 'Dibayar']);
                $this->data_model->updatedata('kode_pesanan',$id,'pesanan', ['status' => 'Dibayar']);
                $this->data_model->saved('pembayaran_masuk',[
                    'kode_pesanan' => $id,
                    'nominal_tagihan' => $tt,
                    'kode_unik' => $th,
                    'total_pembayaran' => $td,
                    'tgl_terima' => date('Y-m-d H:i:s'),
                    'penerima' => $this->session->userdata('nama'),
                    'jenis_pemb' => 'QRIS'
                ]);
                $isi_pesan = "✅ Terimakasih, pembayaran telah diterima\n\nID Pesanan *#".$id."* \n\nKetik *Status* untuk melihat status pesanan anda.";
                $this->data_model->kirim_notif_ke_wa($nomor_wa,$isi_pesan,'');
                $response = [
                    'status' => 'success',
                    'message' => 'Pembayaran berhasil. Pesanan akan segera diproses.',
                    'kode_pesanan' => $id,
                    'nomorwa' => $nomor_wa,
                    'isipesan'=> $isi_pesan,
                    'mediapesan' => '',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'info',
                    'message' => 'Pesanan ini telah di bayar.!',
                    'kode_pesanan' => $id,
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            }
        } else {
            if($cek->num_rows() == 0){
                $response = [
                    'status' => 'error',
                    'message' => 'Kode unik tidak ditemukan',
                    'kode_pesanan' => 'null',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Kode Error (221) Hubungi Developer.',
                    'kode_pesanan' => 'null',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            }
        }
        echo json_encode($response);
    }
    function simpanPembayaranCash(){
        $tipe2      = "Cash";
        $kodeOrder  = $this->input->post('kodeOrder', TRUE);
        $kodeOrder  = strtoupper($kodeOrder);
        $html       = "";
        if (is_numeric($kodeOrder)) {
            $kodeOrder = 'OR' . str_pad($kodeOrder, 3, '0', STR_PAD_LEFT); // 3 digit
        }
        $sql        = "SELECT kode_pesanan,nomor_wa,metode_pembayaran,total_harga,status FROM pesanan WHERE kode_pesanan = ? AND metode_pembayaran = ?";
        $data       = $this->db->query($sql, [$kodeOrder, $tipe2]);
        if($data->num_rows() == 1){
            $id       = $data->row("kode_pesanan");
            $total    = $data->row("total_harga");
            $nomor_wa = $data->row("nomor_wa");
            $status   = $data->row("status");
            if($status=="Menunggu Pembayaran"){
                $this->data_model->updatedata('kode_pesanan',$id,'pesanan', ['status' => 'Dibayar']);
                $this->data_model->saved('pembayaran_masuk',[
                    'kode_pesanan' => $id,
                    'nominal_tagihan' => $total,
                    'kode_unik' => 0,
                    'total_pembayaran' => $total,
                    'tgl_terima' => date('Y-m-d H:i:s'),
                    'penerima' => $this->session->userdata('nama'),
                    'jenis_pemb' => 'Cash'
                ]);
                $isi_pesan = "✅ Terimakasih, pembayaran telah diterima\n\nID Pesanan *#".$id."* \n\nKetik *Status* untuk melihat status pesanan anda.";
                $this->data_model->kirim_notif_ke_wa($nomor_wa,$isi_pesan,'');
                $response = [
                    'status' => 'success',
                    'message' => 'Pembayaran berhasil. Pesanan akan segera diproses.',
                    'kode_pesanan' => $id,
                    'nomorwa' => $nomor_wa,
                    'isipesan'=> $isi_pesan,
                    'mediapesan' => '',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Status Pesanan Adalah '.$status.'',
                    'kode_pesanan' => 'null',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Kode Pesanan Tidak Ditemukan',
                'kode_pesanan' => 'null',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
    }

    function show_pesanan(){
        $tipe = $this->input->post('tipe', TRUE);
        $fromTgl = $this->input->post('fromtgl', TRUE);
        if($fromTgl=="null" || $fromTgl==""){
            $tgl_now = date('Y-m-d');
        } else {
            $tgl_now = $fromTgl;
        }
        $html = "";
        if($tipe=="all"){
            //tampilkan yang statusnya adalah sedang dibuat
            $qry1 = $this->db->query("SELECT pesanan.id, pesanan.kode_pesanan, pesanan.nomor_wa, pesanan.daftar_kode_menu, pesanan.total_harga, pesanan.metode_pengambilan, pesanan.alamat, pesanan.no_meja, pesanan.metode_pembayaran, pesanan.status, pesanan.tanggal, pesanan.created_at, user.nama FROM pesanan,user WHERE pesanan.nomor_wa=user.nomor_wa AND pesanan.status='Sedang dibuat' AND DATE(pesanan.tanggal)='$tgl_now' ORDER BY id");
            if($qry1->num_rows() > 0){
                foreach($qry1->result() as $row){
                    $idid = $row->id;
                    $nama_pemesan = strtolower($row->nama);
                    if($row->status == "Dibatalkan"){
                        $efek = "style='color:red;'";
                        $icon = "fa-xmark";
                        $icon2 = '<div class="card-icon pink"><i class="fas fa-xmark"></i></div>';
                    } elseif($row->status == "Selesai"){ 
                        $efek = "style='color:green;'";
                        $icon = "fa-circle-check";
                        $icon2 = '<div class="card-icon green"><i class="fas fa-circle-check"></i></div>';
                    } elseif($row->status=="Menunggu Pembayaran"){
                        $efek = "style='color:orange;'";
                        $icon = "fa-stopwatch";
                        $icon2 = '<div class="card-icon orange"><i class="fas fa-stopwatch"></i></div>';
                    } elseif($row->status=="Dibayar"){
                        $efek = "style='color:blue;'";
                        $icon = "fa-credit-card";
                        $icon2 = '<div class="card-icon blue"><i class="fas fa-credit-card"></i></div>';
                    } elseif($row->status=="Sedang dibuat"){
                        $efek = "style='color:#fc03be;'";
                        $icon = "fa-utensils";
                        $icon2 = '<div class="card-icon pink"><i class="fas fa-utensils"></i></div>';
                    }
                    $hasil = "";
                    $x = explode(",", $row->daftar_kode_menu);
                    $html .= '
                    <div class="card">
                        <div class="card-header" style="cursor:pointer;" onclick="showDetail('.$idid.')">
                            <div>
                                <div class="card-title">'.ucwords($nama_pemesan).'</div>
                                <div class="card-value">'.$row->kode_pesanan.'</div>
                                <div class="card-change" '.$efek.'>
                                    '.$row->status.'
                                </div>
                            </div>
                            '.$icon2.'
                        </div>
                        <div class="card-body" style="font-size:12px;">
                            ';
                    for ($i=0; $i <count($x) ; $i++) { 
                        $xx = explode('x', $x[$i]);
                        $nama_menu = $this->db->query("SELECT kode_menu,nama_menu FROM table_menu WHERE kode_menu='$xx[0]'")->row('nama_menu');
                        $html .= '<div style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                            <span>#<strong>'.$xx[0].'</strong> '.$nama_menu.'</span>
                            <span style="width:20px;">x '.$xx[1].'</span>
                            </div>
                        ';
                    }
                    if($row->status == "Sedang dibuat"){
                        $html .= '<div style="font-size:12px;border-top:1px solid #ccc;margin-top:10px;padding-top:5px;">
                            <a href="javascript:void(0);" onclick="tandaiSelesaiDibuat(\'' . $row->kode_pesanan . '\');" style="color:green;text-decoration:none;">Tandai Pesanan Selesai.</a>
                        </div>';
                    }
                    $html .= '<div style="width:100%;display:flex;justify-content:space-between;align-items:center;"><button style="outline:none;border:none;cursor:pointer;background:#4287f5;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;" onclick="printStruk()"><i class="fas fa-print"></i>&nbsp; Cetak</button>';
                    if($row->metode_pembayaran == "Cash"){
                        $html .= '<button style="outline:none;border:none;background:#078a07;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;"><i class="fas fa-money-bill"></i>&nbsp; Cash</button>';
                    } else {
                        $html .= '<button style="outline:none;border:none;background:#c90808;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;"><i class="fas fa-qrcode"></i>&nbsp; QRIS</button>';
                    }
                    $html .= '</div>
                        </div>
                    </div>
                    ';
                }
            }
            //tampilkan yang statusnya adalah dibayar
            $qry2 = $this->db->query("SELECT pesanan.id, pesanan.kode_pesanan, pesanan.nomor_wa, pesanan.daftar_kode_menu, pesanan.total_harga, pesanan.metode_pengambilan, pesanan.alamat, pesanan.no_meja, pesanan.metode_pembayaran, pesanan.status, pesanan.tanggal, pesanan.created_at, user.nama FROM pesanan,user WHERE pesanan.nomor_wa=user.nomor_wa AND pesanan.status='Dibayar' AND DATE(pesanan.tanggal)='$tgl_now' ORDER BY id");
            if($qry2->num_rows() > 0){
                foreach($qry2->result() as $row){
                    $idid = $row->id;
                    $nama_pemesan = strtolower($row->nama);
                    if($row->status == "Dibatalkan"){
                        $efek = "style='color:red;'";
                        $icon = "fa-xmark";
                        $icon2 = '<div class="card-icon pink"><i class="fas fa-xmark"></i></div>';
                    } elseif($row->status == "Selesai"){ 
                        $efek = "style='color:green;'";
                        $icon = "fa-circle-check";
                        $icon2 = '<div class="card-icon green"><i class="fas fa-circle-check"></i></div>';
                    } elseif($row->status=="Menunggu Pembayaran"){
                        $efek = "style='color:orange;'";
                        $icon = "fa-stopwatch";
                        $icon2 = '<div class="card-icon orange"><i class="fas fa-stopwatch"></i></div>';
                    } elseif($row->status=="Dibayar"){
                        $efek = "style='color:blue;'";
                        $icon = "fa-credit-card";
                        $icon2 = '<div class="card-icon blue"><i class="fas fa-credit-card"></i></div>';
                    } elseif($row->status=="Sedang dibuat"){
                        $efek = "style='color:#fc03be;'";
                        $icon = "fa-utensils";
                        $icon2 = '<div class="card-icon pink"><i class="fas fa-utensils"></i></div>';
                    }
                    $hasil = "";
                    $x = explode(",", $row->daftar_kode_menu);
                    $html .= '
                    <div class="card">
                        <div class="card-header" style="cursor:pointer;" onclick="showDetail('.$idid.')">
                            <div>
                                <div class="card-title">'.ucwords($nama_pemesan).'</div>
                                <div class="card-value">'.$row->kode_pesanan.'</div>
                                <div class="card-change" '.$efek.'>
                                    '.$row->status.'
                                </div>
                            </div>
                            '.$icon2.'
                        </div>
                        <div class="card-body" style="font-size:12px;">
                            ';
                    for ($i=0; $i <count($x) ; $i++) { 
                        $xx = explode('x', $x[$i]);
                        $nama_menu = $this->db->query("SELECT kode_menu,nama_menu FROM table_menu WHERE kode_menu='$xx[0]'")->row('nama_menu');
                        $html .= '<div style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                            <span>#<strong>'.$xx[0].'</strong> '.$nama_menu.'</span>
                            <span style="width:20px;">x '.$xx[1].'</span>
                            </div>
                        ';
                    }
                    if($row->status == "Dibayar"){
                        $html .= '<div style="font-size:12px;border-top:1px solid #ccc;margin-top:10px;padding-top:5px;">
                            <a href="javascript:void(0);" onclick="tandaiSedangDibuat(\'' . $row->kode_pesanan . '\');" style="color:red;text-decoration:none;">Tandai sedang dibuat.</a>
                        </div>';
                    }
                    $html .= '<div style="width:100%;display:flex;justify-content:space-between;align-items:center;"><button style="outline:none;border:none;cursor:pointer;background:#4287f5;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;" onclick="printStruk()"><i class="fas fa-print"></i>&nbsp; Cetak</button>';
                    if($row->metode_pembayaran == "Cash"){
                        $html .= '<button style="outline:none;border:none;background:#078a07;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;"><i class="fas fa-money-bill"></i>&nbsp; Cash</button>';
                    } else {
                        $html .= '<button style="outline:none;border:none;background:#c90808;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;"><i class="fas fa-qrcode"></i>&nbsp; QRIS</button>';
                    }
                    $html .= '</div>
                        </div>
                    </div>
                    ';
                }
            }
            //tampilkan yang statusnya adalah Menunggu Pembayaran
            $qry3 = $this->db->query("SELECT pesanan.id, pesanan.kode_pesanan, pesanan.nomor_wa, pesanan.daftar_kode_menu, pesanan.total_harga, pesanan.metode_pengambilan, pesanan.alamat, pesanan.no_meja, pesanan.metode_pembayaran, pesanan.status, pesanan.tanggal, pesanan.created_at, user.nama FROM pesanan,user WHERE pesanan.nomor_wa=user.nomor_wa AND pesanan.status='Menunggu Pembayaran' AND DATE(pesanan.tanggal)='$tgl_now' ORDER BY id");
            if($qry3->num_rows() > 0){
                foreach($qry3->result() as $row){
                    $idid = $row->id;
                    $nama_pemesan = strtolower($row->nama);
                    if($row->status == "Dibatalkan"){
                        $efek = "style='color:red;'";
                        $icon = "fa-xmark";
                        $icon2 = '<div class="card-icon pink"><i class="fas fa-xmark"></i></div>';
                    } elseif($row->status == "Selesai"){ 
                        $efek = "style='color:green;'";
                        $icon = "fa-circle-check";
                        $icon2 = '<div class="card-icon green"><i class="fas fa-circle-check"></i></div>';
                    } elseif($row->status=="Menunggu Pembayaran"){
                        $efek = "style='color:orange;'";
                        $icon = "fa-stopwatch";
                        $icon2 = '<div class="card-icon orange"><i class="fas fa-stopwatch"></i></div>';
                    } elseif($row->status=="Dibayar"){
                        $efek = "style='color:blue;'";
                        $icon = "fa-credit-card";
                        $icon2 = '<div class="card-icon blue"><i class="fas fa-credit-card"></i></div>';
                    } elseif($row->status=="Sedang dibuat"){
                        $efek = "style='color:#fc03be;'";
                        $icon = "fa-utensils";
                        $icon2 = '<div class="card-icon pink"><i class="fas fa-utensils"></i></div>';
                    }
                    $hasil = "";
                    $x = explode(",", $row->daftar_kode_menu);
                    $html .= '
                    <div class="card">
                        <div class="card-header" style="cursor:pointer;" onclick="showDetail('.$idid.')">
                            <div>
                                <div class="card-title">'.ucwords($nama_pemesan).'</div>
                                <div class="card-value">'.$row->kode_pesanan.'</div>
                                <div class="card-change" '.$efek.'>
                                    '.$row->status.'
                                </div>
                            </div>
                            '.$icon2.'
                        </div>
                        <div class="card-body" style="font-size:12px;">
                            ';
                    for ($i=0; $i <count($x) ; $i++) { 
                        $xx = explode('x', $x[$i]);
                        $nama_menu = $this->db->query("SELECT kode_menu,nama_menu FROM table_menu WHERE kode_menu='$xx[0]'")->row('nama_menu');
                        $html .= '<div style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                            <span>#<strong>'.$xx[0].'</strong> '.$nama_menu.'</span>
                            <span style="width:20px;">x '.$xx[1].'</span>
                            </div>
                        ';
                    }
                    
                    $html .= '<div style="width:100%;display:flex;justify-content:space-between;align-items:center;"><button style="outline:none;border:none;cursor:pointer;background:#4287f5;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;" onclick="printStruk()"><i class="fas fa-print"></i>&nbsp; Cetak</button>';
                    if($row->metode_pembayaran == "Cash"){
                        $html .= '<button style="outline:none;border:none;background:#078a07;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;"><i class="fas fa-money-bill"></i>&nbsp; Cash</button>';
                    } else {
                        $html .= '<button style="outline:none;border:none;background:#c90808;color:#fff;padding:5px 10px;border-radius:5px;margin-top:10px;font-size:11px;"><i class="fas fa-qrcode"></i>&nbsp; QRIS</button>';
                    }
                    $html .= '</div>
                        </div>
                    </div>
                    ';
                }
            } 
            if($qry1->num_rows() == 0 && $qry2->num_rows() == 0 && $qry3->num_rows() == 0){
                $html .= "Hari ini tidak ada pesanan.";
            }
        } else {
            //disini tampilkan bukan semua pesanan
        }
        $response = [
            'status' => $status,
            'message' => $msg,
            'html' => $html,
            'newCsrfHash' => $this->security->get_csrf_hash()
        ];
        echo json_encode($response);
    }
    function lihatOrderByKode(){
        $tipe       = $this->input->post('ktipeode', TRUE);
        $tipe2      = "Cash";
        $kodeOrder  = $this->input->post('kodeOrder', TRUE);
        $kodeOrder  = strtoupper($kodeOrder);
        $html       = "";
        if (is_numeric($kodeOrder)) {
            $kodeOrder = 'OR' . str_pad($kodeOrder, 3, '0', STR_PAD_LEFT); // 3 digit
        }
        $sql        = "SELECT * FROM pesanan WHERE kode_pesanan = ? AND metode_pembayaran = ?";
        $data       = $this->db->query($sql, [$kodeOrder, $tipe2]);
        if($data->num_rows() == 1){
            $row = $data->row_array();
            $nomorwa = $row['nomor_wa'];
            $allmenu = $row['daftar_kode_menu'];
            $x = explode(",", $allmenu);
            $nama_cus = $this->db->query("SELECT nomor_wa,nama FROM user WHERE nomor_wa = '$nomorwa'")->row('nama');
            $html .= '
                <div style="margin-top:15px;width:100%;display:flex;align-items:center;gap:10px;">
                    <span style="width:150px;">Kode Pesanan</span>
                    <div>: <span style="color:green;font-weight:bold;">'.$kodeOrder.'</span></div>
                </div>
                <div style="width:100%;display:flex;align-items:center;gap:10px;">
                    <span style="width:150px;">Nama Customer</span>
                    <span>: '.$nama_cus.'</span>
                </div>
                <div style="width:100%;display:flex;align-items:center;gap:10px;">
                    <span style="width:150px;">Total Tagihan</span>
                    <div>: Rp. <span style="color:red;font-weight:bold;">'.number_format($row['total_harga']).'</span></div>
                </div>
                <table border="1" style="margin-bottom:20px;">
                    <tr>
                        <td>No</td>
                        <td>Menu</td>
                        <td>Harga</td>
                        <td>Qty</td>
                        <td>Total</td>
                    </tr>
            ';
            for ($i=0; $i <count($x) ; $i++) { 
                $_no = $i + 1;
                $xx = explode('x', $x[$i]);
                $kode_menu = $xx[0];
                $qty = $xx[1];
                $mn = $this->db->query("SELECT kode_menu,nama_menu,harga FROM table_menu WHERE kode_menu = '$kode_menu'")->row_array();
                $nama_menu = strtolower($mn['nama_menu']);
                $harga_menu = $mn['harga'];
                $total_this = $qty * $harga_menu;
                $html .= '
                    <tr>
                        <td>'.$_no.'</td>
                        <td>#'.$kode_menu.' - '.ucwords($nama_menu).'</td>
                        <td>Rp. '.number_format($harga_menu).'</td>
                        <td>'.$qty.'</td>
                        <td>Rp. '.number_format($total_this).'</td>
                    </tr>
                ';
            }
            $html .= '</table>';
            $response = [
                'status' => 'success',
                'message' => 'Pesanan ditemukan.',
                'html' => $html,
                'kode_pesanan' => $kodeOrder,
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        } else {
            $html = '<span style="color:red;margin-top:15px;"><strong>'.$kodeOrder.'</strong> : Pesanan tidak ditemukan</span>';
            $response = [
                'status' => 'error',
                'message' => 'Pesanan tidak ditemukan.',
                'html' => $html,
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
    }
    function updateSedangDibuat(){
        $kode = $this->input->post('kode', TRUE);
        $nomor_wa  = $this->db->query("SELECT kode_pesanan,nomor_wa FROM pesanan WHERE kode_pesanan = '$kode'")->row("nomor_wa");
        $this->data_model->updatedata('kode_pesanan', $kode, 'pesanan', ['status' => 'Sedang dibuat']);
        $response = [
            'status' => 'success',
            'message' => 'Pesanan sedang dibuat.',
            'newCsrfHash' => $this->security->get_csrf_hash()
        ];
        $isi_pesan = "🍽 Pesanan sedang dibuat.";
        $this->data_model->kirim_notif_ke_wa($nomor_wa,$isi_pesan,'');
        echo json_encode($response);
    }
    function updateSelesaiDibuat(){
        $kode = $this->input->post('kode', TRUE);
        $nomor_wa  = $this->db->query("SELECT kode_pesanan,nomor_wa FROM pesanan WHERE kode_pesanan = '$kode'")->row("nomor_wa");
        $this->data_model->updatedata('kode_pesanan', $kode, 'pesanan', ['status' => 'Selesai']);
        $response = [
            'status' => 'success',
            'message' => 'Pesanan sedang dibuat.',
            'newCsrfHash' => $this->security->get_csrf_hash()
        ];
        $isi_pesan = "🍻 Pesanan anda selesai dibuat.";
        $this->data_model->kirim_notif_ke_wa($nomor_wa,$isi_pesan,'');
        echo json_encode($response);
    }
    function detilPesanan(){
        $kode = $this->input->get('id', TRUE);
        $qry1 = $this->db->query("SELECT pesanan.id, pesanan.kode_pesanan, pesanan.nomor_wa, pesanan.daftar_kode_menu, pesanan.total_harga, pesanan.metode_pengambilan, pesanan.alamat, pesanan.no_meja, pesanan.metode_pembayaran, pesanan.status, pesanan.tanggal, pesanan.created_at, pesanan.biaya_delivery, user.nama FROM pesanan,user WHERE pesanan.nomor_wa=user.nomor_wa AND pesanan.id='$kode'");
        if($qry1->num_rows() == 1){
            $tipecus = $qry1->row("metode_pengambilan");
            ?>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Kode Pesanan</span>
                <span>: &nbsp;<strong><?php echo $qry1->row("kode_pesanan"); ?></strong></span>
            </div>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Nama Customer</span>
                <span>: &nbsp;<strong><?php echo $qry1->row("nama"); ?></strong></span>
            </div>
            <?php if($tipecus == "Dine In"){ ?>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Tipe</span>
                <span>: &nbsp;<strong>Dine in</strong> (<strong><?php echo $qry1->row("no_meja"); ?></strong>)</span>
            </div>
            <?php } ?>
            <?php if($tipecus == "Take Away"){ ?>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Tipe</span>
                <span>: &nbsp;<strong>Take Away</strong></span>
            </div>
            <?php } ?>
            <?php if($tipecus == "Delivery"){ ?>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Tipe</span>
                <span>: &nbsp;<strong>Delivery</strong></span>
            </div>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Alamat Delivery</span>
                <span>: &nbsp;<strong><?php echo $qry1->row("alamat"); ?></strong></span>
            </div>
            <?php } ?>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Metode Pembayaran</span>
                <span>: &nbsp;<strong><?php echo $qry1->row("metode_pembayaran"); ?></strong></span>
            </div>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Status</span>
                <?php
                if($qry1->row("status") == "Dibatalkan"){
                    $efek = "style='color:red;'";
                } elseif($qry1->row("status") == "Selesai"){ 
                    $efek = "style='color:green;'";
                } elseif($qry1->row("status")=="Menunggu Pembayaran"){
                    $efek = "style='color:orange;'";
                } elseif($qry1->row("status")=="Dibayar"){
                    $efek = "style='color:blue;'";
                } elseif($qry1->row("status")=="Sedang dibuat"){
                    $efek = "style='color:#fc03be;'";
                }
                ?>
                <span>: &nbsp;<strong <?=$efek;?>><?php echo $qry1->row("status"); ?></strong></span>
            </div>
            <div style="width:100%;display:flex;justify-content:flex-start;align-items:center;">
                <span style="width:200px;">Waktu Pemesanan</span>
                <span>: &nbsp;<?php echo date('d M Y, H:i', strtotime($qry1->row("tanggal"))); ?></span>
            </div>
            <table border="1" style="margin:15px 0 20px 0;">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Menu</td>
                        <td>Harga</td>
                        <td>Qty</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $x = explode(',',$qry1->row("daftar_kode_menu"));
                $all_total = 0;
                for ($i=0; $i <count($x) ; $i++) { 
                    $xx = explode('x', $x[$i]);
                    $idmenu = $xx[0];
                    $qty = $xx[1];
                    $z = $this->db->query("SELECT * FROM table_menu WHERE kode_menu='$idmenu'")->row();
                    $ttl1 = $z->harga * $qty;
                    $ttl1f = number_format($ttl1);
                    $all_total += $ttl1;
                    ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $z->nama_menu; ?></td>
                        <td>Rp. <?php echo number_format($z->harga); ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>Rp. <?php echo $ttl1f; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"><?=$tipecus=="Delivery" ? "Total Menu":"<strong>Total</strong>";?></td>
                    <td></td>
                    <td>Rp. <?php echo number_format($all_total); ?></td>
                </tr>
                <?php if($tipecus == "Delivery"){ 
                $ttlDeliv = $all_total + $qry1->row("biaya_delivery");
                ?>
                <tr>
                    <td colspan="3">Biaya Kirim</td>
                    <td></td>
                    <td>Rp. <?php echo number_format($qry1->row("biaya_delivery")); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Total Tagihan</strong></td>
                    <td></td>
                    <td>Rp. <strong><?php echo number_format($ttlDeliv); ?></strong></td>
                </tr>
                <?php } ?>
                </tfoot>
            </table>
            <?php
        } else {
            echo "Error Token : 914";
        }
    }
}
?>