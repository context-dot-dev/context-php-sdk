<?php

namespace ContextDev\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Unprocessable Entity Exception';
}
