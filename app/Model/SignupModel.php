<?php
	
class Signup extends AppModel {
	
	public function checkService($data = null){
		
		$this->request = array(
			'uri' => array(
				'host' => '',
				'path' => ''),
			'body' => array(
				'phonenumber' => $data['checkService']['phonenumber'],
				'zipcode' => $data['checkService']['zipcode'],
			)
			)
			
		);
		return parent::save($data);
		
	}
	
	
	
}
	
