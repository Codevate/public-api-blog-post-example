<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oauth_auth_code")
 * @ORM\Entity()
 */
class OAuthAuthCode extends BaseAuthCode
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
