<?php
App::uses('AppModel', 'Model');
/**
 * Patient Model
 *
 */
class Patient extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'firstname';

	/**
	* Login a patient to Simplex
	*
	*/
	public function loginCheck(){
		return true;
	}

}
