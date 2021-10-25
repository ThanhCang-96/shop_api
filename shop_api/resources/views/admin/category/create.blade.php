@extends('admin.app')

@section('title', 'New category');

@section('content')
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-12">
      <div class="card card-body">
        <h4 class="card-title">New Category Form</h4>
        <!-- <h5 class="card-subtitle"> All bootstrap element classies </h5> -->
        <form method="POST" class="form-horizontal m-t-30">
          @csrf
          <div class="form-group">
            <label><span class="help">Category Name</span></label>
            <input type="text" class="form-control" placeholder="Category name" name="category_name">
            <button style="margin-top: 10px;">Create</button>
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