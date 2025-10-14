<?php
include("Mascota.php");

class Perro {
    private $arrPerro = [];

    function __construct()
    {
        // Agregar mascotas al array

        $t1 = new Mascota("Tafi", "150", "chihuahua", "chi.png");
        $t1->agregarConsulta(new Consulta("2025-10-05", "Vacuna", 150));
        $t1->agregarConsulta(new Consulta("2025-10-01", "Malestar estomacal", 150));

        $r1 = new Mascota("Rocky", "200", "golden", "golden.png");
        $r1->agregarConsulta(new Consulta("2025-10-06", "Chequeo general", 200));

        $t2 = new Mascota("Timmy", "300", "salchicha", "salchi.png");
        $t2->agregarConsulta(new Consulta("2025-10-07", "Desparasitación", 300));

        $c1 = new Mascota("Cuco", "400", "pastor belga", "pb.png");
        $c1->agregarConsulta(new Consulta("2025-10-08", "Vacuna antirrábica", 400));

        $this->arrPerro = [$t1, $r1, $t2, $c1];

    }
    function buscarPorRaza($raza) {
        foreach ($this->arrPerro as $mascota) {
            if ($mascota->getRaza() === $raza) {
                return $mascota;
            }
        }
        return null; // Si no encuentra coincidencia
    }

    function buscarPorNombre($nombre) {
        foreach ($this->arrPerro as $mascota) {
            if ($mascota->getNombre() === $nombre) {
                return $mascota;
            }
        }
        return null; // Si no encuentra coincidencia
    }
}
?>