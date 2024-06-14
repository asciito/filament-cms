<div
    class="text-sm"
    x-data="{ state: $wire.entangle('{{ $getStatePath() }}'), editing: false }"
    x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('plugin', package: 'asciito/filament-cms'))]"
>
    <div>
        <div class="flex items-center gap-2">
            <label class="text-primary-500 font-semibold py-2">Permalink:</label>

            <div class="text-gray-600 w-full">
                <p
                    class="cursor-pointer"
                    x-show="!editing"
                    x-on:click="editing = !editing"
                    x-text="state">
                    {{ $getState() }}
                </p>

                <div x-show="editing" x-trap="editing" x-cloak class="flex items-center gap-2 w-full">
                    <x-filament::input.wrapper
                        class="w-full">
                        <x-filament::input
                            class="w-full"
                            x-bind:value="state"
                            x-on:input="({ target }) => state = kebabCase(target.value)"
                        />
                    </x-filament::input.wrapper>

                    <x-filament::button
                        outlined
                        color="gray"
                        x-on:click="editing = !editing">
                        OK
                    </x-filament::button>
                </div>
            </div>
        </div>


    </div>
</div>
