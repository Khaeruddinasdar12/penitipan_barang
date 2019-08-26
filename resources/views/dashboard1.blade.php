@extends('layouts.template1')
@section('title') Dashboard @endsection

@section('content')
<div class="right_col" role="main">
          <div class="">
	<div class="row top_tiles">
              
              <a href="{{route('items')}}"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{$penitipan}}</div>
                  <h3>Sedang Menitip</h3>
                  <p>Jumlah orang yang sedang menitip barang</p>
                </div>
              </div>
            </a>
              <a href="{{route('histories')}}"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{$riwayat}}</div>
                  <h3>Riwayat Transaksi</h3>
                  <p>Jumlah yang pernah menitip barang</p>
                </div>
              </div>
              </a>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">{{$all}}</div>
                  <h3>Semua Transaksi</h3>
                  <p>Jumlah keseluruhan penitipan</p>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection