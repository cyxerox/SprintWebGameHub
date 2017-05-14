<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chaine
 *
 * @ORM\Table(name="chaine", indexes={@ORM\Index(name="id_mpro", columns={"id_mpro"})})
 * @ORM\Entity
 */
class Chaine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_chaine", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChaine;

    /**
     * @var string
     *
     * @ORM\Column(name="nomC", type="string", length=50, nullable=false)
     */
    private $nomc;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="console", type="string", length=30, nullable=false)
     */
    private $console;

    /**
     * @var string
     *
     * @ORM\Column(name="url_pdp", type="string", length=255, nullable=false)
     */
    private $urlPdp;

    /**
     * @var string
     *
     * @ORM\Column(name="url_chaine", type="string", length=255, nullable=false)
     */
    private $urlChaine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="membre_depuis", type="date", nullable=false)
     */
    private $membreDepuis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modif", type="datetime", nullable=false)
     */
    private $dateModif;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="text", length=65535, nullable=false)
     */
    private $signature;

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

