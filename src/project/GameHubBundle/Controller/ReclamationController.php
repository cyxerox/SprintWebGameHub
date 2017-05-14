<?php

namespace project\GameHubBundle\Controller;

use project\GameHubBundle\Entity\Reclamation;
use project\GameHubBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($this->getUser()->getRoles()[0] == "ROLE_USER") {
            return $this->redirectToRoute("project_game_hub_FO");

        }
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findAll();
        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();
        foreach ($membre as $m) {
            $i = 0;
            foreach ($Reclamation as $r) {
                if ($m->getUsername() == $r->getPseudo()) {
                    $i++;
                }
            }
            $nb[$m->getId()] = $i;
        }

        return $this->render('projectGameHubBundle:Reclamation:index.html.twig', array(
            'Reclamation' => $Reclamation,
            'membre' => $membre,
            'nb' => $nb,
        ));
    }

    public function showAction($pseudo)
    {


        if ($this->getUser()->getRoles()[0] == "ROLE_USER") {
            return $this->redirectToRoute("project_game_hub_FO");

        }
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findBy(array('pseudo' => $pseudo));


        return $this->render('projectGameHubBundle:Reclamation:show.html.twig', array(
            'Reclamation' => $Reclamation,
        ));
    }

    public function deleteAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findOneBy(array('pseudo' => $id));
        $em->remove($Reclamation);
        $em->flush();


        return $this->redirectToRoute("project_game_hub_reclamation");
    }


    public function ajoutAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findAll();

        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();

        $rec = new Reclamation();
        $Form = $this->createForm(ReclamationType::class, $rec);
        $Form->handleRequest($request);
        if ($Form->isValid()) {

            /** @var UploadedFile $url */
            $url = $rec->getUrl();
            $urlName = md5(uniqid()).'.'.$url->guessExtension();
            $url->move(
                $this->getParameter('affiches_directory'),
                $urlName
            );
            $rec->setUrl($urlName);
            $rec->setPseudo($_POST['pseudoajout']);
            $rec->setIdM($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('project_game_hub_reclamation');
        }

        return $this->render('projectGameHubBundle:Reclamation:index.html.twig', array(
            'form' => $Form->createView(),
            'membre' => $membre,
            'Reclamation' => $Reclamation

        ));
    }

    public function modifierAction($pseudo, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository("projectGameHubBundle:Reclamation")->findOneBy(array('pseudo' => $pseudo));
        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();
        $Form = $this->createForm(ReclamationType::class, $rec);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            /** @var UploadedFile $url */
            $url = $rec->getUrl();
            $urlName = md5(uniqid()).'.'.$url->guessExtension();
            $url->move(
                $this->getParameter('affiches_directory'),
                $urlName
            );
            $rec->setUrl($urlName);

            $rec->setPseudo($_POST['pseudo']);

            $em->flush();
            return $this->redirectToRoute('project_game_hub_reclamation');
        }
        return $this->render('projectGameHubBundle:Reclamation:modifier.html.twig', array(
            'formModif' => $Form->createView(),
            'entity' => $rec,
            'membre' => $membre,
        ));
    }

    public function RechercheAction(Request $request)
    {
        $request->get('recherche');


        if ($this->getUser()->getRoles()[0] == "ROLE_USER") {
            return $this->redirectToRoute("project_game_hub_FO");

        }

        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findAll();
        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();

        foreach ($membre as $m) {
            $i = 0;
            foreach ($Reclamation as $r) {
                if ($m->getUsername() == $r->getPseudo()) {
                    $i++;
                }
            }
            $nb[$m->getId()] = $i;

            if ($i >= $request->get('recherche')) {
                $nbM[] = [$i, $m->getUsername(), $m->getId(), $m->isEnabled()];


            }
        }

        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findAll();
        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();


        return $this->render('projectGameHubBundle:Reclamation:Recherche.html.twig', array(
            'Reclamation' => $Reclamation,
            'membre' => $membre,
            'nbM' => $nbM,
        ));
    }


    public function index2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findBy(array('idM'=> $this->getUser()));
        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();
        $rec = new Reclamation();
        $Form = $this->createForm(ReclamationType::class, $rec);
        $Form->handleRequest($request);


        return $this->render('projectGameHubBundle:Reclamation:index_front.html.twig', array(
            'Reclamation' => $Reclamation,
            'membre' => $membre,
            'form' => $Form->createView(),

        ));
    }


    public function ajout2Action(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findAll();

        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();

        $rec = new Reclamation();
        $Form = $this->createForm(ReclamationType::class, $rec);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            /** @var UploadedFile $url */
            $url = $rec->getUrl();
            $urlName = md5(uniqid()).'.'.$url->guessExtension();
            $url->move(
                $this->getParameter('affiches_directory'),
                $urlName
            );
            $rec->setUrl($urlName);
            $rec->setPseudo($_POST['pseudoajout']);
            $rec->setIdM($this->getUser());


            $em = $this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('project_game_hub_FO');
        }

        return $this->render('projectGameHubBundle:Reclamation:Ajout_front.html.twig', array(
            'form' => $Form->createView(),
            'membre' => $membre,
            'Reclamation' => $Reclamation

        ));
    }


    public function delete2Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository("projectGameHubBundle:Reclamation")->findOneBy(array('pseudo' => $id));
        $em->remove($Reclamation);
        $em->flush();


        return $this->redirectToRoute("project_game_hub_FO");
    }

    public function modifier2Action($pseudo, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository("projectGameHubBundle:Reclamation")->findOneBy(array('pseudo' => $pseudo));
        $rec->setUrl(null);
        $membre = $em->getRepository("projectGameHubBundle:Membre")->findAll();
        $Form = $this->createForm(ReclamationType::class, $rec);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            /** @var UploadedFile $url */
            $url = $rec->getUrl();
            $urlName = md5(uniqid()).'.'.$url->guessExtension();
            $url->move(
                $this->getParameter('affiches_directory'),
                $urlName
            );
            $rec->setUrl($urlName);

            $rec->setPseudo($_POST['pseudo']);

            $em->flush();
            return $this->redirectToRoute('project_game_hub_FO');
        }
        return $this->render('projectGameHubBundle:Reclamation:modifier_front.html.twig', array(
            'formModif' => $Form->createView(),
            'entity' => $rec,
            'membre' => $membre,
        ));
    }
}
