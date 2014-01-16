<?php

namespace Diet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DietCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
