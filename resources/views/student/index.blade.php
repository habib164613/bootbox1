@extends('student.layouts.app')

@section ('content')
<div class="container">
    <div class="row" style="height: 100vh">
        <div class="col">
            <div class="col-auto text-end ">
                <a formActionUrl="{{route('students.store')}}" href="{{route('students.create')}}" type="submit" class="btn btn-primary" id="bootModal">Student create</a>
            </div>
        </div>
        <div class="table-parent-div">
            <div class="row">
                <div class="table-contant">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>


                            @forelse($students as $key=> $student)
                            <tr>
                                <th>{{$student->id}}</th>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>
                                    <img style="height: 40px;" src="{{asset('uploads/student-img/'.$student->photo)}}" alt="profile">

                                </td>
                                <td>
                                    <a id="bootModal" class="btn btn-info" href="{{ route('students.show',$student->id) }}"><i class="fa-regular fa-eye"></i></a>

                                    <a formActionUrl="{{route('students.update',$student->id)}}" id="bootModal" class="btn btn-success" href="{{ route('students.edit',$student->id) }}"><i class="fa-regular fa-pen-to-square"></i></a>

                                    <form action="{{route('students.destroy',$student->id)}}" method="post" class="d-inline deletForm">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-danger" href=""><i class="fa-regular fa-trash-can"></i></a>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-danger">No Data</td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //  modal click start
        let formUrl = '';
        let dialog = '';
        let formId = '';
        //modal show
        $(document).on('click', '#bootModal', function(e) {


            e.preventDefault();

            let modalUrl = $(this).attr('href');
            formUrl = $(this).attr('formActionUrl')

            $.ajax({
                type: "GET",
                url: modalUrl,
                dataType: "html",
                success: function(res) {
                    dialog = bootbox.dialog({
                        title: 'Student Create',
                        message: "<div id='studentContent'></div>",
                        size: 'large',

                    });
                    $('#studentContent').html(res);
                    formId = '#' + $('#studentContent').find('form').attr('id');


                }
            })

        });

        //  modal click end


        $(document).on('submit', formId, function(e) {
            e.preventDefault();

            //formUrl= $(this).attr('action');

            let formdata = new FormData($(formId)[0]);

            $.ajax({
                type: "POST",
                url: formUrl,
                data: formdata,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
                    if (res.status === 400) {

                        $('.errors').html('')
                        $('.errors').removeClass('d-none')
                        $('.nameError').text(res.errors.name)
                        $('.emailError').text(res.errors.email)
                        $('.photoError').text(res.errors.photo)
                        $('.accepetedError').text(res.errors.accepeted)

                    } else {
                        dialog.modal('hide')
                        $('.errors').html('')
                        $('.errors').addClass('d-none')
                        $('.table-parent-div').load(location.href + ' .table-parent-div')



                    }

                }
            });

        })
        //delete

        $(document).on('click', '.deletForm', function(e) {
            e.preventDefault();

            let deleteUrl = $(this).attr('action')
            let csrf = $(this).find('input[name="_token"]').val();

            bootbox.confirm({
                message: 'This is a confirm with custom button text and color! Do you like it?',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if (result) {


                        $.ajax({
                            type: "POST",
                            url: deleteUrl,
                            data: {
                                '_token': csrf,
                                '_method': 'DELETE'
                            },
                            dataType: "dataType",
                            success: function(response) {

                            }
                        });

                    }
                }
            });

        });

        //pagination
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];

            $.ajax({
                type: "GET",
                url: "students/pagination/?page=" + page,
                success: function(res) {
                    console.log(page)
                    $('.table-parent-div').html(res);

                }
            });

        });


    });
</script>

@endsection