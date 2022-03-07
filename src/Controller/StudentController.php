<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/list", name="student_list")
     */
    public function getListStudents(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);
        $sts=$rep->findAll();
        return $this->render('student/index.html.twig', [
            'listSt' => $sts,
        ]);
    }

    /**
     * @Route("/student/add", name="add_student")
     */
    public function addStudent(Request $req): Response
    {   $st = new Student();
        $f=$this->createForm(StudentType::class,$st);
        $f->handleRequest($req);
        if ($f->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($st);
            $em->flush();
           // return $this->redirectToRoute("list_clas
        }
        return $this->render('student/add.html.twig', [
            'studentForm' => $f->createView(),
        ]);
    }
}
