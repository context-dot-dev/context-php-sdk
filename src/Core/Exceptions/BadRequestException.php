<?php

namespace ContextDev\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Bad Request Exception';
}
