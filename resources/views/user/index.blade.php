@extends('layouts.template1')
@section('title') Users @endsection

@section('content')
@php 
  $roles = Auth::user()->role;
@endphp
<script type="text/javascript">
  var role_user = '{{$roles}}';
</script>
	<div class="right_col" role="main">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data User</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="text-center">
        <button onclick="cek(role_user)" class="btn btn-primary tombol">
          <i class="fa fa-plus"></i> Tambah data</button>
      </div >
                    <table id="data-table" class="table table-striped table-bordered">
                       <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. Hp</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
						          </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tambah User -->
     <div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data User</h4>
              </div>
              <form id="input_user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kodbar" class="control-label" style="padding-top: 10px;">Nama 
                      :</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                      style="width: 100%;" id="password" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan ulang password" style="width: 100%;" id="password-confirm" name="password_confirmation" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">No. Hp/Telp </label>
                    <input type="text" name="phone" class="form-control" placeholder="Masukkan No.Hp/Telp" maxlength="13"
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Roles :</label>
                  <!-- </div> -->
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="role" id="exampleRadios1" 
                  value="superadmin">
                  <label class="form-check-label" for="exampleRadios1">
                    SuperAdmin
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="role" id="exampleRadios2" 
                  value="admin" checked="">
                  <label class="form-check-label" for="exampleRadios2">
                    Admin
                  </label>
                </div>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Akhir Tambah User -->


        <!-- Edit Data User -->
         <div class="modal fade" id="confirm-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Data User</h4>
              </div>
              <form id="edit-user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group" style="width: 100%;">
                    <label for="kodbar" class="control-label" style="padding-top: 10px;">Nama 
                      :</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" disabled
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="nama" class="control-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" disabled="" 
                      style="width: 100%;" required>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">No. Hp/Telp </label>
                    <input type="text" name="phone" id="nohp" class="form-control" placeholder="Masukkan No.Hp/Telp" maxlength="13"
                      style="width: 100%;" required disabled>
                  </div>
                  <div class="form-group" style="width: 100%;">
                    <label for="jumlah" class="control-label">Roles :</label>
                  <!-- </div> -->
                  <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="superadmin" 
                  value="superadmin">
                  <label class="form-check-label">SuperAdmin</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="admin" 
                  value="admin">
                  <label class="form-check-label">Admin</label>
                </div>
                </div>
                </div>
                <input type="hidden" name="hiddenid" id="hidden-id">
                <input name="_method" type="hidden" value="PUT">
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Akhir Edit Data User -->
@endsection

@section('script')
  
    <script type="text/javascript">
      $('#edit-user').submit(function(e){
    e.preventDefault();
    var id  = eval(document.getElementById('hidden-id').value);
    var request = new FormData(this);
    var endpoint= "user/"+id;
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              // console.log(data);
              $('#edit-user')[0].reset();
              $('#confirm-edit').modal('hide');
              // $('#role_user').load();
              role_user = data.role;
              berhasil(data.status, data.pesan);
              // tablebarang();
              $('#data-table').DataTable().ajax.reload();
              // $('#datatable').ajax.reload();
            },
            error: function(xhr, status, error){
                var error = xhr.responseJSON; 
                if ($.isEmptyObject(error) == false) {
                  $.each(error.errors, function(key, value) {
                    gagal(key, value);
                  });
                }
                } 
            }); 
});

      function cek_edit(role) {
   if(role != 'superadmin') {
    Swal.fire({
        type: 'error',
        title:  'Hanya SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
   } else {
    $(document).on('click', '#edit-item', function(){
      $('#edit-user')[0].reset();
    var id = $(this).attr('data-id');
    $.ajax({
      'url': "user/"+id+"/edit",
      'dataType': 'json',
      success:function(html){
        $('#hidden-id').val(html.data.id);
        $('#name').val(html.data.name);
        $('#email').val(html.data.email);
        $('#nohp').val(html.data.phone);
        if(html.data.role == 'superadmin') {
          $("#superadmin").attr('checked', 'checked');
        } else {
          $("#admin").attr('checked', 'checked');
        }
        $('#confirm-edit').modal('show');
      }
    })
  })
   }
 }


function cek(role) {
   if(role != 'superadmin') {
    Swal.fire({
        type: 'error',
        title:  'Hanya SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
   } else {
    $('#confirm-add').modal('show');
   }
 }

      $('#input_user').submit(function(e){
    e.preventDefault();
    var password  = document.getElementById('password').value;
    var konf_pass = document.getElementById('password-confirm').value;

    if(password != konf_pass) {
      var key   = 'Password';
      var pesan = 'tidak sama'; 
      return gagal(key, pesan);
    }

    var request = new FormData(this);
    var endpoint= '{{ route("user.store") }}';
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              console.log(data);
              if(data.status == 'success') {
                $('#input_user')[0].reset();
                $('#confirm-add').modal('hide');
                $('#data-table').DataTable().ajax.reload();
              }
              berhasil(data.status, data.pesan);
            },
            error: function(xhr, status, error){
                var error = xhr.responseJSON; 
                if ($.isEmptyObject(error) == false) {
                  $.each(error.errors, function(key, value) {
                    gagal(key, value);
                  });
                }
                } 
            }); 
});

function hapus_cek(role) {
  if(role != 'superadmin') {
    Swal.fire({
        type: 'error',
        title:  'Hanya SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
   } else {
    $(document).on('click', '#del_user', function(){
      // e.preventDefault();
      // $('#edit-user')[0].reset();
      Swal.fire({
        title: 'Anda Yakin ?',
        text: "Anda tidak dapat mengembalikan data yang telah di hapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan Hapus!',
        timer: 6500
      }).then((result) => {
          if (result.value) {
            var me = $(this),
                url = me.attr('href'),
                token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                  url: url,
                  method: "POST",
                  data : {
                    '_method' : 'DELETE',
                    '_token'  : token
                  },
                  success:function(data){
                    berhasil(data.status, data.pesan);

                    $('#data-table').DataTable().ajax.reload();
                  },
                  error: function(xhr, status, error){
                      var error = xhr.responseJSON; 
                      if ($.isEmptyObject(error) == false) {
                        $.each(error.errors, function(key, value) {
                          gagal(key, value);
                        });
                      }
                  } 
                });
        }
      });
    });
   }
}
      
var tabel = null;
 tabel = $(document).ready(function(){
    $('#data-table').DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        // "scrollX" : true,
        "order": [[ 0, 'asc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tableuser")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "name" },
            { "data": "phone" },
            { "data": "email" },
            { "data": "role" },
            { "data": "action" }
        ]
    });
});
    </script>
@endsection