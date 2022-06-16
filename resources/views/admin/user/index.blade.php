@extends('admin.layouts.main')
@section('content')
<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">Danh Sách User
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											
                                                <a href="{{route('user.add')}}">
												<button type="button" class="btn btn-light-primary font-weight-bolder" aria-haspopup="true" aria-expanded="false">
												Thêm User</button>
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
                                                    <th>Họ Và Tên</th>
													<th>Email</th>
													<th>Quyền</th>
                                                    <th>Sửa/Xóa User</th>
											</thead>
											<tbody>
												@foreach($list as $user)
												<tr>
													<td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
													<td>{{$user->email}}</td>
													<td>{{$user->nameRole}}</td>
													<td>
														<a href="{{route('user.edit', ['id'=>$user->id])}}"><button class="btn btn-primary">Sửa</button></a>
														<a href="{{route('user.del', ['id'=>$user->id])}}" onclick="return confirm('Bạn có chắc chắn xóa user này không ?')"><button class="btn btn-success">Xóa</button></a>
													</td>
												</tr>
												@endforeach
											</tbody>
											
											
										</table>
										<!--end: Datatable-->
									</div>
								</div>
@endsection