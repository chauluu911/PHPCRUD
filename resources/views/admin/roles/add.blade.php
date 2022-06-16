@extends('admin.layouts.main')
@section('content')
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <h1 class="card-title">Thêm Quyền</h1>

    </div>
    @include('admin.notify')
    <!--begin::Form-->
    <form method="POST" action="">
        @csrf
        <div class="card-body">

            <!-- <div class="form-group row">
                <label class="col-2 col-form-label">ID</label>
                <div class="col-10">
                    <input class="form-control" name="id" type="number" placeholder="Nhập ID" id="example-text-input" />
                </div>
            </div> -->
            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label">Thêm quyền</label>
                <div class="col-10">
                    <input class="form-control" name="name" type="text" placeholder="Nhập quyền" id="example-search-input" />
                </div>
            </div>
            <!--begin: Code-->
            <div class="example-code mt-10">
                <div class="example-highlight">
                    <pre style="height:400px">
                                                            </pre>
                </div>
            </div>
            <!--end: Code-->
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Submit</button> 
                    <button type="reset" class="btn btn-secondary">Cancel</button>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection