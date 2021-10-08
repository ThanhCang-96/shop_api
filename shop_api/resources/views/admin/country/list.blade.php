@extends('admin.app')

@section('title', 'Country')

@section('content')
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Country</h4>
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
                  <th scope="col">Name</th>
                  <th scope="col">Status</th>
                  <th scope="col" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>

                <!-- printf data coutries -->
                @foreach($data as $key=>$val)
                  <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $val['name'] }}</td>
                    @if($val['active'])
                      <td>Active</td>
                    @else
                      <td>Inactive</td>
                    @endif
                    <td>
                      <a href="{{ route('country.edit',['id'=>$val['id']]) }}">
                        <i class="fas fa-edit"></i>Edit
                      </a>
                    </td>
                    @if($val['active'])
                      <td>
                        <a href="{{ route('country.disable',$val['id']) }}">
                          <i class="fas fa-ban" style="color: red;"></i>Disable
                        </a>
                      </td>
                    @else
                      <td>
                        <a href="{{ route('country.enable',$val['id']) }}">
                          <i class="fas fa-plus-circle" style="color: green;"></i>Enable
                        </a>
                      </td>
                    @endif
                    
                    <td>
                      <a href="{{ route('country.delete',['id'=>$val['id']]) }}">
                        <i class="fas fa-minus-circle"></i>Delete
                      </a>
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td>
                    <a href="{{ route('country.store') }}">
                      <i class="fas fa-plus-square"></i>New country</td>
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