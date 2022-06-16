@extends('admin.layouts.main')
@section('content')
<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">Danh Quyền
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											
                                                <a href="{{route('roles.add')}}">
												<button type="button" class="btn btn-light-primary font-weight-bolder" aria-haspopup="true" aria-expanded="false">
												Thêm Quyền</button>
                                                </a>
												<!--begin::Dropdown Menu-->
												
												<!--end::Dropdown Menu-->
											
											<!--end::Dropdown-->
											<!--begin::Button-->
											
											<!--end::Button-->
										</div>
									</div>
									@include('admin.notify')
									<div class="card-body" method = "POST">
										<!--begin: Datatable-->
										<table class="table table-bordered table-checkable" id="kt_datatable">
											<thead>
												<tr>
													<!-- <th>ID</th> -->
													<th>ID</th>
													<th>Quyền</th>
													<th>Sửa/Xóa Quyền</th>
											</thead>
											<tbody>
												@foreach($list as $roles)
												<tr>
                                                    <td>{{$roles->id}}</td>
													<td>{{$roles->name}}</td>
													<td>
														<a href="{{route('roles.edit',['id'=>$roles->id])}}"><button class="btn btn-primary">Sửa</button></a>
														<a href="{{route('roles.del',['id'=>$roles->id])}}" onclick="return confirm('Bạn có chắc chắn xóa quyền này không ?')"><button class="btn btn-success">Xóa</button></a>
													</td>
												</tr>
												@endforeach
											</tbody> 
											
											
										</table>
										<!--end: Datatable-->
									</div>
								</div>
@endsection