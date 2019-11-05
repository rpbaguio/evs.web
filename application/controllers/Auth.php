<?php

/*
    Filename    : Auth.php
    Location    : application/controller/Auth.php
    Purpose     : Auth Controller
    Created     : 11/01/2019 22:46:41 by rpbaguio
    Updated     : 11/02/2019 12:10:41 by rpbaguio
    Changes     : 
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $id;
    private $role_id;

    public function __construct()
    {
        parent::__construct();
        $this->id = (int)user('id');
        $this->role_id = (int)user('role_id');
    }

    public function index()
    {
        if (logged_in()) {
            $this->_user_role();
        } else {
            $view_data = [
                'page_title' => 'Login',
                'page_subtitle' => 'Election' . '&nbsp;' . date('Y')
            ];
            $this->load->view('_shared/header', $view_data);
            $this->load->view('_shared/signin-form');
        }
    }

    public function login()
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('access_code', 'Access Code', 'trim|required|xss_clean|callback_is_voted', 
                array('required' => '%s field is required.')
            );

        if ($this->form_validation->run()) {
            if($this->authme->login(set_value('access_code'))) {
                $response = [
                    'status' => true
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => false,
                'message' => validation_errors(),
                'access_code' => form_error('access_code')
            ];
            echo json_encode($response);
        }
    }

    public function logout()
    {
        $this->authme->logout('auth', 'refresh');
    }

    # Callbacks
    public function is_voted()
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }
    
        // Create a client with a base URI
        $client = $this->guzzle->client();
    
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->guzzle->key()
            ]
        ];
    
        try {
            // GET request
            $response = $client->get('auth/is_voted/access_code/' . set_value('access_code'), $options);
    
            // Return $response 
            $response = json_decode($response->getBody()->getContents());

            if ((int)$response->is_voted === 0) {
                return true;
            } else {
                $this->form_validation->set_message('is_voted', 'Access code is invalid');
                return false;
            }
    
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            $response = json_decode($response->getBody()->getContents());

            if ($response->status == false) {
                $this->form_validation->set_message('is_voted', $response->message);
                return false;
            }
        }
    }
    # End of callbacks

    # Helpers
    private function _user_role()
    {
        switch ($this->role_id) {
            case 1:
                redirect('admin/persons', 'refresh');
                break;
            case 2:
                redirect('user/ballot', 'refresh');
                break;
            default:
                redirect('auth', 'refresh');
                break;
        }
    }
    # End of helpers
}