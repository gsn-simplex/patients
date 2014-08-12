<?php

App::uses('AppController', 'Controller');

class AgendaAppController extends AppController {
	public function beforeFilter(){
		
		// First execute the parents' beforeFilter
		parent::beforeFilter();
		
		// Then check if this client even has access to this plugin
		$hasAccess = true;
		if(!$hasAccess){
			throw new ForbiddenException();
		}
	}
}
