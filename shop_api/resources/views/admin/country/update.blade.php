@extends('admin.app')

@section('title', 'Update Country');

@section('content')
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-12">
      <div class="card card-body">
        <h4 class="card-title">New Country Form</h4>
        <!-- <h5 class="card-subtitle"> All bootstrap element classies </h5> -->
        <form method="POST" class="form-horizontal m-t-30">
          @csrf
          <div class="form-group">
            <label><span class="help">Country Name</span></label>
            <input type="text" class="form-control" value="{{ $data['name'] }}" name="name">
            <label>Status</label>
            <select class="custom-select col-12" id="inlineFormCustomSelect" name="active">
              <option value="1"
                @if($data['active']==1)
                  selected='selected';
                @endif>Active
              </option>
              <option value="0"
                @if($data['active']==0)
                  selected='selected'
                @endif>
              Inactive</option>
            </select>
            <button style="margin-top: 10px;">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- End PAge Content -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Right sidebar -->
  <!-- ============================================================== -->
  <!-- .right-sidebar -->
  <!-- ============================================================== -->
  <!-- End Right sidebar -->
  <!-- ============================================================== -->
@endsection