<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Token API') }}
        </h2>
    </x-slot>

    <div>
        @livewire('api.api-token-manager')
    </div>
</x-app-layout>