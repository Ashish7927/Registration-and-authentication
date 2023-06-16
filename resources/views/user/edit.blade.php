@extends('layouts.master')
@section('content')
    <div class="container">
        <h2 class="mt-5 mb-3">Update Profile</h2>
        <form method="POST" id="updateprofileForm" onsubmit="return UpdateProfileFunction();">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="avatar">Profile Photo:</label>
                <input type="file" class="form-control" id="avatar">
            </div>
            <div class="form-group">
                <img src="{{ $user->profile_pic != '' ? url('') . '/uploads' . '/' . $user->profile_pic : url('') . '/uploads/image_not_found.png' }}"
                    alt="Profile_photo" style="height: 70px;width: 100px;">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <p>See all registered user, <a href="{{ route('GetAllUser') }}"> here</a></p>
    </div>
    <script>
        const UpdateProfileFunction = () => {
            var fd = new FormData();
            fd.append('_token', "{{ csrf_token() }}");
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var fileInput = document.getElementById("avatar");
            var file = fileInput.files[0];

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
            if (file) {
                fd.append("file", file);
            }
            $.ajax({
                url: "{{ url('') . '/update-profile' . '/' . $user->id }}",
                data: fd,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    const text = data;
                    if (text.status == 'success') {
                        alert('profile Updated Successfully!');
                        window.location.replace("");
                    } else if (text.status == 'fail') {
                        $('#email').css({
                            "border": '#FF0000 1px solid'
                        });
                        alert(text.message);
                    }else{
                        alert(text.message);
                    }
                    return false;
                }
            });

            return false;
        };
    </script>
@endsection
