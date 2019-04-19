<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\TaskFolder;
use App\Entity\Task;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;

class TaskManagerController extends AbstractController
{

    private $user;
    private $entityManager;

    public function __construct(TokenStorageInterface $tokenStorage,EntityManagerInterface $entityManager)
    {
        $this->user = $tokenStorage->getToken()->getUser();
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/task-manager", name="task_manager")
     */
    public function index()
    {
        $main_folders = $this->entityManager->getRepository(TaskFolder::class)->getTaskFolders($this->user);

        return $this->render('task_manager/main_folders_list.html.twig', [
            'main_folders' => $main_folders,
        ]);
    }


    /**
     * @Route("/task-manager/folder/{folder}", name="task_folder")
     */
    public function folder(TaskFolder $folder)
    {
        return $this->render('task_manager/folder.html.twig', [
            'folder' => $folder,
            'tasks' => $folder->getTasks(),
            'parentfolder' => $folder->getFolder()
        ]);
    }

    /**
     * @Route("/task-manager/subfolders/{folder}", name="task_folder_subfolders")
     */
    public function subfolders(TaskFolder $folder)
    {
        $taskFolderRepo = $this->entityManager->getRepository(TaskFolder::class);

        return $this->render('task_manager/subfolders.html.twig', [
            'folder' => $folder,
            'parentfolder' => $folder->getFolder(),
            'subfolders' => $taskFolderRepo->getTaskFolders($this->user,$folder->getId())
        ]);
    }
}
