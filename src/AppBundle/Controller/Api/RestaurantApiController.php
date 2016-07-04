<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\OAuthAccessToken;
use AppBundle\Entity\Restaurant;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class RestaurantApiController extends FOSRestController
{
  /**
   * @Rest\Get("/restaurant/{hashid}", name="api.restaurant")
   *
   * @param Restaurant $restaurant
   * @return static
   */
  public function getRestaurantAction(Restaurant $restaurant)
  {
    $view = View::create();

    // check if the auth token is scoped
    if ($this->isGranted('ROLE_WIDGET')) {
      /** @var OAuthAccessToken $token */
      $token = $this->get('fos_oauth_server.access_token_manager')->findTokenByToken($this->get('security.token_storage')->getToken()->getToken());

      // prevent access to all other restaurants
      if ($token->getRestaurant()->getId() !== $restaurant->getId()) {
        throw new AccessDeniedException();
      }

      // only serialise certain fields
      $context = new Context();
      $context->setGroups(array('widget'));
      $view->setContext($context);
    }

    $view->setData(array(
      'restaurant' => $restaurant,
    ));

    return $view;
  }
}
