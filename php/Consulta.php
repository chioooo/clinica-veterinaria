<?php

class Consulta
{
    private $fecha;
    private $motivo;
    private $costoConsulta;

    function __construct($fecha, $motivo, $costoConsulta)
    {
        $this->fecha = $fecha;
        $this->motivo = $motivo;
        $this->costoConsulta = $costoConsulta;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getMotivo()
    {
        return $this->motivo;
    }

    public function getCostoConsulta()
    {
        return $this->costoConsulta;
    }

    public function toArray()
    {
        return [
            "fecha" => $this->fecha,
            "motivo" => $this->motivo,
            "costo" => $this->costoConsulta
        ];
    }
}