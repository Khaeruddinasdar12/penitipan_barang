@extends('layouts.template1')
@section('title') Data penitipan @endsection

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
                    <h2>Data Penitipan</h2>
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
                            <th>Id</th>
                            <th>No. Hp</th>
                            <th>Nama Pemilik</th>
                            <th>Jumlah Barang</th>
                            <th>Lama Titip</th>
                            <th>Harga</th>
                            <th>PPN(10%)</th>
                            <th>Total bayar</th>
                            <th>Tanggal Titip</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

<!-- Tambah Data -->
<div class="modal fade" id="confirm-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Penitipan</h4>
    </div>
    <form id="insertdata" method="POST">
        @csrf
        <div class="modal-body">  
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Nama Pemilik : </label>
            <input type="text" name="nama_peminjam" id="" class="form-control" placeholder="Masukkan nama peminjam"
            style="width: 100%;" required>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">No. Hp : </label>
            <input type="text" name="phone" id="" class="form-control" placeholder="Masukkan No.Hp"
            style="width: 100%;" required>
        </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Jumlah Barang : </label>
        <input type="text" id="stok" name="jumlah_barang" class="form-control" placeholder="Masukkan jumlah barang"
        style="width: 100%;" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Lama Penitipan : </label>
        <input type="text" id="" name="lama" class="form-control" placeholder="Lama penitipan"
        style="width: 100%;" required onkeypress="return hanyaAngka(event)">
    </div>
</div>

<div class="modal-footer">
  <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button type="submit" id="data" class="btn btn-primary">Tambah</button>
</div>

</form>
</div>
</div>
</div>
<!-- Akhir Tambah Data -->


<!-- Edit Data -->
<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Penitipan</h4>
    </div>
    <form id="form-edit" method="POST">
        @csrf
        <div class="modal-body">  
          <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">Nama Pemilik : </label>
            <input type="text" name="nama_peminjam" id="pemilik" class="form-control" placeholder="Masukkan nama peminjam"
            style="width: 100%;" required>
        </div>
        <div class="form-group" style="width: 100%;">
            <label for="nama" class="control-label">No. Hp : </label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan No. Hp"
            style="width: 100%;" required>
        </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Jumlah Barang : </label>
        <input type="text" id="jumlah" name="jumlah_barang" class="form-control" placeholder="Masukkan jumlah barang"
        style="width: 100%;" required>
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="stok" class="control-label">Lama Penitipan : </label>
        <input type="text" id="lama" name="lama" class="form-control" placeholder="Lama penitipan"
        style="width: 100%;" required onkeypress="return hanyaAngka(event)">
    </div>
</div>
<input type="hidden" name="hiddenid" id="hidden-id">
<input name="_method" type="hidden" value="PUT">
<div class="modal-footer">
  <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button type="submit" id="data" class="btn btn-primary">Edit</button>
</div>

</form>
</div>
</div>
</div>
<!-- Akhir Edit Data -->
@endsection

@section('script')
<script>
 function sukses(status, pesan, nama, total) {
      Swal.fire({
        type: status,
        title: pesan,
        text: nama+" Silakan melakukan pembayaran Rp."+total,
        showConfirmButton: true,
        timer: 25500,
        button: "Ok"
    })
  }
  
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
  
    <script type="text/javascript">

function cek(role) {
   if(role == 'kasir' || role == 'superadmin') {
    $('#confirm-add').modal('show');
   } else {
    Swal.fire({
        type: 'error',
        title:  'Hanya Kasir atau SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
   }
 }

      // function balik_item(total_bayar, nama) {
function kembalikan(role) {
  if(role == 'kasir' || role == 'superadmin') {

        $('body').on('click', '#balik-item', function(e){
      e.preventDefault();
      var me = $(this),
                url  = me.attr('href'),
                total= me.attr('total'),
                nama= me.attr('nama'),
                token = $('meta[name="csrf-token"]').attr('content');
        Swal.fire({
        title: 'Rp. '+total,
        text: "Atas nama "+nama,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Kembalikan Barang ?',
        timer: 6500
      }).then((result) => {
          if (result.value) {
            
                $.ajax({
                  url: url,
                  method: "POST",
                  data : {
                    '_method' : 'PUT',
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
      })
   } else {
     Swal.fire({
        type: 'error',
        title:  'Hanya Kasir atau SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
    }
  }


function hapus_cek(role) {
  if(role == 'kasir' || role == 'superadmin') {

$('body').on('click', '#del_id', function(e){
      e.preventDefault();
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
   } else {
    Swal.fire({
        type: 'error',
        title:  'Hanya Kasir atau SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
  }
}

$('#form-edit').submit(function(e){
    e.preventDefault();

    var id  = eval(document.getElementById('hidden-id').value);

    // console.log(id);
    var request = new FormData(this);
    var endpoint= "items/"+id;
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              $('#form-edit')[0].reset();
              $('#edit-data').modal('hide');
             
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

  var tabel = null;
  tabel = $(document).ready(function(){
    $('#data-table').DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ordering": true,
        // "scrollX" : true,
        "order": [[ 0, 'desc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tablebarang")}}', // URL file untuk proses select datanya
                "type": "GET"
              },
        "columns": [
            { "data": "id" },
            { "data": "phone" },
            { "data": "nama_peminjam" },
            { "data": "jumlah_barang" },
            { "data": "lama_pinjam" },
            { "data": "harga" },
            { "data": "ppn" },
            { "data": "total_bayar" },
            { "data": "created_at" },
            { "data": "namaadmin" },
            { "data": "action" }
        ]
    });
});

 $('#insertdata').submit(function(e){
    e.preventDefault();
    
    var request = new FormData(this);
    var endpoint= 'items';
          $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: "json",
            success:function(data){
              $('#insertdata')[0].reset();
              $('#confirm-add').modal('hide');
             
              sukses(data.status, data.pesan, data.nama, data.total);
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
});

function cek_edit(role) {
  if(role == 'kasir' || role == 'superadmin') {

 $(document).on('click', '#edit-item', function(){
    var id = $(this).attr('data-id');
    $.ajax({
      'url': "items/"+id+"/edit",
      'dataType': 'json',
      success:function(html){
        $('#pemilik').val(html.data.nama_peminjam);
        $('#jumlah').val(html.data.jumlah_barang);
        $('#lama').val(html.data.lama_pinjam);
        $('#phone').val(html.data.phone);
        $('#hidden-id').val(html.data.id);
        $('#edit-data').modal('show');
      }

    })
});
    
   } else {
    Swal.fire({
        type: 'error',
        title:  'Hanya Kasir atau SuperAdmin',
        showConfirmButton: true,
        timer: 5500,
        button: "Ok"
    })
}
}
</script>
@endsection