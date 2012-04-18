<?php if ( ! defined('BASEPATH')) exit();

class Import_upd {
	
	var $version = '0.1';
	
	function __construct()
	{
		// Make a local reference to EE super nifty wifty object
		$this->EE =& get_instance();
	}
	
	public function install()
	{
		$this->EE->load->dbforge();
		
		$data = array(
			'module_name' => 'Import',
			'module_version' => $this->version,
			'has_cp_backend' => 'y',
			'has_publish_fields' => 'n'
		);
		
		$this->EE->db->insert('modules', $data);
		
		$fields = array(
				'id' => array('type' => 'int', 'contraint' => '10', 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'import_text' => array('type' => 'longblob')
		);
		
		$this->EE->dbforge->add_field($fields);
		$this->EE->dbforge->add_key('id', TRUE);
		
		$this->EE->dbforge->create_table('import_imports');
		
		return TRUE;
	}
	
	public function uninstall()
	{
		$this->EE->load->dbforge();
		
		$this->EE->db->where('module_name', 'Import');
		$this->EE->db->delete('modules');
		
		$this->EE->dbforge->drop_table('import_imports');
		
		return True;
	}
	
	public function update($current = '')
	{
		return FALSE;
	}
	
}