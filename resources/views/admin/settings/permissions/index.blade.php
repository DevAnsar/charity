@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">سطوح دسترسی</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    @foreach($roles as $role)
                                        <th>{{$role->name}}</th>
                                    @endforeach
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $key=>$permission)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$permission->name}}</th>
                                        @foreach($roles as $role)
                                            <th>
                                                <permission-change role_id="{{$role->id}}"
                                                                   permission_id="{{$permission->id}}"
                                                                   permission="{{$permission->name}}"
                                                                   is_checked="{{$role->hasPermissionTo($permission->name)}}"
                                                ></permission-change>
                                                {{--<input type="checkbox" @if($role->hasPermissionTo($permission->name)) checked @endif >--}}
                                            </th>
                                        @endforeach
                                        <th>
                                            @include('admin.settings.permissions.actions',['id'=>$permission->id])
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


    </div>
@endsection