<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        redirect_if_level_not('Manager');
        $this->load->model('Jabatan_model', 'jabatan');
    }

    public function index()
    {
        $data['jabatan'] = $this->jabatan->get_all();
        return $this->template->load('template', 'jabatan', $data);
    }

    public function store()
    {
        $nama_jabatan = $this->input->post('nama_jabatan');
        $result = $this->jabatan->insert_data(['nama_jabatan' => $nama_jabatan]);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'jabatan berhasil ditambahkan!',
                'data' => $result
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'jabatan gagal ditambahkan!'
            ];
        }

        return $this->response_json($response);
    }

    public function update()
    {
        $id_jabatan = $this->input->post('id_jabatan');
        $nama_jabatan = $this->input->post('nama_jabatan');

        $result = $this->jabatan->update_data($id_jabatan, ['nama_jabatan' => $nama_jabatan]);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'jabatan berhasil diupdate!',
                'data' => $result
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'jabatan gagal diupdate!'
            ];
        }

        return $this->response_json($response);
    }

    public function destroy()
    {
        $id_jabatan = $this->uri->segment(3);
        $result = $this->jabatan->delete_data($id_jabatan);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'jabatan telah dihapus!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'jabatan gagal dihapus!'
            ];
        }

        return $this->response_json($response);
    }

    private function response_json($response)
    {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\jabatan.php */