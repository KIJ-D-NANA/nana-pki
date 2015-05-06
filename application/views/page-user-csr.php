
    <!--Page Content-->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-striped table-condensed text-center" style="margin:auto;width:100%;"  >
                        <tr class="text-center">
	    			            <th class="text-center">CSR ID</th>
	    			            <th class="text-center">Common Name</th>
	    			            <th class="text-center">Organization Unit</th>
	    			            <th class="text-center">Organization</th>
	    			            <th class="text-center">City</th>
	    			            <th class="text-center">State</th>
	    			            <th class="text-center">Country</th>
	    			            <th class="text-center">Status</th>
	    			    </tr>
	    			    <?php 
    	    			    $i = 0;
    	    				foreach($pack as $row)
    	    				{
    	    					echo '<tr>';
    	    					echo '<td>'.$pack[$i]["csr_id"].'</td>';
    	    						if(isset($pack[$i]["dn"]["CN"])){
    	    							echo '<td>'.$pack[$i]["dn"]["CN"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["dn"]["OU"])){
    	    							echo '<td>'.$pack[$i]["dn"]["OU"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["dn"]["O"])){
    	    							echo '<td>'.$pack[$i]["dn"]["O"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["dn"]["L"])){
    	    							echo '<td>'.$pack[$i]["dn"]["L"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["dn"]["ST"])){
    	    							echo '<td>'.$pack[$i]["dn"]["ST"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["dn"]["C"])){
    	    							echo '<td>'.$pack[$i]["dn"]["C"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    					echo '<td>Pending</td>';  
    	    					echo '</tr>';
    	    				}	
    	    				
	    			    ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>