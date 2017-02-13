<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 * @UniqueEntity("cedula",message="Esta cedula ya existe")
 * @UniqueEntity("email",message="Este email ya existe")
 * @UniqueEntity("numeroRegistro",message="Este numero de registro ya existe")
 */
class Customer
{


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     * @Assert\NotBlank(message = "El nombre es requerido")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     * @Assert\NotBlank(message = "El apellido es requerido")
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=100, unique=true)
     * @Assert\NotBlank(message = "La cedula es requerida")
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=100, nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     * @Assert\NotBlank(message = "El email es requerido")
     * @Assert\Email(
     *     message = "El email '{{ value }}' No es un email valido.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_registro", type="string", length=50, unique=true)
     * @Assert\NotBlank(message = "El nombre numero de registro es requerido")
     */
    private $numeroRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_curso", type="datetimetz")
     * @Assert\Date()
     * @Assert\NotBlank(message = "La fecha del curso es requerida")
     */
    private $fechaCurso;

    /**
     * @var bool
     *
     * @ORM\Column(name="descargar_certificado", type="boolean")
     * @Assert\NotBlank(message = "Debe seleccionar si puede descargar el certificado o no")
     */
    private $descargarCertificado;


    /**
     * @ORM\ManyToOne(targetEntity="Nivel_certificado", inversedBy="customers")
     * @ORM\JoinColumn(name="idnivel_certificado", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $nivel_certificado;

    


    public function __construct()
    {

        $this->fechaCurso = new \DateTime();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Customer
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Customer
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Customer
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return Customer
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set numeroRegistro
     *
     * @param string $numeroRegistro
     *
     * @return Customer
     */
    public function setNumeroRegistro($numeroRegistro)
    {
        $this->numeroRegistro = $numeroRegistro;

        return $this;
    }

    /**
     * Get numeroRegistro
     *
     * @return string
     */
    public function getNumeroRegistro()
    {
        return $this->numeroRegistro;
    }

    /**
     * Set fechaCurso
     *
     * @param \DateTime $fechaCurso
     *
     * @return Customer
     */
    public function setFechaCurso($fechaCurso)
    {
        $this->fechaCurso = $fechaCurso;
    }

    /**
     * Get fechaCurso
     *
     * @return \DateTime
     */
    public function getFechaCurso()
    {
        return $this->fechaCurso;
    }

    /**
     * Set descargarCertificado
     *
     * @param boolean $descargarCertificado
     *
     * @return Customer
     */
    public function setDescargarCertificado($descargarCertificado)
    {
        $this->descargarCertificado = $descargarCertificado;

        return $this;
    }

    /**
     * Get descargarCertificado
     *
     * @return bool
     */
    public function getDescargarCertificado()
    {
        return $this->descargarCertificado;
    }


    /**
     * Set nivelCertificado
     *
     * @param \AppBundle\Entity\Nivel_certificado $nivelCertificado
     *
     * @return Customer
     */
    public function setNivelCertificado(\AppBundle\Entity\Nivel_certificado $nivelCertificado = null)
    {
        $this->nivel_certificado = $nivelCertificado;

        return $this;
    }

    /**
     * Get nivelCertificado
     *
     * @return \AppBundle\Entity\Category
     */
    public function getNivelCertificado()
    {
        return $this->nivel_certificado;
    }

}
