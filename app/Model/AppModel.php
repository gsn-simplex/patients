<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public $actsAs = array(
		'Containable'
	);

	public $recursive = -1;

	/**
	* Rewrite of the basic cakephp find function
	* First checks the cache instead of querying the database directly
	* --
	*
	* Add cache params to the find array to enable caching for that query
	*
	* Usage:
	* $this->User->find('list',
    * 	array(
    * 		'cache' => 'userList',
    * 		'cacheConfig' => 'short',
    * 		'cacheDebug' => false,
    * 		'conditions' => .. ,
    * 		'order' => .., etc ..
    * 	)
	* );
	*
	* Cache is written to a folder called 'database' in the default cache folder, make sure it's writable
	*
	* --
	* courtesy of: http://phpmaster.com/speeding-up-your-cakephp-websites/
	*/

	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		$doQuery = true;
		$cacheDebug = false;

		// Check for custom debug level
		if (!empty($fields['cacheDebug'])) {
			$cacheDebug = $fields['cacheDebug'];
		}

		// Force debug
		// $cacheDebug = true;

		// check if we want the cache
		if (!empty($fields['cache'])) {
			$cacheConfig = null;

			// Check if we have specified a custom config
			if (!empty($fields['cacheConfig'])) {
				$cacheConfig = $fields['cacheConfig'];

				// Lets collect all the garbage first
				Cache::gc($fields['cacheConfig']);
			}

			// Define cache name, starting with modelname
			$cacheName = /*$this->name . '-' .*/ $fields['cache'];

			// Attempt to read the cache
			$data = Cache::read($cacheName, $cacheConfig);

			// Check if the cache exists and holds valid data
			if ($data === false) { // && $data !== 0 && count($data) != 0
				/***** Coming at this point, we have no cache data *****/

				// Send debug message
				if($cacheDebug) { echo "<pre>".$cacheConfig." -> "; print_r($fields['cache'].' :: cache not found, query'); echo "</pre>"; }

				// Do actual $model->find()
				$data = parent::find($conditions, $fields, $order, $recursive);

				// Dont save anything that is empty to cache
				if($data !== false) {
					Cache::write($cacheName, $data, $cacheConfig);
				}
			} else {
				// Send debug message
				if($cacheDebug) { echo "<pre>".$cacheConfig." -> "; print_r($fields['cache'].' :: cache found!'); echo "</pre>"; }
			}

			$doQuery = false;
		}

		if ($doQuery) {
			// Send debug message
			if($cacheDebug) { echo "<pre>"; print_r('No cache rules found, do regular query'); echo "</pre>"; }
			$data = parent::find($conditions, $fields, $order, $recursive);
		}
		return $data;
	}
}
