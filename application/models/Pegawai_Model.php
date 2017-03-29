<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataPegawai()
		{
			$this->db->select("id,nama,nip,DATE_FORMAT(tanggalLahir,'%d-%m-%Y') as tanggalLahir");
			$query = $this->db->get('pegawai');
			return $query->result();
		}

		public function getJabatanByPegawai($idPegawai)
		{
			$this->db->select("pegawai.nama as namaPegawai, namaJabatan,DATE_FORMAT(tanggalMulai,'%d-%m-%Y') as tanggalMulai,DATE_FORMAT(tanggalSelesai,'%d-%m-%Y') as tanggalSelesai");
			$this->db->where('fk_pegawai', $idPegawai);	
			$this->db->join('pegawai', 'pegawai.id = jabatan_pegawai.fk_pegawai', 'left');	
			$query = $this->db->get('jabatan_pegawai');
			return $query->result();
		}
		public function getAnakByPegawai($idPegawai)
		{
			$this->db->select("pegawai.nama as namaPegawai, anak.nama as namaAnak,DATE_FORMAT(anak.tanggalLahir,'%d-%m-%Y') as tanggalLahir");
			$this->db->where('fk_pegawai', $idPegawai);	
			$this->db->join('pegawai', 'pegawai.id = anak.fk_pegawai', 'left');	
			$query = $this->db->get('anak');
			return $query->result();
		}


		public function insertPegawai()
		{
			$object = array('nama' => $this->input->post('nama'),
						'nip' => $this->input->post('nip'),
						'tanggalLahir' => $this->input->post('ttl')
						,
						'alamat' => $this->input->post('alamat')

			 );

			$this->db->insert('pegawai', $object);
		}

// 		$data = array(
// 'Student_Name' => $this->input->post('dname'),
// 'Student_Email' => $this->input->post('demail'),
// 'Student_Mobile' => $this->input->post('dmobile'),
// 'Student_Address' => $this->input->post('daddress')
// );


		public function getPegawai($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('pegawai',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array('nama' => $this->input->post('nama'), 
				'nip' => $this->input->post('nip'),
			'tanggalLahir' => $this->input->post('ttl'),
			'alamat' => $this->input->post('alamat'));
			$this->db->where('id', $id);
			$this->db->update('pegawai', $data);
		}

		public function delete($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('pegawai');
		}

}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>