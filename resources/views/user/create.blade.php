@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white">新增使用者</div>
                @include('components.popModal')
                <div class="card-body">
                    <form method="POST" action="/">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">姓名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birthday" class="col-md-4 control-label">生日</label>

                            <div class="col-md-10">
                                <input id="birthday" type="date" class="form-control" name="birthday" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">性別</label>


                            <div class="col-md-6">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" selected="selected">男</option>
                                    <option value="female">女</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment" class="col-md-4 control-label">備註</label>

                            <div class="col-md-10">
                                <textarea class="form-control" id="comment" name="comment" rows="1"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-primary" onclick="sendForm()">
                                    新增使用者
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function sendForm(){
        name = document.getElementById('name').value;
        email = document.getElementById('email').value;
        birthday = document.getElementById('birthday').value;
        gender = document.getElementById('gender').value;
        comment = document.getElementById('comment').value;

        axios.post("{{ route('user.store') }}", {
            name: name,
            email: email,
            birthday: birthday,
            gender: gender,
            comment: comment,
        })
        .then(function(res) {
            console.log(res.data.msg);
            title = document.getElementById('popModalTitle');
            title.innerHTML = (res.data.status);
            body = document.getElementById('popModalBody');
            body.innerHTML = (res.data.msg);
            url = document.getElementById('popModalUrl');
            url.setAttribute('href', "{{ route('index') }}");
            $('#popModal').modal('show');
        })
        .catch(function(error) {
            console.log(error.response.msg);
            title = document.getElementById('popModalTitle');
            title.innerHTML = (error.response.status);
            body = document.getElementById('popModalBody');
            body.innerHTML = (error.response.msg);
            $('#popModal').modal('show');
        });
    }
</script>
@endsection

