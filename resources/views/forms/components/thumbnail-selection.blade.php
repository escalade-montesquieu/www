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
        <img :src="images[state]" class="w-full aspect-video">
        <div class="flex gap-2 pt-2 pb-6 px-2" style="overflow: auto;">
            @foreach($getOptions() as $id => $assetSrc)
                <img
                    @click="state = {{ $id }}"
                    class="cursor-pointer block h-12"
                    :class="{'ring-2 ring-primary-500': state=== {{ $id }}}"
                    src="{{ $assetSrc }}"
                >
            @endforeach
        </div>
        <!-- Interact with the `state` property in Alpine.js -->
    </div>
</x-dynamic-component>
