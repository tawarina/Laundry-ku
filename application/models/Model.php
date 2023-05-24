<?php 

	class Model extends CI_Model {


		public function get_all($table) {
			return $this->db->get($table);
		}

		public function getID($table){
		    $this->db->select("ClothesID");
		    $this->db->from($table);
		    $this->db->order_by("ClothesID","DESC");
		    $this->db->limit(1);
		     //You can use limit before it. if u want last 3 or 4 entries from database.. 
		    $query = $this->db->get(); 
		    if($query->num_rows() > 0){
		        $category['rows'] = $query->num_rows();
		        return $query->result();
		    }
		    else {
		        return $query->result();
		    }
	    }

	    public function count_all($table){
	    	$this->db->select("COUNT(*)");
	    	$this->db->from($table);
	    	$query = $this->db->get();
	    	return $query->result();
	    }

		public function get_by($table,$id, $where) {
			return $this->db->get_where($table, [$id=>$where]);
		}

		public function save($table,$data) {
			$this->db->insert($table, $data);
		}

		public function delete($table,$pk, $where) {
			$this->db->delete($table, [$pk=>$where]);
		}

		public function update($table, $id, $where, $data) {
			$this->db->update($table, $data , [$id=>$where]);
		}

		public function reset_pass($table, $id, $where, $field) {
			$pass = '$2y$10$NuJpueDsXtO2jre2Dq5TXucFV8hEnOV4CLUnMAgvCpO5o2wIe6wOG';
			$data = [$field=>$pass];
			$this->db->update($table, $data, [$id=>$where]);
		}


		public function proses() {
				$this->db->select('*');
				$this->db->from('Transaction');
				$this->db->join('Transaction_status','transaksi.id_transaksi=Transaction_status.id_transaksi_s');
				$this->db->where('Transaction_status.selesai=0');
				$query = $this->db->get();

				return $query->result();
		}
		
		public function find_transaction_by_idTransaction($id_transaction) {
			$this->db->select('s.TransactionID, s.prosescuci, s.proseskering, s.prosesstrika, s.bisadiambil, s.selesai, t.Receipt, t.tDate, t.dDate, c.cName');
			$this->db->from('Transaction_status As s');
			$this->db->join('Transaction As t', 't.TransactionID = s.TransactionID');
			$this->db->join('Customers As c', 't.CustID = c.CustID');
			$this->db->where(['t.Receipt' => $id_transaction]);
			$query = $this->db->get();

			return $query->result_array();
		}

	}

?>
