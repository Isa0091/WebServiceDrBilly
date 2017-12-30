<?php

require_once('conectar.php');

class Operaciones_Citas{
	
	public function getconexion(){
		
		$conectarnos = new conectar();
       return $conectarnos;	
		
	}
	
	public function insertarCita($fechacita,$motivocita,$idadmin,$idpaciente){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_insertar_cita(:fechacita,:motivocita,:idadmin,:idpaciente)');
		$procedimiento->bindParam(':fechacita',$fechacita);
		$procedimiento->bindParam(':motivocita',$motivocita);
		$procedimiento->bindParam(':idadmin',$idadmin);
		$procedimiento->bindParam(':idpaciente',$idpaciente);
		$procedimiento->execute();
		$insertado=$procedimiento->rowCount();
		return $insertado;
	}
	
	
	
	public function actualizarCita($idcitas,$fechacita,$motivocita,$idadmin){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_actualizar_cita(:idcitas,:fechacita,:motivocita,:idadmin)');
		$procedimiento->bindParam(':idcitas',$idcitas);
		$procedimiento->bindParam(':fechacita',$fechacita);
		$procedimiento->bindParam(':motivocita',$motivocita);
		$procedimiento->bindParam(':idadmin',$idadmin);
		$procedimiento->execute();
		$actualizado=$procedimiento->rowCount();
		
		
		return $actualizado;
	}
	
	public function eliminarcita($idcitas){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_eliminar_cita(:idcitas)');
		$procedimiento->bindParam(':idcitas',$idcitas);
		$procedimiento->execute();
		$eliminado=$procedimiento->rowCount();
		
		return $eliminado;
		
	}
	
	
	public function selectcitasTodas(){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_select_citas()');
		$procedimiento->execute();
		$listado_citas=$procedimiento->fetchAll(PDO::FETCH_ASSOC);
		return $listado_citas;
		

	}
	
	public function selectCitasPorFecha($fecha){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_select_citasporFecha(:fecha)');
		$procedimiento->bindParam(':fecha',$fecha);
		
		$procedimiento->execute();
		$listado_citas_porFecha=$procedimiento->fetchAll(PDO::FETCH_ASSOC);
		return $listado_citas_porFecha;
		
	}
	
	public function selectcitasporRangoFecha($fechaini,$fechafini){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_select_citasporRangoFecha(:fechaini,:fechafini)');
		$procedimiento->bindParam(':fechaini',$fechaini);
		$procedimiento->bindParam(':fechafini',$fechafini);
		
		$procedimiento->execute();
		$listado_citas_porRangoFecha=$procedimiento->fetchAll(PDO::FETCH_ASSOC);
		return $listado_citas_porRangoFecha;
	}
	
	
	
	
	
}

?>