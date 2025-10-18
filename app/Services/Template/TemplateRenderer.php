<?php

declare(strict_types=1);

namespace App\Services\Template;

use App\Enum\Template\TemplateContext;
use App\Models\EmailTemplate;

final class TemplateRenderer
{
    public function __construct() {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function render(EmailTemplate $template, array $data): string
    {
        $context = TemplateContext::from($template->getAttribute('context'));
        $body = (string) $template->getAttribute('body');

        return TemplateVariableRegistry::render($body, $context, $data);
    }
}
