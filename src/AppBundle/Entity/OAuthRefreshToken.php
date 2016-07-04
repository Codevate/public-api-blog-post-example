<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oauth_refresh_token")
 * @ORM\Entity()
 */
class OAuthRefreshToken extends BaseRefreshToken
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
}
