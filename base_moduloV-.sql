CREATE DATABASE proyectomodulov;

CREATE TABLE modalidad (
id_modalidad INT UNSIGNED NOT NULL AUTO_INCREMENT,
modalidad VARCHAR(128) NOT NULL,
PRIMARY KEY(id_modalidad)
);

INSERT INTO modalidad ( modalidad) VALUES
('Virtual'),
('Presencial'),
('SemiPresencial');

SELECT * FROM modalidad;

CREATE TABLE financiamiento (
id_financiamiento INT UNSIGNED NOT NULL AUTO_INCREMENT,
financiamiento VARCHAR(128) NOT NULL,
PRIMARY KEY(id_financiamiento)
);

INSERT INTO financiamiento ( financiamiento) VALUES
('fondos propios'),
('becado/a'),
('otro');

SELECT * FROM financiamiento;

CREATE TABLE estado_capacitacion (
id_estado_capacitacion INT UNSIGNED NOT NULL AUTO_INCREMENT,
estado_capacitacion VARCHAR(128) NOT NULL,
PRIMARY KEY(id_estado_capacitacion)
);

INSERT INTO estado_capacitacion (estado_capacitacion) VALUES
( 'en proceso'),
('reprobada'),
('finalizada con diploma');

SELECT * FROM estado_capacitacion;

CREATE TABLE permisos (
id_permiso INT UNSIGNED NOT NULL AUTO_INCREMENT,
permiso VARCHAR(128) NOT NULL,
PRIMARY KEY(id_permiso)
);

INSERT INTO permisos (permiso) VALUES
('Registrar misiones y capacitaciones '),
('ver sus misiones y capacitaciones'),
('ver todas las misiones y capacitaciones'),
('ver capacitacion y mision por departamento'),
('ver todas las misiones');

SELECT * FROM permisos;

CREATE TABLE roles (
id_rol INT UNSIGNED NOT NULL AUTO_INCREMENT,
rol VARCHAR(100) NOT NULL,
PRIMARY KEY(id_rol)
);


INSERT INTO roles (rol) VALUES
('Gerente'),
('Recepcionista'),
('Empleados');

SELECT * FROM roles;

CREATE TABLE departamentos (
id_departamento INT UNSIGNED NOT NULL AUTO_INCREMENT,
departamento VARCHAR(128) NOT NULL,
PRIMARY KEY(id_departamento)
);

INSERT INTO departamentos (departamento) VALUES
( 'informatica'),
( 'finanzas'),
( 'contabilidad');

SELECT * FROM departamentos;

CREATE TABLE estado_misiones (
id_estado_misiones INT UNSIGNED NOT NULL AUTO_INCREMENT,
estado_misiones VARCHAR(128) NOT NULL,
PRIMARY KEY(id_estado_misiones)
);

INSERT INTO estado_misiones (estado_misiones) VALUES
( 'en proceso'),
('reprobada'),
('finalizada ');

SELECT * FROM estado_misiones;

CREATE TABLE rol_mision (
id_rol_mision INT UNSIGNED NOT NULL AUTO_INCREMENT,
rol_mision VARCHAR(128) NOT NULL,
PRIMARY KEY(id_rol_mision)
);

INSERT INTO rol_mision (rol_mision) VALUES
('Oyente'),
('Ponente');

SELECT * FROM rol_mision;

CREATE TABLE empleados (
id_empleado INT UNSIGNED NOT NULL AUTO_INCREMENT,
nombres VARCHAR(128) NOT NULL,
apellidos VARCHAR(128) NOT NULL,
fecha_nacimiento datetime NOT NULL,
telefono VARCHAR(128) NOT NULL,
direccion VARCHAR(128) NOT NULL,
id_rol INT unsigned NOT NULL,
id_departamento VARCHAR(128) NOT NULL,
PRIMARY KEY(id_empleado),
CONSTRAINT FK_ROL_ID FOREIGN KEY(id_empleado) REFERENCES roles(id_rol) ON UPDATE CASCADE,
CONSTRAINT FK_DET_ID FOREIGN KEY(id_empleado) REFERENCES departamentos(id_departamento) ON UPDATE CASCADE

);

INSERT INTO empleados (nombres,apellidos,fecha_nacimiento,telefono,direccion,id_rol,id_departamento) VALUES
('Marcos Alberto','Chavez Del Cid','1998-02-10','7334-8360','Quelepa San Miguel',2,3);

SELECT * FROM empleados;


