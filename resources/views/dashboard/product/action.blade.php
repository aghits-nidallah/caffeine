<div class="flex">
    <a href="{{ route('dashboard.product.show', $id) }}">
        <x-primary-button class="!px-3">
            <i class="fas fa-eye"></i>
        </x-primary-button>
    </a>
    <a href="{{ route('dashboard.product.edit', $id) }}">
        <x-secondary-button class="!px-3 ml-1">
            <i class="fas fa-edit"></i>
        </x-secondary-button>
    </a>
    <form action="{{ route('dashboard.product.destroy', $id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <x-danger-button class="!px-3 ml-1">
            <i class="fas fa-trash"></i>
        </x-danger-button>
    </form>
</div>