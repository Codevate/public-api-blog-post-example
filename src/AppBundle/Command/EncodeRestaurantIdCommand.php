<?php

namespace AppBundle\Command;

use Hashids\Hashids;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EncodeRestaurantIdCommand extends ContainerAwareCommand
{
  const MIN_HASH_LENGTH = 6;

  /**
   * {@inheritdoc}
   */
  protected function configure()
  {
    $this
      ->setName('app:restaurant:encode-id')
      ->setDescription('Encodes the restaurant ID to a unique string')
      ->addArgument('restaurant', InputArgument::REQUIRED, 'The restaurant ID');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $em = $this->getContainer()->get('doctrine.orm.entity_manager');
    $restaurantId = (int) $input->getArgument('restaurant');

    if (!($restaurant = $em->getRepository('AppBundle:Restaurant')->find($restaurantId))) {
      $output->writeln(sprintf('Could not find restaurant with ID "%d"', $restaurantId));
      return false;
    }

    // encode the restaurant's ID
    $encoder = new Hashids($this->getContainer()->getParameter('secret'), self::MIN_HASH_LENGTH);
    $hashid = $encoder->encode($restaurant->getId());
    $restaurant->setHashid($hashid);
    $em->flush();

    $output->writeln(sprintf('Created hashid for restaurant: %s', $hashid));
  }
}
