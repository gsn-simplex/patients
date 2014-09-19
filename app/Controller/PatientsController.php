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

	public function bench(){
		/**
		 * Query the same query 1000 times and see how many hits the DB gets and the amount of time it takes
		 */
		// http://54.72.119.149/bench/50000/nocache/1
		// http://54.72.119.149/bench/50000/memcached/1
		// http://54.72.119.149/bench/50000/memcached/10

		if(isset($this->request->params['type'])){
			$type = $this->request->params['type'];
		} else {
			$type = 'nocache';
		}

		if(isset($this->request->params['iterations'])){
			$iterations = $this->request->params['iterations'];
		} else {
			$iterations = 1000;
		}

		if(isset($this->request->params['cacheduration'])){
			$cacheduration = $this->request->params['cacheduration'];
			cache::config('defaultcache', array('duration' => 1));
		}

		$startTime = microtime(true);
		for($i=0; $i<=$iterations; $i++){
			if($type == 'nocache'){
				$output = $this->Patient->find('all');
			} elseif($type == 'memcached'){
				$output = $this->Patient->find('all', array(
					'cache' => 'patient_all',
					'cacheConfig' => 'defaultcache',
					// 'cacheDebug' => true
				));
			}
		}
		$endTime = microtime(true);

		$timeElapsed = ($endTime - $startTime);
		$avgTimePerQueryMS = ($timeElapsed / $iterations) * 1000;
		$queryLog = $this->Patient->getDataSource()->getLog();

		pr($iterations . ' queries took ' .  $timeElapsed. ' sec');
		pr('Query average: ' . $avgTimePerQueryMS . ' ms');
		pr('Queries ran on DB: '. $queryLog['count']);
	}


	public function cache(){

		// Find all patients, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('all', array(
			'cache' => 'patient_all',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		// Find first patient, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('all', array(
			'cache' => 'patient_all',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		// Find first patient, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('first', array(
			'cache' => 'patient_first',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		// Find first patient, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('first', array(
			'cache' => 'patient_first',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		// Find first patient, cache results in cachekey 'patientlist'
		$output = $this->Patient->find('first', array(
			'cache' => 'patient_first',
			'cacheConfig' => 'defaultcache',
			'cacheDebug' => true
		));

		$queryLog = $this->Patient->getDataSource()->getLog();
		$this->set(compact('queryLog'));
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
