@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-file-text"></i> Regras de Prova
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Provas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Regras de Prova</li>
                        </ol>
                    </nav>
                    <div class="mb-4 bg-white border shadow-sm p-3">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Total de Pontos</th>
                                    <th scope="col">Pontos para Aprovação</th>
                                    <th scope="col">Nota de Distribuição de Pontos</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_rules as $exam_rule)
                                <tr>
                                    <td>{{$exam_rule->total_marks}}</td>
                                    <td>{{$exam_rule->pass_marks}}</td>
                                    <td>{{$exam_rule->marks_distribution_note}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a type="button" href="{{route('exam.rule.edit', [
                                                'exam_rule_id' => $exam_rule->id
                                            ])}}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pen"></i> Editar</a>
                                            {{-- <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-trash2"></i> Excluir</button> --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
