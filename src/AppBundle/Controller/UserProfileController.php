<?php

namespace AppBundle\Controller;

use eZ\Publish\Core\MVC\Symfony\Security\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserProfileController
 * @package AppBundle\Controller
 */
class UserProfileController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function UserProfileAction()
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('themes/tastefulplanet/user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
