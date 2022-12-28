@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="nav-icon fas fa-user-shield"></i> {{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('user')}}">User</a></li>
                        <li class="breadcrumb-item active">{{$key}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form role="form" id="formWizard" class="form--wizard" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Basic Information</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('success') }}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label> Name*</label>
                                <input type="text" name="name" maxlength="191" id="name" placeholder="Name" class="form-control required" autocomplete="off" value="{{ @$user->name }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label> Phone Number*</label>
                                <input type="number" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control required" autocomplete="off" value="{{ @$user->phone_number }}" required>
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label> Department*</label>
                                <select class="form-control required" name="department" id="department" required>
                                    <option value="">Select Department</option>
                                    @if(@$departments->isNotEmpty())
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id}}" {{(@$user->department_id==$department->id)?'selected':''}}>{{ $department->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label> Designation*</label>
                                <select class="form-control required" name="designation" id="designation" required>
                                    <option value="">Select Designation</option>
                                    @if(@$designations->isNotEmpty())
                                    @foreach($designations as $designation)
                                    <option value="{{ $designation->id}}" {{(@$user->designation_id==$designation->id)?'selected':''}}>{{ $designation->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="submit" name="btn_save" value="Submit" class="btn btn-primary pull-left submitBtn">
                        <button type="reset" id="reset_btn" class="btn btn-default">Cancel</button>
                        <img class="animation__shake loadingImg" src="{{asset('backend/dist/img/loading.gif')}}" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection