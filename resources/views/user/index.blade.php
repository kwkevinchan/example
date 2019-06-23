@extends('layouts.app')

@section('content')
<div>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold flex-grow-1 " style="margin-top:5px">
              使用者清單
            </h5>
            @include('components.popModal')

            <form class="ml-auto col-md-6">
              <div class="form-group" style="margin-bottom:0px">
              </div>
            </form>

            <a href="{{ route('user.create') }}" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">新增使用者</a>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>名稱</th>
                  <th>Email</th>
                  <th>性別</th>
                  <th>生日</th>
                  <th>備註</th>
                  <th width="20%">操作</th>
                  <th width="20%"></th>
                </tr>
              </thead>
              <tbody id="mainTable">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const data = JSON.parse('{!! $data->toJson() !!}');
  console.log(data)
  //初始表格
  let table = new Array();
  for(let item in data){
    let value = data[item];
      let d = value;
      table.push('<tr>')
        table.push('<td>' + d['name'] + '</td>')
        table.push('<td>' + d['email'] + '</td>')
        table.push('<td>' + d['gender'] + '</td>')
        table.push('<td>' + d['birthday'] + '</td>')
        table.push('<td>' + d['comment'] + '</td>')
        table.push('<td><a href="/user/'+ d['id'] +'/edit" class="btn text-white btn-primary" role="button" aria-pressed="true">修改使用者</a></td>')
        table.push('<td><a href="/user/'+ d['id'] +'/delete" class="btn text-white btn-primary" role="button" aria-pressed="true" onclick="delete(' + d['id'] + ',' + d['name'] +')">刪除使用者</a></td>')
      table.push('</tr>')
  }
  document.getElementById('mainTable').innerHTML = table.join('');

  function delete(id, name) {
    title = document.getElementById('popModalTitle');
    title.innerHTML = ('您將刪除:' + name);
    url = document.getElementById('popModalUrl');
    url.setAttribute('onclick', "sendDelete("+id+")");
    $('#popModal').modal('show');
  }

  function sendDelete(id) {
    axios.post("{{ route('user.destroy', [ 'id' => " + id + " ]) }}")
        .then(function(res) {
            console.log(res.data.msg);
            title = document.getElementById('popModalTitle');
            title.innerHTML = (res.data.status);
            body = document.getElementById('popModalBody');
            body.innerHTML = (res.data.msg);
            $('#popModal').modal('show');
        })
        .catch(function(error) {
            console.log(error.response.data);
            title = document.getElementById('popModalTitle');
            title.innerHTML = (error.response.data.status);
            body = document.getElementById('popModalBody');
            body.innerHTML = (error.response.data.msg);
            $('#popModal').modal('show');
        });
  }
</script>
@endsection
