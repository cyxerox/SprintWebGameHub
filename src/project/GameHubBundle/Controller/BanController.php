<?php

namespace project\GameHubBundle\Controller;

use project\GameHubBundle\Entity\Ban;
use project\GameHubBundle\Entity\Reclamation;
use project\GameHubBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BanController extends Controller
{
    public function banAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $m=$em->getRepository("projectGameHubBundle:Membre")->find($id);

        $membre=$em->getRepository("projectGameHubBundle:Membre")->findAll();
        $em=$this->getDoctrine()->getManager();
        $ban =new Ban();


            $d = new \DateTime('now');
            $ban->setIdM($m);
            $ban->setDate($d);
            $m->setEnabled(false);

            $em->persist($ban);
            $em->persist($m);
            $em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('GameHub')
            ->setFrom('badr.taamallah@gmail.com')
            ->setTo($m->getEmail())
            ->setBody(
                $this->renderView(
                    '@projectGameHub/Ban/messageBan.html.twig',
                    array('ban' => $ban)
                ),
                'text/html'
            )

        ;
        $this->get('mailer')->send($message);

        return $this->redirectToRoute("project_game_hub_reclamation");
    }

    public function debanAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $m=$em->getRepository("projectGameHubBundle:Membre")->find($id);

        $ban=$em->getRepository("projectGameHubBundle:Ban")->find($id);

        $membre=$em->getRepository("projectGameHubBundle:Membre")->findAll();
        $em=$this->getDoctrine()->getManager();

        $m->setEnabled(true);

        $em->remove($ban);
        $em->persist($m);
        $em->flush();


        $message = \Swift_Message::newInstance()
            ->setSubject('GameHub')
            ->setFrom('badr.taamallah@gmail.com')
            ->setTo($m->getEmail())
            ->setBody(
                $this->renderView(
                    '@FOSUser/Ban/messageUnban.html.twig',
                    array('ban' => $ban)
                ),
                'text/html'
            )

        ;
        $this->get('mailer')->send($message);



        return $this->redirectToRoute("project_game_hub_reclamation");
    }

}
