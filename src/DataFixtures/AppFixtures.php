<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\TaskFolder;
use App\Entity\Task;
use DateTime;
use DateTimeZone;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Pablo');
        $user->setMiddleName('Calebe Cordeiro');
        $user->setLastName('Camara');
        $user->setEmail('pablo@camara.pt');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCreatedAt(new DateTime('now'));
        $user->setPassword($this->passwordEncoder->encodePassword($user,'1234'));

        $taskFolder = new TaskFolder();
        $taskFolder->setName('Gestor de Utilizadores');
        $taskFolder->setDescription('Esta pasta contem tarefas relacionadas com o Gestor de Utilizadores');
        $taskFolder->setCreatedAt(new DateTime('now'));
        $taskFolder->setCreatedBy($user);

        $task = new Task();
        $task->setName('Listar todos os utilizadores');
        $task->setDescription('Mostrar lista de utilizadores e sua informação basica (para já: Nome e Email )');
        $task->setCreatedAt(new DateTime('now'));
        $task->setFolder($taskFolder);


        $task2 = new Task();
        $task2->setName('Mostrar informação completa do utilizador');
        $task2->setDescription('Ao clicar num utilizador, abrir pagina com a informação completa do utilizador');
        $task2->setCreatedAt(new DateTime('now'));
        $task2->setFolder($taskFolder);

        $user->addTask($task);
        $user->addTask($task2);

        $manager->persist($user);
        $manager->persist($taskFolder);
        $manager->persist($task);
        $manager->persist($task2);
        $manager->flush();
    }
}
