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
                    <div class="col-md-12">
                        <form role="form" method="post" action="">
                        <? php 
                        echo '<table class="events-list">';
                        $counter = 1;
                        foreach($pack as $row)
                        {
                            echo '<tr>';
                            echo '<td><div class="event-date"> <div class="event-day">'.$counter.'</div></div></td>';
                            echo '<td>Status for CSR ID : '.$pack[$i]["csr_id"].'</td>';
                            echo '<td> still Pending </td>';
                            $counter++;
                        }   
                        echo "</table>"; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>