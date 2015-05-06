
        
        <div class="section">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-12">
	    			    <table class="table table-striped table-condensed">
	    			        <!-- Array ( [C] => ID [ST] => East Java [L] => Surabaya [O] => Raizan Inc [OU] => Web Administration [CN] => www.raizan.com ) -->
	    			        <tr>
	    			            <th>Common Name</th>
	    			            <th>Organization Unit</th>
	    			            <th>Organization</th>
	    			            <th>City</th>
	    			            <th>State</th>
	    			            <th>Country</th>
	    			            <th></th>
	    			        </tr>
	    				<?php 
    	    			    $i = 0;
    	    				foreach($pack as $row)
    	    				{
    	    					echo '<tr>';
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
    	    					    echo '<td><a href="'.site_url('admin/signcsr').'/'.$pack[$i]["csr_id"].'" class="btn btn-grey btn-sm event-more">Sign</a></td>';
    	    					echo '</tr>';
    	    					$i++;
    	    				}	
    	    				
	    			    ?>
	    				
	    				</table>
	    			</div>
	    		</div>
			</div>
		</div>
