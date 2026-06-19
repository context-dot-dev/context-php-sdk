<?php

namespace ContextDev\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ContextDev Internal Server Exception';
}
