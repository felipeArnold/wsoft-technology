<?php

declare(strict_types=1);

namespace App\Filament\Resources\Services\ServiceOrders\Actions;

use App\Models\ServiceOrder;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;

final class DownloadServiceOrderPdfAction extends Action
{
    protected string|HtmlString|null $previewHtml = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Visualizar PDF')
            ->color(Color::Blue)
            ->icon('heroicon-o-document-arrow-down')
            ->modalHeading('Visualizar Ordem de Serviço')
            ->modalDescription('Visualize o documento antes de fazer o download')
            ->modalSubmitAction(false)
            ->modalCancelActionLabel('Fechar')
            ->modalWidth('full')
            ->form([
                Placeholder::make('preview')
                    ->label('')
                    ->content(fn () => $this->getPreviewHtml()),
            ])
            ->extraModalFooterActions(fn () => [
                Action::make('download')
                    ->label('Baixar PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->url(fn (): string => route('service-orders.pdf.download', ['serviceOrder' => $this->getRecord()->id]))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function make(?string $name = 'download_pdf'): static
    {
        return parent::make($name);
    }

    protected function getPreviewHtml(): string|HtmlString
    {
        if ($this->previewHtml !== null) {
            return $this->previewHtml;
        }

        /** @var ServiceOrder|null $record */
        $record = $this->getRecord();

        if (! $record) {
            return $this->getErrorHtml('Ordem de serviço não encontrada');
        }

        try {
            $serviceOrder = $record->load([
                'person.phones',
                'person.addresses',
                'person.emails',
                'user',
                'tenant.phones',
                'tenant.addresses',
                'tenant.emails',
                'serviceOrderServices',
                'serviceOrderProducts',
            ]);

            // Gerar o HTML da view do PDF para preview (sem componentes de layout)
            $html = view('pdf.service-order-preview', [
                'serviceOrder' => $serviceOrder,
                'tenant' => $serviceOrder->tenant,
            ])->render();

            $this->previewHtml = $this->wrapPreviewHtml($html);

            return $this->previewHtml;
        } catch (Exception $e) {
            return $this->getErrorHtml('Erro ao carregar o documento: '.$e->getMessage());
        }
    }

    protected function wrapPreviewHtml(string $html): HtmlString
    {
        return new HtmlString(
            '<div style="max-height: 70vh; overflow-y: auto; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px; background: white; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">'.
            $html.
            '</div>'
        );
    }

    protected function getErrorHtml(string $message): HtmlString
    {
        return new HtmlString(
            '<div style="text-align: center; padding: 40px; color: #6b7280;">'.
            '<div style="font-size: 48px; margin-bottom: 16px;">📄</div>'.
            '<h3 style="margin: 0 0 8px 0; color: #374151;">Erro na Visualização</h3>'.
            '<p style="margin: 0; font-size: 14px;">'.e($message).'</p>'.
            '</div>'
        );
    }
}
