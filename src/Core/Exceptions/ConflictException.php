<?php

namespace ContextDev\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Conflict Exception';
}
