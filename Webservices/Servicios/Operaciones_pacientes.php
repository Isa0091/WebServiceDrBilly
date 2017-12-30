<?php

require_once('conectar.php');

class Operaciones_pacientes{
	
	
	public function getconexion(){
		
		$conectarnos = new conectar();
       return $conectarnos;	
		
	}
	
	public function insertarPaciente($nombre,$apellido,$edad,$genero,$correo,$idadmin){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_insertar_Paciente(:nombre,:apellido,:edad,:genero,:correo,:idadmin)');
		$procedimiento->bindParam(':nombre',$nombre);
		$procedimiento->bindParam(':apellido',$apellido);
		$procedimiento->bindParam(':edad',$edad);
		$procedimiento->bindParam(':genero',$genero);
		$procedimiento->bindParam(':correo',$correo);
		$procedimiento->bindParam(':idadmin',$idadmin);
		
		$procedimiento->execute();
		$insertado=$procedimiento->rowCount();
		return $insertado;
		
	}
	
	
	public function actualizarPaciente($idpaciente,$nombre,$apellido,$edad,$genero,$correo,$idadmin){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_actualizar_Paciente(:idpaciente,:nombre,:apellido,:edad,:genero,:correo,:idadmin)');
		$procedimiento->bindParam(':idpaciente',$idpaciente);
		$procedimiento->bindParam(':nombre',$nombre);
		$procedimiento->bindParam(':apellido',$apellido);
		$procedimiento->bindParam(':edad',$edad);
		$procedimiento->bindParam(':genero',$genero);
		$procedimiento->bindParam(':correo',$correo);
		$procedimiento->bindParam(':idadmin',$idadmin);
		
		$procedimiento->execute();
		$Modificado=$procedimiento->rowCount();
		return $Modificado;
		
	}
	
	public function eliminarPaciente($idpaciente){
		
		$procedimiento =$this->getconexion()->prepare('Call sp_eliminar_Paciente(:idpaciente)');
		$procedimiento->bindParam(':idpaciente',$idpaciente);
		$procedimiento->execute();
		$Eliminado=$procedimiento->rowCount();
		
		return $Eliminado;
		
	}
	
	
	public function listadoPacientes(){
		
		
		$procedimiento =$this->getconexion()->prepare('Call sp_select_Paciente()');
		$procedimiento->execute();
		$lista_pacientes= $procedimiento->fetchAll(PDO::FETCH_ASSOC);
		 
		return $lista_pacientes;
		
	}
	
	public function listadoPacientesPorFecha($fecha){
		$procedimiento =$this->getconexion()->prepare('call sp_select_pacientesporfechacita(:fecha)');
		$procedimiento->bindParam(':fecha',$fecha);
		$procedimiento->execute();
		$lista_pacientes_porfecha=$procedimiento->fetchAll(PDO::FETCH_ASSOC);
		
		return $lista_pacientes_porfecha;
	}
	
	
	public function listadoPacientesPorRangoFechas($fechaini,$fechafini){
		$procedimiento =$this->getconexion()->prepare('call sp_select_pacienteporrangoFecha(:fechaini,:fechafini)');
		$procedimiento->bindParam(':fechaini',$fechaini);
		$procedimiento->bindParam(':fechafini',$fechafini);
		$procedimiento->execute();
		$lista_pacientes_porrangofecha=$procedimiento->fetchAll(PDO::FETCH_ASSOC);
		return $lista_pacientes_porrangofecha;
	}
	
	//busca por nombre y apellido
	public function Buscarpaciente($nombres){
		
		$procedimiento =$this->getconexion()->prepare('call sp_buscar_paciente(:nombres)');
		$procedimiento->bindParam(':nombres',$nombres);
		
		$procedimiento->execute();
		$lista_pacientes=$procedimiento->fetchAll(PDO::FETCH_ASSOC);
		return $lista_pacientes;
	}
	
	
	
}

?>