<?php
header("Content-Type:text/html");
load::model('common/role_permission');
$role_permission_model = new Role_permission_model();

@$role_id=post('roleid');
$menus=$role_permission_model->menus_list();
$ids=$role_permission_model->getMenuByRole($role_id)[0];

foreach ($menus as $menu):
	$menu_label=$menu['menu_label'];
	$menu_title=$menu['menu_title'];
?>		 
<input type="checkbox" name="menu_label[]" value="<?php echo $menu_label; ?>" <?php if($ids[$menu_label]=='1'):?> checked <?php endif; ?>     /> <?php echo $menu_title; ?>
<?php endforeach; ?>
