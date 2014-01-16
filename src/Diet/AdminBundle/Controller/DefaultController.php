<?php

namespace Diet\AdminBundle\Controller;
use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('DietAdminBundle:Default:index.html.twig');
    }

}
