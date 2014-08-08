
                    	<ul class="tablinks tabfade">
                        	<li class="nomar"><a href="#graphs-1">Bar</a></li>
<!--                            <li><a href="#graphs-3">Line</a></li>-->

                        </ul>
<!-- Tabbed navigation end -->
<form action="<?php echo base_url().'pemilik/index/grafik_okupasi_lapangan';?>" method="POST">
    <?php
    $months = array(
        '1'=>'Januari',
        '2'=>'Februrari',
        '3'=>'Maret',
        '4'=>'April',
        '5'=>'Mei',
        '6'=>'Juni',
        '7'=>'Juli',
        '8'=>'Agustus',
        '9'=>'September',
        '10'=>'Oktober',
        '11'=>'November',
        '12'=>'Desember',
        );
    ?>
    <select name="bulan">
        <?php
        foreach($months as $key=>$val){
        echo '<option value="'.$key.'">'.$val.'</option>';
        }
        ?>
    </select>
    <select name="tahun">
        <?php
        for($i=2010;$i<=date('Y');$i++){

        echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Cari" name="cari">
</form>
<br>
<!-- Tabbed boxes start -->
                    	<div id="graphs-1">
                            <h4><?php echo 'Data per '.$months[$bulan]." ".$tahun?></h4>
                            <table style="display: none; height: 250px" class="bar" width="90%">
                                <caption></caption>
                                <thead>
                                    <tr>
                                         <td></td>
                                       <?php
                                    foreach($data_lapangan as $key=>$data): ?>

                                        <th><?php echo $key;?></th>

                                    <?php endforeach ;?>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php 
                                    foreach($data_lapangan as $key=>$val): ?>
                                    
                                      
                                        <td><?php echo $val;?></td>
                                        
                                       
                                    
                                    <?php endforeach ;?>
                                        </tr>
                                </tbody>
                            </table>
                            <br><br><br>

                            <table style="display: none; height: 250px" class="pie" width="90%">
                                <caption></caption>
                                <thead>
                                    <tr>
                                         <td></td>
                                      
                                        <th><?php echo 'percent';?></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    foreach($data_lapangan as $key=>$val): ?>
                                    <tr>
                                        <th scope="row"><?php echo $key;?></th>
                                        <td><?php echo $val;?></td>

                                     </tr>

                                    <?php endforeach ;?>
                                       
                                </tbody>
                            </table>
                    </div>
