<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikeReponse
 *
 * @ORM\Table(name="like_reponse", indexes={@ORM\Index(name="id_reponse", columns={"id_reponse"}), @ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class LikeReponse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_like", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idLike;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_like", type="integer", nullable=false)
     */
    private $nbrLike;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_dislike", type="integer", nullable=false)
     */
    private $nbrDislike;

    /**
     * @var \Reponse
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Reponse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reponse", referencedColumnName="id_reponse")
     * })
     */
    private $idReponse;

    /**
     * @var \Membre
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id_membre")
     * })
     */
    private $idMembre;


}

