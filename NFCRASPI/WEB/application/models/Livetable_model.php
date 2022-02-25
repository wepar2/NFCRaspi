<?php
class LiveTable_model extends CI_Model
{
	function load_data()
	{
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('administradores');
		return $query->result_array();
	}

	function insert($data)
	{
		$this->db->insert('administradores', $data);
	}

	function update($data, $id)
	{
		$res=$this->db->where('id', $id);
		$this->db->update('administradores', $data);
               
                return $res;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('administradores');
	}
}
?>