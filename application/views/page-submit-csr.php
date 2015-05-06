
        
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-md-7 centered">
						<div class="basic-login">
							<form id="usrform" role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('home/uploadcsr'); ?>">
								<div class="form-group">
									<label for="usrform">CSR File Upload</label>
		        				 	<input class="form-control" name="csr" id="csr" type="file" placeholder="">
								</div>
								<div class="control-group">
								  <label class="control-label" for="usage">Certificate Usage</label>
								  <div class="controls">
								    <select id="usage" name="usage" class="input-large">
								      <option value="tls">TLS Server Certificate</option>
								      <option value="email">Email Certificate</option>
								    </select>
								  </div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn pull-right">Submit</button>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	   