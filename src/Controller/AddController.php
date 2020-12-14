<?php

namespace App\Controller;

use App\Service\AddServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    /**
     * @Route( name="addUser",
     * path="api/admin/users",
     * methods= {"PUT","POST"},
     * defaults={
     *   "_controller"="/App/Controller/UserController::PostUser",
     * "_api_collection_operartion_name"={} 
     *}
     *)
     */
    public function Add(AddServices $AddServices, Request $request)
    {
        //dd($request);
        return $this->json($AddServices->AddUser ($request),200);
       //$AddServices->AddUser ($request);

    }
}
