@extends('front.layouts')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h1 class="fw-bold fs-3">Student Information</h1>
        </div>
        <div class="card-body d-flex justify-content-around">
            <div class="w-25">
                <img src="https://github.com/mdo.png" width="100%" height="200px"  alt="">
            </div>
            <table class="table table-bordered w-50">
                    <tr>
                        <td>Name </td>
                        <td>Ashok</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Bharatpur-10</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Bharatpur-10</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Bharatpur-10</td>
                    </tr>
                    <tr>
                        <td>Room</td>
                        <td>Ten</td>
                    </tr>
                    <tr>
                       <td>Parents</td>
                       <td>ABCDE</td>
                    </tr>
            </table>
        </div>
      </div>
</div>

@endsection
