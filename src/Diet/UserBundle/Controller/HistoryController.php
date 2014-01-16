<?php

namespace Diet\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoryController extends Controller
{
    public function historyAction()
    {
        return $this->render('DietUserBundle:History:history.html.twig');
    }
    
}
