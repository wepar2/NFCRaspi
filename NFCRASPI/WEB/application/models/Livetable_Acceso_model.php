<?php
class Livetable_Acceso_model extends CI_Model
{
	function load_data()
	{
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('acceso');
		return $query->result_array();
	}

	function insert($data)
	{
		$this->db->insert('acceso', $data);
	}

	function update($data, $id)
	{
		$res=$this->db->where('id', $id);
		$this->db->update('acceso', $data);
               
                return $res;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('acceso');
	}
        
        
        
}
?>