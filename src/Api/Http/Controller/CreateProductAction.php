<?php

declare(strict_types=1);

namespace Api\Http\Controller;

use Api\Form\Type\ProductType;
use Api\Http\Request\CreateProductRequest;
use Api\Http\Response\ApiResponse;
use Cobiro\Common\Application\System;
use Cobiro\Product\Application\Command\CreateProductCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateProductAction
{
    private FormFactoryInterface $formFactory;

    private System $system;

    public function __construct(FormFactoryInterface $formFactory, System $system)
    {
        $this->formFactory = $formFactory;
        $this->system = $system;
    }

    public function __invoke(Request $request): Response
    {
        $createProductRequest = new CreateProductRequest();

        $form = $this->formFactory->create(ProductType::class, $createProductRequest);
        $form->submit(\json_decode($request->getContent(), true));

        if (false === $form->isValid()) {
            return ApiResponse::error('Invalid request data');
        }

        try {
            $this->system->handle(new CreateProductCommand(
                $id = Uuid::uuid4()->toString(),
                $createProductRequest->name,
                $createProductRequest->price->amount,
                $createProductRequest->price->currency
            ));
        } catch (System\Exception\Exception $exception) {
            return ApiResponse::error('Could not perform operation');
        }

        return new JsonResponse(['id' => $id]);
    }
}
