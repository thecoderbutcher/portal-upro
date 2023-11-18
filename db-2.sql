-- DROP SCHEMA plataforma_upro;

CREATE SCHEMA plataforma_upro AUTHORIZATION postgres;

-- plataforma_upro.areas definition

-- Drop table

-- DROP TABLE areas;

CREATE TABLE areas (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	secretaria_id serial4 NOT NULL,
	CONSTRAINT areas_pkey PRIMARY KEY (id)
);


-- plataforma_upro.areas foreign keys


-- plataforma_upro.carreras definition

-- Drop table

-- DROP TABLE carreras;

CREATE TABLE carreras (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT carreras_pkey PRIMARY KEY (id)
);

-- plataforma_upro.egresados definition

-- Drop table

-- DROP TABLE egresados;

CREATE TABLE egresados (
	id serial4 NOT NULL,
	documento varchar(40) NULL,
	apellido varchar(50) NULL,
	nombres varchar(50) NULL,
	fecha_nacimiento date NULL,
	email varchar(255) NULL,
	telefono varchar(50) NULL,
	ubicacion_id int4 NULL DEFAULT 1,
	asistira int4 NOT NULL DEFAULT 0,
	recibio_diploma int4 NOT NULL DEFAULT 0,
	carrera_id serial4 NOT NULL,
	CONSTRAINT egresados_pkey PRIMARY KEY (id)
);


-- plataforma_upro.egresados foreign keys

ALTER TABLE plataforma_upro.egresados ADD CONSTRAINT egresados_carrera_id_fkey FOREIGN KEY (carrera_id) REFERENCES carreras(id);
ALTER TABLE plataforma_upro.egresados ADD CONSTRAINT egresados_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES ubicaciones(id);



-- plataforma_upro.empleados definition

-- Drop table

-- DROP TABLE empleados;

CREATE TABLE empleados (
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

ALTER TABLE plataforma_upro.empleados ADD CONSTRAINT empleados_area_id_fkey FOREIGN KEY (area_id) REFERENCES areas(id);
ALTER TABLE plataforma_upro.empleados ADD CONSTRAINT empleados_rol_id_fkey FOREIGN KEY (rol_id) REFERENCES roles(id);
ALTER TABLE plataforma_upro.empleados ADD CONSTRAINT empleados_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES ubicaciones(id);


-- plataforma_upro.eventos definition

-- Drop table

-- DROP TABLE eventos;

CREATE TABLE eventos (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	fecha timestamp NULL,
	ubicacion_id int4 NULL DEFAULT 1,
	CONSTRAINT eventos_pkey PRIMARY KEY (id)
);


-- plataforma_upro.eventos foreign keys

ALTER TABLE plataforma_upro.eventos ADD CONSTRAINT eventos_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES ubicaciones(id);


-- plataforma_upro.eventos_asientos definition

-- Drop table

-- DROP TABLE eventos_asientos;

CREATE TABLE eventos_asientos (
	id serial4 NOT NULL,
	nombre varchar(4) NULL,
	fila_id serial4 NOT NULL,
	CONSTRAINT eventos_asiento_pkey PRIMARY KEY (id)
);


-- plataforma_upro.eventos_asientos foreign keys

ALTER TABLE plataforma_upro.eventos_asientos ADD CONSTRAINT eventos_asientos_fila_id_fkey FOREIGN KEY (fila_id) REFERENCES eventos_fila(id);


-- plataforma_upro.eventos_fila definition

-- Drop table

-- DROP TABLE eventos_fila;

CREATE TABLE eventos_fila (
	id serial4 NOT NULL,
	nombre varchar(4) NULL,
	evento_id int4 NOT NULL DEFAULT nextval('plataforma_upro.eventos_fila_fila_id_seq'::regclass),
	CONSTRAINT eventos_fila_pkey PRIMARY KEY (id)
);


-- plataforma_upro.eventos_fila foreign keys

ALTER TABLE plataforma_upro.eventos_fila ADD CONSTRAINT eventos_fila_evento_id_fkey FOREIGN KEY (evento_id) REFERENCES eventos(id);


-- plataforma_upro.eventos_posicion definition

-- Drop table

-- DROP TABLE eventos_posicion;

CREATE TABLE eventos_posicion (
	id serial4 NOT NULL,
	status int4 NOT NULL DEFAULT 0,
	asiento_id int4 NULL,
	fila_id int4 NULL,
	egresado_id int4 NULL,
	evento_id int4 NULL,
	CONSTRAINT eventos_posicion_pkey PRIMARY KEY (id)
);


-- plataforma_upro.eventos_posicion foreign keys

ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_asiento_id_fkey FOREIGN KEY (asiento_id) REFERENCES eventos_asientos(id);
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_egresado_id_fkey FOREIGN KEY (egresado_id) REFERENCES egresados(id);
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_evento_id_fkey FOREIGN KEY (evento_id) REFERENCES eventos(id);
ALTER TABLE plataforma_upro.eventos_posicion ADD CONSTRAINT empleados_fila_id_fkey FOREIGN KEY (fila_id) REFERENCES eventos_fila(id);


-- plataforma_upro.registros definition

-- Drop table

-- DROP TABLE registros;

CREATE TABLE registros (
	id serial4 NOT NULL,
	empleado_id int4 NULL,
	registrador_in_id int4 NULL,
	registrador_out_id int4 NULL,
	fecha_entrada timestamp NULL,
	fecha_salida timestamp NULL,
	CONSTRAINT registros_pkey PRIMARY KEY (id)
);


-- plataforma_upro.registros foreign keys


-- plataforma_upro.roles definition

-- Drop table

-- DROP TABLE roles;

CREATE TABLE roles (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT roles_pkey PRIMARY KEY (id)
);


-- plataforma_upro.secretaria definition

-- Drop table

-- DROP TABLE secretaria;

CREATE TABLE secretaria (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT secretaria_pkey PRIMARY KEY (id)
);


-- plataforma_upro.secretaria foreign keys

-- plataforma_upro.ubicaciones definition

-- Drop table

-- DROP TABLE ubicaciones;

CREATE TABLE ubicaciones (
	id serial4 NOT NULL,
	nombre varchar(255) NULL,
	CONSTRAINT ubicaciones_pkey PRIMARY KEY (id)
);