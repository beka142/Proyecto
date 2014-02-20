<?php

class Employee {

	public $first_name;
	public $last_name;
	public $genre;
	public $notification;

	function __construct($name, $lastname, $genre, $notification) {
		$this->first_name = $name;
		$this->last_name = $lastname;
		$this->genre = $genre;
		$this->notification = $notification;

	}

	function save($connection) {
		$query = "INSERT INTO employee (first_name, last_name, genre, notify) VALUES('$this->first_name', '$this->last_name', '$this->genre', $this->notification)";
		echo $query;

		mysqli_query($connection, $query);

	}
}

?>