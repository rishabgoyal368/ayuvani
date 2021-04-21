@extends('Admin.Layout.app')
@section('title','Profile')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">Profile</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body ">
                        <form  method="post" id="profile_form" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="user_name">User Name</label>
                                    <input type="text" class="form-control" name="user_name" value="{{ @$profile['user_name'] }}" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ @$profile['email'] }}" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_number" value="{{ @$profile['mobile_number'] }}" placeholder="Mobile Number">
                                </div>
                            </div>
                            @csrf
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary">
                                <a id="back_redirect" class="btn btn-info">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $('#profile_form').validate({
        rules:{
            user_name:{
                required:true,
            },
            mobile_number:{
                required:true,
                minlength:7,
                maxlength:15,
                number: true,
            },
            email:{
                required:true,
            }
        },
    });
</script>
@endsection