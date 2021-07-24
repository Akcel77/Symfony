<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\AddWishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/wish/newWishList", name="wish_newWishList")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {

        $newWish = new Wish();
        $newWish->setDateCreated(new\DateTime());
        $newWish->setIsPublished(1);
        $wishForm = $this ->createForm(AddWishType::class, $newWish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()) {
            $entityManager->persist($newWish);
            $entityManager->flush();
            $this->addFlash('success','Votre souhait a ete cree');
            return $this->redirectToRoute('wish_detail', ['id' => $newWish->getId()]);
        }

        return $this->render('wish/newWishList.html.twig', [
            "wishForm" => $wishForm->createView()
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
