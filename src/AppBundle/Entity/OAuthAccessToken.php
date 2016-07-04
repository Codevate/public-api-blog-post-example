<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oauth_access_token")
 * @ORM\Entity()
 */
class OAuthAccessToken extends BaseAccessToken
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="OAuthClient")
   * @ORM\JoinColumn(nullable=false)
   */
  protected $client;

  /**
   * @var Restaurant
   *
   * @ORM\ManyToOne(targetEntity="Restaurant")
   */
  protected $restaurant;

  /**
   * @param Restaurant|null $restaurant
   * @return $this
   */
  public function setRestaurant(Restaurant $restaurant = null)
  {
    $this->restaurant = $restaurant;

    return $this;
  }

  /**
   * @return Restaurant
   */
  public function getRestaurant()
  {
    return $this->restaurant;
  }
}
