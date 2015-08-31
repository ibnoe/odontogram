<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		# code...
        parent::__construct();
        $this->load->helper('url');
	}
	public function index()
	{
		$data['title'] = "Pasien";
		$this->load->model('m_main');
		$data['pasien'] = $this->m_main->getall('pasien');
		$this->load->view('dashboard/header', $data);
		$this->load->view('pasien/index', $data);
		$this->load->view('dashboard/footer');
	}
	public function tambah()
	{
		$data['title'] = "Pasien - New";
		$this->load->view('dashboard/header', $data);
		$this->load->view('pasien/add');
		$this->load->view('dashboard/footer');
	}
	public function ubah($id)
	{
		$this->load->model('m_main');
		$where = array(
			'id_dokter' => $id
		);
		$data['dokter'] = $this->m_main->select_where('dokter',$where);
		$data['title'] = "Dokter - Update";
		$this->load->view('dashboard/header', $data);
		$this->load->view('dokter/update', $data);
		$this->load->view('dashboard/footer');
	}
	public function add()
	{
		# code...
		$this->load->model('m_main');
		$table = 'pasien';
		$data = array(
			'nama_pasien' => $this->input->post('nama_pasien'),
			'ktp_pasien' => $this->input->post('ktp_pasien'),
			'tempat_lahir_pasien' => $this->input->post('tempat_lahir_pasien'),
			'tanggal_lahir_pasien' => $this->input->post('tanggal_lahir_pasien'),
			'jk_pasien' => $this->input->post('jenis_kelamin_pasien'),
			'suku_pasien' => $this->input->post('suku_pasien'),
			'pekerjaan_pasien' => $this->input->post('pekerjaan_pasien'),
			'alamat_rumah_pasien' => $this->input->post('alamat_rumah_pasien'),
			'telepon_rumah_pasien' => $this->input->post('telepon_rumah_pasien'),
			'alamat_kantor_pasien' => $this->input->post('alamat_kantor_pasien'),
			'ponsel_pasien' => $this->input->post('ponsel_pasien')
		);

		$this->m_main->insert($table, $data);
		$this->index();
	}
	public function update()
	{
		$data = array(
			'nama_dokter' => $this->input->post('nama_dokter'),
			'alamat_dokter' => $this->input->post('alamat_dokter'),
			'alamat_praktik_dokter' => $this->input->post('alamat_praktik_dokter'),
			'telepon_dokter' => $this->input->post('telepon_dokter'),
			'password_dokter' => md5($this->input->post('password_dokter'))
		);
		$where = array(
			'id_dokter' => $this->input->post('id_dokter')
		);
		$this->load->model('m_main');
		$this->m_main->update('dokter',$data, $where);
		$this->index();
	}
}