@extends('master')
@section('content')

{{-- @dd($projects)
@foreach ($projects as $key => $project)

@endforeach --}}
<div class="content">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 header-title">Check Seo-rank</h4>

                <form class="form-horizontal" action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Key Serprobot</label>
                        <div class="col-8 col-xl-9">
                            <input class="form-control" id="inputEmail3" placeholder="Eg: b2c40bfc55161461279f9fe12345e1a0" name="apikey" required>
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-8 col-xl-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
@endsection
