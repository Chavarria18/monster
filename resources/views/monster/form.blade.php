@if ($errors->any())
    <div class="parchment-errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    method="POST"
    action="{{ $action }}"
    enctype="multipart/form-data"
    class="parchment-form"
>
    @csrf

    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="field">
        <label for="name">Nombre</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $monster->name ?? '') }}"
            required
        >
    </div>

    <div class="field">
        <label for="life">Vida</label>
        <input
            type="number"
            id="life"
            name="life"
            value="{{ old('life', $monster->life ?? '') }}"
            min="1"
            required
        >
    </div>

    <div class="field">
        <label for="atack">Ataque</label>
        <input
            type="number"
            id="atack"
            name="atack"
            value="{{ old('atack', $monster->atack ?? '') }}"
            min="0"
            required
        >
    </div>

    <div class="field">
        <label for="defense">Defensa</label>
        <input
            type="number"
            id="defense"
            name="defense"
            value="{{ old('defense', $monster->defense ?? '') }}"
            min="0"
            required
        >
    </div>

    <div class="field">
        <label for="velocity">Velocidad</label>
        <input
            type="number"
            id="velocity"
            name="velocity"
            value="{{ old('velocity', $monster->velocity ?? '') }}"
            min="0"
            required
        >
    </div>

    <div class="field field--image">
        <label for="image">Imagen</label>

        <div class="image-field-row">

            <input
                type="file"
                id="image"
                name="image"
                accept="image/*"
                onchange="previewMonsterImage(event)"
            >

            <div class="image-preview" id="imagePreviewBox">

                @if (!empty($monster?->image))
                    <img
                        id="imagePreview"
                        class="img-fluid"
                        src="{{ asset('storage/' . $monster->image) }}"
                        alt="{{ $monster->name }}"
                    >

                    <span
                        id="imagePreviewPlaceholder"
                        style="display:none;"
                    >
                        Sin imagen
                    </span>
                @else
                    <img
                        id="imagePreview"
                        class="img-fluid"
                        src=""
                        alt="Vista previa"
                        style="display:none;"
                    >

                    <span
                        id="imagePreviewPlaceholder"
                        style="display:inline-block; width:100%; text-align:center;"
                    >
                        Sin imagen
                    </span>
                @endif

            </div>

        </div>
    </div>

    <button type="submit" class="tavern-btn">
        {{ $buttonText }}
    </button>

</form>

<script>
function previewMonsterImage(event) {
    const file = event.target.files[0];

    const img = document.getElementById('imagePreview');
    const placeholder = document.getElementById('imagePreviewPlaceholder');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            img.src = e.target.result;
            img.style.display = 'block';
            placeholder.style.display = 'none';
        };

        reader.readAsDataURL(file);
    }
}
</script>