<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tapa
 *
 * @ORM\Table(name="tapa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TapaRepository")
 */
class Tapa {

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetimetz")
     */
    private $fechaCreacion;

    /**
     * @var bool
     *
     * @ORM\Column(name="top", type="boolean")
     */
    private $top;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="tapas")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    private $categoria;

    /**
     * Many Tapas have Many Ingredientes.
     * @ORM\ManyToMany(targetEntity="Ingrediente")
     * @ORM\JoinTable(name="ingredientes_tapas",
     *      joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ingredientes", referencedColumnName="id")}
     *      )
     */
    private $ingredientes;

    public function __construct() {
        $this->ingredientes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tapa
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tapa
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Tapa
     */
    public function setFoto($foto) {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Tapa
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Set top
     *
     * @param boolean $top
     *
     * @return Tapa
     */
    public function setTop($top) {
        $this->top = $top;

        return $this;
    }

    /**
     * Get top
     *
     * @return bool
     */
    public function getTop() {
        return $this->top;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Tapa
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null) {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria() {
        return $this->categoria;
    }


    /**
     * Add ingrediente
     *
     * @param \AppBundle\Entity\Ingrediente $ingrediente
     *
     * @return Tapa
     */
    public function addIngrediente(\AppBundle\Entity\Ingrediente $ingrediente)
    {
        $this->ingredientes[] = $ingrediente;

        return $this;
    }

    /**
     * Remove ingrediente
     *
     * @param \AppBundle\Entity\Ingrediente $ingrediente
     */
    public function removeIngrediente(\AppBundle\Entity\Ingrediente $ingrediente)
    {
        $this->ingredientes->removeElement($ingrediente);
    }

    /**
     * Get ingredientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredientes()
    {
        return $this->ingredientes;
    }
}
