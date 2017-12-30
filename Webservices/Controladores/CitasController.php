<?php

require_once('../Servicios/Operaciones_Citas.php');

class CitasController{

public function insertarCita($fechacita,$motivocita,$idadmin,$idpaciente){
		
	$citas = new Operaciones_Citas(); 
	$rawdata=$citas->insertarCita($fechacita,$motivocita,$idadmin,$idpaciente);
	return ($rawdata);
		
	}
	
	public function actualizarCita($idcitas,$fechacita,$motivocita,$idadmin){
		
	$citas = new Operaciones_Citas(); 
	$rawdata=$citas->actualizarCita($idcitas,$fechacita,$motivocita,$idadmin);
	return ($rawdata);
		
	}
	
	public function eliminarcita($idcitas){
	
	$citas = new Operaciones_Citas(); 
	$rawdata=$citas->eliminarcita($idcitas);
	return ($rawdata);
		
		
	}
	
	public function selectcitasTodas(){
		
		$citas = new Operaciones_Citas(); 
		$rawdata=$citas->selectcitasTodas();
		return ($rawdata);
		
	}
	
	public function selectCitasPorFecha($fecha){
		
	   $citas = new Operaciones_Citas(); 
		$rawdata=$citas->selectCitasPorFecha($fecha);
		return ($rawdata);
		
	}
	
	public function selectcitasporRangoFecha($fechaini,$fechafini){
		 $citas = new Operaciones_Citas(); 
		$rawdata=$citas->selectcitasporRangoFecha($fechaini,$fechafini);
		return ($rawdata);
		
	}
	



}


?>