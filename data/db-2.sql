CREATE SCHEMA plataforma_upro AUTHORIZATION postgres;

-- plataforma_upro.roles definition
CREATE TABLE plataforma_upro.roles (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT roles_pkey PRIMARY KEY (id)
);

-- plataforma_upro.secretaria definition
CREATE TABLE plataforma_upro.secretaria (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT secretaria_pkey PRIMARY KEY (id)
);

-- plataforma_upro.areas definition
CREATE TABLE plataforma_upro.areas (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	secretaria_id serial4 NOT NULL,
	CONSTRAINT areas_pkey PRIMARY KEY (id)
);
-- plataforma_upro.areas foreign keys
ALTER TABLE plataforma_upro.areas ADD CONSTRAINT areas_secretaria_id_fkey FOREIGN KEY (secretaria_id) REFERENCES plataforma_upro.secretaria(id);

-- plataforma_upro.carreras definition 
CREATE TABLE plataforma_upro.carreras (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT carreras_pkey PRIMARY KEY (id)
);

-- plataforma_upro.ubicaciones definition
CREATE TABLE plataforma_upro.ubicaciones (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT ubicaciones_pkey PRIMARY KEY (id)
);

-- plataforma_upro.egresados definition
CREATE TABLE plataforma_upro.egresados (
	id serial4 NOT NULL,
	documento varchar(40) NULL,
	apellido varchar(50) NULL,
	nombres varchar(50) NULL,
	fecha_nacimiento date NULL,
	email varchar(255) NULL,
	telefono varchar(50) NULL,
	ubicacion_id int4 NULL DEFAULT 1,
	carrera_id serial4 NOT NULL,
	asistira int4 NOT NULL DEFAULT 0,
	recibio_diploma int4 NOT NULL DEFAULT 0,
	CONSTRAINT egresados_pkey PRIMARY KEY (id)
);
-- plataforma_upro.egresados foreign keys
ALTER TABLE plataforma_upro.egresados ADD CONSTRAINT egresados_carrera_id_fkey FOREIGN KEY (carrera_id) REFERENCES plataforma_upro.carreras(id);
ALTER TABLE plataforma_upro.egresados ADD CONSTRAINT egresados_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES plataforma_upro.ubicaciones(id);

-- plataforma_upro.empleados definition
CREATE TABLE plataforma_upro.empleados (
	id serial4 NOT NULL,
	documento varchar(40) NULL,
	apellido varchar(50) NULL,
	nombres varchar(50) NULL,
	fecha_nacimiento date NULL,
	email varchar(255) NULL,
	telefono varchar(50) NULL,
	contrasena varchar(255) NULL,
	ubicacion_id int4 NULL DEFAULT 1,
	area_id int4 NULL,
	rol_id int4 NULL DEFAULT 5,
	status int4 NOT NULL DEFAULT 0,
	CONSTRAINT empleados_pkey PRIMARY KEY (id)
);
-- plataforma_upro.empleados foreign keys
ALTER TABLE plataforma_upro.empleados ADD CONSTRAINT empleados_area_id_fkey FOREIGN KEY (area_id) REFERENCES plataforma_upro.areas(id);
ALTER TABLE plataforma_upro.empleados ADD CONSTRAINT empleados_rol_id_fkey FOREIGN KEY (rol_id) REFERENCES plataforma_upro.roles(id);
ALTER TABLE plataforma_upro.empleados ADD CONSTRAINT empleados_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES plataforma_upro.ubicaciones(id);

-- plataforma_upro.eventos definition
CREATE TABLE plataforma_upro.eventos (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	fecha timestamp NULL,
	ubicacion_id int4 NULL DEFAULT 1,
	CONSTRAINT eventos_pkey PRIMARY KEY (id)
);
-- plataforma_upro.eventos foreign keys
ALTER TABLE plataforma_upro.eventos ADD CONSTRAINT eventos_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES plataforma_upro.ubicaciones(id);

