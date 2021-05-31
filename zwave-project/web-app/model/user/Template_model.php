<?php

class Template_model{

	private $tablename = 'tbl_templates';

	// Primary Key
	private $pk = 'id';

	// Columns Set
	private $column_chatbot_id = 'chatbot_id';
	private $column_token = 'token';
	private $column_has_placeholder = 'has_placeholder';
	private $column_placeholder_variable = 'placeholder_variable';
	private $column_variable_keys = 'variable_keys';
	private $column_variable_values = 'variable_values';
	private $column_http_type = 'http_type';
	private $column_query_url = 'query_url';
	private $column_status = 'status';

	// Foreign Key
	private $column_created_by = 'created_by';
	// Timestamps
	private $column_created_at = 'created_at';
	private $column_created_on = 'created_on';

	private $last_id;
	private $fillable;

	public function __construct(){

		$this->fillable = [
				$this->column_chatbot_id,
				$this->column_token,
				$this->column_has_placeholder,
				$this->column_placeholder_variable,
				$this->column_variable_keys,
				$this->column_variable_values,
				$this->column_http_type,
				$this->column_query_url,
				$this->column_status,
				$this->column_created_by,
				$this->column_created_on,
				$this->column_created_at,
		];	

	}

	public function getTemplatesByUserId($user_id){
		global $chain;
		$chain = true;

		$where = [
			$this->$this->column_created_by => " =' $user_id'",
		];
		return fetch_records(where_this(getAll($this->tablename),$where));
	}

	public static function getTemplatesById($id,$column_name=''){
		global $chain;

		$chain = false;
		$instance = get_instance(__CLASS__);
		$templates = getOne($instance->tablename,[$instance->pk => $id]);
		return $templates[$column_name];
	}

	public static function getTemplatesByChatBotID($id){

		global $chain;
		$chain = false;
		$instance = get_instance(__CLASS__);
		$templates = getOne($instance->tablename,[$instance->column_chatbot_id => $id]);
			return $templates;
	}



	public function addTemplate($form_data){
		global $chain;
		$chain = false;

		$form_data[] = date('d-m-Y');
		$form_data[] = date('H:i:s');

		// prx(insertat($this->tablename,array_combine($this->fillable,$form_data)));

		if(insertat($this->tablename,array_combine($this->fillable,$form_data))):
			return true;
		else:
			return false;
		endif;
	}

	public function delete($id){
		global $chain;
		$chain = false;


		// prx(delete($this->tablename,[$this->pk=>$id]));

		if(delete($this->tablename,[$this->pk=>$id])):
			return true;
		else:
		    return false;
		endif;
	}

	public function updateOldTemplateById($template_text,$chatbot_id){
		global $chain;
		$chain = false;

		load::model('admin/Chatbot');
		$chatbot = new Chatbot_model();

		if(update($chatbot->getTableName(),[
			$chatbot->getColumnCompaignText() => $template_text,
		],[$chatbot->getPrimary()=>$chatbot_id])){
			return true;
		}else{
			return false;
		}
	}

	public static function is_configured($chatbot_id,$created_by){
		global $chain;
		$chain = false;

		$instance  = get_instance(__CLASS__);
		if(getOne($instance->tablename,[ 
				   $instance->column_chatbot_id => $chatbot_id, 
				   $instance->column_created_by => $created_by,
				])){
			return true;
		}else{
			return false;
		}
	}


}