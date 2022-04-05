<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-user']) }}>
    {{ $slot }}
</button>
