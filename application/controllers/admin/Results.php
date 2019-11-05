<?php

/*
    Filename    : Results.php
    Location    : application/controllers/admin/Results.php
    Purpose     : Results controller
    Created     : 11/05/2019 22:24:37 by rpbaguio
    Updated     :
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Results extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (logged_in()) {
            $view_data = array(
                'page_title' => 'Results',
                'page_subtitle' => ''
            );

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/results');
        } else {
            redirect('auth', 'refresh');
        }
    }

    // GET request
    public function results() 
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
            $response = $client->get('tally/results', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }
}