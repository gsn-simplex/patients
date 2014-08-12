<?php
App::uses('Agenda.Agenda', 'Model');

/**
 * Patient Test Case
 *
 */
class AgendaTest extends CakeTestCase {

	/**
	* Test testAgenda
	* List of assertions : http://phpunit.de/manual/3.7/en/appendixes.assertions.html
	*/
	public function testTestAgenda() {
    	$result = $this->Agenda->testAgenda(array('test' => 'testvalue'));
    	$this->assertArrayHasKey('test', $result);
    }

    public function testTestAgenda2() {
    	$result = $this->Agenda->testAgenda('test');
    	$this->assertEquals('test', $result);
    }


	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->Agenda = ClassRegistry::init('Agenda.Agenda');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Agenda);

		parent::tearDown();
	}

}
