<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Dhaka");
class Api extends CI_Controller {
	function __construct()
    {
			parent::__construct();
			$this->load->driver('cache');
    }
	public function get_pregame($olddate=null){
		$prediction=null;
		$callback="";
		$dateObject=$this->workingdate($olddate);
		if (array_key_exists('callback', $_GET) == TRUE) {
			$callback = $_GET['callback'];
		}
		$startTime=$dateObject[0].' 00:00:00';
		$endTime=$dateObject[1].' 23:59:00' ;
		 $prediction=$this->db->query('call get_pregame(?,?)',array($startTime,$endTime));
		 $data=json_encode($prediction->result());
			echo $callback . '(' . $data . ');';

	}
	public function get_running($olddate=null){
		$prediction=null;
		$callback="";
		$dateObject=$this->workingdate($olddate);
		if (array_key_exists('callback', $_GET) == TRUE) {
			$callback = $_GET['callback'];
		}
		$startTime=$dateObject[0].' 00:00:00';
		$endTime=$dateObject[1].' 23:59:00' ;
		$this->db->trans_begin();
		$dtmatch=$this->db->query('call get_prediction_inplay(?,?)',array($startTime,$endTime));
		mysqli_next_result( $this->db->conn_id );
		$dtprediction=$this->db->query('call get_prediction()');
		
		if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
		}else{
				$this->db->trans_commit();
		}

