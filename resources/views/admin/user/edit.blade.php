@extends('admin.layouts.main')
@section('content')
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <h1 class="card-title">Sửa User</h1>

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
                <label for="example-search-input" class="col-2 col-form-label">Họ Và Tên</label>
                <div class="col-10">
                    <input class="form-control" value="{{$user->name}}" name="name" type="text" placeholder="Nhập họ và tên" id="example-search-input" />
                </div>
            </div>
            <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control" value="{{$user->email}}" name="email" type="email" placeholder="Nhập email" id="example-search-input" />
                </div>
            </div>
                        <div class="form-group row">
                <label for="example-search-input" class="col-2 col-form-label">Quyền</label>
                <div class="col-10">
                <select class="form-control" id="exampleSelectd" name='roles'>
                        @foreach($roles as $r)
                        @if($user->role_id==$r->id)
                        <option value="{{$r->id}}" selected>{{$r->name}}</option>
                        @else
                        <option value="{{$r->id}}">{{$r->name}}</option>
                        @endif
                        @endforeach 
                    </select>
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