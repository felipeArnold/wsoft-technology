<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\EmailTemplate;

final class EmailTemplateObserver
{
    public function creating(EmailTemplate $template)
    {
        unset($template->variables_copy_list);
        unset($template->variable_context_preview);
    }

    public function updating(EmailTemplate $template)
    {
        unset($template->variables_copy_list);
        unset($template->variable_context_preview);
    }
}
