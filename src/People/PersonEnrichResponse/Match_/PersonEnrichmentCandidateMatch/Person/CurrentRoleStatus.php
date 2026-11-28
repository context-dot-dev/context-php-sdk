<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

/**
 * Whether the person's current role is known. `present` means `current_role` is filled in; `none` means the work history shows every role has ended; `unknown` means it could not be confirmed either way, so treat a missing `current_role` as unverified, not vacant.
 */
enum CurrentRoleStatus: string
{
    case PRESENT = 'present';

    case NONE = 'none';

    case UNKNOWN = 'unknown';
}
