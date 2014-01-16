<?php

namespace Diet\AdminBundle\Controller;
use Diet\CoreBundle\Entity\WeightMachine;

use Diet\CoreBundle\Form\WeightMachineType;

use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WeightMachineController extends Controller
{
    public function weightMachineAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        /* @var $em EntityManager */

        $weightmachine = new WeightMachine();

        $form = $this->createForm(new WeightMachineType(), $weightmachine);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($weightmachine);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', '新しい体重計を登録しました。');
                return $this->redirect($this->generateUrl('diet_admin_weightMachine'));
            }
        }

        return $this->render('DietAdminBundle:Weight:register.html.twig', array(
                'form' => $form->createView()
        ));
    }

}
