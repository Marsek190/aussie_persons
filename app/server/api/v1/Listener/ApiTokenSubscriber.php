<?php

namespace Api\V1\Listener;

use Api\V1\Exception\InvalidTokenException;
use Api\V1\Validator\ApiTokenValidator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiTokenSubscriber implements EventSubscriberInterface
{
    private ApiTokenValidator $tokenValidator;

    public function __construct(ApiTokenValidator $tokenValidator)
    {
        $this->tokenValidator = $tokenValidator;
    }

    /**
     * @param RequestEvent $event
     * @throws InvalidTokenException
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!str_contains('/api/v1/', $request->getUri())) {
            return;
        }

        if (!$this->tokenValidator->validate($request)) {
            throw new InvalidTokenException();
        }
    }

    /** @inheritDoc */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}