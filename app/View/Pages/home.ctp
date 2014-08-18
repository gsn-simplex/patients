<h2>Patients</h2>
<ul>
	<li><?php echo $this->Html->link(__('Voeg een patient toe'), Router::url(array('controller' => 'patients','action' => 'add', 'admin' => true))); ?></li>
	<li><?php echo $this->Html->link(__('Bekijk lijst met patienten'), Router::url(array('controller' => 'patients','action' => 'index', 'admin' => true))); ?></li>
</ul>

<!--<h2>Todo</h2>
<ul>
	<li>Agenda plugin maken, patient moet afspraak kunnen maken. alleen bruikbaar als vlaggetje gezet</li>
	<li>Hoe gebruik je een schema in cake en in de plugin?</li>
	<li>Unit tests opbouwen</li>
</ul>

<h2>Links todo</h2>
<ul>
	<li><?php echo $this->Html->link(__('Patients Login'), Router::url(array('controller' => 'patients','action' => 'login'))); ?></li>
	<li><?php echo $this->Html->link(__('Agenda'), Router::url(array('plugin' =>'agenda', 'controller' => 'agenda','action' => 'index'))); ?></li>

</ul>
-->