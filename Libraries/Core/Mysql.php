<?php
class Mysql extends Conexion
{
    private $conexion;
    private $strquery;
    private $arrvaluesM;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    public function insert(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrvaluesM = $arrValues;
        $insert = $this->conexion->prepare($this->strquery);
        $resInsert = $insert->execute($arrValues);
        if (!$resInsert) {
            $lastInsert = $this->conexion->lastInsertId();
        } else {
            $lastInsert = 0;
        }
        return $lastInsert;
    }

    public function select_all(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrvaluesM = $arrValues;
        $update = $this->conexion->prepare($this->strquery);
        $resExecute = $update->execute($this->arrvaluesM);
        return $resExecute;
    }

    public function delete(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        return $result;
    }
    public function select(string $query)
    {
        $this->strquery = $query;
        try {
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();

            // Si esperas múltiples filas, utiliza fetchAll
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

            // Puedes retornar un array incluso si es una sola fila
            return $data;
        } catch (PDOException $e) {
            // Manejo de errores
            // Aquí puedes registrar o imprimir el error según tus necesidades
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
}
?>