<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 */
class Classroom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom1;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom2;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="classroom_id")
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNom1()
    {
        return $this->nom1;
    }

    /**
     * @param mixed $nom1
     */
    public function setNom1($nom1): void
    {
        $this->nom1 = $nom1;
    }

    /**
     * @return mixed
     */
    public function getNom2()
    {
        return $this->nom2;
    }

    /**
     * @param mixed $nom2
     */
    public function setNom2($nom2): void
    {
        $this->nom2 = $nom2;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setClassroomId($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getClassroomId() === $this) {
                $student->setClassroomId(null);
            }
        }

        return $this;
    }
}
