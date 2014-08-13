<?php
App::uses('AppController', 'Controller');

class AgendaController extends AgendaAppController {
	public $uses = array('Patient', 'Agenda.Agenda');

    public function index() {
        $patients = $this->Patient->find('list');
        pr($patients);

        foreach($patients as $id=>$name){
        	$afspraken = $this->Agenda->find('all', array(
				'conditions' => array(
					'Agenda.patient_id' => $id,
				),
				'cache' => 'agenda_patient_'.$id,
				'cacheDebug' => true,
				'cacheConfig' => 'defaultcache'
			));

			pr(count($afspraken).' afspraak voor patient '.$name.' ('.$id.')');
        }

        $log = $this->Agenda->getDataSource()->getLog(false, false);
		debug($log['count'] . ' Queries');

        // pr($this->Agenda->findAllByPatientId(1));
        // pr($this->Agenda->findAllByPatientId(2));
    }
}
