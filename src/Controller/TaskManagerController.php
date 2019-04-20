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
     * Shows the User's main task Folders
     * @Route({
     *     "pt": "/gestor-de-tarefas/pastas",
     *     "en": "/task-manager/folders"
     * }, name="task-manager-folders")
     */
    public function folders()
    {
        $main_folders = $this->entityManager->getRepository(TaskFolder::class)->getTaskFolders($this->user);

        return $this->render('task_manager/folders.html.twig', [
            'main_folders' => $main_folders,
        ]);
    }

    /**
     * Shows all Subfolders from a Folder
     * @Route({
     *     "pt": "/gestor-de-tarefas/pasta/{folder}/subpastas",
     *     "en": "/task-manager/folder/{folder}/subfolders"
     * }, name="task-manager-folder-subfolders")
     */
    public function folder_subfolders(TaskFolder $folder)
    {
        $taskFolderRepo = $this->entityManager->getRepository(TaskFolder::class);

        return $this->render('task_manager/folder/subfolders.html.twig', [
            'view' => 'folder_subfolders',
            'folder' => $folder,
            'parentfolder' => $folder->getFolder(),
            'subfolders' => $taskFolderRepo->getTaskFolders($this->user,$folder->getId())
        ]);
    }


    /**
     * Shows all Tasks from a Folder
     * @Route({
     *     "pt": "/gestor-de-tarefas/pasta/{folder}/tarefas",
     *     "en": "/task-manager/folder/{folder}/tasks"
     * }, name="task-manager-folder-tasks")
     */
    public function folder_tasks(TaskFolder $folder)
    {

        return $this->render('task_manager/folder/tasks.html.twig', [
            'view' => 'folder_tasks',
            'folder' => $folder,
            'tasks' => $folder->getTasks(),
            'parentfolder' => $folder->getFolder()
        ]);
    }


}
