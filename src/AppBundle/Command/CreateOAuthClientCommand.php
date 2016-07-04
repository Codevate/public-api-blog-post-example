<?php

namespace AppBundle\Command;

use OAuth2\OAuth2;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateOAuthClientCommand extends ContainerAwareCommand
{
  /**
   * {@inheritdoc}
   */
  protected function configure()
  {
    $this
      ->setName('app:oauth-client:create')
      ->setDescription('Create a new OAuth client for a company')
      ->addArgument('company', InputArgument::REQUIRED, 'The company ID');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager');
    $em = $this->getContainer()->get('doctrine.orm.entity_manager');
    $companyId = (int) $input->getArgument('company');

    if (!($company = $em->getRepository('AppBundle:Company')->find($companyId))) {
      $output->writeln(sprintf('Could not find company with ID "%d"', $companyId));
      return false;
    }

    // create a new OAuth client and assign it to the company
    $client = $clientManager->createClient();
    $client->setAllowedGrantTypes(array(OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS));
    $company->setOAuthClient($client);
    $clientManager->updateClient($client);

    $output->writeln(sprintf('client_id=%s_%s', $client->getId(), $client->getRandomId()));
    $output->writeln(sprintf('client_secret=%s', $client->getSecret()));
  }
}
