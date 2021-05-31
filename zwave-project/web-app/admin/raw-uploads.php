<?php

if(method()=='POST'){

        $uploaded=$_FILES['files'];
        load::library('upload');
        
        if(isset($uploaded['name']) and !empty($uploaded['name'])){

            $file = new Upload();
            $file->set($uploaded)
              ->max_size(1000)
              ->allow_extension('xls|xlsx|csv')
              ->directory(SYSTEM_PATH.'/package/bulk-upload/tmp/');

        if($file->do_upload()){

        // print_r($file->file_info());

        $formdata=[
            'client_ip'=>get_client_ip(),
            'login_id'=>'1',
            'file_name' =>$file->file_info()['file_name'],
            'extension'=>$file->file_info()['type'],
            'size'=>$file->file_info()['size'],
            'date'=>$file->file_info()['uploaded_date'],
            'time'=>$file->file_info()['uploaded_time'],
        ];

        load::model('upload');
        $upload_model = new Upload_model();
        if($upload_model->addRawfileData($formdata)){
            set_flash('msg', '102'); 
             
        }else{
            set_flash('msg','400');
        }
        
        }else{

            set_flash('msg', '101',[
                '101' => $file->report(),
            ]);
            set_flash('action','files');
           

        }///end of else
            

        }else{

            set_flash('msg', '103',[
                '103' => 'Files is Required',
            ]);
            set_flash('action','files');
            
        }
        
}

?>

<?php show_flash(); ?>

<div class="row">
<div class="col-12">
<div class="card-box">
    <h4 class="header-title mb-4">Upload  Raw files </h4>

    
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/raw-uploads'); ?>">
    
    <div class="form-group row">
        <label for="example-text-input" class="col-lg-2 col-form-label">
            Upload File
        </label>
        
    <div class="col-lg-4">
        <input class="form-control" type="file" value="Artisanal kale" 
            id="files" name="files" accept=".xls,.csv,.xlsx">
            <span class="text text-info ">  xlsx,xls,csv(s) files only</span>
        </div>
        <?php show_flash('files'); ?>
    </div>

    <div class="form-group row mb-0">
        <label class="col-lg-2 col-form-label"></label>
        <div class="col-lg-10">
            <input class="btn btn-primary mt-2"  type="submit" value="Upload" name="upload">
        </div>
    </div>
</form>

</div>
</div>
</div>




