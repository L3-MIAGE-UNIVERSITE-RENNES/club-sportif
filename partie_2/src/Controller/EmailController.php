<?php

namespace App\Controller;

use App\Entity\MailEducateur;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use App\Repository\EducateurRepository;
use App\Repository\LicencieRepository;
use App\Repository\MailEducateurRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    #[Route(path: '/mail', name: 'app_mail')]
    public function DisplayEmail(Request $request): Response
    {
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
                return $this->redirectToRoute('app_mail_educateur');
            } else {
                $licencie = $this->licencieRepository->findBy(["categorie" => $categorie->getId()]);
                return $this->render('list.html.twig', ["licencie" => $licencie, "categorie" => $categorie]);
            }
        }

        return $this->render('email.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/mails/educateur', name: 'app_mail_educateur')]
    public function educateurEmails(Request $request): Response
    {   // TODO; Get id from auth user after having implemented authentification
        $mails = $this->mailEducateurRepository->getByEducateurId(21);
        return $this->render('mail/educateur/list.html.twig', ["mails" => $mails]);
    }


    #[Route(path: '/mail/send', name: 'app_send_mail_educateur')]
    public function sendMailEducateur(Request $request): Response {
        $educateurs = $this->educateurRepository->findAll();
        $form = $this->createFormBuilder()->add('objet', TextType::class, [
                'label' => 'Objet: ',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Objet...',
                ]])->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Message: ',
                'attr' => [
                    'placeholder' => 'Entrer votre message ici..',
                ]])->add('destinataires', ChoiceType::class, [
                'label' => 'Destinataire: ',
                'choices' => $educateurs,
                'choice_label' => 'email',
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => false,
            ])->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mail  = new MailEducateur();
            $mail->setObjet($data['objet']);
            $mail->setMessage($data['message']);
            $now = new DateTime();
            $mail->setDateEnvoi($now);

            // TODO; Complete this after auth
            $expediteur = $this->educateurRepository->findOneBy(['id'=> 21]);
            $mail->setExpediteur($expediteur);

            foreach ($data['destinataires'] as $value) {
                $mail->addDestinataire($value);
            }
            $this->mailEducateurRepository->send($mail);
            return $this->redirectToRoute('app_mail_educateur');
        }

        return $this->render('mail/educateur/send.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route(path: '/mail/view', name: 'app_view_mail_educateur')]
    public function viewMailEducateur(Request $request): Response {
        $id = $request->query->get('id');
        $mail = $this->mailEducateurRepository->findOneBy(["id" => $id]);
        return $this->render('mail/educateur/view.html.twig', [
            'mail' => $mail
        ]);
    }

    #[Route(path: '/mail/delete', name: 'app_delete_mail_educateur')]
    public function deleteMailEducateur(Request $request): Response {
        $id = $request->query->get('id');
        $this->mailEducateurRepository->deleteById($id);
        return $this->redirectToRoute('app_mail_educateur');
    }
}


