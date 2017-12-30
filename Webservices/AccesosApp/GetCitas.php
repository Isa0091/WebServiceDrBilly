<?php

require_once '../Controladores/CitasController.php';
$citas = new CitasController();

//accion 1 insertara la cita
//la accion 2 editara la cita
//la accion 3 elimina la cita 
//la accion 4 selecciona todas las citas
//la accion 5 selecciona las citas de una fecha especifica
// la accion 6 seleciona las fechas en un rango de fechas inicial y final
if(isset($_REQUEST['Accion'])){
	
	$accion =$_REQUEST['Accion'];
	$rawdata = array();
	
	if($accion==1){
		
		$fechacita=$_REQUEST['fechacita'];
		$motivocita=$_REQUEST['motivocita'];
		$idpaciente=$_REQUEST['idpaciente'];
		$idadmin=$_REQUEST['idadmin'];
	
	//retorna 1 si se insero correctamente si no devuelve cero 
		$rawdata=$citas->insertarCita($fechacita,$motivocita,$idadmin,$idpaciente);
        echo $rawdata;
	}else if($accion==2){
		
		
		$fechacita=$_REQUEST['fechacita'];
		$motivocita=$_REQUEST['motivocita'];
		$idcitas=$_REQUEST['idcitas'];
		$idadmin=$_REQUEST['idadmin'];

		$rawdata=$citas->actualizarCita($idcitas,$fechacita,$motivocita,$idadmin);
        echo $rawdata;
		
		
	}else if($accion==3){
		
		$idcitas=$_REQUEST['idcitas'];

		$rawdata=$citas->eliminarcita($idcitas);
        echo $rawdata;
	}else if($accion==4){
		
		$rawdata=$citas->selectcitasTodas();
         echo  json_encode($rawdata);

	}else if($accion==5){
		
		$fecha=$_REQUEST['fecha'];
		$rawdata=$citas->selectCitasPorFecha($fecha);
        echo json_encode($rawdata);
		 
		
		
	}else if($accion==6){
		
		$fechaini=$_REQUEST['fechaini'];
		$fechafini=$_REQUEST['fechafini'];
		
		$rawdata=$citas->selectcitasporRangoFecha($fechaini,$fechafini);
        echo json_encode($rawdata);

	}
	
	
	
	
	
	
	
	
	
	
	
}
	

?>