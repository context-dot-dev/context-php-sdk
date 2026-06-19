<?php

namespace ContextDev\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Authentication Exception';
}
