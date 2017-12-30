<?php
require_once('../Servicios/Operaciones_pacientes.php');

class PacienteController{
	


public function selec_pacientes(){
	
	$paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->listadoPacientes();
	return ($rawdata);
}


public function listadopacientesfechaCita($fecha){
	
	$paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->listadoPacientesPorFecha($fecha);
	return ($rawdata);
	
}

public function listadoPacientesPorRangoFechasfCita($fechaini,$fechafini){
	
	$paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->listadoPacientesPorRangoFechas($fechaini,$fechafini);
	return ($rawdata);
	
}

public function insertarPaciente($nombre,$apellido,$edad,$genero,$correo,$idadmin){
	
	$paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->insertarPaciente($nombre,$apellido,$edad,$genero,$correo,$idadmin);
	return ($rawdata);
}

public function actualizarPaciente($idpaciente,$nombre,$apellido,$edad,$genero,$correo,$idadmin){
	
	
	$paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->actualizarPaciente($idpaciente,$nombre,$apellido,$edad,$genero,$correo,$idadmin);
	return ($rawdata);
	
	
}

public function eliminarPaciente($idpaciente){
	
	$paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->eliminarPaciente($idpaciente);
	return ($rawdata);
	
	
	
}

public function buscarPacienteNombres($nombres){
	
    $paciente = new Operaciones_pacientes(); 
	$rawdata=$paciente->Buscarpaciente($nombres);
	return ($rawdata);
	
	
	
}
	
	
	
	
	
}

?>
