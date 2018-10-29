<?php
/**
 * keyStone(SD) - Site Development
 *
 * Licensed under GNU General Public License v.2
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     TBD
 * @link          TBD
 * @package       app.Controller.InboundController
 * @since         keyStone(SD) v1.0 
 * @license       TBD
 */

class InboundController extends AppController {	
	
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function index(){
		$this->layout = null;
		$this->autoRender = false;
		return $this->redirect('/');
	}
	
	public function clear(){
		$this->layout = null;
		$this->autoRender = false;
		
		//Check the settings from before filter of AppController.  If condition true, session has already been destroyed and data points set  
		if(!($this->Session->check('Application.KeepOriginalCredentials') && $this->Session->read('Application.KeepOriginalCredentials') === "true")){
			$this->Session->destroy();		
		}
		
		return $this->redirect('/');
	}
	
	public function prepop(){
		
		//Check the settings from before filter of AppController.  If condition true, session has already been destroyed and data points set  
		if(!($this->Session->check('Application.KeepOriginalCredentials') && $this->Session->read('Application.KeepOriginalCredentials') === "true")){
			$this->Session->destroy();		
		}
		
		$qs = "CreditRating=excellent&Military=true&MonthlyNetIncome=3232&Zip=36006&Agree=true&LoanAmount=8500&LoanPurpose=debt&CoApplicant=Yes&FirstName=jtest&LastName=wtest&DateOfBirth=02%2F03%2F1987&SocialSecurityNumber=324324234&DriversLicenseNumber=32423423&DriversLicenseState=GA&Email=sdsfs3%40go.com&ResidenceType=ownwmtg&ResidentSinceDate=02%2F2010&Address1=3+fsdfsdf&Address2=suite+4&City=Billingsley&State=AL&RentMortgage=323&PrimaryPhone=7709418932&PhoneType=Mobile&EmployeeType=self_employed&EmployerName=sdfsdf&EmployerAddress=sdfsdf&EmployerCity=austell&EmployerState=GA&EmployerZip=30168&WorkPhone=7709419329&EmploymentTime=06%2F2010&PayFrequency=bi-weekly&DirectDeposit=true&CoFirstName=sdfsd&CoLastName=sfdsdfs&CoPrimaryPhone=7709427821&CoSsn=234324234&CoDateOfBirth=02%2F06%2F1990&CoEmployeeType=employed&CoEmployerName=sdfsdfds&CoWorkPhone=7709417983&CoEmploymentTime=02%2F2010&CoMonthlyNetIncome=34343&CoAppSameAddr=No&CoAddress1=sdfsdf&CoAddress2=sdfsf&CoCity=austell&CoState=GA&CoZip=30106&BankAccountType=checking&BankRoutingNumber=061000052&BankAccountNumber=234234232&BankName=BANK+OF+AMERICA+N.A.&BankTime=60&AgreeConsent=true&AgreePhone=true";
		parse_str($qs,$qsArray);
		
		$skip_array= array();
		if(is_array($qsArray)){
			foreach($qsArray as $k=>$v){
				if(in_array($k, $skip_array))continue;
					$this->setSessionData($k,$v);
			}
		}
		
		return $this->redirect('/');
	}
	
	/**
	 * Handle inbound offer link and set sessions accordingly.
	 * @param string $a - Affiliate ID
	 * @param string $id - Request ID
	 * @param string $cmp - Campaign ID
	 * @param string $c - Creative ID
	 * @param string $o - Offer ID
	 * @param string $s1 - Sub ID 1
	 * @param string $s2 - Sub ID 2
	 */
	public function offer($a, $id, $cmp, $c, $o, $s1='', $s2='') {
		$this->layout = null;
		$this->autoRender = false;
		
		$prepop = $this->request->query; //pull down GET Parameters
		$prepop_array = array('FirstName','LastName','Address1','Address2','City','State','Zip','Email','CreditRating','MonthlyNetIncome','ResidenceType','RentMortgage','PrimaryPhone','SecondaryPhone','PhoneType','EmployeeType','WorkPhone');
		
		// Start with a clean session
		$this->Session->destroy();
		
		$this->Session->write('Application.AffiliateId',$a);
		$this->Session->write('Application.RequestId',$id);
		$this->Session->write('Application.CampaignId',$cmp);
		$this->Session->write('Application.CreativeId',$c);
		$this->Session->write('Application.OfferId',$o);
		$this->Session->write('Application.SubId1',$s1);
		$this->Session->write('Application.SubId2',$s2);
		
		//Prepop Check and add to session
		if($this->request->query['Prepop'] == 'true'){
			if(!empty($prepop)){
				$this->setSessionData('Prepop', 'true');
				foreach($prepop_array as $field){
					if(isset($prepop[$field]) && !empty($prepop[$field])){
						$this->setSessionData($field, $prepop[$field]);	
					}
				}
			}
		}

		//Check file config to get theme or use default
		if($theme_config = $this->checkTheme()){
			$this->theme = $theme_config;
			$this->Session->write('Application.Theme', $theme_config);
		}else{
			$this->Session->write('Application.Theme', $this->theme);
		}
		
		return $this->redirect('/');
	}
	
	/**
	 * Set application variables in the user session
	 * @param string $key
	 * @param mixed $value
	 */
	private function setSessionData($key, $value){
		$this->Session->write('Application.'.$key, $value);
	}
}