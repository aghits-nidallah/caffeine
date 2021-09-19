@if (session()->has('success'))
    @if (session()->get('success'))
        <x-alert-success>
            {{ session()->get('message') }}
        </x-alert-success>
    @else
        <x-alert-danger>
            {{ session()->get('message') }}
        </x-alert-danger>
    @endif
@endif