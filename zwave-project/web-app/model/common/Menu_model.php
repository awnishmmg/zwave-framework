<?php


Class Menu_model{
	
	private $tablename = 'tbl_menus'; 
	private $column_pk = 'tbl_menus';
	private $column_menu_label = 'menu_label';
	private $column_menu_title = 'menu_title';

	protected function getMenus(){
		return getall($this->tablename);
	}

	protected function getColumnMenuLabel(){
		return $this->column_menu_label;
	}
	 
}