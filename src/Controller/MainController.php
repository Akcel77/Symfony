<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home(){
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/test", name="main_test")
     */
    public function test(){
        $testB = [
            "title" => "Games of thrones",
            "year" => 2000
        ];
        return $this->render('main/test.html.twig' , [
            "testB" => &$testB,
        ]);
    }
    /**
     * @Route("/about", name="main_about")
     */
    public function about()
    {
        return $this->render('main/about.html.twig', [

        ]);
    }
}
