<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{
        state: $wire.entangle('{{ $getStatePath() }}').defer,
        images: @js($getOptions()),
    }">
        <img :src="images[state]" class="mb-2">
        <div class="flex gap-2 pb-4" style="overflow: auto;">
            @foreach($getOptions() as $id => $assetSrc)
                <img
                    @click="state = {{ $id }}"
                    class="cursor-pointer block h-12"
                    src="{{ $assetSrc }}"
                >
            @endforeach
        </div>
        <!-- Interact with the `state` property in Alpine.js -->
    </div>
</x-dynamic-component>
