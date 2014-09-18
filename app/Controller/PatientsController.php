<?php
App::uses('AppController', 'Controller');
/**
 * Patients Controller
 *
 * @property Patient $Patient
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PatientsController extends AppController {

	public function cache(){

		// Find all patients, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('all', array(
			'cache' => 'patientlist',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		// Find first patient, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('all', array(
			'cache' => 'patientlist',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		// Setting and _serializing output to force parsing the JSON extension
		$this->set('output', $output);
		$this->set('_serialize', 'output');
	}

	public function bench(){

		/// ------- Change DB to amazon
		$this->Patient->setDataSource('amazon');
		/// -------
		///
		$tic = microtime(true);
		pr('Amazon: ' .count($this->Patient->find('all')));
		$toc = microtime(true);

		$time = ($toc - $tic) * 100;
		pr($time.' ms');

		/// ------- Change DB to default
		$this->Patient->setDataSource('default');
		/// -------
		///
		$tic = microtime(true);
		pr('Local DB: '. count($this->Patient->find('all')));
		$toc = microtime(true);

		$time = ($toc - $tic) * 100;
		pr($time.' ms');
	}

	function test2(){
		echo 'hallo';
	}

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	/**
	* Login a patient to Simplex
	*
	*/
	public function login(){
		if ($this->request->is('post')) {
			$result = $this->Patient->loginCheck();
			var_dump($result);
			$this->set('result', $result);
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Patient->recursive = 0;
		$this->set('patients', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Patient->exists($id)) {
			throw new NotFoundException(__('Invalid patient'));
		}
		$options = array('conditions' => array('Patient.' . $this->Patient->primaryKey => $id));
		$this->set('patient', $this->Patient->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Patient->create();
			if ($this->Patient->save($this->request->data)) {
				$this->Session->setFlash(__('The patient has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Patient->exists($id)) {
			throw new NotFoundException(__('Invalid patient'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Patient->save($this->request->data)) {
				$this->Session->setFlash(__('The patient has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Patient.' . $this->Patient->primaryKey => $id));
			$this->request->data = $this->Patient->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Patient->id = $id;
		if (!$this->Patient->exists()) {
			throw new NotFoundException(__('Invalid patient'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Patient->delete()) {
			$this->Session->setFlash(__('The patient has been deleted.'));
		} else {
			$this->Session->setFlash(__('The patient could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
