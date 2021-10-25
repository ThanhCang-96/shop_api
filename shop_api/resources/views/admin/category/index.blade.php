@extends('admin.app')

@section('title','Category')

@section('content')
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Categories</h4>
          <!-- <h6 class="card-subtitle">Using the most basic table markup, here’s how <code>.table</code>-based tables look
            in Bootstrap. All table styles are inherited in Bootstrap 4, meaning any nested tables will be styled in the
            same manner as the parent.</h6> -->
          <!-- <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With
            Outside Padding</h6> -->

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Category name</th>
                  <th scope="col" colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>

                <!-- printf data coutries -->
                @foreach($data as $key=>$val)
                  <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $val['category_name'] }}</td>
                    <td>
                      <a href="{{ route('category.edit',['id'=>$val['id']]) }}">
                        <i class="fas fa-edit"></i>Edit
                      </a>
                    </td>
                    <td>
                      <a onclick="return confirm('Are you sure?')" href="{{ route('category.delete',['id'=>$val['id']]) }}">
                        <i class="fas fa-minus-circle"></i>Delete
                      </a>
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td>
                    <a href="{{ route('category.create') }}">
                      <i class="fas fa-plus-square"></i>New brand</td>
                    </a>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- <h6 class="card-title"><i class="m-r-5 font-18 mdi mdi-numeric-2-box-multiple-outline"></i> Table Without
            Outside Padding</h6> -->
        </div>
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