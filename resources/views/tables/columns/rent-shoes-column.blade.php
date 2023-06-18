<div class="filament-tables-icon-column filament-tables-icon-column-size-lg px-4 py-3">
    @if($getState())
        <span>T{{ $getState() }}</span>
    @else
        <x-heroicon-o-x-circle class="text-danger-500 h-6 w-6" />
    @endif
</div>
