
create database DrBilly
use DrBilly

create table administradores(idadmin int primary key auto_increment, 
					usuario varchar(128),
                    nombre varchar(128),
                    genero char,
                    pass varchar(256),
                    roles varchar(256))
                    
create table Paciente(idpaciente int primary key auto_increment, 
					nombre varchar(128),
                    apellido varchar(128),
                    edad int,
                    genero char,
                    correo varchar(128),
                    idadmin int, foreign key (idadmin) references administradores(idadmin))
                    
 create table citas(idcitas int primary key auto_increment,
					fechaCita date,
                    motivocita varchar(128),
                    idadmin int, 
                    idpaciente int, foreign key (idpaciente) references Paciente(idpaciente) on delete cascade,
                    foreign key (idadmin) references administradores(idadmin)	on delete no action
					) 
                    
 create table encabezadoOrdencitas (idencabezado int primary key auto_increment,
						   fechaorden date,
                           tipo_orden varchar(128) )
        
 create table ordencitas (idorden int primary key auto_increment,
						   numeroparticipante int,
						   idencabezado int, foreign key (idencabezado) references encabezadoOrdencitas(idencabezado),
						   idadmin int,
                           idpaciente int, foreign key (idpaciente) references Paciente(idpaciente) ON DELETE CASCADE,
                           foreign key (idadmin) references administradores(idadmin) on delete no action
						)
                        



DELIMITER $$ 
create procedure sp_insertar_admin(usuario varchar(128),nombre varchar(128), genero char,  pass varchar(128))
begin 

insert into administradores(usuario,nombre,genero,pass,roles) values(usuario,nombre,genero,md5(pass),'admin');
end

$$ 

	
DELIMITER $$ 
create procedure sp_insertar_cita(fechaCita date,motivocita varchar(128), idadmin int,idpaciente int)
begin 

insert into citas(fechaCita,motivocita,idadmin,idpaciente) values(fechaCita,motivocita,idadmin,idpaciente);
end

$$ 



Delimiter $$
create procedure sp_actualizar_cita(idcitasparametro int,fechaCita date,motivocita varchar(128), idadmin int)
begin
   update citas set fechaCita=fechaCita , motivocita =motivocita , idadmin=idadmin  where idcitas=idcitasparametro;
   
   end
   $$
   
   Delimiter $$
   create procedure sp_eliminar_cita(ideliminar int)
   begin
    delete from citas where idcitas = ideliminar;
   end
$$ 


Delimiter $$
	create procedure sp_select_citas()
    begin
     select idcitas,fechaCita,motivocita,idadmin,idpaciente from citas order by fechaCita,idcitas desc;
    end
    $$
    
    Delimiter $$
	create procedure sp_select_citasporFecha(fecha date)
    begin
     select * from citas where fechaCita =fecha ;
    end
    $$
    
     Delimiter $$
	create procedure sp_select_citasporRangoFecha(fechaini date,fechafini date)
    begin
     select * from citas where fechaCita between fechaini and fechafini;
    end
    $$
    
     Delimiter $$
	create procedure sp_select_citasporPaciente(idpaciente int)
    begin
     select * from citas where idpaciente =idpaciente order by fechaCita desc;
    end
    $$
 

Delimiter $$
	create procedure sp_insertar_EncabezadoOrdenCitas(fechaorden date,
                           tipo_orden varchar(128) )
	begin
    insert into encabezadoOrdencitas(fechaorden,tipo_orden)values (fechaorden,tipo_orden);
    end
    $$

Delimiter $$
	create procedure sp_insertar_ordencitas(idencabezado int, idadmin int,idpaciente int,numeroparticipante int)
    begin
      insert into ordencitas(numeroparticipante,idencabezado,idadmin,idpaciente)values (numeroparticipante,idencabezado,idadmin,idpaciente);
    end
$$

	
DELIMITER $$ 
create procedure sp_insertar_Paciente(nombre varchar(128),
                    apellido varchar(128),
                    edad int,
                    genero char,
                    correo varchar(128),
                    idadmin int)
begin 

insert into Paciente(nombre,apellido,edad,genero,correo,idadmin) values(nombre,apellido,edad,genero,correo,idadmin);
end

$$ 



Delimiter $$
create procedure sp_actualizar_Paciente(idpacienteparametro int, 
					nombre varchar(128),
                    apellido varchar(128),
                    edad int,
                    genero char,
                    correo varchar(128),
                    idadmin int)
begin
   update DrBilly.Paciente set nombre=nombre , apellido =apellido , edad=edad, genero=genero, correo=correo,idadmin=idadmin Where idpaciente=idpacienteparametro;
   
   end
   $$
   
   

   Delimiter $$
   create procedure sp_eliminar_Paciente(idpacienteparametro int)
   begin
    delete from Paciente where idpaciente = idpacienteparametro;
   end
$$ 


Delimiter $$
	create procedure sp_select_Paciente()
    begin
     select * from Paciente;
    end
    $$
    
    
    Delimiter $$
create procedure sp_select_pacientesporfechacita(fechacita date)
    begin
    select p.nombre, p.apellido, c.fechaCita,c.motivocita from Paciente as p inner join citas as c on p.idpaciente= c.idpaciente where c.fechaCita=fechacita;
    end
    $$ 
    
    
    Delimiter $$
    create procedure sp_select_pacienteporrangoFecha(fechaini date , fechafini date)
    begin
   select p.nombre, p.apellido, c.fechaCita, c.motivocita from Paciente as p inner join citas as c on p.idpaciente= c.idpaciente where c.fechaCita between fechaini and fechafini;
    end
    $$
    

    Delimiter $$
    create procedure sp_buscar_paciente( nombres varchar(128))
    begin
    
    select * from Paciente where nombre like CONCAT('%', nombres , '%') or apellido like CONCAT('%', nombres , '%') ;
    
    end
    
                    