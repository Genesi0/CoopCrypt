<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\APIService;


class HomeController extends AbstractController
{
    #[Route('/home')]
    public function Index(APIService $apiService): Response
    {
        $titre = "CoopCrypt";
        $number = random_int(0, 100);
        $content = $apiService->fetchProfilesInfoFromUUID("ab9246028fd944b388985923e1b9d402");

        // Valeur de retour
        return $this->render('home.html.twig', [
            'number' => $number,
            'title' => $titre,
            'content' => $content,
        ]);
    }
}