<?php

namespace App\Controller;

use App\Form\Type\InscriptionType;
use App\Form\Type\LoginType;
use App\Entity\Inscription;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/formulaire")
 * Class FormulaireController
 * @package App\Controller
 */
class FormulaireController extends AbstractController
{
    /**
     * @Route("/inscription", name="formulaire_inscription") 
     * 
     * @param Request $request
     * @return Response
     */
    public function inscription(Request $request)
    {

        $dataEntity = new Inscription();
        
        $form = $this->createForm(InscriptionType::class, $dataEntity);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $dataEntity = $form->getData();
            return $this->render('acces_login.html.twig');
        }else{
            $infoRendu = $form->createView();
            return $this->render('formulaire.html.twig', ["infoForm" => $infoRendu]);
        }
    }

    /**
     * @Route("/login", name="formulaire_login") 
     * 
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {        

        $data = new Inscription();

        $form = $this->createForm(LoginType::class, $data);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && $data->getEmail() == "toto@gmail.com" && $data->getMotDePasse() == "toto0202"){
            return $this->forward('App\Controller\FormulaireController::bravo');
        }else{
            $loginRendu = $form->createView();
            return $this->render('login.html.twig', ["loginForm" => $loginRendu]);
        }
    }

    /**
     * @Route("/bravo", name="formulaire_bravo") 
     * @param TranslatorInterface $translator
     * 
     * @return Response
     */
    public function bravo(TranslatorInterface $translator)
    {
        return new Response($translator->trans("bravo tu es connecter"));
    }

}