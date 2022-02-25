<?php
class UploadFile_model extends CI_Model
{
	function insert($data)
	{
            $this->db->insert('personal', $data);
	}

	function update($data, $id)
	{
            $res=$this->db->where('id', $id);
            $this->db->update('personal', $data);
//                echo json_encode(array('status' => 'OK', 'data pruebas ' => $res));
        return $res;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('personal');
	}
}
?>