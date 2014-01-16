<?php

namespace Diet\UserBundle\Controller;
use Diet\CoreBundle\Form\WeightMachineType;

use Diet\CoreBundle\Entity\WeightMachine;

use Diet\CoreBundle\Form\WeightType;

use Diet\CoreBundle\Entity\Weight;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class WeightController extends Controller
{

    public function registAction(Request $request)
    {
        return $this->redirect('http://google.com');

        /*
         * regist
         */
        $newmachine = new WeightMachine();
        $newweight = new Weight();

        $forms = array();
        $forms['machine'] = $this->createForm(new WeightMachineType(), $newmachine);
        $forms['weight'] = $this->createForm(new WeightType(), $newweight);

        if ($request->getMethod() === 'POST') {
            foreach ($forms as $form) {
                $form->handleRequest($request);
            }
            /*            $forms['machine']->handleRequest($request);
                        $forms['weight']->handleRequest($request);*/
            $em = $this->get('doctrine')->getManager();
            /* @var $em EntityManager */

            if ($forms['machine']->isValid() && $forms['weight']->isValid()) {
                return $this->redirect($this->generateUrl('blog_admin_index'));

                $machine_repository = $em->getRepository('DietCoreBundle:WeightMachine');
                $machine = $machine_repository->findOneByMachine($newmachine->getMachineid());
                if (!$machine) {
                    $this->get('session')->getFlashBag()->add('success', '体重計IDが誤っています。');
                    $this->redirect($this->generateUrl('diet_user_login'));
                }
                $weight_repository = $em->getRepository('DietCoreBundle:Weight');
                $weight = $weight_repository->findOneByWeightmachine($machine->getId());

                if ($weight) {
                    $this->get('session')->getFlashBag()->add('success', 'その体重計には既にuserが登録されています。');
                    $this->redirect($this->generateUrl('diet_user_login'));
                }

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($newweight);
                $password = $encoder->encodePassword($newweight->getPassword(), $newweight->getSalt());
                $newweight->setPassword($password);
                $newweight->setWeightmachine($machine->getId());
                $machine->setWeightuser($newweight->getId());
                $em->persist($newweight);
                $em->flush();
                return $this->render('DietUserBundle:Security:register_success.html.twig');
            }
            $this->redirect($this->generateUrl('diet_admin_login'));
        }
        return $this->render('DietUserBundle:Security:register.html.twig');
    }
}
