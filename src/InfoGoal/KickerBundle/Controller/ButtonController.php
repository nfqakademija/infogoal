<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-05-12
 * Time: 23:10
 */

namespace InfoGoal\KickerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ButtonController extends Controller
{
 public function indexAction() {

     return $this->render('::button.html.twig');
 }
}