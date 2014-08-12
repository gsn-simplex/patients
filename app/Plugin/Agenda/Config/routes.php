<?php

// Map routing to this, this is overwritten by the base routing
Router::connect('/agenda', array('plugin' => 'agenda', 'controller' => 'agenda', 'action' => 'index'));

// Promote these routes to be able to overwrite base routing
Router::promote();