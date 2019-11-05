<?php

/*
    Filename    : Ballot.php
    Location    : application/controllers/admin/Ballot.php
    Purpose     : Ballot controller
    Created     : 11/05/2019 16:00:19 by rpbaguio
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Ballot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (logged_in()) {
            $view_data = [
                'page_title' => 'Ballot Form',
                'page_subtitle' => ''
            ];
            $this->load->view('_shared/header', $view_data);
            $this->load->view('user/ballot-form');
        } else {
            redirect('auth', 'refresh');
        }
    }

    // POST request
    public function submit_form()
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('candidate_id[]', 'Candidate', 'required', array('required' => 'Please select a %s.'))
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
                    'candidate_id' => $this->input->post('candidate_id'),
                    'person_id' => user('id'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('tally/create', $options);  
    
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
                'message' => validation_errors()
            ];
            echo json_encode($view_data);
        }
    }
}
