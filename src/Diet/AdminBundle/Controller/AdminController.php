<?php

namespace Diet\AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use Diet\CoreBundle\Entity\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Diet\CoreBundle\Form\AdminType;

use JMS\SecurityExtraBundle\Annotation\Secure;

class AdminController extends Controller
{
    /*    public function indexAction($name)
        {
            return $this->render('DietAdminBundle:Default:index.html.twig', array('name' => $name));
        }
     */
    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @param Request $request
     */
    public function registerAction(Request $request)
    {

        $newadmin = new Admin();
        $form = $this->createForm(new AdminType(), $newadmin);
        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine')->getManager();
                /* @var $em EntityManager */
                //don't forget encoding
                $factory = $this->get('security.encoder_factory');

                $encoder = $factory->getEncoder($newadmin);
                $password = $encoder->encodePassword($newadmin->getPassword(), $newadmin->getSalt());
                $newadmin->setPassword($password);
                $em->persist($newadmin);
                $em->flush();
                return $this->render('DietAdminBundle:Admin:register_success.html.twig');
            }
        }
        return $this->render('DietAdminBundle:Admin:register.html.twig', array(
                'form' => $form->createView()
        ));
    }

}
