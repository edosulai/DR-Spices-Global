<x-app-layout>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="cetak"><i class="fas fa-download fa-sm text-white-50"></i> Cetak PDF</button>

    <script>
      $('#cetak').on('click', function() {
          $('table').printThis({
            debug: false,
            printContainer: true,
            pageTitle: "Rekap Data {{ $title }}",
            printDelay: 666,
            header: `<h3 class="text-gray-800 mb-4">Rekap Data {{ $title }}</h3>`,
            footer: $('footer'),
            base: false,                // preserve the BASE tag or accept a string for the URL
            formValues: true,           // preserve input/form values
            canvas: false,              // copy canvas content
            removeScripts: false,       // remove script tags from print content
            copyTagClasses: false,      // copy classes from the html & body tag
            beforePrintEvent: null,     // function for printEvent in iframe
            beforePrint: null,          // function called before iframe is filled
            afterPrint: null            // function called before iframe is removed
          });
      });
    </script>

  </div>

  @livewire('request-buy', ['title' => $title])

</x-app-layout>