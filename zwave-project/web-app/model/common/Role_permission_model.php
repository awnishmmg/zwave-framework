<?php

load::model('common/Menu');

Class Role_permission_model extends Menu_model{
private $menus;

private $tablename = 'tbl_role_permission';
private $column_pk = 'id';
private $column_role_id = 'role_id';

public function __construct(){
	$this->menus=$this->getMenus();
}

public function menus_list(){
	return $this->menus;
}

public function get_menu(){
	foreach ($this->menus_list() as $menu) {
		$menu_key[]= $menu[$this->getColumnMenuLabel()];
	}
	return $menu_key;
}


public function getMenuByRole($role_id){
	global $chain;
	$where =[
		$this->column_role_id =>" = '{$role_id}'",
	];
	$menu_key=$this->get_menu();
	$chain = true;
	
	return fetch_records(where_this(select_from($this->tablename, implode(',', array_values($menu_key))), $where));

}


}