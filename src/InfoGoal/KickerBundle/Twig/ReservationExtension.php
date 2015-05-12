<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-05-12
 * Time: 19:14
 */
namespace InfoGoal\KickerBundle\Twig;

use Doctrine\ORM\EntityManager;

class ReservationExtension extends \Twig_Extension
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('reservation', array($this, 'reservationStatus')),
        );
    }

    public function reservationStatus()
    {
        $reservationStatus = $this->em->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "table_state"));
        return $reservationStatus->getOptionValue();
    }

    public function getName()
    {
        return 'reservationStatus';
    }
}