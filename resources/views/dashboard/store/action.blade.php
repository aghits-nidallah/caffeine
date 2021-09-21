<div class="flex">
    <a href="{{ route('dashboard.store.show', $id) }}">
        <x-primary-button class="!px-3">
            <i class="fas fa-eye"></i>
        </x-primary-button>
    </a>
    <form action="{{ route('dashboard.store.destroy', $id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <x-danger-button class="!px-3 ml-1">
            <i class="fas fa-trash"></i>
        </x-danger-button>
    </form>
</div>