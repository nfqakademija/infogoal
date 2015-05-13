<?php

namespace InfoGoal\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApiUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('api:update')
            ->setDescription('Updates data from API.')
            ->addArgument(
                'timeout',
                InputArgument::REQUIRED,
                'Timeout for action doing.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $api = $this->getContainer()->get('kicker.api');
        $reservation = $this->getContainer()->get('kicker.reservation');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $optionsRepo = $em->getRepository('InfoGoalKickerBundle:TableOption');

        $timeout = $input->getArgument('timeout');
        $startTime = time();

        while (time() - $startTime < $timeout) {
            $options = $optionsRepo->findAll();
            $api->readApi($options);
            $reservation->checkForCancellation();
            sleep(2);
        }
    }
}