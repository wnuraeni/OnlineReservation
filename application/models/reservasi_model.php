<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class reservasi_model extends CI_Model{ 
    
function __contruct(){
    parent :: __construct();
}

    
function ambil_reservasi($where=null,$like=null,$limit=10,$offset=0){
    $this->db->select('*');
    $this->db->from('booking');
    $this->db->join('lapangan','booking.id_lapangan=lapangan.id_lapangan');
    $this->db->join('pelanggan','pelanggan.id_member=booking.id_member','left');
    if(!empty($where)){
        $this->db->where($where);
    }
    if(!empty($like)){
        $this->db->like($like);
    }
    $this->db->limit($limit,$offset);
    $this->db->group_by('booking.id_booking');
    $this->db->order_by('booking.id_booking','desc');
    $query=$this->db->get();
    return $query->result();
   
  }

  function ambil_reservasi_between($where=null){
      $this->db->select('booking.nama_lapangan,pelanggan.nama_pelanggan, booking.jam,booking.lama_pemakaian,
          SUM(pembayaran.total_pembayaran) as total_pembayaran, booking.status_pembayaran,booking.tanggal_booking,
          lapangan.jenis_lapangan,lapangan.sewa_lapangan');
      $this->db->from('booking');
      $this->db->join('lapangan','booking.id_lapangan=lapangan.id_lapangan');
      $this->db->join('pelanggan','pelanggan.id_member=booking.id_member');
      $this->db->join('pembayaran','booking.id_booking=pembayaran.id_booking','left');
      if(!empty($where)){
          $this->db->where($where);
      }
      $this->db->group_by('booking.id_booking');
      $this->db->order_by('booking.tanggal_booking','asc');
      $query=$this->db->get();
      return $query->result();
  }
function ambil_total_reservasi($like=null,$where=null){
    $this->db->select('*');
    $this->db->from('booking');
    $this->db->join('pelanggan','pelanggan.id_member=booking.id_member');
    $this->db->join('lapangan','lapangan.id_lapangan=booking.id_lapangan');
    if(!empty($where)){
        $this->db->where($where);
    }
    if(!empty($like)){
        $this->db->like($like);
    }
    $query=$this->db->get();
    return $query->num_rows();
}
function pesan($data){
    if(empty($data['id_member'])){
        $id_member = uniqid("NM_");
        $data_user = array('id_member'=>  $id_member,
            'nama_pelanggan'=>$data['nama'],
            'alamat_pelanggan'=>$data['alamat'],
            'telepon_pelanggan'=>$data['telepon']);
        $insert_pelanggan = $this->db->insert('pelanggan',$data_user);;
    }else{
        $id_member = $data['id_member'];
        $insert_pelanggan = true;
    }
    $data_booking = array(
           'id_kasir'=>$data['id_kasir'],
           'id_member'=>  $id_member,'id_lapangan'=>$data['id_lapangan'],
           'tanggal_booking'=>$data['tanggal_booking'],
           'jam'=>$data['jam'],
           'nama_lapangan'=>$data['nama_lapangan'],
           'harga_lapangan'=>$data['harga_lapangan'],
           'lama_pemakaian'=>$data['lama_pemakaian'],
           'status_pembayaran'=>'belum dibayar',
           'status_booking'=>$data['status_booking']);
    $insert_book = $this->db->insert('booking',$data_booking);
    
    if($insert_book){

        $var=$this->db->insert_id();

        return $var;
    }else {
        return false;
    }
}

function checkin($id_booking){
    $this->db->where('id_booking',$id_booking);
    $this->db->update('booking',array('status_booking'=>'checkin'));

}

function batal($id_booking=null,$data=null){
    //batal satu booking
    $this->db->where('id_booking',$id_booking);
    $this->db->update('booking',$data);
    
 }
function pembatalan($ids){
    foreach($ids as $id){
        $this->db->where('id_booking',$id);
        $this->db->update('booking',array('status_booking'=>'batal'));
    }
}

function sewa_selesai($id_booking){
   date_default_timezone_set('Asia/Jakarta');
    $query=$this->db->get_where('booking',array('id_booking'=>$id_booking));
    $sewa=$query->result();
    $tgl_sewa = $sewa[0]->tanggal_booking;
    $jam=$sewa[0]->jam;
    $lama_pemakaian=strtotime(date('Y-m-d H:i:s'))-strtotime($tgl_sewa.' '.$jam);

    $lama_pakai=floor($lama_pemakaian/3600);
    $this->db->where('booking.id_booking',$id_booking);
    $this->db->update('booking',array('status_booking'=>'selesai','lama_pemakaian'=>$lama_pakai));
 
 }
function ambil_total_lama_pemakaian($where=null){
    $this->db->select('SUM(lama_pemakaian) as lama_pemakaian');
    $this->db->from('booking');
    $this->db->join('pelanggan','pelanggan.id_member=booking.id_member');
    if(!empty($where)){
        $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->row();
}

function cek_reservasi(){

// ambil data booking yang belum pada bayar
//   $query = $this->db->query("SELECT * FROM booking INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
//        WHERE (tanggal_booking < CURDATE() OR SUBDATE(tanggal_booking, INTERVAL 1 DAY) <= CURDATE())
//        AND status_booking = 'booking' AND status_pembayaran=''");
    $query = $this->db->query("SELECT * FROM booking INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
        WHERE status_booking = 'booking' AND status_pembayaran='belum dibayar'");
    return $query->result();
}
function cek_dp(){
//    $query = $this->db->query("SELECT * FROM booking INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
//        WHERE (tanggal_booking < CURDATE() OR SUBDATE(tanggal_booking, INTERVAL 1 DAY) <= CURDATE())
//        AND status_booking = 'booking' AND status_pembayaran='pembayaran dp1'");
     $query = $this->db->query("SELECT * FROM booking INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
        WHERE status_booking = 'booking' AND status_pembayaran='pembayaran dp1'");
   return $query->result();
}
function cek_now(){
    $query = $this->db->query("SELECT * FROM (`booking`)JOIN  `lapangan` ON  `booking`.`id_lapangan` =  `lapangan`.`id_lapangan` 
LEFT JOIN  `pelanggan` ON  `pelanggan`.`id_member` =  `booking`.`id_member` WHERE  `status_booking`= 'checkin' ORDER BY  `booking`.`id_booking` DESC ");
    return $query->result();
}
function pembayaran($data){
    $query1=$this->db->insert('pembayaran',$data);
    $id_pembayaran = $this->db->insert_id();
    $this->db->where('id_booking',$data['id_booking']);
    $query2=$this->db->update('booking',
            array(
                'status_pembayaran'=>$data['keterangan_pbyr'],
                'tanggal_pembayaran'=>$data['tanggal_pbyr'],
                ));
    
    if($query1 && $query2 ){
        return true;
    }else {
        return false;
    }
}
function ambil_pembayaran($where=null){
    $this->db->select('id_booking,id_pembayaran,
        MIN(status_pbyr) as status_pbyr,
        MAX(tanggal_pbyr) as tanggal_pbyr, bukti_pbyr,
        MIN(keterangan_pbyr) as keterangan_pbyr,
        SUM(total_pembayaran) as total_pembayaran');
    $this->db->from('pembayaran');
    if(!empty($where)){
        $this->db->where($where);
    }
    $this->db->group_by('id_booking');
    $query = $this->db->get();
    return $query->result();
}
function konfirmasi_pembayaran($id_pembayaran){
    //ambil keterangan klo dp2 update status jd lunas
    $query_keterangan = $this->db->get_where('pembayaran',array('id_pembayaran'=>$id_pembayaran));
    $result_keterangan = $query_keterangan->row();
    $keterangan =$result_keterangan->keterangan_pbyr;
    $id_booking = $result_keterangan->id_booking;
    
    $this->db->where('id_booking',$id_booking);
    $this->db->update('booking',array('status_pembayaran'=>$result_keterangan->keterangan_pbyr));
    $status = '';
    if($result_keterangan->keterangan_pbyr == 'pembayaran dp1'){
        $status = 'dp1';
    }
    else{
        $status = 'lunas';
    }
    $this->db->where('id_pembayaran',$id_pembayaran);
    $this->db->update('pembayaran',array('status_pbyr'=>$status));

}
function ambil_konfirmasi_pembayaran($id_booking){
    $query = $this->db->query("SELECT booking.id_booking,`booking`.`harga_lapangan`, `booking`.`lama_pemakaian`,
            MAX(`pembayaran`.`status_pbyr`) as status_pbyr, MAX(pembayaran.tanggal_pbyr) as tanggal_pbyr,
            MAX(`pembayaran`.`bukti_pbyr`) as bukti_pbyr,
            MIN(`pembayaran`.`keterangan_pbyr`) as keterangan_pbyr,
            SUM(pembayaran.total_pembayaran) as total_pembayaran
            FROM (`booking`)
            LEFT JOIN `pembayaran` ON `pembayaran`.`id_booking`=`booking`.`id_booking`
            WHERE  `booking`.`id_booking`  = '$id_booking'
            GROUP BY `pembayaran`.`id_booking`");
    return $query->row();
}
function get_detail_reservasi($id_reservasi=null){
    $html = "";
    $data_reservasi = $this->ambil_reservasi(array('id_booking'=>$id_reservasi));
    $data_pembayaran = $this->ambil_detail_pembayaran(array('id_booking'=>$id_reservasi));
    $html .= '<table>
            <tr><td>No Booking</td><td>:</td><td>'.$data_reservasi[0]->id_booking.'</td></tr>
            <tr><td>Nama</td><td>:</td><td>'.$data_reservasi[0]->nama_pelanggan.'</td></tr>
            <tr><td>Alamat</td><td>:</td><td>'.$data_reservasi[0]->alamat_pelanggan.'</td></tr>
            <tr><td>Telepon</td><td>:</td><td>'.$data_reservasi[0]->telepon_pelanggan.'</td></tr>
            <tr><td>Tanggal booking</td><td>:</td><td>'.$data_reservasi[0]->tanggal_booking.'</td></tr>
            <tr><td>Jam mulai</td><td>:</td><td>'.$data_reservasi[0]->jam.'</td></tr>
            <tr><td>Nama Lapangan</td><td>:</td><td>'.$data_reservasi[0]->nama_lapangan.'</td></tr>
            <tr><td>Lama Pemakaian</td><td>:</td><td>'.$data_reservasi[0]->lama_pemakaian.' jam</td></tr>
            <tr><td>Biaya sewa perjam</td><td>:</td><td>Rp. '.number_format($data_reservasi[0]->harga_lapangan, 0,'','.').'</td></tr>
            <tr><td>Status Pembayaran</td><td>:</td><td>'.$data_reservasi[0]->status_pembayaran.'</td></tr>
            <tr><td>Status booking</td><td>:</td><td>'.$data_reservasi[0]->status_booking.'</td></tr>
            </table>';
            if($data_reservasi[0]->status_pembayaran != 'lunas' && $data_reservasi[0]->status_booking != 'batal' ){   
                $html .= '<button class="button" onclick="pembayaran('.$id_reservasi.')" style="font-weight:bold; color: black">Tambah Pembayaran</button>';
            }
            else{
                $html .= '<br><h3>Histori Pembayaran</h3>';
            }
            $html .= '<table><tr><th>Tanggal Pembayaran</th><th>Jumlah Bayar</th><th>Bukti Pembayaran</th><th>Keterangan</th><th>Status Pembayaran</th><th>Aksi</th></tr>';
    foreach($data_pembayaran as $data){
            $html .= '<tr>
                <td>'.$data->tanggal_pbyr.'</td>
                <td>Rp. '.number_format($data->total_pembayaran, 0,'','.').'</td>
                <td><img src="'.base_url().'images/'.$data->bukti_pbyr.'" height="50" width="50"></td>
                <td>'.$data->keterangan_pbyr.'</td>
                <td>'.$data->status_pbyr.'</td>
                <td>';
            if(($data->status_pbyr == 'dp1')||($data->status_pbyr == 'lunas')){
                $html .= '';
            }else{
                $html .= '<a href="'.base_url().'index.php/kasir/reservasi_controller/konfirmasi_pembayaran/'.$id_reservasi.'/'.$data->id_pembayaran.'">Konfirmasi</a>';
            }
                $html .= '</td>
                </tr>';
    }
    $html .= '</table>';
    if(strpos($data_reservasi[0]->status_pembayaran,'30%')){
        $html .= '<button onclick="window.location.href=\''.base_url().'index.php/kasir/reservasi_controller/receipt/'.$id_reservasi.'\'" style="font-weight:bold; color: black">Cetak</button>';
    }else{
        $html .= '<button onclick="window.location.href=\''.base_url().'index.php/kasir/reservasi_controller/claim_refund/'.$id_reservasi.'\'" style="font-weight:bold; color: black">Claim Refund</button>
        <button onclick="window.location.href=\''.base_url().'index.php/kasir/reservasi_controller/receipt/'.$id_reservasi.'\'" style="font-weight:bold; color: black">Cetak</button>';
    }    
    return $html;
}
function claim_refund($id_reservasi=null){
    $query = $this->db->get_where('pembayaran',array('id_booking'=>$id_reservasi));
    $result = $query->result();
    $total = 0;
    foreach($result as $res){
        $total += $res->total_pembayaran;
    }
    $refund = 0.3 * $total;
    $this->db->where('id_booking',$id_reservasi);
    $query = $this->db->update('booking',
            array('status_pembayaran'=>'dikembalikan 30% dari pembayaran sejumlah : Rp. '.$refund
                 , 'status_booking'=>'batal'));
    if($query){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

function ambil_detail_pembayaran($where=null){
    $this->db->select('id_booking,id_pembayaran,
        (status_pbyr) as status_pbyr,
        (tanggal_pbyr) as tanggal_pbyr, bukti_pbyr,
        (keterangan_pbyr) as keterangan_pbyr,
        (total_pembayaran) as total_pembayaran');
    $this->db->from('pembayaran');
    if(!empty($where)){
        $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
}

function ambil_detail_pembayaran_checkin($where=null){
     $this->db->select('booking.id_booking,id_pembayaran,
        (status_pbyr) as status_pbyr,
        (tanggal_pbyr) as tanggal_pbyr, bukti_pbyr,
        (keterangan_pbyr) as keterangan_pbyr,
        SUM(total_pembayaran) as total_pembayaran,
        booking.nama_lapangan, booking.lama_pemakaian, booking.harga_lapangan,
        booking.jam, user.nama,
        pelanggan.nama_pelanggan, pelanggan.alamat_pelanggan, pelanggan.telepon_pelanggan');
    $this->db->from('pembayaran');
    $this->db->join('booking','booking.id_booking=pembayaran.id_booking');
    $this->db->join('pelanggan','booking.id_member = pelanggan.id_member');
    $this->db->join('user','user.user_id = booking.id_kasir','left');
    if(!empty($where)){
        $this->db->where($where);
    }
    $this->db->group_by('pembayaran.id_booking');
    $query = $this->db->get();
    return $query->result();
}
function template_konfirmasi($id_reservasi){
      $reservasi = $this->ambil_reservasi(array('id_booking'=>$id_reservasi));
         $html = '<h5>Terima Kasih Telah Melakukan Pesanan</h5>
                <p>Silakan Datang 30 menit Sebelum Waktu yang telah Anda pesan</p>
                <p>Simpan Bukti dibawah untuk Bukti Konfirmasi Pesanan</p>

                <table>
                <tr><td>No Booking</td><td>'.$reservasi[0]->id_booking.'</td></tr>
                <tr><td>Nama Lapangan</td><td>'. $reservasi[0]->nama_lapangan.'</td></tr>
                <tr><td>Tanggal Sewa</td><td>'. $reservasi[0]->tanggal_booking.'</td></tr>
                <tr><td>Jam Sewa</td><td>'. $reservasi[0]->jam.'</td></tr>
                <tr><td>Lama Pemakaian</td><td>'. $reservasi[0]->lama_pemakaian.' jam</td></tr>
                <tr><td>Nama</td><td>'. $reservasi[0]->nama_pelanggan.'</td></tr>
                <tr><td>Alamat</td><td>'. $reservasi[0]->alamat_pelanggan.'</td></tr>
                <tr><td>Telepon</td><td>'. $reservasi[0]->telepon_pelanggan.'</td></tr>
                </table>';
         return $html;
}
function template_receipt($id_reservasi){
     $reservasi=$this->ambil_reservasi(array('id_booking'=>$id_reservasi));
     $pembayaran=  $this->ambil_detail_pembayaran(array('id_booking'=>$id_reservasi));
     $html = "";
     $html .= '<div style="text-align:center">
<h3>Bukti Pembayaran Reservasi</h3>
<hr>
</div>
    <table style="margin:auto" width="50%">
            <tr><td><strong>No Booking</strong></td><td>:</td><td>'.$reservasi[0]->id_booking.'</td></tr>
            <tr><td><strong>Nama</strong></td><td>:</td><td>'.$reservasi[0]->nama_pelanggan.'</td></tr>
            <tr><td><strong>Alamat</strong></td><td>:</td><td>'.$reservasi[0]->alamat_pelanggan.'</td></tr>
            <tr><td><strong>Telepon</strong></td><td>:</td><td>'.$reservasi[0]->telepon_pelanggan.'</td></tr>
            <tr><td><strong>Tanggal booking</strong></td><td>:</td><td>'.$reservasi[0]->tanggal_booking.'</td></tr>
            <tr><td><strong>Jam mulai</strong></td><td>:</td><td>'.$reservasi[0]->jam.'</td></tr>
            <tr><td><strong>Nama Lapangan</strong></td><td>:</td><td>'.$reservasi[0]->nama_lapangan.'</td></tr>
            <tr><td><strong>Lama Pemakaian</strong></td><td>:</td><td>'.$reservasi[0]->lama_pemakaian.' jam</td></tr>
            <tr><td><strong>Biaya sewa perjam</strong></td><td>:</td><td>Rp. '.number_format($reservasi[0]->harga_lapangan, 0,'','.').'</td></tr>
            <tr><td><strong>Status Pembayaran</strong></td><td>:</td><td>'.$reservasi[0]->status_pembayaran.'</td></tr>
                <tr><td colspan="3"><hr></td></tr>
            <tr><td><strong>Total harus dibayar</strong></td><td>:</td><td>
            Rp. '.number_format($reservasi[0]->harga_lapangan * $reservasi[0]->lama_pemakaian, 0,'','.').'</td></tr>
                <tr><td colspan="3"><hr></td></tr>
            </table>
           <table style="margin:auto" width="50%">

           <tr ><th colspan="3" style="text-align:center">Catatan Pembayaran</th></tr>
            <tr><td colspan="3"><hr></td></tr>
            <tr>
            <th>Tanggal Pembayaran</th>
            <th>Jumlah Bayar</th>
            <th>Keterangan</th>
            </tr>';
            $total = 0;
    foreach($pembayaran as $data){
            $html .= '<tr>
                <td>'.$data->tanggal_pbyr.'</td>
                <td>Rp. '.number_format($data->total_pembayaran, 0,'','.').'</td>
                <td>'.$data->keterangan_pbyr.'</td>
                <td></td></tr>';
                $total += $data->total_pembayaran;
    }
    $harus_dibayar = $reservasi[0]->harga_lapangan * $reservasi[0]->lama_pemakaian;
    $html .= '<tr><td colspan="3"><hr></td></tr>
    <tr><td><strong>Total telah dibayar </strong></td><td>:</td><td>Rp. '.number_format($total, 0,'','.').'</td></tr>
    <tr><td><strong>Sisa yang harus dibayar </strong></td><td>:</td><td>Rp. '.number_format(($harus_dibayar - $total), 0,'','.').'</td></tr>
    </table>';
    return $html;
}

}
?>
