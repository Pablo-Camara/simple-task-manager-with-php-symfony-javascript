<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;
use App\Entity\User;

class UserController extends AbstractController
{

    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * List users
     * @Route({
     *     "pt": "/gestor-de-utilizadores",
     *     "en": "/user-manager"
     * }, name="user-manager")
     */
    public function index()
    {

        $users = $this->entityManager->getRepository(User::class)->findAll();

        return $this->render('user/users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Add user
     * @Route({
     *     "pt": "/gestor-de-utilizadores/add",
     *     "en": "/user-manager/add"
     * }, name="user-manager-add")
     */
    public function add(ObjectManager $manager)
    {
      $request = Request::createFromGlobals();
      $csrf_token = $request->request->get('csrf_token');

      if(!$this->isCsrfTokenValid('user-manager-add',$csrf_token)){
        return new JsonResponse([
          'status' => 0,
          'message' => 'Invalid Csrf token'
        ]);
      }

      $full_name = $request->request->get('full_name');
      $email = $request->request->get('email');
      $password = $request->request->get('password');


      $roles = [];
      if($request->request->get('is_admin',false)){
        $roles[] = 'ROLE_ADMIN';
      };

      if($request->request->get('is_user_manager',false)){
        $roles[] = 'ROLE_USER_MANAGER';
      };

      if($request->request->get('is_task_manager',false)){
        $roles[] = 'ROLE_TASK_MANAGER';
      };


      $user = new User();
      $user->setFullName($full_name);
      $user->setEmail($email);
      $user->setPassword($this->passwordEncoder->encodePassword($user,$password));
      $user->setRoles($roles);
      $user->setCreatedAt(new DateTime('now'));

      $manager->persist($user);
      $manager->flush();

      $new_user_added = $user->getId() ? 1 : 0;
      return new JsonResponse([
        'status' => $new_user_added,
        'message' => $new_user_added ? $user->getId() : 'Could not add the User'
      ]);

    }

}
