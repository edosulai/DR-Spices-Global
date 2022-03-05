<div class="btn-group btn-group-toggle" data-toggle="buttons">
    <a href="#" class="btn btn-success" wire:click="openSpiceModal({{ $rempah->id }})" wire:loading.attr="disabled">Edit</a>
    <a href="#" class="btn btn-danger" wire:click="openDeleteSpiceModal({{ $rempah->id }})" wire:loading.attr="disabled">Hapus</a>
</div>