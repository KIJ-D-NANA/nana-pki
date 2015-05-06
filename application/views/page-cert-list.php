

        
        <div class="section">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-12">
	    			    <table class="table table-striped table-condensed">
	    			        <!-- Array ( [C] => ID [ST] => East Java [L] => Surabaya [O] => Raizan Inc [OU] => Web Administration [CN] => www.raizan.com ) -->
	    			        <tr>
	    			            <th>Serial Number</th>
	    			            <th>Name</th>
	    			            <th>Revoke Request</th>
	    			            <th></th>
	    			        </tr>
	    				<?php 
    	    			    $i = 0;
    	    				foreach($pack as $row)
    	    				{
    	    					echo '<tr>';
    	    						if(isset($pack[$i]["serial_number"])){
    	    							echo '<td>'.$pack[$i]["serial_number"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["name"])){
    	    							echo '<td>'.$pack[$i]["name"].'</td>';
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    						if(isset($pack[$i]["revoke_request"])){
    	    							if($pack[$i]["revoke_request"] == 1) {
    	    								echo '<td> YES </td>';
    	    								echo '<td><a href="'.site_url('admin/revoke').'/'.$pack[$i]["serial_number"].'" class="btn btn-grey btn-sm event-more">Revoke</a></td>';		
    	    							}
    	    								
    	    							else {
    	    								echo '<td>NO</td>';
    	    								
    	    							}
    	    						}
    	    						else {
    	    							echo '<td>-</td>';
    	    						}
    	    					    
    	    					echo '</tr>';
    	    					$i++;
    	    				}	
    	    				
	    			    ?>
	    				
	    				</table>
	    			</div>
	    		</div>
			</div>
		</div>
