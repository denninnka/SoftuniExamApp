<?php
/**
 * Created by PhpStorm.
 * User: denninnka
 * Date: 15.06.17
 * Time: 20:39
 */

namespace SoftuniProductsBundle\Services;

use SoftuniProductsBundle\Entity\Product;
use Symfony\Bridge\Twig\TwigEngine;

class MailSender
{

    private $mailer, $templating, $recepients;


    public function __construct(\Swift_Mailer $mailer, TwigEngine $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->recepients = ['recipient1@example.com','recipient2@example.com','recipient3@example.com','recipient4@example.com', 'recipient5@example.com'];
    }

    /**
     * @param array $recepients
     */
    public function setRecepients($recepients)
    {
        $this->recepients = $recepients;
    }



    public function send(Product $product)
    {
        foreach ($this->recepients as $recepient){
            $message = new \Swift_Message('New product have arrived');
            $message->setFrom('send@example.com')
                ->setTo($recepient)
                ->setBody(
                    $this->templating->render(
                    // app/Resources/views/Emails/registration.html.twig
                        '@SoftuniProducts/Email/new_product.html.twig',
                        array('product' => $product)
                    ),
                    'text/html'
                );
            $this->mailer->send($message);
        }

        return true;
    }
}