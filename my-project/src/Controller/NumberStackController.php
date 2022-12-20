<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\NumberStackManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class NumberStackController extends AbstractController
{
    private NumberStackManager $numberStackManager;

    public function __construct(NumberStackManager $numberStackManager)
    {
        $this->numberStackManager = $numberStackManager;
    }

    /**
     * @Route("/push/{number}", name="app_push")
     */
    public function push(Request $request): Response
    {
        $this->numberStackManager->onPush((int) $request->get('number'));
        return new Response('kek');
    }
    /**
     * @Route("/pop", name="app_pop")
     */
    public function pop(): Response
    {
        $message = $this->numberStackManager->onPop();

        return new JsonResponse([
            'message' => $message,
        ]);
    }
}
