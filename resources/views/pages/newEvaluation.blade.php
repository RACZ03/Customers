@extends('layouts.layout')

@section('content')

    <div class=" mt-4 mx-auto content"  style="max-width: 750px;">

        <!-- Title -->
        <h5 class="title" id="titleContent">
        </h5>

        <form class="col-12" id="form-Evaluation">
        @csrf
            <!-- Stage 1 -->
            <div id="stage1">
                <!-- Stage1 import -->
                @include('components.stageOne')
            </div>
                

            <!-- Stage 2 -->
            <div id="stage2">
                @include('components.stageTwo')
            </div>

            <!-- Stage 2 -->
            <div id="stage3">
                @include('components.stageThree')
            </div>

            <!-- Options form -->
            <div class="col-12 mt-5 d-flex justify-content-end">
                
                <a type="button" class="btn btn-danger mr-3" id="btnCancelE" href="{{ route('index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Cancelar
                </a>
                <button type="button" class="btn btn-primary mr-3" id="btnBack" onclick="nextOrBack(false)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Atras
                </button>
                <button type="button" class="btn btn-primary" onclick="nextOrBack(true)">
                    <label id="labelBtnNext" style="margin: 0; padding: 0;"></label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>
        </form>
    
    </div>

@endsection
