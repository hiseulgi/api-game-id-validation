@extends('layout.master')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <h1 class="page-title text-center">Product List Game {{$gamedetails[0]->game_code}}</h1>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="container">

    <form method="POST" action="{{ route('transaksi.index') }}" enctype="multipart/form-data">
      <input type="hidden" name="game_code" class="form-control" value="{{$gamedetails[0]->game_code}}">
      <input type="hidden" name="status" class="form-control" value="0">
      <input type="hidden" name="user_id" class="form-control" value="1">

      @csrf
      <div class="form-group">
        <label>Game ID</label>
        <input type="text" name="buyer_game_id" class="form-control">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="form-group">
        <label for="">Product</label>
        @foreach($gamedetails as $detail)

        <div class="form-check">
          <input type="radio" name="game_detail_id" value="{{$detail->id}}" class="form-check-input" onclick="change( {{ $detail->price }} )">
          <label class="form-check-label" for="flexRadioDefault2">
            {{$detail->product_name}} - Rp.{{$detail->price}}
          </label>
        </div>

        @endforeach
      </div>

      <div class="form-group">
        <label for="">Payment</label>
        @foreach($payments as $pay)

        <div class="form-check">
          <input type="radio" name="payment_method_id" value="{{$pay->id}}" class="form-check-input">
          <label class="form-check-label" for="flexRadioDefault2">
            {{$pay->name}}
          </label>
        </div>

        @endforeach
      </div>

      <div class="form-group">
        <label>Total</label>
        <input type="text" name="amount" class="form-control" id="amount" value="" readonly>
      </div>

      <div>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>

  </div>
  <script>
    function change(value) {
      document.getElementById("amount").value = value;
    }
  </script>
</div>
<!-- end row -->
@endsection