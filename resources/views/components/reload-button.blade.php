<button type="submit" {{ $attributes->merge(['class' => 'btn p-1 ml-auto card-header-action']) }}>
    <span style="color: rgb(0, 114, 36);">&#x21bb;</span>
    {{ $slot }}
</button>
