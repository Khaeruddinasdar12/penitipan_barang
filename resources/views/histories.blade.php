@extends('layouts.template1')
@section('title') Riwayat penitipan @endsection

@section('content')
	<div class="right_col" role="main">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Riwayat Penitipan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="data-table" class="table table-striped table-bordered" style="width: 100% !important">
                       <thead>
                        <tr>
                            <th>Id</th>
                            <th>No. Hp</th>
                            <th>Nama Pemilik</th>
                            <th>Jumlah Barang</th>
                            <th>Lama Titip</th>
                            <th>Harga</th>
                            <th>PPN(10%)</th>
                            <th>Total Bayar</th>
                            <th>Tanggal Titip</th>
                            <th>Tanggal Kembali</th>
                            <th>Created by</th>
                            <th>Confirm by</th>
                            <th>Action</th>
                        </tr>
						          </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('script')
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
    <script type="text/javascript">
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
        "order": [[ 0, 'desc' ]],
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],
        "ajax":  {
                "url":  '{{route("tablehistories")}}', // URL file untuk proses select datanya
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
            { "data": "tanggal_kembali" },
            { "data": "namaadmin" },
            { "data": "updated_by" },
            { "data": "action" }
        ]
    });
});
    </script>
@endsection