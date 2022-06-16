@extends('admin.layouts.main')
@section('content')
<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">Danh Sách Giảng Viên
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											
                                                <a href="{{route('teacher.addgv')}}">
												<button type="button" class="btn btn-light-primary font-weight-bolder" aria-haspopup="true" aria-expanded="false">
												Thêm Giảng Viên</button>
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
                                                    <th>Mã Giảng viên</th>
													<th>Họ Và Tên</th>
													<th>SDT</th>
                                                    <th>Môn học giảng dạy</th>
                                                    <th>Sửa/Xóa Giảng Viên</th>
											</thead>
											<tbody>
												@foreach($list as $teacher)
												<tr>
                                                    <td>{{$teacher->id}}</td>
                                                    <td>{{$teacher->magv}}</td>
													<td>{{$teacher->tengv}}</td>
													<td>{{$teacher->sdt}}</td>
                                                    <td>{{$teacher->giangday}}</td>
													<td>
														<a href="{{route('teacher.editgv', ['id' => $teacher->id])}}"><button class="btn btn-primary">Sửa</button></a>
														<a href="{{route('teacher.del', ['id'=> $teacher->id])}}" onclick="return confirm('Bạn có chắc chắn xóa sinh viên này không ?')"><button class="btn btn-success">Xóa</button></a>
													</td>
												</tr>
												@endforeach
											</tbody>
											
										</table>
										<!--end: Datatable-->
									</div>
								</div>
@endsection