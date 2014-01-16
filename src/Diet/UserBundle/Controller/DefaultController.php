<?php

namespace Diet\UserBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('diet_user_home'));
    }
    public function homeAction()
    {
        $histories = array();
        $em = $this->get('doctrine')->getManager();
        /* @var $em EntityManager */

        $userRepo = $em->getRepository('DietCoreBundle:User');
        $historyRepo = $em->getRepository('DietCoreBundle:History');

        $id = $this->get('security.context')->getToken()->getUser()->getId();
        $users = $em->getRepository('DietCoreBundle:User')->findBy(array(
                'weight' => $id
        ));

        foreach ($users as $user) {
            $userid = $user->getId();
            $histories[$userid] = $historyRepo->findBy(array(
                    'user' => $userid,
            ));
        }

        return $this->render('DietUserBundle:Default:home.html.twig', array(
                'users' => $users,
                'histories' => $histories,
        ));
    }

}
