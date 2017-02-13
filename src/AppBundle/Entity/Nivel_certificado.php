<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Nivel_certificado
 *
 * @ORM\Table(name="nivel_certificado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Nivel_certificadoRepository")
 */
class Nivel_certificado
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
     * @ORM\Column(name="descripcion", type="string", length=100, unique=true)
     */
    private $descripcion;


    /**
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="nivel_certificado")
     */
    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Nivel_certificado
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Nivel_certificado
     */
    public function addCustomer(\AppBundle\Entity\Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param \AppBundle\Entity\Customer $customer
     */
    public function removeCustomer(\AppBundle\Entity\Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }
}
