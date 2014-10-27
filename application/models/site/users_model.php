<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_model extends CI_Model{
		
		public function get_link_login_page($menu_item_id = NULL, $params = NULL){
			return 'users/index/login/'.$menu_item_id;
		}
		public function get_link_logout_page($menu_item_id = NULL, $params = NULL){
			return 'users/index/logout/'.$menu_item_id;
		}
		
		
	}
