<form action="{{ route('dashboard.product.update', $id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="active" value="{{ !$active ? '1' : '0' }}">
    <input type="checkbox" {{ $active ? 'checked' : '' }} onchange="$(this).parent().submit()" />
</form>