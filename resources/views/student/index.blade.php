@extends('student.layouts.app')

@section ('content')
<div class="container">
    <div class="row" style="height: 100vh" >
        <div class="col">
            <div class="col-auto text-end ">
                <a href=""><button type="submit" class="btn btn-primary" id="createBtn">Submit</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('#createBtn').click(function(e) {
            e.preventDefault();
            
             $.ajax({
                type: "GET",
                url: "{{ route('students.create') }}",
                dataType: "html",
                success: function (res)
                 {
                    let dialog = bootbox.dialog({
                title: 'A custom dialog with buttons and callbacks',
                message: "<div id='studentContent'></div>",
                size: 'large',
                buttons: {
                    cancel: {
                        label: "Cancel",
                        className: 'btn-danger',
                        callback: function() {
                            
                        }
                    },
                
                    ok: {
                        label: " OK ",
                        className: 'btn-info',
                        callback: function() {
                           
                        }
                    }
                }
            });
               $('#studentContent').html(res);
                    
                }
             });


            




        });
    });
</script>

@endsection