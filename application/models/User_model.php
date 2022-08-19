<?php
/**
 * Author: Akshay Rathod
 */
class User_model extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * [save_common common function to save data]
     * @param  string $table [table name]
     * @param  string $data  [data array to save]
     * @return [int / boolean]        [return last insert id or false on failure ]
     */
    function save_common($table='',$data=''){
    	if($table){
    		if($data){
    			return $this->db->insert($table, $data);
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }

    /**
     * [get_common common function to get records based on passed parameters]
     * @param  string  $table     [table name]
     * @param  array   $where     [where condtion in array]
     * @param  string  $select    [select string to select fields]
     * @param  integer $total_rec [1- single record, 2-mulitple records]
     * @param  string  $limit_to  [record limit]
     * @param  string  $group_by  [group by column]
     * @param  string  $order_by  [order by column]
     * @param  string  $order     [order]
     * @return [array]             [returns data]
     */
    function get_common($table='', $where=array(), $select='*', $total_rec=1, $limit_to='', $group_by = '', $order_by='id', $order='DESC', $start=''){

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($order_by, $order);

        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        if($limit_to != ''){
            $this->db->limit($limit_to, $start);
        }

        $query = $this->db->get();

        if($total_rec == 1){
            $result = $query->row();
        }else{
            $result = $query->result();
        }

        return $result;
    }
	
	public function record_count($table='', $where=array()) {
		$this->db->where($where);
		$this->db->from($table);
        return $this->db->count_all_results();
    }
	
    function update_common($table='', $where=array(), $update_data=''){
        
        $this->db->set($update_data);
        $this->db->where($where);
        $this->db->update($table);

        return true;
    }
	
	function field_exists($table='', $where=array(), $select='*')
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);

		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function delete_common($table='', $where=array())
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
} 
?>