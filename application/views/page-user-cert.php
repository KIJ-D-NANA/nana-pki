
        <!--Page Content-->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-striped table-condensed text-center" style="margin:auto;width:80%;"  >
                        <tr class="text-center">
	    			            <th class="text-center">Serial Number</th>
	    			            <th class="text-center">Download</th>
	    			            <th class="text-center">Revoke</th>
	    			            
	    			    </tr>
	    			    <?php
                        $i = 0;
                        foreach($pack as $row)
                        {
                            echo '<tr>';
                            echo '<td> '.$pack[$i]["serial_number"].'</td>';

                           
                            echo '<td>
                            
                            <form method="post" action="'.site_url('home/exportcert').'">
                            
                                <select name="format" class="input-xlarge format">
                                  <option value="">--Select Download Format--</option>
                                  <option value="crt">CRT</option>
                                  
                                </select>
                                <input type="hidden" name="serial_number" value="'.$pack[$i]["serial_number"].'">
                            <button type="submit" class="btn btn-default">Download!</button>
                            </form>
                            </td>';

                            
                            echo '<td><div id="thanks"><p><a data-toggle="modal" href="#form-content" class="btn btn-grey btn-sm event-more">Revoke Request</a></p></div></td>';
                            echo '</tr>';
                            $i++;
                        }   
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Revoke Modal-->
        <div class="container">
            <div id="form-content" class="modal hide fade in" style="display: none;">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Revoke Certificate</h3>
                </div>
                <div class="modal-body">
                    <form class="contact" name="contact">
                        <label class="label" for="reason">Enter Your Reason</label><br>
                        <textarea name="reason" class="input-xlarge"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-danger" type="submit" value="Revoke!" id="submit">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    <script>
        
        
    </script>
     