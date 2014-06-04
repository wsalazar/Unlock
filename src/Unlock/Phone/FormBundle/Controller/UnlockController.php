<?php

namespace Unlock\Phone\FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unlock\Phone\FormBundle\Entity\Unlock;
use Unlock\Phone\FormBundle\Form\UnlockType;

class UnlockController extends Controller
{
    public function unlockAction()
    {
        $unlock = new Unlock();
        $form = $this->createForm(new UnlockType(), $unlock);
        $request = $this->getRequest();
        if( $request->getMethod() == 'POST'){
            $form->bind($request);
            $paypal = $this->get('paypal');
            $accessToken = $paypal->
                                    getApiContext()->
                                    getCredential()->
                                    getAccessToken($paypal->
                                                            getApiContext()->
                                                            getConfig()
                                                   );

        }
        return $this->render('UnlockPhoneFormBundle:Unlock:unlock.html.twig', array(
            //'name' => $name,
            'form' => $form->createView()
        ));
    }
}
