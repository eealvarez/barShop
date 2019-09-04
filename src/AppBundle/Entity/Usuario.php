<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;    //Esta librería está inculada o necesaria para el ArrayCollection del contructor indicado más abajo en este archivo, específicamente el de reservas, es decir: $this->reservas = ArrayCollection();

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */

class Usuario implements AdvancedUserInterface, \Serializable {
//class Usuario implements UserInterface, \Serializable {
//class Usuario implements UserInterface {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $username;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=254)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

//    /**
//     * @ORM\Column(type="string", length=256)
//     */
//    private $roles;
//    /**
//     * @ORM\Column(type="json_array", length=256)
//     */
//    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json_array", length=255)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="usuario")
     */
    private $reservas;

    public function __construct() {
        $this->isActive = true;
//        $this->reservas = ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        return $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        return $this->email = $email;
    }

    public function getSalt() {           //para estas funciones es necesario agregar en el inicio de la clase: implements UserInterface, \Serializable
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($password) {
        $this->plainPassword = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        return $this->password = $password;
    }

//    public function setRoles($roles) {
//        $roles_json = json_encode($roles);
//        return $this->roles = $roles_json;
//    }
//
//    public function getRoles() {
//        $roles = json_decode($this->roles);  //lo que tenemos en la BD, por eso escribimos $this->roles
//        return array($this->roles);      //esta línea se agregó debido al módulo de seguridad de autenticación de usuarios para manejar la autorización de usuarios
////        return $roles;
////        return ['ROLE_USER'];
//    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return Usuario
     */
    public function setRoles(array $roles) {
        $this->roles = $roles;
        // allows for chaining
        return $this;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function eraseCredentials() {
        
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
                // see section on salt below
                // $this->salt,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->username,
                $this->password,
                // see section on salt below
                // $this->salt
//                ) = unserialize($serialized, ['allowed_classes' => false]);
                ) = unserialize($serialized);
    }

    //los siguientes métodos que Symfony usa internamente son para manejar a los usuarios que se encuentran activos:

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->isActive;
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Usuario
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return Usuario
     */
    public function addReserva(\AppBundle\Entity\Reserva $reserva) {
        $this->reservas[] = $reserva;

        return $this;
    }

    /**
     * Remove reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     */
    public function removeReserva(\AppBundle\Entity\Reserva $reserva) {
        $this->reservas->removeElement($reserva);
    }

    /**
     * Get reservas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservas() {
        return $this->reservas;
    }

}
