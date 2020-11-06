<?php
namespace App\Library;

class ResponseEstructure
{
	private $response;
	private $messages;
	private $data;
	private $login;
	private $id_usuario;

	public function __construct()
	{
		$this->response = false;

		$this->messages = array(
			"messages_errors"=>array(),
			"messages_success"=>array()
		);

		$this->login = false;

		$this->private = array();
	}

	public function set_response($response)
	{
		$this->response = $response;
	}

	public function get_response()
	{
		return $this->response;
	}

	public function set_id_usuario($id_usuario)
	{
		$this->id_usuario = $id_usuario;
	}

	public function get_id_usuario()
	{
		return $this->id_usuario;
	}

	public function set_data($data)
	{
		$this->data = $data;
	}

	public function get_data()
	{
		return $this->data;
	}

	public function set_login($login)
	{
		$this->login = $login;
	}

	public function get_login()
	{
		return $this->login;
	}

	public function add_message_error($message)
	{
		$this->messages["messages_errors"][] = $message;
	}

	public function add_message_success($message)
	{
		$this->messages["messages_success"][] = $message;
	}

	public function get_response_array()
	{
		return array(
			"response"=>$this->response,
			"login"=>$this->login,
			"id_usuario"=>$this->id_usuario,
			"messages_success"=>$this->messages["messages_success"],
			"messages_errors"=>$this->messages["messages_errors"],
			"data"=>$this->data,
		);
	}
}