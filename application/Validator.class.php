<?php

abstract class Validator {

/*
 * @registry object
 */
protected $registry;

function __construct($registry) {
	$this->registry = $registry;
}

}

?>
