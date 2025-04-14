@extends('master')

@section('konten')
  <h4>Selamat Datang <b>{{Auth::user()->name}}</b>, Anda Login sebagai <b>{{Auth::user()->level}}</b>.</h4>
@endsection