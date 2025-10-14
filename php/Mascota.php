<?php
include("Consulta.php");
class Mascota
{
  protected $nombre;  //private, public
  protected $raza;
  protected $costo;
  private $consultas = [];

  public function getCosto()
  {
    return $this->costo;
  }

  public function setCosto($costo)
  {
    $this->costo= $costo;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

 public function getRaza()
  {
    return $this->raza;   //this.raza
  }

  public function setRaza($raza)
  {
    $this->raza = $raza;
  }


  protected function toString()
  {
    return "Esta mascota {$this->nombre} es {$this->raza} .";
  }

  function setFoto($valor){
    $this->sFoto = $valor;
  }

  function getFoto(){
    return $this->sFoto;
  }

  function __construct($sNom, $nCosto, $sRaza, $sFot){
    $this->nombre = $sNom;
    $this->costo = $nCosto;
    $this->raza = $sRaza;
    $this->sFoto = $sFot;
  }

    public function agregarConsulta($consulta) {
        $this->consultas[] = $consulta;
    }

    public function getConsultas() {
        return $this->consultas;
    }

    public function toArray() {
        $consultasArray = [];
        foreach ($this->consultas as $c) {
            $consultasArray[] = $c->toArray();
        }
        return [
            "nombre" => $this->nombre,
            "raza" => $this->raza,
            "foto" => $this->sFoto,
            "consultas" => $consultasArray
        ];
    }
}
?>