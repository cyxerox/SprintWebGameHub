<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ban
 *
 * @ORM\Table
 * @ORM\Entity
 */
class Ban
{
    /**
     *
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_m", referencedColumnName="id_membre")
     * })
     */
    private $idM;

    /**
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @return mixed
     */
    public function getIdM()
    {
        return $this->idM;
    }

    /**
     * @param mixed $idM
     */
    public function setIdM($idM)
    {
        $this->idM = $idM;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }









}

