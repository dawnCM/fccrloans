<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('HttpSocket', 'Network/Http');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('RequestHandler', 'Session');
	public $theme = 'Alpha';
	public $template = 'crystal';
	public $keystone_site_id = 4;
	
	function beforeFilter() {
		
		//Ajax must validate
		if ($this->request->is('ajax')) {
			$basekey = Configure::read('Ajax.nonce');
			if($this->request->header('x-keyStone-nonce') != $basekey){
				throw new ForbiddenException();
				exit;
			}
		}
		if($this->params['url']['lp_request_id'] == true){ 
			
			$lp_request_id = $this->params['url']['lp_request_id'];
			$this->Session->write('Application.RequestId', $lp_request_id);
		}

		//---@16/4/2018 Prepop code ---
		//if(isset($this->params['url']['Prepop'])){
			if($this->params['url']['Prepop'] == true){
				$Prepop = $this->params['url']['Prepop'];
				// if Prepop Value is true then set Prepop data to Session
				if($Prepop=="true"){
					$url_prepop = $this->params['url'];
					$skip_array= array();
					if(is_array($url_prepop)){
						foreach($url_prepop as $k=>$v){
							if(in_array($k, $skip_array))continue;
							$this->Session->write('Application.'.$k, $v);
						}
					}
				}
			}
		//}

		$url_param = $this->params['url'];
		$this->Session->write('Application.SubId1', ($url_param['s1']) ? $url_param['s1'] : "");
		$this->Session->write('Application.SubId2', ($url_param['s2']) ? $url_param['s2'] : "");
		$this->Session->write('Application.SubId3', ($url_param['s3']) ? $url_param['s3'] : "");
		$this->Session->write('Application.SubId4', ($url_param['s4']) ? $url_param['s4'] : "");
		$this->Session->write('Application.SubId5', ($url_param['s5']) ? $url_param['s5'] : "");

		if($this->params['url']['check'] == false){ 
			
			$check = $this->params['url']['check'];
			$this->Session->write('Application.Check', $check);
		}else{

			$this->Session->write('Application.Check', 'true');
		}
		
		//Grab current session data
		$offer_id 		= $this->Session->read('Application.OfferId');
		$campaign_id 	= $this->Session->read('Application.CampaignId');
		$affiliate_id 	= $this->Session->read('Application.AffiliateId');
		$creative_id	= $this->Session->read('Application.CreativeId');
		$sub_id 		= $this->Session->read('Application.SubId1');
		$sub_id2 		= $this->Session->read('Application.SubId2');
		$request_id		= $this->Session->read('Application.RequestId');
				
		//Keep lead credentials if exist in session.  Remove other data points
		if( (isset($this->request->params['action']) && ($this->request->params['action'] == "clear" || $this->request->params['action'] == "prepop" ))  && (!empty($offer_id) && !empty($campaign_id) && !empty($affiliate_id))){
			// Start with a clean session
			$this->Session->destroy();
		
			$this->Session->write('Application.AffiliateId',$affiliate_id);
			$this->Session->write('Application.CampaignId',$campaign_id);
			$this->Session->write('Application.CreativeId',$creative_id);
			$this->Session->write('Application.OfferId',$offer_id);
			$this->Session->write('Application.SubId1',$sub_id);
			$this->Session->write('Application.SubId2', $sub_id2);
			$this->Session->write('Application.RequestId', $request_id);
			$this->Session->write('Application.KeepOriginalCredentials', "true");	
			
		
		}else{
			// Set organic offer if we do not have any offers set
			if(!$this->Session->check('Application.AffiliateId')) {
			
				$this->Session->write('Application.AffiliateId',Configure::read('Offers.Organic.AffiliateId'));
				$this->Session->write('Application.CampaignId',	Configure::read('Offers.Organic.CampaignId'));
				$this->Session->write('Application.OfferId',	Configure::read('Offers.Organic.OfferId'));
				$this->Session->write('Application.CreativeId', Configure::read('Offers.Organic.CreativeId'));
			}	
		}
		

		//Do we have a theme? if not, check theme.json and determine if we 
		//should set one or use the default alpha theme.
		if(!$this->Session->check('Application.Theme')) {
			if($theme_config = $this->checkTheme()){
				$this->theme = $theme_config;
				$this->Session->write('Application.Theme', $theme_config);
			}else{
				$this->Session->write('Application.Theme', $this->theme);	
			}			
		}else{
			$this->theme = $this->Session->read('Application.Theme');
		}
		
		//Set state dropdown
		$this->set('StateDrop', array(
			'AL'=>'ALABAMA','AK'=>'ALASKA','AZ'=>'ARIZONA','AR'=>'ARKANSAS','CA'=>'CALIFORNIA','CO'=>'COLORADO','CT'=>'CONNECTICUT','DE'=>'DELAWARE',
			'DC'=>'DISTRICT OF COLUMBIA','FL'=>'FLORIDA','GA'=>'GEORGIA','HI'=>'HAWAII','ID'=>'IDAHO','IL'=>'ILLINOIS','IN'=>'INDIANA','IA'=>'IOWA','KS'=>'KANSAS','KY'=>'KENTUCKY',
			'LA'=>'LOUISIANA','ME'=>'MAINE','MD'=>'MARYLAND','MA'=>'MASSACHUSETTS','MI'=>'MICHIGAN','MN'=>'MINNESOTA','MS'=>'MISSISSIPPI','MO'=>'MISSOURI','MT'=>'MONTANA','NE'=>'NEBRASKA',
			'NV'=>'NEVADA','NH'=>'NEW HAMPSHIRE','NJ'=>'NEW JERSEY','NM'=>'NEW MEXICO','NY'=>'NEW YORK','NC'=>'NORTH CAROLINA','ND'=>'NORTH DAKOTA','OH'=>'OHIO','OK'=>'OKLAHOMA',
			'OR'=>'OREGON','PA'=>'PENNSYLVANIA','RI'=>'RHODE ISLAND','SC'=>'SOUTH CAROLINA','SD'=>'SOUTH DAKOTA','TN'=>'TENNESSEE','TX'=>'TEXAS','UT'=>'UTAH','VT'=>'VERMONT',
			'VA'=>'VIRGINIA','WA'=>'WASHINGTON','WV'=>'WEST VIRGINIA','WI'=>'WISCONSIN','WY'=>'WYOMING'));
			
		
		//Smart Load Js
		$this->set('loadApplicationJS',false);
				
		//Set mobile check
		if ($this->RequestHandler->isMobile()) {
     		Configure::write('Global.Mobile', true);
     		$this->Session->write('Application.Mobile', true);
		}else{
			if($this->Session->read('Script.Ancillary') != 'built'){
				$this->buildAncillaryPops();
				$this->Session->write('Script.Ancillary', 'built');
			}
		}
				
		
	}

	/**
	 * Check to see what theme we should set.
	 * @return string
	 */
	protected function checkTheme(){
		//Check cache to get json or pull from file
		$cache['hash'] = md5('JSONTheme');
		$cache['value'] = false;
		$cache['value'] = Cache::read($cache['hash']);
	
		if($cache['value'] === false){
			$result = $this->checkThemeJsonFile();
			if(is_array($result)){
				Cache::write($cache['hash'],json_encode($result),'15m');	
			}
		}else{
			$result = json_decode($cache['value'], true);
		}
		
		$theme=false;
		if(is_array($result)){
			//actions - Campaign(c) Split(s)  Time(t)
			$theme = $this->themeLogic($result);
			if(trim($theme) == false || trim($theme) == ""){
				$theme = $this->theme; //set back to default	
			}else{
				if(!is_dir('../View/Themed/'.$theme)){
					$theme=false;
				}
			}	
		}
	
		return $theme;
	}

	/**
	 * Theme configuration file
	 * @return string|boolean
	 */
	protected function checkThemeJsonFile(){
		$file = new File('../tmp/json/theme.json', false, 0777); //create object - will not error at this level if missing	
		if( $file->exists() ){ //Does file exist
			$file_contents = @$file->read(false, 'rb', false);
			if($file->size() > 0 && $jsonToArray = @json_decode($file_contents,true)){ //check if valid json
				if(is_array($jsonToArray)){
					return $jsonToArray;
				}
			}
		}
		return false;
	}
	
	protected function themeLogic(ARRAY $data){
		//json by time - {"c":"24","a":"t","theme":["alpha","beta"],"v":"23:56"}
		//json by percentage -  {"c":"24","a":"s","theme":["alpha","beta"],"v":["50","50"]}
		//json by campaign only - {"c":"24","a":"c","theme":"alpha"}
		
		$specific_config = false; //array holder for a specific campaign config
		$default_config = false; //array holder for default config for all campaigns
		
		$campaignid = $this->Session->read('Application.CampaignId');
		
		foreach($data as $k=>$v){
			//set default array	if present
			if($v['c'] == "default"){
				$default_config = $v;
				continue;	
			}
			
			//set specific campaign config is present
			if($v['c'] == $campaignid){
				$specific_config = $v;
			}
		}
		
		if($specific_config === false && $default_config === false){ //Use app controller theme
			return false;
		}else if(is_array($specific_config)){ //rank 1
			$config = $specific_config;
		}else if(is_array($default_config)){ // rank 2
			$config = $default_config;
		}else{
			return false; //use app controller theme
		}
		
		
		switch ($config['a']) { //actions - Campaign(c) Split(s)  Time(t)
			case 's': //split percentage
				$campaign_id = $config['c'];
				$theme1 = $config['theme'][0];
				$theme2 = $config['theme'][1];
				$split_percentage1 = (INT) $config['v'][0] / 10; //whole number 1-10
				$split_percentage2 = (INT) $config['v'][1] / 10; //whole number 1-10
				$random_number = rand(1, 10);
				
				return ucfirst((($random_number <= $split_percentage1) ? $theme1 : $theme2 ));
				break;
			
			case 't': //Split by Time
				$campaign_id = $config['c'];
				$theme1 = $config['theme'][0];
				$theme2 = $config['theme'][1];
				$split_unix = strtotime($config['v']); //to unix format HH:MM 24hour format
				$current_unix = strtotime("now");
				return ucfirst((($current_unix < $split_unix) ? $theme1 : $theme2 ));
				break;
			
			case 'c': //Campaign
				$campaign_id = $config['c'];
				$theme = $config['theme'];
				return ucfirst($theme);
				break;
				
			default:
				return false;
				break;
		}
	}
	/* -Check memcache to see if config exists. If not, Service call to get config
	 * -Check the Restrictions (no pops for Affiliate/Subaffiliate)
	 * -Loop through config and build javascript
	 * -Print javascript layout
	 */
	protected function buildAncillaryPops(){
		//Just incase we forget to declare and initilize property
		if(!isset($this->keystone_site_id)){
			$keystone_site_id = 4;
		}else{
			$keystone_site_id = $this->keystone_site_id;
		}
		$affiliate_id 	= $this->Session->read('Application.AffiliateId');
		$sub_id 		= $this->Session->read('Application.SubId1');
		
		$ancillaryConfig = false;
		
		if($this->RequestHandler->isMobile()){
			return;	
		}
		
		//Check cache to get json config
		$cache['hash'] = md5('AncillaryPops_4');
		$cache['value'] = false;
		$cache['value'] = Cache::read($cache['hash']);
	
		if($cache['value'] === false){
			
			$httpPops = new HttpSocket();
			$result = $httpPops->get(Configure::read('Global.ServiceUrl').'/getAncillaryPops/'.$keystone_site_id);
			
			if(!empty($result->body)){
				$config_array = json_decode($result->body, true);
				
				if($config_array['status'] == 'success'){
					$ancillaryConfig = $config_array['body'];
					
					Cache::write($cache['hash'],json_encode($config_array['body']));	
				}else{
					//Only success when I can pull a config and do something
					return;	
				}	
			}else{
				//Empty response
				return;
			}
		}else{
			//Cache has value
			$ancillaryConfig = json_decode($cache['value'], true);
		}
	
		if($ancillaryConfig === false){
			return;	
		}	
		
		
		
		$js = <<<JS
		
//The numeric values are assigned by me.  These va
var pages_map = {"home"  			: 6,
				 "personal_info"	: 0,
				 "verify_identity"	: 1,
				 "employment_info"	: 2,
				 "deposit_cash"		: 4,
				 "finalize"			: 5
				};
\n				
var ancillary_manager = {"page" : 	{"0"	: [],
									 "1"	: [],
									 "2"	: [],
									 "4"	: [],
									 "5"	: [],
									 "6"	: []
									},
									
						 "pop_config" : {}
						};			
\n

function randomId(){
	return Math.floor((Math.random() * 10) + 1);
}
\n
function pop(manager_id){
	var type = ancillary_manager.pop_config[manager_id].type;
	var url = ancillary_manager.pop_config[manager_id].url;
	var infinite_pop = ancillary_manager.pop_config[manager_id].infinite_pop;
	var shown = ancillary_manager.pop_config[manager_id].shown;
	
	//Only show once		
	if(shown == 'true' && infinite_pop == 'false'){
		return;
	}
		
	window.open(url, 'win_'+randomId()+'_'+type+'_'+randomId(), 'width=500,height=400');
	ancillary_manager.pop_config[manager_id].shown = 'true';

	
}
\n
function ancillaryPageChangeCheck(page_id){
				
		
	$.each( ancillary_manager.pop_config, function( index, obj ) {
		//index is the same index in ancillary manager
		
		if(obj.type == 'page' && obj.page_id == page_id){
			
			pop(index);
		}
	});	

}
\n

jQuery(document).ready(function(){
							
JS;
		
			$index_ct = 0;
			$js_config = array();
			foreach($ancillaryConfig  as $index=>$configuration){
				$config = $configuration['Ancillary'];
				$blocked = $configuration['SiteConfiguration']['blocked'];
				$infinite_pops = (($configuration['SiteConfiguration']['infinite_pop']) ? 'true' : 'false');
				
				if(!empty($blocked)){ // not blank
					$blocked_array = json_decode($blocked, true);
					
					if(is_array($blocked_array)){
						$block_ancillary = false;
						foreach($blocked_array as $blocked_data){
							$aff = $blocked_data[0];
							$subs = $blocked_data[1];
							
							$subs = ((empty($subs) || $subs == "" || $subs == null || $subs == "null") ? false : $subs);
							
							if(!$subs){ // no subs so search for a match on affiliate only
							
								if($aff == $affiliate_id){
									
									$block_ancillary = true;
									break;
								}
							}else if($aff == $affiliate_id){ //affilite id matach but subs are present
							
								$exploded_subs = explode(",", $subs);
								foreach($exploded_subs as $s_id){
									if(empty($s_id))continue;
									
									if($s_id == $sub_id){
										$block_ancillary = true;
										break;	
									}
								}
							}
						}
						
						if($block_ancillary){
							continue;
						}
					}	
				}
				
				$status = $config['status'];
				$type = $config['type'];
				
				switch ($type) {
					case 'field':
						$url = $config['url'];
						$trigger = json_decode($config['triggeraction'], true);
						
						foreach($trigger as $field=>$values){ //loop through fields
						
							//Convert comma separated into single array.
							if(!is_array($values)){
								$exploded =  explode(",", $values);
								$values = array(); //reset
								foreach($exploded as $data){
									if(empty($data))continue;
									$values[] = $data;
								}
								
								//no data. go to next
								if(empty($values))continue;
							}
						
							//Start js onchange.  Add namespace to event so we can easily remove.
							$js .= <<<JS
									
	$(document).on('change','#$field', function(){
													
JS;
							
							$ct = 0;
							foreach($values as $val){ //loop through values and concatenate javascript
						
								$js_config[$index_ct] = array('url'=>$url, 'type'=>'field', 'infinite_pop'=>$infinite_pops, 'shown'=>'false' );
								
								//Add conditions to look for inside of event
								$js .= <<<JS
		if(jQuery('#$field').val() == '$val'){
			pop($index_ct);
				
		} \n
JS;
								$index_ct++;	
							}
							
							//Close Event
							$js .= <<<JS
	
	});	
				
JS;
													
						}
						
						break;
						
						
					case 'click':
						$url = $config['url'];	
						$trigger = json_decode($config['triggeraction'], true);
						$field = $trigger['click'];
						
						$js_config[$index_ct] = array('url'=>$url, 'type'=>'click', 'infinite_pop'=>$infinite_pops, 'shown'=>'false' );
								
						
						$js .= <<<JS
	jQuery('#$field').on('click', function(){
		pop($index_ct);
	});
	\n												
JS;
						break;
						
					case 'page':
						$url = $config['url'];
						$trigger = json_decode($config['triggeraction'], true);
						$page_name = $trigger['page'];
						
						
						$js .= <<<JS
	//add to manager to be checked at time of action
	var page_id = pages_map['$page_name'];						
	ancillary_manager.pop_config[$index_ct] = {'url': '$url', 'type':'page', 'infinite_pop':'$infinite_pops', 'shown':'false', 'page_id':page_id};		
	\n												
JS;
						
						
						break;
										
					default:
						
						break;
				}
				
				//id for javascript
				$index_ct++;	
			}
			
			$js_json = json_encode($js_config);		
		$js .= <<<JS
				    var js_obj = JSON.parse('$js_json');
				    	
				    	//Add info to object	
				    	$.each( js_obj, function( index, obj ) {
						    ancillary_manager.pop_config[index] = {'url': obj.url, 'type': obj.type, 'infinite_pop': obj.infinite_pop, 'shown':'false'};	
						});
										    	
				
					
});
JS;
		$this->Session->write('Script.ancillaryConfig', $js);
	}
}