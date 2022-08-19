<?php

class Clase{
    private $nombre;
    private $entrenador;
    private $aAlumnos;

    public function __construct()
    {
        $this->aAlumnos = array();
    }

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }

    public function asignarEntrenador($entrenador){
        $this->entrenador = $entrenador;
    }

    public function inscribirAlumno($alumno){
        $this->aAlumnos[] = $alumno;
    }

    public function imprimirListado(){

        echo "*** Listado de alumnos de clase " . $this->nombre . " ***<br/>";
        foreach($this->aAlumnos as $pos => $alumno){
            echo $pos+1 . ". " . $alumno->nombre . "</br>";
        }
        echo "<br/>";

    }
}

class Persona {
    protected $dni;
    protected $nombre;
    protected $correo;
    protected $celular;
}

class Alumno extends Persona {
    private $fechaNac;
    private $peso;
    private $altura;
    private $aptoFisico;
    private $presentismo;

    public function __construct($dni, $nombre, $correo, $celular, $fechaNac)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->celular = $celular;
        $this->fechaNac = $fechaNac;
        $this->peso = 0.0;
        $this->altura = 0.0;
        $this->aptoFisico = false;
        $this->presentismo = 0.0;
    }

    public function __get($propiedad){
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor){
        $this->$propiedad = $valor;
    }

    public function setFichaMedica($peso, $altura, $aptoFisico){
        $this->peso = $peso;
        $this->altura = $altura;
        $this->aptoFisico = $aptoFisico;
    }
}

class Entrenador extends Persona{
    private $aClases;

    public function __construct($dni, $nombre, $correo, $celular)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->celular = $celular;
        $this->aClases = array();
    }

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }

    public function asignarClase($clase){
        $this->aClases[] = $clase;
    }
}

//Desarrollo del programa

$entrenador1 = new Entrenador("34987789", "Miguel Ocampo", "miguel@mail.com", "11678634");
$entrenador2 = new Entrenador("28987589", "Andrea Zarate", "andrea@mail.com", "11768654");

$alumno1 = new Alumno("40787657", "Dante Montera", "dante@mail.com", "1145632457", "1997-08-28");
$alumno1->setFichaMedica(90, 178, true);
$alumno1->presentismo = 78;

$alumno2 = new Alumno("46766547", "Darío Turchi", "dario@mail.com", "1145632457", "1986-11-21");
$alumno2->setFichaMedica(90, 178, true);
$alumno2->presentismo = 68;

$alumno3 = new Alumno("39765454", "Facundo Fagnano", "facundo@mail.com", "1145632457", "1993-02-06");
$alumno3->setFichaMedica(90, 187, true);
$alumno3->presentismo = 88;

$alumno4 = new Alumno("39765454", "Gastón Aguilar", "gaston@mail.com", "1145632457", "1999-11-02");
$alumno4->setFichaMedica(70, 169, false);
$alumno4->presentismo = 98;

$clase1 = new Clase();
$clase1->nombre = "Funcional";
$clase1->asignarEntrenador($entrenador1);
$clase1->inscribirAlumno($alumno1);
$clase1->inscribirAlumno($alumno3);
$clase1->inscribirAlumno($alumno4);
$clase1->imprimirListado();

$clase2 = new Clase();
$clase2->nombre = "Zumba";
$clase2->asignarEntrenador($entrenador2);
$clase2->inscribirAlumno($alumno1);
$clase2->inscribirAlumno($alumno2);
$clase2->inscribirAlumno($alumno3);
$clase2->imprimirListado();


?>