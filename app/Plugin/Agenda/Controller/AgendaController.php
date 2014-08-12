<?php
App::uses('AppController', 'Controller');

class AgendaController extends AgendaAppController {
	public $uses = array('Patient', 'Agenda.Agenda');

    public function index() {
        $patients = $this->Patient->find('list');
        pr($patients);

        pr($this->Agenda->findAllByPatientId(1));
        pr($this->Agenda->findAllByPatientId(2));
    }
}
