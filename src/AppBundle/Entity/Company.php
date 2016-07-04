<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="company")
 * @ORM\Entity()
 */
class Company
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
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @var Restaurant[]|ArrayCollection
   *
   * @ORM\OneToMany(targetEntity="Restaurant", mappedBy="company")
   */
  private $restaurants;

  /**
   * @var OAuthClient
   *
   * @ORM\OneToOne(targetEntity="OAuthClient")
   */
  private $oauthClient;

  public function __construct()
  {
    $this->restaurants = new ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   * @return $this
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Add restaurant
   *
   * @param Restaurant $restaurant
   * @return $this
   */
  public function addRestaurant(Restaurant $restaurant)
  {
    $restaurant->setCompany($this);
    $this->restaurants->add($restaurant);

    return $this;
  }

  /**
   * Remove restaurant
   *
   * @param Restaurant $restaurant
   * @return $this
   */
  public function removeRestaurant(Restaurant $restaurant)
  {
    $this->restaurants->removeElement($restaurant);
    $restaurant->setCompany(null);

    return $this;
  }
  /**
   * Get restaurants
   *
   * @return Restaurant[]|ArrayCollection
   */
  public function getRestaurants()
  {
    return $this->restaurants;
  }

  /**
   * Set oauthClient
   *
   * @param OAuthClient $oauthClient
   * @return $this
   */
  public function setOAuthClient(OAuthClient $oauthClient = null)
  {
    $this->oauthClient = $oauthClient;

    return $this;
  }

  /**
   * Get oauthClient
   *
   * @return OAuthClient
   */
  public function getOAuthClient()
  {
    return $this->oauthClient;
  }
}
