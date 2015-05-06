    <script>
        $(document).ready(function () {
            $("input#submit").click(function(){
                $.ajax({
                    type: "POST",
                    url: "process.php", // 
                    data: $('form.contact').serialize(),
                    success: function(msg){
                        $("#thanks").html(msg)
                        $("#form-content").modal('hide');   
                    },
                    error: function(){
                        alert("failure");
                    }
                });
            });
        });
    </script>
    

    <!--Page Content-->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-striped table-condensed text-center" style="margin:auto;width:80%;"  >
                        <tr class="text-center">
	    			            <th class="text-center">CSR ID</th>
	    			            <th class="text-center">Status</th>
	    			    </tr>
	    			    <?php
                        $i = 0;
                        foreach($pack as $row)
                        {
                            echo '<tr>';
                            echo '<td> '.$pack[$i]["csr_id"].'</td>';
                            echo '<td>Pending</td>';
                            echo '</tr>';
                            
                        }   
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>