
                    	<ul class="tablinks tabfade">
                        	<li class="nomar"><a href="#graphs-1">Bar</a></li>
<!--                            <li><a href="#graphs-3">Line</a></li>-->

                        </ul>
<!-- Tabbed navigation end -->
<!-- Tabbed boxes start -->
                    	<div id="graphs-1">
                            <table style="display: none; height: 250px" class="bar" width="52%">
                                <caption> <?php echo $legend;?></caption>
                                <thead>
                                    <tr>
                                        <td></td>
                                      <th scope="col">Jan</th>
                                        <th scope="col">Feb</th>
                                        <th scope="col">Maret</th>
                                        <th scope="col">April</th>
                                        <th scope="col">Mei</th>
                                         <th scope="col">Juni</th>
                                         <th scope="col">Juli</th>
                                        <th scope="col">Agust</th>
                                         <th scope="col">Sept</th>
                                         <th scope="col">Okt</th>
                                        <th scope="col">Nov</th>
                                         <th scope="col">Des</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data_lapangan as $key=>$data): ?>
                                    <tr>
                                        <th scope="row"><?php echo $key;?></th>
                                        <td><?php echo $data['January'];?></td>
                                        <td><?php echo $data['February'];?></td>
                                        <td><?php echo $data['March'];?></td>
                                        <td><?php echo $data['April'];?></td>
                                        <td><?php echo $data['May'];?></td>
                                        <td><?php echo $data['June'];?></td>
                                        <td><?php echo $data['July'];?></td>
                                        <td><?php echo $data['August'];?></td>
                                        <td><?php echo $data['September'];?></td>
                                        <td><?php echo $data['October'];?></td>
                                        <td><?php echo $data['November'];?></td>
                                        <td><?php echo $data['December'];?></td>
                                    </tr>
                                    <?php endforeach ;?>
                                </tbody>
                            </table>
                    </div>

<!--                    <div class="tabcontent" id="graphs-3">
                            <table style="display: none; height: 250px" class="line" width="52%">
                                <caption><?php echo $legend;?></caption>
                                <thead>
                                    <tr>
                                        <td></td>
                                       <th scope="col">Jan</th>
                                        <th scope="col">Feb</th>
                                        <th scope="col">Maret</th>
                                        <th scope="col">April</th>
                                        <th scope="col">Mei</th>
                                         <th scope="col">Juni</th>
                                         <th scope="col">Juli</th>
                                        <th scope="col">Agust</th>
                                         <th scope="col">Sept</th>
                                         <th scope="col">Okt</th>
                                        <th scope="col">Nov</th>
                                         <th scope="col">Des</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data_lapangan as $key=>$data): ?>
                                    <tr>
                                        <th scope="row"><?php echo $key;?></th>
                                        <td><?php echo $data['January'];?></td>
                                        <td><?php echo $data['February'];?></td>
                                        <td><?php echo $data['March'];?></td>
                                        <td><?php echo $data['April'];?></td>
                                        <td><?php echo $data['May'];?></td>
                                        <td><?php echo $data['June'];?></td>
                                        <td><?php echo $data['July'];?></td>
                                        <td><?php echo $data['August'];?></td>
                                        <td><?php echo $data['September'];?></td>
                                        <td><?php echo $data['October'];?></td>
                                        <td><?php echo $data['November'];?></td>
                                        <td><?php echo $data['December'];?></td>
                                    </tr>
                                    <?php endforeach ;?>
                                </tbody>
                            </table>
                    	</div>
-->
