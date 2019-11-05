<?php

/*
    Filename    : Excel.php
    Location    : application/libraries/Excel.php
    Purpose     : PHPExcel library
    Created     : 09/11/2019 13:43:45 by Spiderman
    Updated     : 
    Changes     : 
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . "/vendor/autoload.php";

class Excel extends PHPExcel
{
    public function __construct()
    {
        parent::__construct();
    }
}