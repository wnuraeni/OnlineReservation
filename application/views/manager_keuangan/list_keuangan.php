<style>

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

<?php if($this->uri->segment(4)=='set'):?>
            <form action="<?php echo base_url();?>manager_keuangan/harga_controller/index" method="post">
                
                <label>Harga Beli</label><input type="text" name="harga_beli" value="<?php echo $barang2[0]->harga_satuan;?>" readonly><br>
                <label>Useful Life</label><input type="text" name="useful_life">Hari <br><input type="hidden" name="id_barang_inventori" value="<?php echo $barang2[0]->id_barang_inventori;?>"><br>
                <!--<label>Salvage Value</label><input type="text" name="salvage_value" value="<?php echo $barang2[0]->salvage_value;?>" readonly><br> -->
                <input type="submit" name="set_harga" value="set">
                <a href="<?php echo base_url();?>manager_keuangan/harga_controller/index">Back</a>
                </form>
            <?php endif ;?>



    <table>
        <th>Tanggal Request</th>
        <th>Nama Barang</th>
        <th>Id Barang</th>
        <th>Merek Barang</th>
        <th>Jumlah Barang</th>
        <th>Harga Satuan</th>
        <th>Total Harga</th>
        <th>Harga Sewa</th>
        <th>Kelola</th>
        <?php foreach($barang as $r):?>
        <tr>
            <td><?php echo $r->tanggal_pembelian;?></td>
            <td><?php echo $r->nama_barang;?></td>
            <td><?php echo $r->id_barang_inventori;?></td>
            <td><?php echo $r->merek_barang;?></td>
            <td><?php echo $r->jumlah_barang;?></td>
            <td><?php echo $r->harga_satuan;?></td>
            <td><?php echo $r->total_harga;?></td>
            <td>
                <?php echo $r->harga_sewa ;?>
                
                </td>
            <td>
               <a href="<?php echo base_url();?>manager_keuangan/harga_controller/index/set/<?php echo $r->id_barang_inventori;?>">Set</a>
            
            </td>

        </tr>
        <?php endforeach ;?>
    </table>

