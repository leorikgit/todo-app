<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="todolist.index")
     */
    public function index()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();

        return $this->render('ToDoList/index.html.twig', ['tasks' => $tasks]);
    }
    /**
     * @Route("/task/create", name="todolist.create")
     */
    public function create()
    {
        return $this->render('ToDoList/create.html.twig');
    }
    /**
     * @Route("/task", name="todolist.store", methods={"POST"})
     */
    public function store(Request $request, ValidatorInterface $validator)
    {
        $doctrineManager = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setTitle($request->request->get('title'));
        $task->setDescription($request->request->get('description'));

        $errors = $validator->validate($task);
        if (count($errors) > 0) {
           return $this->redirectToRoute('todolist.create');
        }

        $doctrineManager->persist($task);
        $doctrineManager->flush();

        return $this->redirectToRoute('todolist.index');
    }
    /**
     * @Route("/change-status/{id}", name="todolist.updateStatus", methods={"GET"})
     */
    public function updateStatus(Request $request, Task $task)
    {

        $doctrineManager = $this->getDoctrine()->getManager();

        $task->setStatus(! $task->getStatus());
        $doctrineManager->persist($task);
        $doctrineManager->flush();

        return $this->redirectToRoute('todolist.index');
    }
    /**
     * @Route("/task/delete/{id}", name="todolist.delete", methods={"GET"})
     */
    public function delete(Request $request, Task $task)
    {

        $doctrineManager = $this->getDoctrine()->getManager();
        $doctrineManager->remove($task);
        $doctrineManager->flush();

        return $this->redirectToRoute('todolist.index');
    }
}
