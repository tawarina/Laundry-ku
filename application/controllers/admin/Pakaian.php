<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');


class Pakaian extends CI_Controller {

	var $table 		= 'clothestypes';
	var $folder		= 'pakaian/';
	var $section 	= 'Pakaian';

	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect(base_url('')); 
        };
		$this->load->model(['Model']);
		$this->load->library(['form_validation', 'encryption']);

	}

	public function index()
	{	
		$this->db->order_by('tName', 'ASC');
		$data = [
					'content' 	=> $this->folder.('view'),
					'section'	=> $this->section,
					'tampil'	=> $this->Model->get_all($this->table)->result()
				];
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama', 'Jenis Pakaian', 'required|rtrim');
		$post 	= $this->input->post();
		$cek 	= count($this->Model->get_by($this->table, 'tName', $post['nama'])->result());
		if ($this->form_validation->run()==true) {
			if($cek<1){
				$lastid = $this->Model->getID($this->table);
				$split = explode("-", $lastid[0]->ClothesID);
				$ss = $split[1] + 1;
				$customid = "C"."-".$ss;
				$data = [
							'ClothesID'	=>$customid,
							'tName'	=>$post['nama'],
							'Additionalfee' =>$post['biaya']
						];
				$this->Model->save($this->table, $data);
				$this->session->set_flashdata('flash','<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di simpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' );
				redirect('admin/pakaian');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Jenis Pakaian</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/pakaian');
			}
		}else{
		}
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Jenis Pakaian</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
	}


	public function edit()
	{
		$this->form_validation->set_rules('namapakaian', 'Jenis Pakaian', "required|rtrim|");
		$post 		= $this->input->post();
		$oldNama	= $post['oldNama'];
		$oldBiaya	= $post['oldBiaya'];
		$nama 		= $post['nama'];
		$biaya 		= $post['biaya'];
		$cek = count($this->Model->get_by($this->table, 'tName', $nama)->result());

		if($this->form_validation->run()==False){
			if($cek<1){
				$data = [
					'tName'=>$nama,
					'Additionalfee'=>$biaya
			];
				$this->Model->update($this->table,'tName', $oldNama, $data);
				$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di ubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/pakaian');
			}else{
				$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><b>Jenis Pakaian</b> sudah ada.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('admin/pakaian');
			}
		}else{
			$this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Form <b>Jenis Pakaian</b> tidak boleh kosong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/pakaian');
		}
	}




}
?>