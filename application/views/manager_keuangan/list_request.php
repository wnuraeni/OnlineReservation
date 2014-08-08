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


<form action="<?php echo base_url();?>manager_keuangan/pembelian_controller/beli" method="post">
    <table>
        <th><input type="checkbox" class="checkall"></th>
        <th>Tanggal Request</th>
        <th>Nama Barang</th>
        <th>Merek Barang</th>
        <th>Jumlah Barang</th>
        <th>Harga Satuan</th>
        <th>Total Harga</th>
        <th>Status</th>
        <?php foreach($request as $r):?>
        <tr><td><input type="checkbox" name="id_barang[]" value="<?php echo $r->id_request_pembelian;?>"></td>
            <td><?php echo $r->tanggal_pembelian;?></td>
            <td><?php echo $r->nama_barang;?></td>
            <td><?php echo $r->merek_barang;?></td>
            <td><?php echo $r->jumlah_barang;?></td>
            <td><?php echo $r->harga_satuan;?></td>
            <td><?php echo $r->total_harga;?></td>
            <td><?php echo $r->status;?></td>

        </tr>
        <?php endforeach ;?>
        <tr><td><input type="submit" name="submit" value="beli"></td></tr>
    </table>
</form>

<script>
    $('.checkall').click(function(){
        $(this).parents('form').find(':checkbox').attr('checked',this.checked);

    });
    

</script>
