<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/classroom/list", name="list_classroom")
     */
    public function getAllClasses(): Response
    {
        $repo = $this->getDoctrine()
            ->getRepository(Classroom::class);
        $liste=$repo->findAll();
        return $this->render('classroom/list.html.twig', [
            'list' => $liste,
        ]);
    }

    /**
     * @Route("/classroom/get/{id}", name="get_classroom")
     */
    public function getClasse($id, ClassroomRepository $repo): Response
    {
        //$repo = $this->getDoctrine()->getRepository(Classroom::class);
        $classe=$repo->find($id);
        return $this->render('classroom/classroom.html.twig', [
            'myClass' => $classe,
        ]);
    }

    /**
     * @Route("/classroom/add", name="add_classroom")
     */
    public function addClassroom(Request $req): Response
    {
        $c=new Classroom();
        $form=$this->createForm(ClassroomType::class,$c);
        $form->add('Add', SubmitType::class);
        /*$c->setNom('3A25');
        $c->setNom1('3A25');
        $c->setNom2('3A25');*/
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            return $this->redirectToRoute("list_classroom");
        }
            return $this->render('classroom/add.html.twig', [
            'myForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/classroom/update/{id}", name="update_classroom")
     */
    public function updateClassroom($id,Request $req): Response
    {
        $repo=$this->getDoctrine()->getRepository(Classroom::class);
        $c=$repo->find($id);
        $form=$this->createForm(ClassroomType::class,$c);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("list_classroom");
        }
        return $this->render('classroom/add.html.twig', [
            'myForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/classroom/delete/{id}", name="delete_classroom")
     */
    public function deleteClassroom($id): Response
    {    $repo=$this->getDoctrine()->getRepository(Classroom::class);
        $c=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($c);
        $em->flush();
        return $this->redirectToRoute("list_classroom");

    }

    /**
     * @Route("/classroom/newadd", name="newadd_classroom")
     */
    public function addNewClassroom(Request $req): Response
    {
        if ($req->get('ajouter')) { //test sur submit
            $c=new Classroom();
            $c->setNom($req->get('name')); //remplissage
            $c->setNom1($req->get('name'));
            $c->setNom2($req->get('name'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
            return $this->redirectToRoute("list_classroom");
        }
        return $this->render('classroom/ajout.html.twig');
    }

    /**
     * @Route("/classroom/new2add", name="new2add_classroom")
     */
    public function add2NewClassroom(Request $req): Response
    {
       // if ($req->get('ajouter')) { //test sur submit
            $c=new Classroom();
            $c->setNom($req->get('name')); //remplissage
            $c->setNom1($req->get('name'));
            $c->setNom2($req->get('name'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
          //  return $this->redirectToRoute("list_classroom");

    }
}
