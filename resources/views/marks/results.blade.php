@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-12 col-lg-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-cloud-sun"></i> Visualizar Resultados
                    </h1>
                    <h6>Filtrar lista por:</h6>
                    <div class="mb-4 mt-4">
                        <form action="{{route('course.mark.list.show')}}" method="GET">
                            <div class="row g-2">
                                <div class="col-12 col-md">
                                    <select class="form-select" name="semester_id" required>
                                        @isset($semesters)
                                            @foreach ($semesters as $semester)
                                            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col-12 col-md">
                                    <select onchange="getSectionsAndCourses(this);" class="form-select" name="class_id" aria-label="Turma" required>
                                        @isset($classes)
                                            <option selected disabled>Selecione uma turma</option>
                                            @foreach ($classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col-12 col-md">
                                    <select class="form-select" id="section-select" name="section_id" required>
                                        <option selected disabled>Selecione uma seção</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md">
                                    <select class="form-select" id="course-select" name="course_id" required>
                                        <option selected disabled>Selecione um curso</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-auto d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Carregar Lista</button>
                                </div>
                            </div>
                        </form>
                        <div class="bg-white border mt-4 p-3 shadow-sm table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nome do Aluno</th>
                                        <th scope="col">Notas Totais</th>
                                        <th scope="col">Pontos de Nota</th>
                                        <th scope="col">Conceito</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($marks)
                                        @foreach ($marks as $mark)
                                        <tr>
                                            <td><i class="bi bi-person-square fs-4"></i></td>
                                            <td>{{$mark->student->first_name}} {{$mark->student->last_name}}</td>
                                            <td>{{$mark->final_marks}}</td>
                                            <td>{{$mark->getAttribute('point')}}</td>
                                            <td>{{$mark->getAttribute('grade')}}</td>
                                        </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

<script>
    function getSectionsAndCourses(obj) {
        var class_id = obj.options[obj.selectedIndex].value;
        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('section-select');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Selecione uma seção'});
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });

            var courseSelect = document.getElementById('course-select');
            courseSelect.options.length = 0;
            data.courses.unshift({'id': 0,'course_name': 'Selecione um curso'});
            data.courses.forEach(function(course, key) {
                courseSelect[key] = new Option(course.course_name, course.id);
            });
        })
        .catch(function(error) {
            console.error(error);
        });
    }
</script>
@endsection
