<?php
    class InoutModel{
        private $db;

        public function __construct(){ $this->db = new DataBase; }

        public function registroEntrada($param){
            if(isset($param)){
                $this->db->query('INSERT INTO plataforma_upro.registros(empleado_id, registrador_in_id, fecha_entrada) VALUES (:empleado_id, :registrador_id, :fecha)');
            
                $fecha = date('Y-m-d h:i:s.u');
                $this->db->bind(':empleado_id', intval($param['empleado']));
                $this->db->bind(':registrador_id', intval($param['registrador']));
                $this->db->bind(':fecha', $fecha);
                
                if($this->db->execute()){ return $fecha; }
            }
        }
        
        public function getRegistroEntradaId($param){
            if(isset($param)){
                $this->db->query('SELECT id FROM plataforma_upro.registros WHERE empleado_id = :empleado_id AND registrador_in_id = :registrador_id AND fecha_entrada = :fecha');
                
                $this->db->bind(':empleado_id', $param['empleado']);
                $this->db->bind(':registrador_id', $param['registrador']);
                $this->db->bind(':fecha', $param['fecha']);
        
                return ($this->db->getRecord())->id;
            }
        }

        public function getRegistros($ubicacion, $fecha){            
            $this->db->query("
                SELECT empleado.documento as e_documento, empleado.apellido as e_apellido, empleado.nombres as e_nombres, 
                        registro.fecha_entrada as r_entrada, registro.fecha_salida as r_salida, 
                        registrador_in.documento as rin_documento, registrador_in.apellido as rin_apellido, registrador_in.nombres as rin_nombres,
                        registrador_out.documento as rout_documento, registrador_out.apellido as rout_apellido, registrador_out.nombres as rout_nombres
                FROM plataforma_upro.registros registro
                JOIN plataforma_upro.empleados empleado on empleado.id = registro.empleado_id
                JOIN plataforma_upro.ubicaciones ubicacion on ubicacion.id = empleado.ubicacion_id
                LEFT JOIN(
                    SELECT id, apellido, nombres, documento
                    from plataforma_upro.empleados
                ) as registrador_in on registrador_in.id = registro.registrador_in_id
                LEFT JOIN(
                    SELECT id, apellido, nombres, documento
                    from plataforma_upro.empleados
                ) as registrador_out on registrador_out.id = registro.registrador_out_id
                WHERE registro.fecha_entrada::text like :fecha || '%' 
                AND ubicacion.nombre = :ubicacion
            ");

            $this->db->bind(':ubicacion', $ubicacion);
            $this->db->bind(':fecha', $fecha);

            return $this->db->getRecords(); 
        }

        public function changeStatus($param){
            if(isset($param)){
                $this->db->query('UPDATE plataforma_upro.empleados SET status = :status WHERE id = :empleado_id');
                $this->db->bind(':empleado_id', $param['empleado']);
                $this->db->bind(':status', $param['id_entrada']);

                return $this->db->execute();
            }
        }

        public function registroSalida($param){
            if(isset($param)){
                $this->db->query('UPDATE plataforma_upro.registros SET fecha_salida = :fecha, registrador_out_id = :registrador_id WHERE empleado_id = :empleado_id AND id = :id');
            
                $fecha = date('Y-m-d h:i:s.u');
                $this->db->bind(':empleado_id', intval($param['empleado'])); 
                $this->db->bind(':id', intval($param['id_entrada']));
                $this->db->bind(':registrador_id', $param['registrador']);
                $this->db->bind(':fecha', $fecha);
                
                return $this->db->execute();
            }
        }
    }
?>