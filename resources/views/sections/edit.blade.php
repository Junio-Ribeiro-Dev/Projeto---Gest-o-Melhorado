@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-diagram-2"></i> Editar Seção</h1>
                    @include('session-messages')
                    <div class="row">
                        <form class="col-6" action="{{ route('school.section.update') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="session_id" value="{{ $current_school_session_id }}">
                            <input type="hidden" name="section_id" value="{{ $section_id }}">
                            <div class="mb-3">
                                <label for="section_name" class="form-label">Nome da Seção</label>
                                <input class="form-control" id="section_name" name="section_name" type="text" value="{{ old('section_name', $section->section_name) }}" required placeholder="Digite o nome da seção">
                            </div>
                            <div class="mb-3">
                                <label for="room_no" class="form-label">Número da Sala</label>
                                <input class="form-control" id="room_no" name="room_no" type="text" value="{{ old('room_no', $section->room_no) }}" required placeholder="Digite o número da sala">
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-2"><i class="bi bi-check2"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
