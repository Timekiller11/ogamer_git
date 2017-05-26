<?php
defined('BASEPATH') OR exit('No direct script access allowed');
# Basic speed calculator toolkit

class Api extends CI_Controller {
	# Temporary in this file, could be placed in config files or dinamically requested.
	# For Taurus EN, change if needed
	private $baseURL = "https://s120-en.ogame.gameforge.com/";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Updated_Model');
		$this->load->helper('xml');
	}
	
	# Formula available at : http://ogame.wikia.com/wiki/Base_Speed
	public function flight_calculator($distance, $speed){
		return 10+3500*sqrt((10*$distance)/$speed);
	}
	
	# Calculate the return time of a fleet based on known information
	public function blind_lanx($arrival_time, $recall_time, $origin, $destination){
		$arrival_time = strtotime( $arrival_time );
		$recall_time = strtotime( $recall_time );
		
		#Calculate initial values
		$distance = $this->get_distance($origin, $destination);
		$total_time = $this->flight_calculator($distance, $speed)
		
		#Calculate total flight time
		$start_time = $arrival_time - $total_time;
		$flight_time = $start_time - $recall_time;
		
		return  date("Y-m-d H:i:s", strtotime($recall_time + $flight_time));
	}
	
	# http://ogame.wikia.com/wiki/Distance
	private function distance($origin, $destination){
		if($origin["galaxy"] != $destination["galaxy"]){
			return abs($origin["galaxy"] - $destination["galaxy"]) * 20000;
		}else if($origin["system"] != $destination["system"]){
			return abs($origin["system"] - $destination["system"])*95 + 2700;
		}else{
			return abs($origin["planet"] - $destination["planet"])*5 + 1000;
		}
	}
}