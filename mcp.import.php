<?php

class Import_mcp {
	
	function __construct()
	{
		$this->EE =& get_instance();
		$this->EE->load->library('api');
		$this->EE->api->instantiate(array('channel_entries', 'channel_categories', 'channel_fields', 'channel_structure'));
	}
	
	function index()
	{
		$this->EE->load->library('javascript');
		
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('import_module_name'));
		
		$vars['choose_channel'] = $this->EE->lang->line('import_choose_channel');
		$vars['channels'] = $this->EE->api_channel_structure->get_channels();
		$vars['editLink'] = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=import'.AMP.'method=import'.AMP.'channel_id=%s&field_group=%s';
		
		return $this->EE->load->view('index', $vars, TRUE);
	}
	
	function import()
	{
		$this->EE->load->helper('form');
		
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('import_module_import_json'));
		
		$vars['channel_id'] = $this->EE->input->get('channel_id');
		$vars['field_group'] = $this->EE->input->get('field_group');
		$vars['action'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=import'.AMP.'method=mapping';
		
		return $this->EE->load->view('import', $vars, TRUE);
	}
	
	function mapping()
	{
		$this->EE->load->helper('form');
		
		$import = json_decode($this->EE->input->post('import_json'), TRUE);
		
		$vars['keys'] = array_keys($import[0]);
		$vars['originalImport'] = $this->EE->input->post('import_json');
		$vars['action'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=import'.AMP.'method=do_import'.AMP.'channel_id='.$this->EE->input->post('channel_id');
		
		$info = $this->EE->api_channel_structure->get_channel_info(7)->result();
		
		$vars['categories'] = $this->EE->api_channel_categories->category_tree($info[0]->cat_group);
		
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('import_module_mapping'));
		
		$query = $this->EE->db->query("SELECT * FROM exp_channel_fields WHERE group_id = '".$this->EE->input->post('field_group')."'");
		
		$vars['fields'] = $query->result_array();
		
		return $this->EE->load->view('mapping', $vars, TRUE);
	}
	
	function do_import()
	{
		$fields = $this->EE->input->post('fields');
		$import = json_decode(htmlspecialchars_decode($this->EE->input->post('originalImport')), TRUE);
		
		// Loop through the import
		foreach($import as $entry) {
			$data = array();
			$data['entry_date'] = time();
			$data['category'] = $this->EE->input->post('category');
			
			// Loop through the fields to do the mapping
			foreach($fields as $key => $value) {
				if($value !== '') {
					// It really is that simple
					$data[$key] = $entry[$value];
				}
			}
		// Publish the new entry
		$this->EE->api_channel_fields->setup_entry_settings($this->EE->input->get_post('channel_id'), $data);
		if($this->EE->api_channel_entries->submit_new_entry($this->EE->input->get_post('channel_id'), $data) === FALSE) {
			show_error('An Error Occurred Creating the Entry');
		}
		}
	
		return '<img src="http://gimmebar-assets.s3.amazonaws.com/4eef7728ae733.gif" alt="Nice"><p><strong>Nice!</strong> Your stuff got imported successfully!</p>';
		
	}
	
}