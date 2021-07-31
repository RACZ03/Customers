
@extends('layouts.layout')

@section('tableCustomers')
    <!-- Table -->
    <table class="table table-bordered table-striped table-hover mt-2" id="table-custmers">
        <thead>
            <tr class="table">
                <th scope="col" class="col-5">Nombre</th>
                <th scope="col" class="col-3">Cédula</th>
                <th scope="col" class="col-2">Telefono</th>
                <th scope="col" class="col-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if( count($customers) <= 0 )
                <tr>
                    <td colspan="4" class="text-center">
                        No hay resultados
                    </td>
                </tr>
            @else
            @foreach ($customers as $customer)
            <tr>
                <td>
                    {{ $customer->name.' '.$customer->lastName }}
                </td>
                <td>
                    {{ $customer->dni }}
                </td>
                <td>
                    {{ $customer->phoneNumber }}
                </td>
                <td class="text-center">
                    <button class="btn btn-outline-secondary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"
                            onclick="loadModal({{ $customer }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="deleteCustomer({{$customer}})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <!-- Fin table -->

    <!-- Pagination -->

    {{ $customers->links() }}

@endsection
