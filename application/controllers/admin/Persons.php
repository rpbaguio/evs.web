<?php

/*
    Filename    : Persons.php
    Location    : application/controllers/admin/Persons.php
    Purpose     : Persons controller
    Created     : 11/02/2019 17:27:16 by rpbaguio
    Updated     : 11/04/2019 15:03:00 by rpbaguio
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Persons extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (logged_in()) {
            $view_data = array(
                'page_title' => 'Persons',
                'page_subtitle' => ''
            );

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/persons');
        } else {
            redirect('auth', 'refresh');
        }
    }

    // GET request
    public function persons() 
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
            $response = $client->get('persons', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // GET request
    public function person() 
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
            ],
            'query' => [
                'id' => $_GET['id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('persons/person', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // POST request
    public function create() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('prefix', 'Prefix', 'trim|xss_clean')
            ->set_rules('first_name', 'First Name', 'trim|required|xss_clean')
            ->set_rules('last_name', 'Last Name', 'trim|required|xss_clean')
            ->set_rules('suffix', 'Suffix', 'trim|xss_clean')
            ->set_rules('group_id', 'Group', 'trim|required|xss_clean')
            ->set_rules('is_candidate', 'Is Candidate', 'trim|required|xss_clean')
            ->set_rules('position_id', 'Position', 'trim|required|xss_clean')
            ->set_rules('gender_id', 'Gender', 'trim|required|xss_clean')
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {

            // Create a client with a base URI
            $client = $this->guzzle->client();

            $options = [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'X-API-KEY' => $this->guzzle->key()
                ],
                'form_params' => [
                    'prefix' => $this->input->post('prefix'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'suffix' => $this->input->post('suffix'),
                    'group_id' => $this->input->post('group_id'),
                    'is_candidate' => $this->input->post('is_candidate'),
                    'position_id' => $this->input->post('position_id'),
                    'gender_id' => $this->input->post('gender_id'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('persons/create', $options);  
    
                // Return $response  
                echo $response->getBody()->getContents();
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
    
                // Return $response 
                echo $response->getBody()->getContents();
            }
        } else {
            $view_data = [
                'status' => false,
                'message' => validation_errors(),
                'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
                'group_id' => form_error('group_id'),
                'is_candidate' => form_error('is_candidate'),
                'position_id' => form_error('position_id'),
                'gender_id' => form_error('gender_id')
            ];
            echo json_encode($view_data);
        }
    }

    // PUT request
    public function update() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $set_data = array(
            'access_code' => $this->input->put('access_code'),
            'prefix' => $this->input->put('prefix'),
            'first_name' => $this->input->put('first_name'),
            'last_name' => $this->input->put('last_name'),
            'suffix' => $this->input->put('suffix'),
            'group_id' => $this->input->put('group_id'),
            'is_candidate' => $this->input->put('is_candidate'),
            'position_id' => $this->input->put('position_id')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('access_code', 'Access Code', 'trim|required|xss_clean')
            ->set_rules('prefix', 'Prefix', 'trim|xss_clean')
            ->set_rules('first_name', 'First Name', 'trim|required|xss_clean')
            ->set_rules('last_name', 'Last Name', 'trim|required|xss_clean')
            ->set_rules('suffix', 'Suffix', 'trim|xss_clean')
            ->set_rules('group_id', 'Group', 'trim|required|xss_clean')
            ->set_rules('is_candidate', 'Is Candidate', 'trim|required|xss_clean')
            ->set_rules('position_id', 'Position', 'trim|required|xss_clean')
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {

            // Create a client with a base URI
            $client = $this->guzzle->client();

            $options = [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'X-API-KEY' => $this->guzzle->key()
                ],
                'form_params' => [
                    'access_code' => $this->input->put('access_code'),
                    'prefix' => $this->input->put('prefix'),
                    'first_name' => $this->input->put('first_name'),
                    'last_name' => $this->input->put('last_name'),
                    'suffix' => $this->input->put('suffix'),
                    'group_id' => $this->input->put('group_id'),
                    'is_candidate' => $this->input->put('is_candidate'),
                    'position_id' => $this->input->put('position_id'),
                    'user_id' => user('id')
                ]
            ];

            try {

                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('persons/update/id/' . $id, $options);

                // Return $response  
                echo $response->getBody()->getContents();
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();

                // Return $response 
                echo $response->getBody()->getContents();
            }
        } else {
            $view_data = [
                'status' => false,
                'message' => validation_errors(),
                'access_code' => form_error('access_code'),
                'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
                'group_id' => form_error('group_id'),
                'is_candidate' => form_error('is_candidate'),
                'position_id' => form_error('position_id')
            ];
            echo json_encode($view_data);
        }
    } 
    
    // PUT request
    public function delete() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
             redirect('auth', 'refresh');
        }

        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'form_params' => [
                'user_id' => user('id')
            ]
        ];
        
        try {

            $id = $this->uri->segment(5);

            // PUT request
            $response = $client->put('persons/soft_delete/id/' . $id, $options);

            // Return $response  
            echo $response->getBody()->getContents();
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }
}