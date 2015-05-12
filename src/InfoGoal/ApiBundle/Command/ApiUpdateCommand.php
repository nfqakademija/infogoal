<?php

namespace InfoGoal\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApiUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('api:update')
            ->setDescription('Updates data from API.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $api = $this->getContainer()->get('kicker.api');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $optionsRepo = $em->getRepository('InfoGoalKickerBundle:TableOption');

        while (true) {
            $options = $optionsRepo->findAll();
            $api->readApi($options);
            sleep(2);
        }
    }
}