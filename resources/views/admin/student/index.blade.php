@extends('admin.layouts.main')
@section('content')
<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">{{trans('web.student_list')}}
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											
                                                <a href="{{route('student.add')}}">
												<button type="button" class="btn btn-light-primary font-weight-bolder" aria-haspopup="true" aria-expanded="false">
												{{trans('web.add')}}</button>
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
                                                    <th>{{trans('web.student_id')}}</th>
													<th>{{trans('web.name')}}</th>
													<th>{{trans('web.phone')}}</th>
                                                    <th>{{trans('web.edit_del_student')}}</th>
											</thead>
											<tbody>
												@foreach($list as $student)
												<tr>
                                                    <td>{{$student->id}}</td>
                                                    <td>{{$student->mssv}}</td>
													<td>{{$student->hoten}}</td>
													<td>{{$student->sdt}}</td>
													<td>
														<a href="{{route('student.edit', ['id'=>$student->id])}}"><button class="btn btn-primary">{{trans('web.edit')}}</button></a>
														<a href="{{route('student.del', ['id'=>$student->id])}}" onclick="return confirm('Bạn có chắc chắn xóa sinh viên này không ?')"><button class="btn btn-success">{{trans('web.del')}}</button></a>
													</td>
												</tr>
												@endforeach
											</tbody>
											
											
										</table>
										<!--end: Datatable-->
									</div>
								</div>
@endsection