CREATE TABLE misiones (
id_mision INT UNSIGNED NOT NULL AUTO_INCREMENT,
nombre_evento VARCHAR(128) NOT NULL,
fecha_inicio datetime NOT NULL,
fecha_final datetime  NOT NULL,
institucion VARCHAR(128) NOT NULL,
motivo_evento VARCHAR(128) NOT NULL,
id_empleado INT unsigned NOT NULL,
id_rol_mision INT unsigned NOT NULL,
id_estado_misiones INT unsigned NOT NULL,
cantidad_audiencia VARCHAR(128) NOT NULL,
imagenes VARCHAR(128) NULL,
comentarios VARCHAR(128) NULL,
PRIMARY KEY(id_mision),
CONSTRAINT FK_EPLE_ID FOREIGN KEY(id_mision) REFERENCES empleados(id_empleado) ON UPDATE CASCADE,
CONSTRAINT FK_ROLM_ID FOREIGN KEY(id_mision) REFERENCES rol_mision(id_rol_mision) ON UPDATE CASCADE,
CONSTRAINT FK_ESM_ID FOREIGN KEY(id_mision) REFERENCES estado_misiones(id_estado_misiones) ON UPDATE CASCADE
);
 DROP TABLE misiones;
INSERT INTO misiones (nombre_evento,fecha_inicio,fecha_final,institucion,motivo_evento,id_empleado,id_rol_mision,id_estado_misiones,cantidad_audiencia,comentarios) VALUES
('Charla motivacional','2022-04-10 10:00:00','2022-06-10 12:00:00','Seguro social','Concientización',1,1,1,'Al rededor de 50 personas','Buena charla'),
('Primeros auxilios','2022-02-01 07:00:00','2022-02-01 12:00:00','Seguro social _1','primeros auxilios al personal',2,2,3,'Un numero estimado de 20 personas','se hicieron varias practicas ');

SELECT * FROM misiones;




 
CREATE TABLE usuarios (
id_usuario INT UNSIGNED NOT NULL AUTO_INCREMENT,
username VARCHAR(128) NOT NULL,
nombres VARCHAR(128) NOT NULL,
apellidos VARCHAR(128) NOT NULL,
password VARCHAR(128) NOT NULL,
id_rol INT UNSIGNED  NOT NULL,
PRIMARY KEY(id_usuario),
CONSTRAINT FK_ROLS_ID FOREIGN KEY(id_usuario) REFERENCES roles(id_rol) ON UPDATE CASCADE
);

INSERT INTO usuarios (username,nombres,apellidos,password,id_rol) VALUES
('one','Oneyda Maricela','Chavez Del Cid','123',1);

SELECT * FROM usuarios;

CREATE TABLE capacitacion (
id_capacitacion INT UNSIGNED NOT NULL AUTO_INCREMENT,
institucion VARCHAR(128) NOT NULL,
fecha_inicio datetime NOT NULL,
fecha_final datetime NOT NULL,
id_modalidad INT unsigned NOT NULL,
id_financiamiento INT unsigned NOT NULL,
id_estado_capacitacion INT unsigned NOT NULL,
id_empleado INT unsigned NOT NULL,
descripcion INT unsigned NOT NULL,
comprobantes VARCHAR(128) NOT NULL,
imagenes VARCHAR(128) NOT NULL,
PRIMARY KEY(id_capacitacion),
CONSTRAINT FK_MOD_ID FOREIGN KEY(id_capacitacion) REFERENCES modalidad(id_modalidad) ON UPDATE CASCADE,
CONSTRAINT FK_FIN_ID FOREIGN KEY(id_capacitacion) REFERENCES financiamiento(id_financiamiento) ON UPDATE CASCADE,
CONSTRAINT FK_ESCA_ID FOREIGN KEY(id_capacitacion) REFERENCES estado_capacitacion(id_estado_capacitacion) ON UPDATE CASCADE,
CONSTRAINT FK_EMPL_ID FOREIGN KEY(id_capacitacion) REFERENCES empleados(id_empleado) ON UPDATE CASCADE
);


CREATE TABLE roles_permisos (
  idrolpermiso int(11) NOT NULL AUTO_INCREMENT,
  idrol int(10) unsigned NOT NULL,
  idpermiso int(10) unsigned NOT NULL,
  PRIMARY KEY (idrolpermiso),
  KEY roles_permisos_FK (idpermiso),
  KEY roles_permisos_FK_1 (idrol),
  CONSTRAINT roles_permisos_FK FOREIGN KEY (idpermiso) REFERENCES permisos (id_permiso) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT roles_permisos_FK_1 FOREIGN KEY (idrol) REFERENCES roles (id_rol) ON DELETE CASCADE ON UPDATE CASCADE
) ;















