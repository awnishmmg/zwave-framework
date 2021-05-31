<?php
$enc_id = get('m_id');
if(isset($enc_id)):
    
    $vn_id = decode_64($enc_id);
    load::model('admin/Procured_number');
    $Procured_number = new Procured_number_model();
    $numbers_data=$Procured_number->getNumberDetailsById($vn_id);
    $vn_no = $numbers_data['miscall_numbers'];
    $prefix_code = $numbers_data['prefix_code'];

?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header mt-0" style="background-color: white;border-top: 3px solid black;">
		<div class="row">
			<div class="col-md-10"><h5>Misscall Logs </h5></div>
			<div class="col-md-2">
			<a href="javascript:void(0)"><button class="btn btn-dark btn-sm"><i class="mdi mdi-refresh" style="font-size:1rem;" id="icon_refresh"></i> Reload </button></a>
			</div>
		</div>
	</div>
	<div class="card-body mt-0">
	<div class="row">
	    <div class="col-md-4">
	        <table class="table table-hover">
	            <tr>
	                   <th>VN (Misscall No)</th>
	                   <td><?php echo "+{$prefix_code}{$vn_no}"; ?></td>
	            </tr>
	        </table>
	    </div>
	    <div class="col-md-4">
	        <table class="table table-hover">
	            <tr>
	                   <th>Auto Refresh</th>
	                   <td>
	                       <input type="radio" class="radio" name="auto_refresh" onclick="enable_ping()"> Enable
	                       <input type="radio" class="radio" checked name="auto_refresh" onclick="disable_ping()"> Disable
	                   </td>
	            </tr>
	            <tr>
	                   <th>Ping Request</th>
	                   <td>
	                       <select class="form-control form-control-sm" onchange="change_ping(this);" id="change_ping_id">
	                           <?php for($i=2;$i<=1440;$i=$i+2): ?>
	                            <option value="<?php echo ($i*1000); ?>"><?php echo $i; ?> Seconds</option>
	                           <?php endfor; ?>
	                       </select>
	                   </td>
	            </tr>
	        </table>
	    </div>
	    
	    <div class="col-md-4">
	        <table class="table table-hover">
	            <tr>
	                   <th>No of Pings</th>
	                   <td>
	                       <span id="ping_counter">0</span>/<span id="span_seconds" >2</span> Seconds
	                   </td>
	            </tr>
	            <tr>
	                   <th>Status</th>
	                   <td>
	                       <span id="ping_status">stopped</span>
	                   </td>
	            </tr>
	        </table>
	    </div>
	    
	    
	</div>
    
    <div id="user-miscall-logs-show">
        
        Data will Load Here
        
        
    </div>

	</div>

</div>

<script type="text/javascript" >

    var timing = document.getElementById('change_ping_id').value;
    var i=0;
    var ID1;
    var ping_status = document.getElementById('ping_status');
    
    function change_ping(select){
        timing = select.value;
        clearInterval(ID1);
        document.getElementById('span_seconds').innerHTML = (timing/1000);
        enable_ping();
    }
    

    
function enable_ping(){
    ID1 = setInterval(function(){
       var ping_counter = document.getElementById('ping_counter');
        ping_status.innerHTML='<b class="badge badge-success">started</b>';
       i++;
       ping_counter.innerHTML= i;
      
    },timing);
}
 
function disable_ping(){
    clearInterval(ID1);
     ping_status.innerHTML='<b class="badge badge-danger">stopped</b>';
    return false;
}
    
    
</script>

<?php else: ?>
        
        <?php load::php_file('user/views/my-misscall-number/view-logs'); ?>

<?php endif; ?>