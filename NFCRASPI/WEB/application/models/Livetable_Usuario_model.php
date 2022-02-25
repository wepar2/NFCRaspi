<?php
class Livetable_Usuario_model extends CI_Model
{
	function load_data()
	{               
            $query = 'SELECT personal.*,acceso.fechaEntrada FROM personal left join acceso on personal.uid = acceso.uid where acceso.fechaEntrada in (select max(fechaEntrada) from acceso group by acceso.uid) or acceso.fechaEntrada is NULL';
	
            $resultados = $this->db->query($query);
            return $resultados->result();
            
        }

	function insert($data)
	{
		$this->db->insert('personal', $data);
	}

	function update($data, $id)
	{
		$res=$this->db->where('id', $id);
		$this->db->update('personal', $data);
               
                return $res;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('personal');
	}
        
}
?>