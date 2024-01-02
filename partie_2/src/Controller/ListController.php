<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{

    private $categorieRepository;

    public function __construct(CategorieRepository $categorieRepository)
    {
        $this->categorieRepository= $categorieRepository;
    }

    /**
     * @Route("/votre-route", name="votre_route")
     */
    #[Route(path: '/list', name: 'app_list')]
    public function ListerParCategory(Request $request): Response
    {
        $categories = $this->categorieRepository->findAll();
        $form = $this->createFormBuilder()
            ->add('liste', ChoiceType::class, [
                'choices' => [
                    'Licencié' => 'licencie',
                    'Contacts' => 'contacts',
                ],
                'multiple' => false,
                'expanded' => false,
            ]) ->add('categorie', ChoiceType::class, [
                'choices' => $categories,
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'multiple' => false,
                'expanded' => false,
            ]) ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $list = $data['liste'];

            if($list == 'categorie') {
                // do something
                return $this->redirectToRoute('app_list_licencie'); // Redirigez après traitement
            } else {
                // do something
                return $this->redirectToRoute('app_list_licencie');
            }
        }

        return $this->render('list.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/votre-route", name="votre_route")
     */
    #[Route(path: '/list/licencie', name: 'app_list_licencie')]
    public function licencie(): Response {
        return $this->render('licencie.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}


