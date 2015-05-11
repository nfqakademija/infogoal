<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller {

    public function indexAction()
    {
        $reservation = $this->get('kicker.reservation');
        return $reservation->makeReservation();
    }
} 