-- plataforma_upro.eventos_fila definition
CREATE TABLE plataforma_upro.eventos_fila (
	id serial4 NOT NULL,
	nombre varchar(4) NULL,
	evento_id int4 NOT NULL DEFAULT nextval('plataforma_upro.eventos_fila_fila_id_seq'::regclass),
	CONSTRAINT eventos_fila_pkey PRIMARY KEY (id)
);
-- plataforma_upro.eventos_fila foreign keys
ALTER TABLE plataforma_upro.eventos_fila ADD CONSTRAINT eventos_fila_evento_id_fkey FOREIGN KEY (evento_id) REFERENCES plataforma_upro.eventos(id);

-- plataforma_upro.eventos_asientos definition
CREATE TABLE plataforma_upro.eventos_asientos (
	id serial4 NOT NULL,
	nombre varchar(4) NULL,
	fila_id serial4 NOT NULL,
	CONSTRAINT eventos_asiento_pkey PRIMARY KEY (id)
);
-- plataforma_upro.eventos_asientos foreign keys
ALTER TABLE plataforma_upro.eventos_asientos ADD CONSTRAINT eventos_asientos_fila_id_fkey FOREIGN KEY (fila_id) REFERENCES plataforma_upro.eventos_fila(id);

-- plataforma_upro.eventos_posicion definition
CREATE TABLE plataforma_upro.eventos_posicion (
	id serial4 NOT NULL,
	status int4 NOT NULL DEFAULT 0,
	asiento_id int4 NULL,
	fila_id int4 NULL,
	egresado_id int4 NULL,
	evento_id int4 NULL,
	CONSTRAINT eventos_posicion_pkey PRIMARY KEY (id)
);
-- plataforma_upro.eventos_posicion foreign keys
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_asiento_id_fkey FOREIGN KEY (asiento_id) REFERENCES plataforma_upro.eventos_asientos(id);
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_egresado_id_fkey FOREIGN KEY (egresado_id) REFERENCES plataforma_upro.egresados(id);
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_evento_id_fkey FOREIGN KEY (evento_id) REFERENCES plataforma_upro.eventos(id);
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_fila_id_fkey FOREIGN KEY (fila_id) REFERENCES plataforma_upro.eventos_fila(id);

-- plataforma_upro.registros definition
CREATE TABLE plataforma_upro.registros (
	id serial4 NOT NULL,
	empleado_id int4 NULL,
	registrador_in_id int4 NULL,
	registrador_out_id int4 NULL,
	fecha_entrada timestamp NULL,
	fecha_salida timestamp NULL,
	CONSTRAINT registros_pkey PRIMARY KEY (id)
);
-- plataforma_upro.registros foreign keys








--ALTER SEQUENCE plataforma_upro.eventos_posicion_id_seq RESTART WITH 61;
--ALTER SEQUENCE plataforma_upro.eventos_fila_id_seq RESTART WITH 4;
--ALTER SEQUENCE plataforma_upro.eventos_asientos_id_seq RESTART WITH 61;

update uplatform.plataforma_upro.eventos_posicion posicion
set fila_id = :fila,
	asiento_id = :asiento_id 
FROM plataforma_upro.egresados egresados
WHERE egresados.id = posicion.egresado_id 
AND egresados.documento = :dni::text



SELECT egresados.documento as documento, egresados.apellido as apellido, egresados.nombres as nombres, carrera.nombre as carrera, fila.nombre as fila, asiento.nombre as asiento, posicion.status as estado   
FROM plataforma_upro.eventos_posicion posicion
LEFT JOIN plataforma_upro.eventos_fila fila on fila.id = posicion.fila_id 
LEFT JOIN plataforma_upro.eventos_asientos asiento on asiento.id  = posicion.asiento_id 
LEFT JOIN plataforma_upro.egresados egresados on egresados.id = posicion.egresado_id 
LEFT JOIN plataforma_upro.carreras carrera on carrera.id = egresados.carrera_id 
WHERE posicion.evento_id = :evento AND fila.nombre = :fila::text
order by fila.nombre, asiento.nombre 


select  count (*)
from plataforma_upro.eventos_posicion posicion
where posicion.status = 1 and posicion.evento_id  = :evento

select  count (*)
from plataforma_upro.eventos_posicion posicion
where posicion.evento_id  = :evento

SELECT *
FROM plataforma_upro.eventos_posicion posicion
WHERE posicion.evento_id = :evento