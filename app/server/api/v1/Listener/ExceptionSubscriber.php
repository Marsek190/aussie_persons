<?php

namespace Api\V1\Listener;

use Api\V1\Exception\InvalidTokenException;
use Src\Customers\Ui\Factory\ResponseFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        if ($event->getThrowable() instanceof InvalidTokenException) {
            $response = $this->responseFactory->createJson(false, 'Wrong X-Api-Key.', null, 401);
            $event->setResponse($response);
        }
    }

    /** @inheritDoc */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}