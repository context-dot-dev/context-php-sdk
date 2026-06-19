<?php

namespace ContextDev\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Rate Limit Exception';
}
