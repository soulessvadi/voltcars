<?php
	/*	MIRACLE WEB TECHNOLOGIES	*/
	/*	***************************	*/
	/*	Author: Sivkovich Maxim		*/
	/*	***************************	*/
	/*	Developed: from 2015		*/
	/*	***************************	*/
	
	// Config file
	
class Config
{
    public $configs;
    function __construct(){
    $this->configs = array(
            "sitename" => "MIRACLE WEB TECHNOLOGIES - Професcиональная разработка сайтов",
			"db" => array(
            	"host" => "localhost",
				"name" => "voltcars",
            	"user" => "u_voltcars",
				"pass" => "0OzrzGQv",
				"encode" => "utf8",
				),
            "admin" => array(
				"login" => "admin",
            	"pass" => "root"
			),
			"copyright" => "&copy; 2013 MIRACLE WEB TECHNOLOGIES"
        );
    }
    function __destruct(){}
}