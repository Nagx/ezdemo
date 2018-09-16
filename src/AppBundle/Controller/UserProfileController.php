<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MailContact;
use AppBundle\Form\Type\MailContactType;
use eZ\Publish\Core\MVC\Symfony\Security\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserProfileController
 * @package AppBundle\Controller
 */
class UserProfileController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userProfileAction()
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('themes/tastefulplanet/user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        // Get user informations for the formType
        /** @var User $user */
        $user = $this->getUser();
        $userId = $user->getAPIUser()->getUserId();
        $userEmail = $user->getAPIUser()->email;
        $username = $user->getAPIUser()->contentInfo->name;

        // Create an object for the formType
        /** @var MailContact $contact */
        $contact = new MailContact();
        $contact->setEmail($userEmail);
        $contact->setName($username);

        // Create the formType
        /** @var Form $contactForm */
        $contactForm = $this->createForm(MailContactType::class, $contact);
        $contactForm->handleRequest($request);

        // FormType submittion and validation
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $flashMessage = $this->get('session');

            try {
                // Save message in database
                $message = $request->request->get('mail_contact')['message'];
                $contact->setMessage($message);
                $contact->setUserId($userId); // user Id is not set. TODO find the bug
                $entityManager->persist($contact);
                $entityManager->flush();

                // Send mail
                $mailParameter = $this->getParameter('mailer_user');

                $title = 'You have a new message from ' . $username . ' : ';
                $mailer = $this->get('swiftmailer.mailer');
                $mail = (new \Swift_Message($title, $message))
                    ->setFrom($mailParameter)
                    ->setTo($mailParameter)
                    ->setBody($this->render('/themes/tastefulplanet/mail/contact.html.twig', [
                        'contact' => $contact,
                    ]),
                        'text/html'
                    );
                $mailer->send($mail);

                $flashMessage->getFlashBag()->add('success', 'Send mail : Success');

            } catch (\Exception $exception) {
                $flashMessage->getFlashBag()->add(
                    'error',
                    'Error : ' . $exception->getMessage()
                );
            }
        }

        return $this->render('themes/tastefulplanet/user/contact.html.twig', [
            'contact_form' => $contactForm->createView(),
        ]);
    }
}
