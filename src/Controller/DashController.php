<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashController extends AbstractController
{
    #[Route('/dash', name: 'app_dash')]
    public function index(): Response
    {
        return $this->render('dash/index.html.twig', [
            'controller_name' => 'DashController',
        ]);
    }
    #[Route('/user', name: 'app_user')]
    public function user(): Response
    {
        return $this->render('user/user.html.twig', [
            'controller_name' => 'DashController',
        ]);
    }
    #[Route('/listprofessors', name: 'app_list_professors')]
    public function listprofessors(): Response
    {
        return $this->render('dash/listprofessors.html.twig');
    }

    #[Route('/listbourses', name: 'app_list_bourses')]
    public function listbourses(): Response
    {
    return $this->render('dash/listbourses.html.twig');
    }


    #[Route('/liststudents', name: 'app_list_students')]
    public function liststudents(): Response
    {
        return $this->render('dash/liststudents.html.twig');
    }

    #[Route('/listreclamation', name: 'app_list_reclamation')]
    public function listreclamation(): Response
    {
        return $this->render('dash/listreclamation.html.twig');
    }

    #[Route('/listcourses', name: 'app_list_courses')]
    public function listcourses(): Response
    {
        return $this->render('dash/listcourses.html.twig');
    }

    #[Route('/addbourse', name: 'app_add_bourses')]
    public function addbourse(): Response
    {
        return $this->render('dash/addbourse.html.twig');
    }

    #[Route('/editbourse', name: 'app_edit_bourses')]
    public function editbourse(): Response
    {
        return $this->render('dash/editbourse.html.twig');
    }

    #[Route('/allstaff', name: 'app_all_staff')]
    public function allstaff(): Response
    {
        return $this->render('dash/allstaff.html.twig');
    }
    #[Route('/addstaff', name: 'app_add_staff')]
    public function addstaff(): Response
    {
        return $this->render('dash/addstaff.html.twig');
    }
    #[Route('/editstaff', name: 'app_edit_staff')]
    public function editstaff(): Response
    {
        return $this->render('dash/editstaff.html.twig');
    }
    #[Route('/staffprofile', name: 'app_profile_staff')]
    public function staffprofile(): Response
    {
        return $this->render('dash/staffprofile.html.twig');
    }

    #[Route('/respondreclamation', name: 'app_respond_reclamation')]
    public function respondreclamation(): Response
    {
        return $this->render('dash/respondreclamation.html.twig');
    }

    #[Route('/listsupport', name: 'app_list_support')]
    public function listsupport(): Response
    {
        return $this->render('dash/listsupport.html.twig');
    }
    #[Route('/respondsupport', name: 'app_respond_support')]
    public function respondsupport(): Response
    {
        return $this->render('dash/respondsupport.html.twig');
    }



}
