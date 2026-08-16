<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

/**
 * Whether the person's current role is known. `present` — current_role is populated. `none` — the work history explicitly shows every role has ended. `unknown` — our data sources could not confirm either way; treat a missing current_role as unverified rather than vacant.
 */
enum CurrentRoleStatus: string
{
    case PRESENT = 'present';

    case NONE = 'none';

    case UNKNOWN = 'unknown';
}
