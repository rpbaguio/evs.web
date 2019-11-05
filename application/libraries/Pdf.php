<?php

/*
    Filename    : Pdf.php
    Location    : application/libraries/Pdf.php
    Purpose     : Fpdf library
    Created     : 11/01/2019 16:48:42 by rpbaguio
    Updated     : 
    Changes     : 
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

require('fpdf.php');

class Pdf extends FPDF
{
    // Extend FPDF using this class
    // More at fpdf.org -> Tutorials
    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        // Call parent constructor
        parent::__construct();
    }

}