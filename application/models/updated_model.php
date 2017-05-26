<?php

class Updated_Model extends CI_Model {
	
    public $section;
    public $latest_update;
	protected $table = "updated";
	
	public function __construct()
    {
        parent::__construct();
    }
	
	# Return the information stored into the database based on a single section.
	public function get_by_section($section)
	{
		$current_model = new Updated_Model();
		$result = $this->db->get_where($this->table, array( 'section' => $section));
		
		if ($result->num_rows()) {
			return $result->row();
		} else {
			$this->create_entry_by_section($section);
			return $this->get_by_section($section);
		}
	}
	
	# Update the desired section's latest update to now.
	public function update_by_section($section)
	{
		$this->section = $section;
		$this->latest_update = date("Y-m-d H:i:s");
        $this->db->update($this->table, $this, array('section' => $section));
	}
	
	# Create a new entry for a new XML.
	# Technically this will be used during set-up and shouldn't be run again.
	# 
	private function create_entry_by_section($section){
		$this->section = $section;
		$this->latest_update = date("Y-m-d H:i:s", strtotime( '-1 year' ) ); #Creates it a year ago so the update is needed.
		
        $this->db->insert($this->table, $this);
	}
}


/* End of file updated_model.php */
/* Location: ./application/models/updated_model.php */