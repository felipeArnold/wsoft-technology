<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Widgets Overview --}}
        <div class="grid grid-cols-1 gap-6">
            @foreach ($this->getWidgets() as $widget)
                @livewire($widget)
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
