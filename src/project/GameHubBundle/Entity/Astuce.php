<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Astuce
 *
 * @ORM\Table(name="astuce", indexes={@ORM\Index(name="id_mpro", columns={"id_mpro"}), @ORM\Index(name="id_jeux", columns={"id_jeux"})})
 * @ORM\Entity
 */
class Astuce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_astuce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAstuce;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=500, nullable=false)
     */
    private $object;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var \MembrePro
     *
     * @ORM\ManyToOne(targetEntity="MembrePro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mpro", referencedColumnName="id_mpro")
     * })
     */
    private $idMpro;

    /**
     * @var \Jeux
     *
     * @ORM\ManyToOne(targetEntity="Jeux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jeux", referencedColumnName="id_jeux")
     * })
     */
    private $idJeux;


}

