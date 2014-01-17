<?php

namespace Diet\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoryController extends Controller
{
    public function registAction()
    {
        return $this->render('DietUserBundle:History:history.html.twig');
    }

}
