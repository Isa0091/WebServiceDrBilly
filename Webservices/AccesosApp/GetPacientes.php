<?php
require_once '../Controladores/PacienteController.php';
$pacienteslistado = new PacienteController();

  
//las acciones
//la accion 1 devuelve el listado de todos los pacienteslistado
//la accion 2 rrecibe como parametro una cita y devuelve los datos del paciente y la citas de esa fecha
//la accion 3 devuelve los datos del paciente y fechas de citas en un rango de fechas rrecibe 2 parametros fechainicial y fecha final
//la accion 4 inserta el paciente
//la accion 5 actualiza el paciente
//la accion 6 elimina al paciente

if(isset($_REQUEST['Accion'])){
	
	$accion =$_REQUEST['Accion'];
	$rawdata = array();
	
	if($accion==1){
		 
         $rawdata=$pacienteslistado->selec_pacientes();
         echo  json_encode($rawdata);

	}else if($accion==2){
		
		$fechainicial=$_REQUEST['fechaini'];
		$rawdata=$pacienteslistado->listadopacientesfechaCita($fechainicial);
         echo  json_encode($rawdata);
		 
		
	}else if($accion==3){
		
		
		$fechainicial=$_REQUEST['fechaini'];
		$fechafini=$_REQUEST['fechafini'];
	
		$rawdata=$pacienteslistado->listadoPacientesPorRangoFechasfCita($fechainicial,$fechafini);
         echo  json_encode($rawdata);
		
	}else if($accion==4){
		
		$nombre=$_REQUEST['nombre'];
		$apellido=$_REQUEST['apellido'];
		$edad=$_REQUEST['edad'];
		$genero=$_REQUEST['genero'];
		$correo=$_REQUEST['correo'];
		$idadmin=$_REQUEST['idadmin'];
	
	//retorna 1 si se incerto correctamente y 0 si no se inserto
		$rawdata=$pacienteslistado->insertarPaciente($nombre,$apellido,$edad,$genero,$correo,$idadmin);
        echo $rawdata;
		
	}else if($accion==5){
		
		
		$idpaciente=$_REQUEST['idpaciente'];
		$nombre=$_REQUEST['nombre'];
		$apellido=$_REQUEST['apellido'];
		$edad=$_REQUEST['edad'];
		$genero=$_REQUEST['genero'];
		$correo=$_REQUEST['correo'];
		$idadmin=$_REQUEST['idadmin'];
		
	
	//retorna 1 si se Actualizo correctamente y 0 si no se actualizo
		$rawdata=$pacienteslistado-> actualizarPaciente($idpaciente,$nombre,$apellido,$edad,$genero,$correo,$idadmin);
		echo $rawdata;
		
	}else if ($accion==6){
		
		$idpaciente=$_REQUEST['idpaciente'];
		$rawdata=$pacienteslistado->eliminarPaciente($idpaciente);
		echo $rawdata;
		
	}else if($accion==7){
		
		//defini otro request nombres para capturar el nombre completo y ejecutar busqueda por nombre y apellido
		$nombres=$_REQUEST['nombres'];
		
		$rawdata=$pacienteslistado->buscarPacienteNombres($nombres);
        echo  json_encode($rawdata);
		
		
	}
	
	
	
	}
	



?>