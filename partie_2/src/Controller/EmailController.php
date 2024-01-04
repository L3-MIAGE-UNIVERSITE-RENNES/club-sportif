<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\MailContact;
use App\Entity\MailEducateur;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use App\Repository\EducateurRepository;
use App\Repository\LicencieRepository;
use App\Repository\MailEducateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends AbstractController
{

    private CategorieRepository $categorieRepository;
    private LicencieRepository $licencieRepository;
    private ContactRepository $contactRepository;
    private MailEducateurRepository $mailEducateurRepository;
    private EducateurRepository $educateurRepository;

    public function __construct(CategorieRepository $categorieRepository,
                                LicencieRepository $licencieRepository,
                                ContactRepository $contactRepository,
                                MailEducateurRepository $mailEducateurRepository,
                                EducateurRepository $educateurRepository,
    )
    {
        $this->categorieRepository = $categorieRepository;
        $this->licencieRepository = $licencieRepository;
        $this->contactRepository = $contactRepository;
        $this->mailEducateurRepository = $mailEducateurRepository;
        $this->educateurRepository = $educateurRepository;
    }

    #[Route(path: '/email', name: 'app_email')]
    public function DisplayEmail(Request $request): Response
    {
        $categories = $this->categorieRepository->findAll();
        $form = $this->createFormBuilder()
            ->add('liste', ChoiceType::class, [
                'choices' => [
                    'Educateur' => 'educateur',
                    'Contact' => 'contact',
                ],
                'multiple' => false,
                'expanded' => false,
            ])->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $list = $data['liste'];
            if($list == 'educateur') {
                // TODO; Get id from auth user after having implemented authentification
                $mails = $this->mailEducateurRepository->getByEducateurId(21);
                return $this->render('educateur.email.list.html.twig', ["mails" => $mails]);
            } else {
                $licencie = $this->licencieRepository->findBy(["categorie" => $categorie->getId()]);
                return $this->render('contact.email.list.html.twig', ["licencie" => $licencie, "categorie" => $categorie]);
            }
        }

        return $this->render('email.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/list/licencie', name: 'app_list_licencie')]
    public function licencie(Request $request): Response {
        $licencie = $request->query->get('licencie');
        $categorie = $request->query->get('licencie');
        // dd($licencie);
        return $this->render('licencie.html.twig',
            [
                'licencie' => $licencie,
                "categorie" => $categorie,
            ]
        );
    }
}


