<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class My_Authentication {
	var $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
	}

	public function isGroupMemberAllowed($isAdmin, $sessionRights, $groupRight)
	{
		// log_message('DEBUG', 'My_Authentication ' . var_export($sessionRights));
		// log_message('DEBUG', 'My_Authentication ' . var_export($groupRight));
		// log_message('DEBUG', 'My_Authentication stdClass ' . var_export($groupRight));
		// log_message('DEBUG', 'My_Authentication stdClass ' . var_export($sessionRights));
		// Log_message('DEBUG', 'My_Authentication stdClass ' . var_export($sessionRights->{$groupRight}));
		log_message('DEBUG', 'My_Authentication isAdmin: ' . $isAdmin);
		log_message('DEBUG', 'My_Authentication right: ' . $groupRight);
		// log_message('DEBUG', 'My_Authentication sessionRights: ' . var_export($sessionRights));
		log_message('DEBUG', 'My_Authentication groupRight: ' . $sessionRights->{$groupRight});

		if($isAdmin == '1' || $sessionRights->{$groupRight} == 1 || $sessionRights->{$groupRight} == '1')
		{
			log_message('DEBUG', 'My_Authentication ' . $groupRight . ' : Allowed');
			return TRUE;
		}
		log_message('DEBUG', 'My_Authentication ' . $groupRight . ' : Not allowed');
		return FALSE;
	}
}