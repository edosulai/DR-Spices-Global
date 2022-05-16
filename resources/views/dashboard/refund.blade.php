<x-app-layout>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="cetak"><i class="fas fa-download fa-sm text-white-50"></i> Cetak PDF</button>

  </div>

  @livewire('refund', ['title' => $title])

</x-app-layout>
