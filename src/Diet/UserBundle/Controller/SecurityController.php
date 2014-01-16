<?php

namespace Diet\UserBundle\Controller;
use Diet\CoreBundle\Form\PasswordType;

use Diet\CoreBundle\Form\WeightMachineType;

use Diet\CoreBundle\Entity\WeightMachine;

use Diet\CoreBundle\Form\WeightType;

use Diet\CoreBundle\Entity\Weight;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction()
    {
        /*
         * regist
         */
        $newmachine = new WeightMachine();
        $newweight = new Weight();

        $forms = array();
        $forms['machine'] = $this->createForm(new WeightMachineType(), $newmachine);
        $forms['weight'] = $this->createForm(new WeightType(), $newweight);
        /*
         * login
         */
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        $formViews = array();
        $formViews['machine'] = $forms['machine']->createView();
        $formViews['weight'] = $forms['weight']->createView();

        return $this->render('DietUserBundle:Security:login.html.twig', array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error,
                'formViews' => $formViews,
        ));
    }

    public function registAction(Request $request)
    {
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

            $em = $this->get('doctrine')->getManager();
            /* @var $em EntityManager */

            $machine_repository = $em->getRepository('DietCoreBundle:WeightMachine');
            $machine = $machine_repository->findOneBy(array(
                    'machineid' => $newmachine->getMachineid(),
            ));
            /*
             * @var $machine Diet\CoreBundle\Entity\Weightmachine
             */
            if (is_null($machine)) {
                $this->get('session')->getFlashBag()->add('success', '体重計IDが誤っています。');
                return $this->redirect($this->generateUrl('diet_user_login'));
            }

            $machineid = $machine->getId();
            $weight_repository = $em->getRepository('DietCoreBundle:Weight');
            $weight = $weight_repository->findOneBy(array(
                    'weightmachine' => $machineid,
            ));

            if ($weight) {
                $this->get('session')->getFlashBag()->add('success', 'その体重計には既にuserが登録されています。');
                return $this->redirect($this->generateUrl('diet_user_login'));
            }

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($newweight);
            $password = $encoder->encodePassword($newweight->getPassword(), $newweight->getSalt());
            $newweight->setPassword($password);
            $newweight->setWeightmachine($machine);
            $machine->setWeightuser($newweight);
            $em->persist($newweight);
            $em->flush();
            return $this->render('DietUserBundle:Security:register_success.html.twig');
        }
        return $this->redirect($this->generateUrl('diet_user_login'));
    }
}
