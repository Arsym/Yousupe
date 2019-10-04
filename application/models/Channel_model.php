<?php 

class Channel_model extends CI_model {

	public function findChannel()
	{
		return $this->input->get('keyword');
	}
}