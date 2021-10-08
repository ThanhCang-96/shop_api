@extends('admin.app')

@section('title', 'Account detail')

@section('content')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Profile</h4>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex align-items-center justify-content-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('user.index') }}">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
  <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body">
          @if(!empty($user['avatar']))
            <center class="m-t-30"> <img src="{{ asset('upload/avatar/'.$user['id'].'/'.$user['avatar']) }}" class="rounded-circle" width="150" />
          @else
            <center class="m-t-30"> <img src="{{ asset('upload/avatar/default/default.jpg') }}" class="rounded-circle" width="150" />
          @endif
            <h4 class="card-title m-t-10">{{ $user['name'] }}</h4>
            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
            <div class="row text-center justify-content-md-center">
              <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                  <font class="font-medium">254</font>
                </a></div>
              <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                  <font class="font-medium">54</font>
                </a></div>
            </div>
          </center>
        </div>
        <div>
          <hr>
        </div>
        <div class="card-body"> <small class="text-muted">Email address </small>
          <h6>{{ $user['email'] }}</h6> 
          <small class="text-muted p-t-30 db">Phone</small>
          @if(!empty($user['phone']))
            <h6>{{ $user['phone'] }}</h6>
          @else
            <h6>NO PHONE</h6>
          @endif
          <small class="text-muted p-t-30 db">Address</small>
          @if(!empty($user['address']))
            <h6>{{ $user['address'] }}</h6>
          @else
            <h6>NO ADDRESS</h6>
          @endif
          <small class="text-muted p-t-30 db">Country</small>
          @if(!empty($user['country_id']))
            <h6>{{ $user->country->name }}</h6>
          @else
            <h6>NO COUNTRY</h6>
          @endif
          <!-- <div class="map-box">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
              width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>  -->
          <small class="text-muted p-t-30 db">Social Profile</small>
          <br />
          <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
          <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
          <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
        </div>
      </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('user.update',[$user['id']]) }}" class="form-horizontal form-material" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
              <label class="col-md-12">Full Name</label>
              <div class="col-md-12">
                <input type="text" value="{{ $user['name'] }}" class="form-control form-control-line" name="name">
              </div>
            </div>
            <div class="form-group">
              <label for="example-email" class="col-md-12">Email</label>
              <div class="col-md-12">
                <input type="email" value="{{ $user['email'] }}" class="form-control form-control-line"
                  name="email" id="example-email">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Password</label>
              <div class="col-md-12">
                <input type="password" class="form-control form-control-line" name="password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Phone No</label>
              <div class="col-md-12">
                <input type="text" value="{{ $user['phone'] }}" class="form-control form-control-line" name="phone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Address</label>
              <div class="col-md-12">
                <input type="text" value="{{ $user['address'] }}" class="form-control form-control-line" name="address">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12">Select Country</label>
              <div class="col-sm-12">
                <select class="form-control form-control-line" name="country_id">
                  @foreach($countries as $country)
                    <option
                      @if($country['id']==$user['country_id'])
                        selected='selected'
                      @endif
                      value="{{ $country['id'] }}"
                      @if($country['active']==0)
                        disabled
                      @endif
                    >{{ $country['name'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12">Level</label>
              <div class="col-sm-12">
                <select class="form-control form-control-line" name="level">
                  <option value="0"
                    @if($user['level']==0)
                      selected='selecdted'
                    @endif
                  >Customer</option>
                  <option value="1"
                    @if($user['level']==1)
                      selected='selecdted'
                    @endif
                  >Admin</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Avatar</label>
              <div class="col-md-12">
                <input type="file" name="avatar" class="form-control form-control-line">
              </div>
            </div>
            <div class="form-group">
              @if($user['level']==1 && $user['id'] != Auth::id())
                <button class="btn btn-success" disabled>Update Profile</button>
              @else
                <button class="btn btn-success">Update Profile</button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Column -->
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