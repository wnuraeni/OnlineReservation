<style>
input{
    float:left;
}

select{
    margin:0;
    margin-top:4px;
    padding:0;
    float:left;
    margin-left:20px;
}

.pagelink {
  float:right;
  margin-left:550px;
  margin-top:12px;

}
table thead,table tr{
    border:1px solid #ccc;
}
table{
    clear:left;
    margin-top:10px;
    text-align:center;
    width:100%;
}

</style>

    <table>
        
        <th>Tanggal Request</th>
        <th>Nama Barang</th>
        <th>Merek Barang</th>
        <th>Jumlah Barang</th>
        <th>Harga Satuan</th>
        <th>Total Harga</th>
        <th>Status</th>
        <?php foreach($barang as $r):?>
        <tr>
            <td><?php echo $r['options']['tanggal_request'];?></td>
            <td><?php echo $r['name'];?></td>
            <td><?php echo $r['options']['merek_barang'];?></td>
            <td><?php echo $r['qty'];?></td>
            <td><?php echo $r['price'];?></td>
            <td><?php echo $r['subtotal'];?></td>
            <td><?php echo $r['options']['status'];?></td>

        </tr>
        <?php endforeach ;?>
        <tr><td><button name="submit" value="keluar" onclick="window.location.href='<?php echo base_url();?>manager_keuangan/pembelian_controller/request_barang'">Keluar</button></td></tr>
    </table>
