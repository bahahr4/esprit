<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProfessorRepository;

class DashController extends AbstractController
{


    #[Route('/dash', name: 'app_dash')]
    public function dashboard(StudentRepository $studentRepository,ProfessorRepository $professorRepository, EntityManagerInterface $entityManager): Response
    {
        // Compter le nombre total d'étudiants
        $totalStudents = $studentRepository->count([]);
        $totalProfessors = $professorRepository->count([]);

        // Compter le nombre d'étudiants masculins et féminins
        $maleStudents = $studentRepository->count(['gender' => 'Male']);
        $femaleStudents = $studentRepository->count(['gender' => 'Female']);

        // Calculer les pourcentages
        $malePercentage = ($totalStudents > 0) ? ($maleStudents / $totalStudents) * 100 : 0;
        $femalePercentage = ($totalStudents > 0) ? ($femaleStudents / $totalStudents) * 100 : 0;

        // Obtenir le nombre de nouveaux étudiants ajoutés chaque jour au cours des 7 derniers jours
        $connection = $entityManager->getConnection();
        $sql = "
            SELECT DATE(datecreation) AS creation_date, COUNT(*) AS student_count
            FROM student
            WHERE datecreation >= :last_week
            GROUP BY creation_date
            ORDER BY creation_date ASC
        ";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('last_week', (new \DateTime('-7 days'))->format('Y-m-d'));
        $result = $stmt->executeQuery(); // Utiliser executeQuery() pour obtenir un objet Result

        // Utiliser fetchAllAssociative() sur l'objet Result pour obtenir les données
        $studentsPerDay = $result->fetchAllAssociative();

        // Préparer un tableau des étudiants créés chaque jour
        $studentsPerDayData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = (new \DateTime('-' . $i . ' days'))->format('Y-m-d');
            $studentsPerDayData[$date] = 0;
        }

        foreach ($studentsPerDay as $data) {
            $date = $data['creation_date'];
            if (isset($studentsPerDayData[$date])) {
                $studentsPerDayData[$date] = (int)$data['student_count'];
            }
        }

        // Convertir le tableau en une chaîne de valeurs pour Sparkline
        $studentsPerDayString = implode(',', $studentsPerDayData);

        // Passer les données à la vue
        return $this->render('dash/index.html.twig', [
            'total_students' => $totalStudents,
            'male_students' => $maleStudents,
            'female_students' => $femaleStudents,
            'male_percentage' => $malePercentage,
            'female_percentage' => $femalePercentage,
            'new_students' => array_sum($studentsPerDayData),  // Ajout du nombre total de nouveaux étudiants
            'students_per_day' => $studentsPerDayString,       // Ajout des étudiants créés par jour
            'total_professors' => $totalProfessors,
        ]);
    }

    #[Route('/user', name: 'app_user')]
    public function user(): Response
    {
        return $this->render('user/user.html.twig');
    }


    #[Route('/listprofessors', name: 'app_list_professors')]
    public function listProfessors(): Response
    {
        return $this->render('dash/listprofessors.html.twig');
    }

    #[Route('/listbourses', name: 'app_list_bourses')]
    public function listBourses(): Response
    {
        return $this->render('dash/listbourses.html.twig');
    }

    #[Route('/listreclamation', name: 'app_list_reclamation')]
    public function listReclamation(): Response
    {
        return $this->render('dash/listreclamation.html.twig');
    }

    #[Route('/listcourses', name: 'app_list_courses')]
    public function listCourses(): Response
    {
        return $this->render('dash/listcourses.html.twig');
    }

    #[Route('/addbourse', name: 'app_add_bourses')]
    public function addBourse(): Response
    {
        return $this->render('dash/addbourse.html.twig');
    }

    #[Route('/editbourse', name: 'app_edit_bourses')]
    public function editBourse(): Response
    {
        return $this->render('dash/editbourse.html.twig');
    }

    #[Route('/allstaff', name: 'app_all_staff')]
    public function allStaff(): Response
    {
        return $this->render('dash/allstaff.html.twig');
    }

    #[Route('/addstaff', name: 'app_add_staff')]
    public function addStaff(): Response
    {
        return $this->render('dash/addstaff.html.twig');
    }

    #[Route('/editstaff', name: 'app_edit_staff')]
    public function editStaff(): Response
    {
        return $this->render('dash/editstaff.html.twig');
    }

    #[Route('/staffprofile', name: 'app_profile_staff')]
    public function staffProfile(): Response
    {
        return $this->render('dash/staffprofile.html.twig');
    }

    #[Route('/respondreclamation', name: 'app_respond_reclamation')]
    public function respondReclamation(): Response
    {
        return $this->render('dash/respondreclamation.html.twig');
    }

    #[Route('/listsupport', name: 'app_list_support')]
    public function listSupport(): Response
    {
        return $this->render('dash/listsupport.html.twig');
    }

    #[Route('/respondsupport', name: 'app_respond_support')]
    public function respondSupport(): Response
    {
        return $this->render('dash/respondsupport.html.twig');
    }

    #[Route('/payresto', name: 'app_payresto')]
    public function payResto(): Response
    {
        return $this->render('dash/payresto.html.twig');
    }

    #[Route('/gestionlivraison', name: 'app_gestion_livraison')]
    public function gestionLivraison(): Response
    {
        return $this->render('dash/gestionlivraison.html.twig');
    }

    #[Route('/liststudents', name: 'app_list_students')]
    public function listStudents(StudentRepository $studentRepository): Response
    {
        return $this->render('dash/liststudents.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

}
