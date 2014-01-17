<?php

namespace Diet\UserBundle\Controller;
use Diet\CoreBundle\Entity\History;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HistoryController extends Controller
{
    public function registAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        /* @var $em EntityManager */
        $postTitles = array(
                "post_1",
                "post_2",
                "machine_id"
        );
        /*
         * post_1:weight
         * post_2:user_id
         */

        $error = null;
        $posts = array();

        if ($request->getMethod() === 'POST') {

            foreach ($postTitles as $postTitle) {
                $posts[$postTitle] = $this->get('request')->request->get($postTitle);
            }

            $machine = $em->getRepository('DietCoreBundle:WeightMachine')->findOneBy(array(
                    'machineid' => $posts['machine_id'],
            ));

            if (!$machine) {
                $error = $error . "no machine";
            }

            $user = $em->getRepository('DietCoreBundle:User')->findOneById($posts['post_2']);
            if (!$user) {
                $error = $error . "no user";
            }

            if (!$error) {
                $newhistory = new History();
                $newhistory->setWeight($posts['post_1']);
                $newhistory->setUser($user);

                $em->persist($newhistory);
                $em->flush();
            }
        }
        return $this->render('DietUserBundle:History:history.html.twig', array(
                'postTitles' => $postTitles,
                'posts' => $posts,
                'error' => $error,
        ));
    }
    public function formAction(Request $request)
    {
        return $this->render('DietUserBundle:History:form.html.twig');
    }
}
