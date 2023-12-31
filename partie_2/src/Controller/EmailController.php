<?php

namespace App\Controller;

use App\Entity\MailContact;
use App\Entity\MailEducateur;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use App\Repository\EducateurRepository;
use App\Repository\LicencieRepository;
use App\Repository\MailContactRepository;
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
    private MailContactRepository $mailContactRepository;

    public function __construct(CategorieRepository $categorieRepository,
                                LicencieRepository $licencieRepository,
                                ContactRepository $contactRepository,
                                MailEducateurRepository $mailEducateurRepository,
                                MailContactRepository $mailContactRepository,
                                EducateurRepository $educateurRepository,
    )
    {
        $this->categorieRepository = $categorieRepository;
        $this->licencieRepository = $licencieRepository;
        $this->contactRepository = $contactRepository;
        $this->mailEducateurRepository = $mailEducateurRepository;
        $this->mailContactRepository = $mailContactRepository;
        $this->educateurRepository = $educateurRepository;
    }

    #[Route(path: '/mail', name: 'app_mail')]
    public function DisplayEmail(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('liste', ChoiceType::class, [
                'label' => 'Mails',
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
                return $this->redirectToRoute('app_mail_contact');
            }
        }

        return $this->render('mail/email.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/mails/educateur', name: 'app_mail_educateur')]
    public function educateurEmails(Request $request): Response
    {
        $userId = $this->getUser()->getId();
        $mails = $this->mailEducateurRepository->getByEducateurId($userId);
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

            $userId = $this->getUser()->getId();
            $expediteur = $this->educateurRepository->findOneBy(['id'=> $userId]);
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

    #[Route(path: '/mails/contact', name: 'app_mail_contact')]
    public function contactEmails(Request $request): Response
    {
        $userId = $this->getUser()->getId();
        $mails = $this->mailContactRepository->getByContactId($userId);
        return $this->render('mail/contact/list.html.twig', ["mails" => $mails]);
    }

    #[Route(path: '/mail/contact/send', name: 'app_send_mail_contact')]
    public function sendMailContact(Request $request): Response {
        $categories = $this->categorieRepository->findAll();
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
            'choices' => $categories,
            'choice_label' => 'nom',
            'choice_value' => 'id',
            'multiple' => true,
            'expanded' => false,
        ])->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mail  = new MailContact();
            $mail->setObjet($data['objet']);
            $mail->setMessage($data['message']);
            $now = new DateTime();
            $mail->setDateEnvoi($now);

            $userId = $this->getUser()->getId();
            $expediteur = $this->educateurRepository->findOneBy(['id'=> $userId]);
            $mail->setExpediteur($expediteur);

            foreach ($data['destinataires'] as $categorie) {
                $contacts = $this->contactRepository->getContactsByCategory($categorie->getId());
                foreach ($contacts as $value) {
                    $mail->addDestinataire($value);
                }
            }


            $this->mailContactRepository->send($mail);
            return $this->redirectToRoute('app_mail_contact');
        }

        return $this->render('mail/educateur/send.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route(path: '/mail/contact/delete', name: 'app_delete_mail_contact')]
    public function deleteMailContact(Request $request): Response {
        $id = $request->query->get('id');
        $this->mailContactRepository->deleteById($id);
        return $this->redirectToRoute('app_mail_contact');
    }

    #[Route(path: '/mail/contact/view', name: 'app_view_mail_contact')]
    public function viewMailContact(Request $request): Response {
        $id = $request->query->get('id');
        $mail = $this->mailContactRepository->findOneBy(["id" => $id]);
        return $this->render('mail/contact/view.html.twig', [
            'mail' => $mail
        ]);
    }
}


