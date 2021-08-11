
<!-- Import of the main container and heard -->
<!-- Page Evaluations -->
@extends('layouts.layout')

@section('content')

    <div class="row mt-4 content">
        <!-- Title -->
        <h5 class="title">
            Evaluación del personal
        </h5>
    
        <!-- Open modal -->
        <div class="col-12 text-right">
            <a type="button" class="btn btn-primary btn-circle btn-lg top-0 end-0" 
                    href="{{ route('create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
            </a>
        </div>
    
        <!-- Table of records of evaluations -->
        <table class="table table-bordered table-striped table-hover mt-2" id="table-custmers">
            <thead>
                <tr class="table">
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-3">Nombre</th>
                    <th scope="col" class="col-3">Fecha Evaluación</th>
                    <th scope="col" class="col-1 text-right">Puntaje</th>
                    <th scope="col" class="col-2 text-right">Bono</th>
                    <th scope="col" class="col-2 text-center">Acciones</th>
                </tr>
            </thead>
            <!-- Body -->
            <tbody>
                @if( count($evaluations) <= 0 )
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay resultados
                        </td>
                    </tr>
                @else
                @foreach ($evaluations as $key => $item)
                <tr>
                    <td class="col-1">
                        {{ $key+1 }}
                    </td>
                    <td class="col-3">
                        {{ $item->customer->firstName.' '.$item->customer->secondName.' '.$item->customer->surname.' '.$item->customer->secondSurname }}
                    </td>
                    <td class="col-3">
                        {{ \Carbon\Carbon::parse($item->startDate)->format('d/m/Y').' - '.\Carbon\Carbon::parse($item->endDate)->format('d/m/Y') }}
                    </td>
                    <td class="col-1 text-right">
                        {{ $item->score }}
                    </td>                
                    <td class="col-2 text-right">
                        {{ $item->bond }}
                    </td>
                    <!-- Actions (UPDATE/DELETE) -->
                    <td class="col-2 text-center">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ url($item->id.'/edit') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteEvaluation( {{ $item }} )">
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
        <div class="col-12 d-flex justify-content-center">
            {{ $evaluations->links() }}
        </div>
    </div>


@endsection
