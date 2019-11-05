<?php

/*
    Filename    : Settings.php
    Location    : application/controllers/admin/Settings.php
    Purpose     : Settings controller
    Created     : 11/04/2019 16:42:35 by Spiderman
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (logged_in()) {
            $view_data = array(
                'page_title' => 'Settings',
                'page_subtitle' => 'Site Configuration'
            );

            $this->load->view('_shared/header', $view_data);
            $this->load->view('admin/settings');
        } else {
            redirect('auth', 'refresh');
        }
    }

    // GET request
    public function settings() 
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
            $response = $client->get('settings', $options);

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
    public function setting() 
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
            $response = $client->get('settings/setting', $options);
    
            $response = json_decode($response->getBody()->getContents());
    
            // Return $response
            echo json_encode($response, true);
    
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
    
            // Return $response 
            echo $response->getBody()->getContents();
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
            'header' => $this->input->put('header'),
            'slogan' => $this->input->put('slogan'),
            'footer' => $this->input->put('footer'),
            'logo' => $this->input->put('logo')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('header', 'Header', 'trim|required|xss_clean')
            ->set_rules('slogan', 'Slogan', 'trim|required|xss_clean')
            ->set_rules('footer', 'Footer', 'trim|required|xss_clean')
            ->set_rules('logo', 'Logo', 'trim|required|xss_clean')
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
                    'header' => $this->input->put('header'),
                    'slogan' => $this->input->put('slogan'),
                    'footer' => $this->input->put('footer'),
                    'logo' => $this->input->put('logo')
                ]
            ];

            try {

                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('settings/update/id/' . $id, $options);

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
                'header' => form_error('header'),
                'slogan' => form_error('slogan'),
                'footer' => form_error('footer'),
                'logo' => form_error('logo')
            ];
            echo json_encode($view_data);
        }
    } 
}