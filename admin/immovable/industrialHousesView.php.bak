<?php 
$query = "SELECT * FROM provinces";
?>
		<!--**********************************
            Content body start
        ***********************************-->
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
							<a href="index.php?page=residentialHouses"><button type="submit" class="btn btn-primary">Add New</button></a>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Datatable</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Name en francais</th>
                                                <th>Name in english</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($dbh->query($query) as $p){ 
										?>
                                            <tr>
                                                <td><?php echo $p["province_code"]; ?></td>
                                                <td><?php echo $p["province_name"]; ?></td>
                                                <td><?php echo $p["province_name_fr"]; ?></td>
                                                <td><?php echo $p["province_name_en"]; ?></td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!--**********************************
            Content body end
        ***********************************-->
