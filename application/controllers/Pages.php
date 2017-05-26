<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
		$data = array();
        $this->load->view('header');
        $this->load->view('homepage',$data);
        $this->load->view('footer');
	}
	
	public function speed_calculator(){
		
		$data = array();
		$ideas = array(
				"Upload fleets from reports (Req - xml parser for spy report)",
				"Save data into cookies to save for future usage"
			);
			
		$data["ideas"] = $ideas;
		
        $this->load->view('header');
        $this->load->view('speed_calculator',$data);
        $this->load->view('footer');
	}
	
	public function blind_lanx(){
		
		$data = array();
		$ideas = array(
				"Upload fleets from reports (Req - xml parser for spy report)",
				"Save data into cookies to save for future usage",
				"Create a share link (Store in Database? - REQ - Login / Password)"
			);
			
		$data["ideas"] = $ideas;
		
        $this->load->view('header');
        $this->load->view('blind_lanx',$data);
        $this->load->view('footer');
	}
	
	public function help_guides(){
		
		$data = array();
		$ideas = array(
				"We will need to make some 101 guides for advanced techniques, we have Jason's videos but they are a bit outdated.",
				"blind lanx",
				"DF lock",
				"Defences bashing",
				"Moonshots (Fast - Cheap - Small - Big)",
				"Rip bashing",
				"Moon destruction",
				"Slowing attacks / Proper methods"
			);
			
		$data["ideas"] = $ideas;
		
        $this->load->view('header');
        $this->load->view('help_guides',$data);
        $this->load->view('footer');
	}
	
	public function fleet_composition(){
		$data = array();
		$ideas = array(
				"How many times do you wonder 'What should I build...'.",
				"Enter Fleet ratios (Set alliance default 45 lf - 15 CR - 7 Dessies - 6 BS - 3.5 BC)",
				"Consider available ressources",
				"Consider needed ships for specific plans (REQ - Login / Passwords)"
			);
			
		$data["ideas"] = $ideas;
		
        $this->load->view('header');
        $this->load->view('fleet_composition',$data);
        $this->load->view('footer');
	}
}

