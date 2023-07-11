<?php

namespace Model;


class ActiveRecord {

    // DB
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    // Alerts and Messages
    protected static $alerts = [];

    // Set DB connection - includes/database.php
    public static function setDB($database) {
      self::$db = $database;
    }

    public static function setAlert($type, $message) {
      static::$alerts[$type][] = $message;
    }

    // Validation
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // CRUD
    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    // Read – CRUD
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result = self::consultSQL($query);
        return $result;
    }

    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = {$id}";
        $result = self::consultSQL($query);
        return array_shift( $result ) ;
    }

    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT {$limit}";
        $result = self::consultarSQL($query);
        return array_shift( $result ) ;
    }

    // Busqueda Where con Columna
    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";
        $result = self::consultSQL($query);
        return array_shift( $result ) ;
    }

    // Busca todos los registros que pertenecen a un ID
    public static function belongsTo($column, $value) {
        $query = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";
        $result = self::consultSQL($query);
        return $result;
    }

    // SQL para Consultas Avanzadas.
    public static function SQL($consult) {
        $query = $consult;
        $result = self::consultSQL($query);
        return $result;
    }

    // crea un nuevo registro
    public function create() {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        // Resultado de la consulta
        $result = self::$db->query($query);

        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    public function update() {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();

        // Iterar para ir agregando cada campo de la BD
        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";


        $result = self::$db->query($query);
        return $result;
    }

    // Eliminar un registro - Toma el ID de Active Record
    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    public static function consultSQL($query) {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($entry = $result->fetch_assoc()) {
            $array[] = static::createObject($entry);
        }

        // liberar la memoria
        $result->free();

        // retornar los resultados
        return $array;
    }

    protected static function createObject($entry) {
        $object = new static;

        foreach($entry as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }

        return $object;
    }


    // Identificar y unir los atributos de la BD
    public function attributes() {
        $attributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
          $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function sync($args=[]) {
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}
