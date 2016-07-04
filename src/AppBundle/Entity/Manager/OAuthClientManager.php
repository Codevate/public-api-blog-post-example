<?php

namespace AppBundle\Entity\Manager;

use AppBundle\Entity\OAuthClient;
use Doctrine\ORM\NonUniqueResultException;
use FOS\OAuthServerBundle\Entity\ClientManager;

class OAuthClientManager extends ClientManager
{
  /**
   * @param $hashid
   * @return OAuthClient|null
   * @throws NonUniqueResultException
   */
  public function findOAuthClientByRestaurantHashid($hashid)
  {
    return $this->repository->createQueryBuilder('cl')
      ->from('AppBundle:Restaurant', 'r')
      ->join('r.company', 'c')
      ->join('c.oauthClient', 'ccl')
      ->where('cl = ccl')
      ->andWhere('r.hashid = :hashid')
      ->setParameter('hashid', $hashid)
      ->getQuery()
      ->getOneOrNullResult();
  }
}
