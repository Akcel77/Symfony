<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WishController extends AbstractController
{
    /**
     * @Route("/wish/list", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {

        $wishList = $wishRepository->findBy([], ['id' => 'ASC']);

        return $this->render('wish/list.html.twig', [
            "wish" => $wishList
        ]);
    }

    /**
     * @Route("/wish/list/detail/{id}", name="wish_detail")
     */
    public function details(int $id, WishRepository $wishRepository): Response
    {
        $detail = $wishRepository->find($id);
        return $this->render('wish/details.html.twig', [
            "detail" => $detail
        ]);
    }
}
