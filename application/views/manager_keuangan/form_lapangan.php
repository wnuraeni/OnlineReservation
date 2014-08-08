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
            <form action="<?php echo base_url();?>manager_keuangan/harga_controller/lapangan" method="post">
                <label>Harga Bangunan</label><input type="text" name="harga_bangunan"><input type="hidden" name="id_lapangan" value="<?php echo $id_lapangan;?>">
                Minimal RP 100.000.000
                <br><br>
                <input type="submit" name="set_harga" value="set">
                 <a href="<?php echo base_url();?>manager_keuangan/harga_controller/lapangan">Back</a>
                </form>
            <?php endif ;?>




    <table>
     
        <th>Nama Lapangan</th>
        <th>Jenis Lapangan</th>
        <th>Harga Sewa</th>
        <th>Kelola</th>
        <?php foreach($lapangan as $r):?>
        <tr>
           
            <td><?php echo $r->nama_lapangan;?></td>
            <td><?php echo $r->jenis_lapangan;?></td>
            <td><?php echo $r->sewa_lapangan;?></td>
            <td>
               <a href="<?php echo base_url();?>manager_keuangan/harga_controller/lapangan/set/<?php echo $r->id_lapangan;?>">Set</a>

            </td>

        </tr>
        <?php endforeach ;?>
    </table>

