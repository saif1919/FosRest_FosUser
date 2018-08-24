<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Get(
     *     path = "/user/{id}",
     *     name = "app_user",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction($id)
    {
        $user= $this->getDoctrine()->getRepository(User::class)->find($id);
        return $user;
    }

    /**
     * @Post(
     *     path = "/user/register",
     *     name = "app_user_register",
     *
     * )
     *  @ParamConverter("user", converter="fos_rest.request_body")
     * @View
     */
    public function RegisterAction( User $user)
    {
        $userManager = $this->get('fos_user.user_manager');
//        $entityManager= $this->getDoctrine()->getManager();

//        var_dump($user->getEmail()); die;

        $fosuser = $userManager->createUser();
        $fosuser->setEmail($user->getEmail());
        $fosuser->setUsername($user->getUsername());
        $fosuser->setPassword($user->getPassword());
        $userManager->updateUser($fosuser);
//        dump($user); die;
        return $userManager;
    }

}