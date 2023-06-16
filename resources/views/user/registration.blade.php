@extends('layouts.master')
@section('content')
    <div class="container">
        <h2 class="mt-5 mb-3">Registration Form</h2>
        <form method="POST" id="registrationForm" onsubmit="return RegisterUserFunction();">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p>Already have an account, <a href="{{ route('Login') }}">Login here</a></p>
    </div>
    <script>
        const RegisterUserFunction = () => {
            var fd = new FormData();
            fd.append('_token', "{{ csrf_token() }}");
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();

            if (first_name == '') {
                $('#first_name').css({
                    "border": '#FF0000 1px solid'
                });
                return false;
            } else if (last_name == '') {
                $('#last_name').css({
                    "border": '#FF0000 1px solid'
                });
                return false;
            } else if (email == '') {
                $('#email').css({
                    "border": '#FF0000 1px solid'
                });
                return false;
            }
            $('.form-control').css({
                "border": '#ced4da 1px solid'
            });
            fd.append('first_name', first_name);
            fd.append('last_name', last_name);
            fd.append('email', email);
            $.ajax({
                url: "{{ url('') . '/register' }}",
                data: fd,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    const text = data;
                    if (text.status == 'success') {
                        //   Clear field
                        $('#registrationForm').each(function() {
                            this.reset();
                        });
                        window.location.replace("{{ route('Login') }}");
                    } else if (text.status == 'fail') {
                        $('#email').css({
                            "border": '#FF0000 1px solid'
                        });
                        alert(text.message);
                    }
                    return false;
                }
            });

            return false;
        };
    </script>
@endsection
