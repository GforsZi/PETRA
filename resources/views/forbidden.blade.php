<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/adminlte.min.css') }}">
    <x-navbar></x-navbar>
    <main class="app-main vh-100">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">{{ $title }}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        {{ $users }}
    </main>
    <x-footer></x-footer>
    <script src="{{ asset('/js/adminlte.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('/js/app.js') }}" type="text/javascript" charset="utf-8"></script>
</x-guest-layout>
