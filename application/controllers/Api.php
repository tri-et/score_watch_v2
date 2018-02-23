<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Dhaka");
class Api extends CI_Controller {
	function __construct()
    {
		parent::__construct();
		$this->load->driver('cache');
    }
	public function get_pregame(){
		$prediction=null;
		$callback="";
		if($this->cache->file->is_supported() && $this->cache->file->get('pregame')) {
			$prediction=$this->cache->file->get('pregame') ;
		}else{
			$prediction=$this->get_pregame_cron();
		};

		if (array_key_exists('callback', $_GET) == TRUE) {
			$callback = $_GET['callback'];
		}
			echo $callback . '(' . json_encode($prediction) . ');';

	}
	
	public function get_running(){
		$prediction=null;
		$callback="";
		if($this->cache->file->is_supported() && $this->cache->file->get('running')) {
			$prediction=$this->cache->file->get('running') ;
		}else{
			$prediction=$this->get_running_cron();
		};
		//$prediction=$this->get_running_cron();
		if (array_key_exists('callback', $_GET) == TRUE) {
			$callback = $_GET['callback'];
		}
		echo $callback . '(' . json_encode($prediction) . ');';
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
		//$prediction=json_decode('{"Running":[{"active":"1","match_code":"57310","match_dt":"15 Jan 2018 16:00","match_period":"FT","match_minute":"97","league":"AFC U23 CHAMPIONSHIP 2018 (IN CHINA)","team_home":"Uzbekistan U23","team_away":"Oman U23","score_home":"1","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"U","sys_company":"M8","sys":{"hdp":"","odds_home":"","odds_away":"","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"0.56","odds_away":"-0.68","ou":"1.50","odds_over":"-0.24","odds_under":"0.10"},"ibc":{"hdp":"0.00","odds_home":"0.60","odds_away":"-0.76","ou":"1.50","odds_over":"-0.21","odds_under":"0.03"}},{"active":"1","match_code":"57311","match_dt":"15 Jan 2018 16:00","match_period":"FT","match_minute":"94","league":"AFC U23 CHAMPIONSHIP 2018 (IN CHINA)","team_home":"China U23","team_away":"Qatar U23","score_home":"1","score_away":"2","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"O","sys_company":"M8","sys":{"hdp":"","odds_home":"","odds_away":"","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"-0.73","odds_away":"0.61","ou":"3.50","odds_over":"-0.25","odds_under":"0.11"},"ibc":{"hdp":"0.00","odds_home":"-0.78","odds_away":"0.62","ou":"3.50","odds_over":"-0.27","odds_under":"0.09"}},{"active":"1","match_code":"57315","match_dt":"16 Jan 2018 03:00","match_period":"FT","match_minute":"100","league":"PORTUGAL LIGA NOS","team_home":"Moreirense","team_away":"Vitoria Setubal","score_home":"2","score_away":"2","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"O","sys_company":"M8","sys":{"hdp":"","odds_home":"","odds_away":"","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"0.56","odds_away":"-0.64","ou":"4.50","odds_over":"-0.10","odds_under":"0.02"},"ibc":{"hdp":"0.00","odds_home":"0.57","odds_away":"-0.65","ou":"4.50","odds_over":"-0.12","odds_under":"0.04"}},{"active":"1","match_code":"57313","match_dt":"16 Jan 2018 03:00","match_period":"FT","match_minute":"93","league":"HOLLAND JUPILER LEAGUE","team_home":"FC Oss","team_away":"NEC Nijmegen","score_home":"3","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.25","odds_home":"0.07","odds_away":"-0.17","ou":"3.50","odds_over":"-0.13","odds_under":"0.03"},"sbo":{"hdp":"0.00","odds_home":"-0.33","odds_away":"0.23","ou":"3.50","odds_over":"-0.11","odds_under":"0.03"},"ibc":{"hdp":"0.00","odds_home":"-0.34","odds_away":"0.24","ou":"3.50","odds_over":"-0.14","odds_under":"0.06"}},{"active":"1","match_code":"57314","match_dt":"16 Jan 2018 03:00","match_period":"FT","match_minute":"96","league":"HOLLAND JUPILER LEAGUE","team_home":"Jong AZ Alkmaar","team_away":"Cambuur Leeuwarden","score_home":"0","score_away":"1","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"U","sys_company":"M8","sys":{"hdp":"","odds_home":"","odds_away":"","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"-0.59","odds_away":"0.51","ou":"1.50","odds_over":"-0.14","odds_under":"0.06"},"ibc":{"hdp":"0.00","odds_home":"-0.59","odds_away":"0.51","ou":"1.50","odds_over":"-0.16","odds_under":"0.08"}},{"active":"1","match_code":"57318","match_dt":"16 Jan 2018 04:00","match_period":"FT","match_minute":"95","league":"SPAIN LA LIGA","team_home":"Real Betis","team_away":"Leganes","score_home":"3","score_away":"2","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"O","sys_company":"M8","sys":{"hdp":"0.00","odds_home":"0.61","odds_away":"-0.69","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"0.57","odds_away":"-0.65","ou":"5.50","odds_over":"-0.14","odds_under":"0.06"},"ibc":{"hdp":"0.00","odds_home":"0.62","odds_away":"-0.70","ou":"5.50","odds_over":"-0.14","odds_under":"0.06"}},{"active":"1","match_code":"57317","match_dt":"16 Jan 2018 04:00","match_period":"FT","match_minute":"94","league":"ENGLISH PREMIER LEAGUE","team_home":"Manchester United","team_away":"Stoke City","score_home":"3","score_away":"0","rb_id":"","bet_period":"90","pick_hdp":"H","pick_ou":"U","sys_company":"M8","sys":{"hdp":"0.00","odds_home":"0.25","odds_away":"-0.33","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"0.31","odds_away":"-0.39","ou":"3.50","odds_over":"-0.13","odds_under":"0.05"},"ibc":{"hdp":"0.00","odds_home":"0.32","odds_away":"-0.40","ou":"3.50","odds_over":"-0.13","odds_under":"0.05"}},{"active":"1","match_code":"57319","match_dt":"16 Jan 2018 05:00","match_period":"FT","match_minute":"97","league":"FLORIDA CUP (IN USA)","team_home":"Fluminense","team_away":"Barcelona Guayaquil","score_home":"1","score_away":"2","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"U","sys_company":"M8","sys":{"hdp":"","odds_home":"","odds_away":"","ou":"","odds_over":"","odds_under":""},"sbo":{"hdp":"0.00","odds_home":"-0.80","odds_away":"0.70","ou":"3.50","odds_over":"-0.20","odds_under":"0.08"},"ibc":{"hdp":"0.00","odds_home":"-0.78","odds_away":"0.68","ou":"3.50","odds_over":"-0.22","odds_under":"0.10"}},{"active":"1","match_code":"57320","match_dt":"16 Jan 2018 05:00","match_period":"HT","match_minute":"71","league":"PORTUGAL LIGA NOS","team_home":"Estoril Praia","team_away":"Porto","score_home":"2","score_away":"2","rb_id":"","bet_period":"90","pick_hdp":"A","pick_ou":"O","sys_company":"M8","sys":{"hdp":"1.25","odds_home":"-0.95","odds_away":"0.87","ou":"2.75","odds_over":"0.87","odds_under":"-0.97"},"sbo":{"hdp":"1.25","odds_home":"-0.95","odds_away":"0.87","ou":"2.75","odds_over":"0.85","odds_under":"-0.95"},"ibc":{"hdp":"1.00","odds_home":"-0.63","odds_away":"0.55","ou":"2.75","odds_over":"0.83","odds_under":"-0.93"},"time_expired":"2018-01-16 09:57:02","minute_expired":10}]}',true)["Running"];
		$oldData=json_decode($this->cache->file->get('running'),true)['Running'];
		for($i=0;$i<count($prediction);$i++){
			for($j=0;$j<count($oldData);$j++){
				if($prediction[$i]["match_code"]==$oldData[$j]["match_code"]){
					$prediction[$i]['sys']['hdp']=($prediction[$i]['sys']['hdp']==""?$oldData[$j]['sys']['hdp']:$prediction[$i]['sys']['hdp']);
					$prediction[$i]['sys']['odds_home']=($prediction[$i]['sys']['odds_home']==""?$oldData[$j]['sys']['odds_home']:$prediction[$i]['sys']['odds_home']);
					$prediction[$i]['sys']['odds_away']=($prediction[$i]['sys']['odds_away']==""?$oldData[$j]['sys']['odds_away']:$prediction[$i]['sys']['odds_away']);
					$prediction[$i]['sys']['ou']=($prediction[$i]['sys']['ou']==""?$oldData[$j]['sys']['ou']:$prediction[$i]['sys']['ou']);
					$prediction[$i]['sys']['odds_under']=($prediction[$i]['sys']['odds_under']==""?$oldData[$j]['sys']['odds_under']:$prediction[$i]['sys']['odds_under']);
					$prediction[$i]['sys']['odds_over']=($prediction[$i]['sys']['odds_over']==""?$oldData[$j]['sys']['odds_over']:$prediction[$i]['sys']['odds_over']);
					// $match_minute=intval($prediction[$i]["match_minute"]);
					// $oldmatch_minute=intval($oldData[$j]["match_minute"]);
					
					
						// if($prediction[$i]["match_period"]!='FT'){
						// 	if($match_minute!=$oldmatch_minute){
						// 		if($match_minute>=1 && $match_minute<=70){
						// 			if($oldData[$j]["time_expired"]==null){
						// 				$prediction[$i]["time_expired"]=(new DateTime())->format('Y-m-d H:i:s');
						// 				$prediction[$i]["minute_expired"]="10";
						// 			}else{
						// 				$prediction[$i]["time_expired"]=$oldData[$j]["time_expired"];
						// 				$dateold=new DateTime($oldData[$j]["time_expired"],new DateTimeZone('Asia/Dhaka'));
						// 				$datenew=new DateTime((new DateTime())->format('Y-m-d H:i:s'),new DateTimeZone('Asia/Dhaka'));
						// 				$minute_expired=intval($dateold->diff($datenew)->format('%i'));
						// 				if($minute_expired>=10){
						// 					$prediction[$i]["minute_expired"]="10";
						// 					$prediction[$i]["time_expired"]=(new DateTime())->format('Y-m-d H:i:s');
						// 				}else{
						// 					if($prediction[$i]["score_home"]!=$oldData[$j]["score_home"] || $prediction[$i]["score_away"]!=$oldData[$j]["score_away"]){
						// 						$prediction[$i]["time_expired"]=(new DateTime())->format('Y-m-d H:i:s');;
						// 						$prediction[$i]["minute_expired"]=0;
						// 					}else{
						// 						$prediction[$i]["minute_expired"]=10-$minute_expired;
						// 					}
						// 				}
						// 			}
						// 		}else if($match_minute>70){
						// 			if($oldData[$j]["time_expired"]==null){
						// 				$prediction[$i]["time_expired"]=(new DateTime())->format('Y-m-d H:i:s');
						// 				$prediction[$i]["minute_expired"]="3";
						// 			}else{
						// 				$prediction[$i]["time_expired"]=$oldData[$j]["time_expired"];
						// 				$dateold=new DateTime($oldData[$j]["time_expired"],new DateTimeZone('Asia/Dhaka'));
						// 				$datenew=new DateTime((new DateTime())->format('Y-m-d H:i:s'),new DateTimeZone('Asia/Dhaka'));
						// 				$minute_expired=intval($dateold->diff($datenew)->format('%i'));
						// 				if($minute_expired>=3){
						// 					$prediction[$i]["minute_expired"]="3";
						// 					$prediction[$i]["time_expired"]=(new DateTime())->format('Y-m-d H:i:s');
						// 				}else{
						// 					if($prediction[$i]["score_home"]!=$oldData[$j]["score_home"] || $prediction[$i]["score_away"]!=$oldData[$j]["score_away"]){
						// 						$prediction[$i]["time_expired"]=(new DateTime())->format('Y-m-d H:i:s');
						// 						$prediction[$i]["minute_expired"]=0;
						// 					}else{
						// 						$prediction[$i]["minute_expired"]=3-$minute_expired;
						// 					}
						// 				}
						// 			}
						// 		}
						// 	}
						// }
				}
			}
		}
		$dt=new DateTime();
		$this->cache->file->save('test',  $dt->format('Y-m-d H:i:s') . "<br>", 0);
		$this->cache->file->save('running',  "{\"Running\":".json_encode($prediction)."}", 0);
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
		//$this->cache->file->save('pregame', "{\"Pregame\":".json_encode($prediction)."}", 0);
		$matchfinished=null;
		$pregame=array();
		$expired=null;
		if($this->cache->file->is_supported() && $this->cache->file->get('yesterday_match')) {
			$matchfinished=json_decode($this->cache->file->get('yesterday_match'),true)['MatchesFinished'];
		}else{
			$matchfinished=array();
		};
		foreach($prediction as $item){
			if($item['match_period']=='FT'){
				$match_code=$item['match_code'];
				$matchExist=$this->existsInArray($matchfinished,$match_code);
				if(!$matchExist){
					array_push($matchfinished,$item);
				}
			}else{
				array_push($pregame,$item);
			}
		}
		usort($matchfinished, $this->date_sort($a,$b,'DESC'));
		usort($pregame, $this->date_sort($a,$b,'ASC'));
		$this->cache->file->save('pregame', '{"Pregame":'.json_encode($pregame).',"MatchesFinished":'.json_encode($matchfinished).'}', 0);
		$this->cache->file->save('yesterday_match', "{\"MatchesFinished\":".json_encode($matchfinished)."}", 0);
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
}