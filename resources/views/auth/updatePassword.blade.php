@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lupa Password</div>

                <div class="card-body">

                    <form action="{{ route('importCSV') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file">
                        <button type="submit">Import CSV</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
