@extends('layouts.app')

@section('content')
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
@endsection

@section('script')
<script>
  const data = JSON.parse('{!! $data->toJson() !!}');
  //初始表格
  let table = new Array();
  for(let item in data){
    let value = data[item];
      let d = value;
      table.push('<tr id="tr' + d['id'] + '">')
        table.push('<td>' + d['name'] + '</td>')
        table.push('<td>' + d['email'] + '</td>')
        table.push('<td>' + d['gender'] + '</td>')
        table.push('<td>' + d['birthday'] + '</td>')
        table.push('<td>' + d['comment'] + '</td>')
        table.push('<td><a href="/user/'+ d['id'] +'/edit" class="btn text-white btn-primary" role="button" aria-pressed="true">修改使用者</a></td>')
        table.push('<td><button type="button" class="btn btn-primary" onclick="deleteUser(\'' + d['id'] + '\', \'' + d['name'] +'\')">刪除使用者</button></td>')
      table.push('</tr>')
  }
  document.getElementById('mainTable').innerHTML = table.join('');

  function deleteUser(id, name) {
    title = document.getElementById('popModalTitle');
    title.innerHTML = ('您將刪除:' + name);
    body = document.getElementById('popModalBody');
    body.innerHTML = ('請確認，刪除後的資料將無法復原');
    url = document.getElementById('popModalUrl');
    url.setAttribute('onclick', "sendDelete("+id+")");
    $('#popModal').modal('show');
  }

  function sendDelete(id) {
    axios.get("/user/" + id + "/delete")
        .then(function(res) {
            console.log(res);
            title = document.getElementById('popModalTitle');
            title.innerHTML = (res.data.status);
            body = document.getElementById('popModalBody');
            body.innerHTML = (res.data.msg);
            url = document.getElementById('popModalUrl');
            url.setAttribute('onclick', "closePop()");
            document.getElementById("tr" + id).remove();
            $('#popModal').modal('show');
        })
        .catch(function(error) {
            console.log(error.response);
            title = document.getElementById('popModalTitle');
            title.innerHTML = (error.response.data.status);
            body = document.getElementById('popModalBody');
            body.innerHTML = (error.response.data.msg);
            url = document.getElementById('popModalUrl');
            url.setAttribute('onclick', "closePop()");
            $('#popModal').modal('show');
        });
  }

  function closePop(){
    $('#popModal').modal('hide');
  }
</script>
@endsection
