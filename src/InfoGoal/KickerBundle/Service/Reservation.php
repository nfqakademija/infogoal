<?php

namespace InfoGoal\KickerBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use InfoGoal\KickerBundle\Entity\TableOption;

class Reservation
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return Response
     */
    public function makeReservation()
    {
        $reservationStatus = 0;
        $optionRepository = $this->em->getRepository("InfoGoalKickerBundle:TableOption");
        $state = $optionRepository->findOneByOptionKey("table_state");

        if ($state->getOptionValue() == 0) {
            $state->setOptionValue(2);

            $reservationUntil = $optionRepository->findOneByOptionKey("reservation_until");
            if (!$reservationUntil) {
                $reservationUntil = new TableOption();
                $reservationUntil->setOptionKey("reservation_until");
                $this->em->persist($reservationUntil);
            }
            $reservationUntil->setOptionValue(strtotime("+1 minutes"));

            $this->em->flush();
            $reservationStatus = 1;
        }

        return new Response($reservationStatus);
    }

    public function checkForCancellation()
    {
        $optionRepository = $this->em->getRepository("InfoGoalKickerBundle:TableOption");
        $until = $optionRepository->findOneByOptionKey("reservation_until");
        $state = $optionRepository->findOneByOptionKey("table_state");
        $this->em->refresh($until);
        $this->em->refresh($state);

        if ($until && $state && $state->getOptionValue() == 2) {
            $timeUntilWait = $until->getOptionValue();
            if (strtotime("now") > $timeUntilWait) {
                $state->setOptionValue(0);
                $this->em->flush();
            }
        }
    }
} 