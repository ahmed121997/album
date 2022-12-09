@extends('layouts.app')
@section('links')
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-8 offset-2">
            <h4>Add pictures</h4>
            <form method="POST" action="{{route('pictures.store/{id}')}}" enctype="multipart/form-data">
                @csrf

                  <div class="input-group mb-3">
                    <input type="file" name="images[]" class="form-control" id="inputGroupFile02" multiple="multiple" accept="image/jpeg, image/png, image/jpg">

                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>

</div>

@endsection
