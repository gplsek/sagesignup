<?php

class SignupController extends AppController {
    public $helpers = array('Html', 'Form','Session','Xml');
	public $components = array('Session');
	
	public function index() {
		
		
		if ($this->request->is(array('post', 'put'))) {
			        $api = Configure::read('apiurl');
			        App::uses('HttpSocket', 'Network/Http');
					App::uses('Xml', 'Utility');
			        $HttpSocket = new HttpSocket();
					$pdata = array(
						'_CompanyId' => '1',
						'_PhoneNumber' => $this->request['data']['phonenumber']
					);
					
					$_SESSION['phonenumber'] = $this->request['data']['phonenumber'];
					$_SESSION['zipcode'] = $this->request['data']['zipcode'];
					$_SESSION['servicetype'] = $this->request['data']['servicetype'];
					$_SESSION['promocode'] = $this->request['data']['promocode'];
					
			        $phonecheck = $HttpSocket->post($api.'DoesTNExist', $pdata);
					$phoneResponse = Xml::toArray(Xml::build($phonecheck->body));
					
					if($phoneResponse['Response']['ErrorCode'] == 0){

						$servicerequest = array(
							'_CompanyId' => '1',
							'_PlatformType' => 'WIRELESS',
							'_PrePaid' => 'false',
							'_Npa' => substr($this->request['data']['phonenumber'], 0, 3),
							'_Nxx' => substr($this->request['data']['phonenumber'], 3, 3),
							'_ServiceType' => $this->request['data']['servicetype'],
							'_SourceCode' => '',
							'_AgentID' => 0
						);
						
				        $services = $HttpSocket->post($api.'GetProductsByNpaNxx', $servicerequest);
 					    $serviceResponse = Xml::toArray(Xml::build($services->body));
						
					}
					
					//check wiht zipcode
					if(($phoneResponse['Response']['ErrorCode'] != 0) || ($serviceResponse['Response']['ErrorCode'] != 0)){
						if(isset($this->request['data']['zipcode']) && ($this->request['data']['zipcode'] != '')){
						$servicerequest = array(
							'_CompanyId' => '1',
							'_PlatformType' => 'WIRELESS',
							'_PrePaid' => 'false',
							'_ZipCode' => $this->request['data']['zipcode'], 
							'_ServiceType' => $this->request['data']['servicetype'],
							'_SourceCode' => '',
							'_AgentID' => 0
						);
						 
				          $services = $HttpSocket->post($api.'GetProductsByZip', $servicerequest);
	 					  $serviceResponse = Xml::toArray(Xml::build($services->body));
					
	 					  
						  
					   }else{
					   	$this->Session->setFlash(__('Please enter zipcode'));
					   }
					}
					
					
				     if($serviceResponse['Response']['ErrorCode'] == 100){
	                    $this->Session->setFlash(__('There are no services available in your area'));
			         }else if($serviceResponse['Response']['ErrorCode'] == 0){
					  //print_r($serviceResponse['Response']);die();
					  $this->set('plans',$serviceResponse['Response']);
					  return $this->render('selectPlan');
			         }else{
			      	  $this->Session->setFlash(__('something went wrong error:'.$serviceResponse['Response']['ErrorCode']));
			         }
					
			
		            return $this->redirect(array('action' => 'index'));
		    }
	        
	    }
		
}