@extends('layouts.master')
@section('content')
    <div class="container">
        <h2 class="mt-5 mb-3">Login </h2>
        <form method="POST" id="loginForm" onsubmit="return checkLogin();">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p>Don't have an account, <a href="{{ url('/') }}">Register here</a></p>
    </div>

    <script>
        const checkLogin = () => {
            var fd = new FormData();
            fd.append('_token', "{{ csrf_token() }}");
            var email = $('#email').val();
            if (email == '') {
                $('#email').css({
                    "border": '#FF0000 1px solid'
                });
                return false;
            }
            $('.form-control').css({
                "border": '#ced4da 1px solid'
            });
            fd.append('email', email);
            $.ajax({
                url: "{{ url('') . '/checkmail' }}",
                data: fd,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    const text = data;
                    if (text.status == 'success') {
                        //   Clear field
                        $('#loginForm').each(function() {
                            this.reset();
                        });
                        let id=text.data.id;
                        window.location.replace("{{ url('') . '/generate-qrcode/' }}"+id);
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