		$match=$dtmatch->result_array();
		$prediction=$dtprediction->result_array();
		for($i=0;$i<count($match);$i++){
			$detail=array();
			$underOver=array();
			for($j=0;$j<count($prediction);$j++){
				if($match[$i]["idmatch"]==$prediction[$j]["match_code"] && $prediction[$j]["typeprediction"]=="HDP"){
					array_push($detail,$prediction[$j]);
				}else if($match[$i]["idmatch"]==$prediction[$j]["match_code"] && $prediction[$j]["typeprediction"]=="OU"){
					array_push($underOver,$prediction[$j]);
				}else if($match[$i]["idmatch"]==$prediction[$j]["match_code"]){
					array_push($detail,$prediction[$j]);
					array_push($underOver,$prediction[$j]);
				}
			}
			$match[$i]["detail"]=$detail;
			$match[$i]["detailou"]=$underOver;
		}
		echo $callback . '(' . json_encode($match) . ');';
	}

	public function get_expired_pregame(){
		$prediction=null;
		$callback="";
		if($this->cache->file->is_supported() && $this->cache->file->get('matchfinished')) {
			$prediction=$this->cache->file->get('matchfinished') ;
		}else{
			$prediction='{"MatchesFinished":[]}';
		};
		if (array_key_exists('callback', $_GET) == TRUE) {
			$callback = $_GET['callback'];
		}
		echo $callback . '(' . json_encode($prediction) . ');';
	}

	public function get_running_cron(){
		set_time_limit(0);
			$soap_client=new SoapClient('http://118.107.179.27:13881/Vig_WebService/Vig_WebService.asmx?WSDL');
			$prediction=json_decode($soap_client->Prediction_Running()->Prediction_RunningResult,true)['Running'];
			//$prediction=json_decode('{"Running":[{"active":"1","match_code":"60240","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"50","league":"JAPAN J2 LEAGUE","team_home":"Mito Hollyhock","team_away":"Montedio Yamagata","score_home":"2","score_away":"1","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.26","odds_home":"0.81","odds_away":"-0.90","ou":"3.25","odds_over":"0.83","odds_under":"-0.93"},"sbo":{"hdp":"0.25","odds_home":"0.82","odds_away":"-0.90","ou":"3.50","odds_over":"-0.85","odds_under":"0.75"},"ibc":{"hdp":"0.25","odds_home":"0.84","odds_away":"-0.92","ou":"3.50","odds_over":"-0.88","odds_under":"0.78"}},{"active":"1","match_code":"60242","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"38","league":"JAPAN J2 LEAGUE","team_home":"Tokushima Vortis","team_away":"Fagiano Okayama","score_home":"0","score_away":"1","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"U","sys_company":"M8","sys":{"hdp":"-0.25","odds_home":"0.78","odds_away":"-0.86","ou":"2.75","odds_over":"-0.90","odds_under":"0.80"},"sbo":{"hdp":"-0.50","odds_home":"-0.93","odds_away":"0.85","ou":"2.50","odds_over":"0.78","odds_under":"-0.88"},"ibc":{"hdp":"-0.50","odds_home":"-0.94","odds_away":"0.86","ou":"2.75","odds_over":"-0.95","odds_under":"0.85"}},{"active":"1","match_code":"60243","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"40","league":"JAPAN J2 LEAGUE","team_home":"Tokyo Verdy","team_away":"JEF United Ichihara Chiba","score_home":"0","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"U","sys_company":"M8","sys":{"hdp":"-0.50","odds_home":"-0.90","odds_away":"0.80","ou":"1.50","odds_over":"1.00","odds_under":"0.90"},"sbo":{"hdp":"-0.50","odds_home":"-0.90","odds_away":"0.80","ou":"1.50","odds_over":"-1.00","odds_under":"0.90"},"ibc":{"hdp":"-0.50","odds_home":"-0.94","odds_away":"0.84","ou":"1.50","odds_over":"-1.00","odds_under":"0.90"}},{"active":"1","match_code":"60168","match_dt":"25 Feb 2018 12:00","match_period":"Part2","match_minute":"85","league":"JAPAN J1 LEAGUE","team_home":"Vegalta Sendai","team_away":"Kashiwa Reysol","score_home":"1","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.00","odds_home":"-0.65","odds_away":"0.57","ou":"1.50","odds_over":"-0.38","odds_under":"0.30"},"sbo":{"hdp":"0.00","odds_home":"-0.65","odds_away":"0.57","ou":"1.75","odds_over":"-0.20","odds_under":"0.12"},"ibc":{"hdp":"0.00","odds_home":"-0.67","odds_away":"0.59","ou":"1.50","odds_over":"-0.38","odds_under":"0.30"}},{"active":"1","match_code":"60169","match_dt":"25 Feb 2018 12:00","match_period":"Part2","match_minute":"83","league":"JAPAN J2 LEAGUE","team_home":"Avispa Fukuoka","team_away":"FC Gifu","score_home":"2","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"U","sys_company":"M8","sys":{"hdp":"0.00","odds_home":"0.55","odds_away":"-0.63","ou":"2.50","odds_over":"-0.42","odds_under":"0.32"},"sbo":{"hdp":"0.00","odds_home":"0.55","odds_away":"-0.63","ou":"2.50","odds_over":"-0.42","odds_under":"0.32"},"ibc":{"hdp":"0.00","odds_home":"0.59","odds_away":"-0.67","ou":"2.50","odds_over":"-0.43","odds_under":"0.33"}},{"active":"1","match_code":"60167","match_dt":"25 Feb 2018 12:00","match_period":"Part2","match_minute":"85","league":"JAPAN J1 LEAGUE","team_home":"Shimizu S-Pulse","team_away":"Kashima Antlers","score_home":"0","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.00","odds_home":"-0.49","odds_away":"0.41","ou":"0.50","odds_over":"-0.38","odds_under":"0.30"},"sbo":{"hdp":"0.00","odds_home":"-0.49","odds_away":"0.41","ou":"0.50","odds_over":"-0.38","odds_under":"0.30"},"ibc":{"hdp":"0.00","odds_home":"-0.50","odds_away":"0.42","ou":"0.50","odds_over":"-0.36","odds_under":"0.28"}},{"active":"1","match_code":"60238","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"40","league":"JAPAN J2 LEAGUE","team_home":"Ehime FC","team_away":"Zweigen Kanazawa","score_home":"1","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.25","odds_home":"0.68","odds_away":"-0.76","ou":"2.25","odds_over":"0.75","odds_under":"-0.85"},"sbo":{"hdp":"0.00","odds_home":"-0.92","odds_away":"0.84","ou":"2.50","odds_over":"-0.94","odds_under":"0.84"},"ibc":{"hdp":"0.00","odds_home":"-0.91","odds_away":"0.83","ou":"2.25","odds_over":"0.77","odds_under":"-0.87"}},{"active":"1","match_code":"60239","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"40","league":"JAPAN J2 LEAGUE","team_home":"Kamatamare Sanuki","team_away":"Albirex Niigata","score_home":"0","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.25","odds_home":"-0.92","odds_away":"0.84","ou":"1.25","odds_over":"-0.92","odds_under":"0.82"},"sbo":{"hdp":"0.25","odds_home":"-0.92","odds_away":"0.84","ou":"1.25","odds_over":"-0.92","odds_under":"0.82"},"ibc":{"hdp":"0.25","odds_home":"-0.92","odds_away":"0.84","ou":"1.25","odds_over":"-0.94","odds_under":"0.84"}},{"active":"1","match_code":"60241","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"40","league":"JAPAN J2 LEAGUE","team_home":"Tochigi SC","team_away":"Oita Trinita","score_home":"0","score_away":"3","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"U","sys_company":"M8","sys":{"hdp":"0.00","odds_home":"0.76","odds_away":"-0.84","ou":"4.50","odds_over":"0.82","odds_under":"-0.92"},"sbo":{"hdp":"-0.25","odds_home":"-0.89","odds_away":"0.81","ou":"4.50","odds_over":"0.82","odds_under":"-0.92"},"ibc":{"hdp":"-0.25","odds_home":"-0.91","odds_away":"0.83","ou":"4.50","odds_over":"0.86","odds_under":"-0.96"}},{"active":"1","match_code":"60244","match_dt":"25 Feb 2018 13:00","match_period":"Part1","match_minute":"41","league":"JAPAN J2 LEAGUE","team_home":"Yokohama FC","team_away":"Matsumoto Yamaga","score_home":"0","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.25","odds_home":"0.71","odds_away":"-0.79","ou":"1.25","odds_over":"0.84","odds_under":"-0.94"},"sbo":{"hdp":"0.00","odds_home":"-0.90","odds_away":"0.82","ou":"1.25","odds_over":"0.84","odds_under":"-0.94"},"ibc":{"hdp":"0.00","odds_home":"-0.93","odds_away":"0.85","ou":"1.25","odds_over":"0.85","odds_under":"-0.95"}}]}',true)["Running"];
	
		 for($i=0;$i<count($prediction);$i++){
			 $data=$prediction[$i];
			 $sql='call insertmatch(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
			 $dateconvert=(new DateTime($data['match_dt']))->format('Y-m-d H:i:s');
			$this->db->query($sql,array(
				$data['match_code'],
				$data['active'],
				$dateconvert,
				$data['match_period'],
				$data['match_minute'],
				$data['league'],
				$data['team_home'],
				$data['team_away'],
				$data['score_home'],
				$data['score_away'],
				$data['rb_id'],
				$data['bet_period'],
				$data['sys_company'],
				$data['sbo']['hdp'],
				$data['sbo']['odds_home'],
				$data['sbo']['odds_away'],
				$data['sbo']['ou'],
				$data['sbo']['odds_over'],
				$data['sbo']['odds_under'],
				$data['ibc']['hdp'],
				$data['ibc']['odds_home'],
				$data['ibc']['odds_away'],
				$data['ibc']['ou'],
				$data['ibc']['odds_over'],
				$data['ibc']['odds_under'],
				$data['sys']['hdp'],
				$data['sys']['odds_home'],
				$data['sys']['odds_away'],
				$data['sys']['ou'],
				$data['sys']['odds_over'],
				$data['sys']['odds_under'],
				$data['pick_hdp'],
				$data['pick_ou']
			));
		 }
	}

	public function run_cronjob(){
		set_time_limit(20);
		while(true){
			$dt=new DateTime();
			$this->cache->file->save('test',  $dt->format('Y-m-d H:i:s') . "<br>", 0);
			sleep(10);
		}
	}
	public function get_pregame_cron(){
		$soap_client=new SoapClient('http://118.107.179.27:13881/Vig_WebService/Vig_WebService.asmx?WSDL');
		$prediction=json_decode($soap_client->Prediction_Pregame()->Prediction_PregameResult,true)['Pregame'];
		
	
		foreach($prediction as $item){
			$data=$item;
				$sql='call insert_pregame(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
				$dateconvert=(new DateTime($data['match_dt']))->format('Y-m-d H:i:s');
				$this->db->query($sql,array(
					$data['match_code'],
					$data['active'],
					$dateconvert,
					$data['match_period'],
					$data['match_minute'],
					$data['league'],
					$data['team_home'],
					$data['team_away'],
					$data['score_home'],
					$data['score_away'],
					$data['rb_id'],
					$data['bet_period'],
					$data['sys_company'],
					$data['sbo']['hdp'],
					$data['sbo']['odds_home'],
					$data['sbo']['odds_away'],
					$data['sbo']['ou'],
					$data['sbo']['odds_over'],
					$data['sbo']['odds_under'],
					$data['ibc']['hdp'],
					$data['ibc']['odds_home'],
					$data['ibc']['odds_away'],
					$data['ibc']['ou'],
					$data['ibc']['odds_over'],
					$data['ibc']['odds_under'],
					$data['sys']['hdp'],
					$data['sys']['odds_home'],
					$data['sys']['odds_away'],
					$data['sys']['ou'],
					$data['sys']['odds_over'],
					$data['sys']['odds_under'],
					$data['pick_hdp'],
					$data['pick_ou']
				));
	}
}

	public function matchWdate($matchdt){
		$dt=date('d',strtotime('-12 hours',strtotime($matchdt)));
		return $dt;
	}

	public function wDate(){
		$wdate=0;
		if(strtotime(date('H:i'))>=strtotime("12:00 pm")){
			$wdate=intval(date('d'));
		}else{
			$wdate=intval(date('d'))-1;
		}
		return $wdate;
	}

	public function existsInArray($array,$match_code) {
    foreach ($array as $item) {
        if ($item['match_code'] == $match_code) {
					return true;
				}
		}
    return false;
	}

	public function removeMatch(){
		$matchfinished=json_decode($this->cache->file->get('yesterday_match'),true)['MatchesFinished'];
		$wdate=$this->matchWdate(date('Y-m-d H:i:s'));
		$newmatches=array();
		for($i=0;$i<count($matchfinished);$i++){
			$macthDate=$this->matchWdate($matchfinished[$i]['match_dt']);
			if(intval($macthDate)==intval($wdate) || intval($macthDate)==intval($wdate)-1){
				//unset($matchfinished[$i]);
				array_push($newmatches,$matchfinished[$i]);
			}
		}
		$this->cache->file->save('yesterday_match', "{\"MatchesFinished\":".json_encode($newmatches)."}", 0);
	}

	public function date_sort($a,$b,$direction){
			$ad = intval((new DateTime($a['match_dt']))->format('d'));
			$bd = intval((new DateTime($b['match_dt']))->format('d'));
		
			if ($ad == $bd) {
				return 0;
			}
		
			if($direction=='DESC'){
				return $ad < $bd ? 1 : -1;
			}else{
				return $ad < $bd ? -1 : 1;
			}
	}

	public function workingdate($date){
		$dt=array(date('Y-m-d',strtotime('-1 day',strtotime($date))),date('Y-m-d',strtotime($date)));
		return $dt;
	}
}