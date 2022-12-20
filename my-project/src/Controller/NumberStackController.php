<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\StackEmptyException;
use App\Form\PushType;
use App\Manager\NumberStackManager;
use App\Model\PushModel;
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
     * @Route("/push", name="app_push", methods={"POST"})
     */
    public function push(Request $request): Response
    {
        $form = $this->createForm(PushType::class, new PushModel());
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->numberStackManager->onPush($data);

            return new JsonResponse(['message' => 'ok']);
        }

        $errors = array_map(
            function ($item) {
                return $item->getMessage();
            },
            iterator_to_array($form->getErrors(true))
        );

        return new JsonResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }
    /**
     * @Route("/pop", name="app_pop", methods={"GET"})
     */
    public function pop(): Response
    {
        $message = $this->numberStackManager->onPop();

        return new JsonResponse([
            'message' => $message,
        ]);
    }
}
