<?php

$data['companies'] = $companies;
$data['contacts'] = $contacts;
$data['uploads'] = $uploads;


?>

<?php get_flashData('message'); ?>

<div class="row mt-1" style="margin-left: -26px;">
<div class="col-md-12">
<div class="mt-4">
    <div class="row">
        <div class="col-md-2" style="background-color: white;box-shadow: 0px 0px 1px;min-height: 500px;background-color: white;border-top: 3px solid black;">
            <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                
                <a class="nav-link active show mb-2 mt-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                    aria-selected="true">
                    <i class="fas fa-upload" style="font-size: 1.0rem;"></i> Upload Files  </a>

                <a class="nav-link mb-2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                    aria-selected="false">
                   <i class=" far fa-file-alt" style="font-size: 1.0rem;"></i> Manage Files  </a>

                <a class="nav-link mb-2" id="v-pills-downloads-tab" data-toggle="pill" href="#v-pills-downloads" role="tab" aria-controls="v-pills-downloads"
                    aria-selected="false">
                <i class="fas fa-download" style="font-size: 1.0rem;"></i>  All Downloads  </a>

            </div>
        </div> <!-- end col-->
        <div class="col-md-10">
            <div class="tab-content text-muted pt-0">
                
                <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                	<?php 

                    $data['action'] = 'add';
                    load::php_file('admin/views/xls-converter/add',$data); 

                    ?>
                </div>
                    
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                   <?php 

                   $data['action'] = 'manage';
                   load::php_file('admin/views/xls-converter/manage',$data); 

                   ?>
                </div>


                <div class="tab-pane fade" id="v-pills-downloads" role="tabpanel" aria-labelledby="v-pills-downloads-tab">
                   <?php 

                   $data['action'] = 'downloads';
                   $data['downloads'] = $downloads??[];
                   load::php_file('admin/views/xls-converter/mydownloads',$data); 

                   ?>
                </div>
                

                
        </div> <!-- end col-->
    </div> <!-- end row-->
    
</div> <!-- end card-box-->
</div> <!-- end col -->
</div>