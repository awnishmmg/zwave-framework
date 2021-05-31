<?php

switch (get('do')):

	case 'edit':
				load::model('user/Account');
				$accounts_model = new Account_model();
				$accounts->edit(get('id'));
	break;
	case 'delete':

				load::model('user/Account');
				$accounts_model = new Account_model();
				if($accounts_model->delete(get('id'))):

					set_flash('msg','message',[
						'message' => alert_success(" {$GLOBALS['success']} Account Deleted !! "),
					]);

				else:

					set_flash('msg','message',[
						'message' => alert_danger(" {$GLOBALS['warning']} Account Not Deleted !! "),
					]);

				endif;
				
	break;

	default:
	break;

endswitch;
load::php_file('user/views/accounts/create');
redirecting_to('user/accounts-create',1);
