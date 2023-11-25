@extends('layouts.index')
@section('content')
    {{-- CSS Extra --}}
    @push('css')
    @endpush
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <button class="btn btn-outline-success">Tambah Role</button>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Name
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>


    {{-- Javacsript --}}
    @push('script')
        <script>
            $(document).ready(function() {
                let table = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ url('user/role') }}",
                    columns: [{
                            className: 'text-capitalize',
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
