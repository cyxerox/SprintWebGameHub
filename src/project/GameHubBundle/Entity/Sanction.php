<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sanction
 *
 * @ORM\Table(name="sanction", indexes={@ORM\Index(name="id_mpro", columns={"id_mpro"})})
 * @ORM\Entity
 */
class Sanction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sanction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSanction;

    /**
     * @var string
     *
     * @ORM\Column(name="sanction", type="string", length=30, nullable=false)
     */
    private $sanction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree", type="date", nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="string", length=30, nullable=false)
     */
    private $motif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sanc", type="date", nullable=false)
     */
    private $dateSanc;

    /**
     * @var \MembrePro
     *
     * @ORM\ManyToOne(targetEntity="MembrePro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mpro", referencedColumnName="id_mpro")
     * })
     */
    private $idMpro;


}

