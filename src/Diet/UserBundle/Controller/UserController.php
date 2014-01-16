<?php

namespace Diet\UserBundle\Controller;
use Diet\CoreBundle\Form\ConfirmType;

use Diet\CoreBundle\Form\UserType;

use Diet\CoreBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function settingAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        /* @var $em EntityManager */

        $newuser = new User();
        $form = $this->createForm(new UserType('default'), $newuser);

        $id = $this->get('security.context')->getToken()->getUser()->getId();

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $weight = $em->getRepository('DietCoreBundle:Weight')->find($id);
                $newuser->setWeight($weight);

                $em->persist($newuser);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', '新しいユーザーを追加しました。');
                return $this->redirect($this->generateUrl('diet_user_setting'));
            }
        }
        $forms = array();
        $formViews = array();
        $users = $em->getRepository('DietCoreBundle:User')->findBy(array(
                'weight' => $id
        ));

        if ($users) {
            foreach ($users as $user) {
                $forms[$user->getId()] = $this->createForm(new UserType($user->getId()), $user);
                $formViews[$user->getId()] = $forms[$user->getId()]->createView();
            }
        }
        if ($request->getMethod() === 'POST') {
            foreach ($forms as $user_form) {
                $user_form->handleRequest($request);
                if ($user_form->isValid()) {
                    return $this->redirect($this->generateUrl('diet_user_home'));
                }
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', '変更を適用しました');

            return $this->redirect($this->generateUrl('diet_user_setting'));
        }

        return $this->render('DietUserBundle:User:setting.html.twig', array(
                'form' => $form->createView(),
                'users' => $users,
                'formViews' => $formViews,
        ));
    }

    public function deleteAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        /* @var $em EntityManager */
        
        $user = $em->getRepository('DietCoreBundle:User')->find($request->get('id'));

        // Form
        $form = $this->createForm(new ConfirmType());

        // Processing
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->remove($user);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'userを削除しました');

                return $this->redirect($this->generateUrl('diet_user_setting'));
            }
        }
        return $this->render('DietUserBundle:User:delete.html.twig', array(
                'form' => $form->createView(),
                'user' => $user,
        ));

    }

}
