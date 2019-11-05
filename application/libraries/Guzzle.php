<?php

/*
    Filename    : Guzzle.php
    Location    : application/libraries/Guzzle.php
    Purpose     : Use guzzle as ci library
    Created     : 07/03/2019 15:25:44 by rpbaguio
    Updated     : 11/01/2019 21:05:53 by rpbaguio
    Changes     : 
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . "/vendor/autoload.php";

class Guzzle
{
    private $CI;
    private $endpoint;
    private $key;
    private $timeout;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->endpoint = 'http://localhost/evs.api/';
        $this->key = '365-Days';
        $this->timeout = 5;
    }

    // Return client with a base URI
    public function client() {
        return new GuzzleHttp\Client(['base_uri' => $this->endpoint], ['time' => $this->timeout]);
    }

    // Return key
    public function key() {
        return  $this->key;
    }
}