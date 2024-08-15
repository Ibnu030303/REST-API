<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('FunctionName')) {
	function FunctionName($param){
		return $param;
	}
}

if (!function_exists('msgResponse')) {
	function msgResponse($status, $msg, $data){
		return array("status" => $status, "msg" => $msg, "data" => $data);
	}
	
	function getarray($data, $field, $name){
		$aa = array();
		$adt = array();
		foreach ($data->result() as $row){
			$adt[] = $row->$field;
		}
		
		$aa['name'] = $name;
		$aa['data'] = $adt;
		return $aa;
	}
}