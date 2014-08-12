<?php
App::uses('AppModel', 'Model');

class Agenda extends AgendaAppModel {

	public $displayField = 'date';
	public $useTable = 'agenda';

	public function testAgenda($value){
		return $value;
	}
}
