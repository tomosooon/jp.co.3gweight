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
            /*
                        if(!is_float($posts['post_1'])){
                            $error = $error . "your weight is not good type\n";
                        }
             */
            if ((int)($posts['post_1'] * 100) % 10 >= 5) {
                $weight = (int)($posts['post_1']*10)/10.0+0.1;
            } else {
                $weight = (int)($posts['post_1']*10)/10.0;
            }

            if (!$machine) {
                $error = $error . "no machine\n";
            }

            $user = $em->getRepository('DietCoreBundle:User')->findOneById($posts['post_2']);
            if (!$user) {
                $error = $error . "no user\n";
            }

            if ($error) {
                $this->get('session')->getFlashBag()->add('success', $error);
                return $this->redirect($this->generateUrl('diet_user_history_regist_form'));
            }

            $newhistory = new History();
            $newhistory->setWeight($weight);
            $newhistory->setUser($user);

            $em->persist($newhistory);
            $em->flush();
        }
        return $this->render('DietUserBundle:History:regist_confirm.html.twig', array(
                'postTitles' => $postTitles,
                'posts' => $posts,
        ));
    }
    public function formAction(Request $request)
    {
        return $this->render('DietUserBundle:History:form.html.twig');
    }

    public function historyAction(Request $request)
    {
        return $this->render('DietUserBundle:History:history.html.twig');
    }
}
