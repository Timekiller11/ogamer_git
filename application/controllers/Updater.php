<?php
defined('BASEPATH') OR exit('No direct script access allowed');
# Class designied to grab the data from the Ogame API and update the database whenever required.
# Currently in dev, Using Galaxytool Databases for now.
# 
# Done : 
# => checks if the XML was updated since the last request. 
# => Request XML
# => Parse XML into array
#
# Missing : 
# => Inserting the data into the database

class Updater extends CI_Controller {
	# Temporary in this file, could be placed in config files or dinamically requested.
	# For Taurus EN, change if needed
	private $baseURL = "https://s120-en.ogame.gameforge.com/";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Updated_Model');
		$this->load->helper('xml');
	}

	public function index($section = "invalid")
	{
		if(!$this->valid_section($section)){
			die("invalid request");
		}
		$xml = $this->xml_link($section);
		$this->update_process($section, $xml);
	}
	
	

    
	#####
	# check if the update is needed and calls for the updated if it's the case.
	#####
	private function update_process($section, $xml){
		$data = array();
		$updated_model = new Updated_Model();
		$update_time = $this->get_update_time($section);
		
		$data["updated"] = $updated_model->get_by_section($section);
		if(strtotime($data["updated"]->latest_update) < strtotime($update_time )){
			$this->update($section, $xml);
			return true;
		}else{
			return false;
		}
	}
	
	#####
	# Function returning the update interval for each rss feeds.
	#####
	private function update($section, $xml){
		
		$this->load->helper('xml');
		
		if($section == "highscore"){ # multiple feeds
		}else{
			$xmlRaw = file_get_contents($xml);
			$x = @simplexml_load_string( $xmlRaw );
		}
		
		print_r( $x );
		exit();
	}
	
	#####
	# Function returning the URLs for each rss feeds.
	#####
	private function xml_link($section){
		switch ($section) {
			case "alliances":
				return $this->baseURL . "api/alliances.xml";
				break;
			case "highscore":
				return $this->baseURL . "api/highscore.xml"; # category=1 - 2  & type=0 - 7
				break;
			case "players":
				return $this->baseURL . "api/players.xml";
				break;
			case "playerData":
				return $this->baseURL . "api/playerData.xm";
				break;
			case "serverData":
				return $this->baseURL . "serverData.xml";
				break;
			case "universe":
				return $this->baseURL . "api/universe.xml";
				break;
			default:
				return false; // if the name isn'T a valid section, stop here.
				break;
		}
		
	}
		
	######
	# Generic funcitons to call different updates
	#####
	
	
	public function localization()
	{
		$this->recent("localization");
		# Not needed 
		# Seems to be the menus, not really interresting for current purpose
		#s800-en.ogame.gameforge.com/api/localization.xml - Added in Ogame 5.2.2
	}
	
	public function universes()
	{
		$this->recent("universes");
		# Not needed (?)
		# Allows to gather different universes, could be interresting for scaling.
		// s800-en.ogame.gameforge.com/api/universes.xml - Added in OGame 5.5
	}
		
	
	#####
	# Function checking if the requestion section is valid
	#####
	private function valid_section($section){
		switch ($section) {
			case "highscore":
			case "alliances":
			case "players":
			case "playerData":
			case "universe":
			case "serverData":
				return true;
				break;
			default:
				return false; // if the name isn'T a valid section, stop here.
				break;
		}
	}
	
	#####
	# Function returning the update interval for each rss feeds.
	#####
	private function get_update_time($section){
		switch ($section) {
			case "highscore":
				return date("Y-m-d H:i:s", strtotime( '-1 hour' ) );
				break;
			case "alliances":
			case "players":
				return date("Y-m-d H:i:s", strtotime( '-1 day' ) );
				break;
			case "playerData":
			case "universe":
				return date("Y-m-d H:i:s", strtotime( '-1 week' ) );
				break;
			case "serverData":
			default:
				return date("Y-m-d H:i:s", strtotime( '-1 month' ) );
				break;
		}
	}
	
}