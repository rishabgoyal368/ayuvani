@extends('User.Layout.app')
@section('title','Reset Password')
@section('content')

<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4 class=""> Reset Password</h4>

                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-body ">
                        <form  method="post" id="reset_password">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Current Password</label>
                                    <input type="password" class="form-control" name="old_password" value="" placeholder="Current Password">
                                </div>
                            </div>
                            
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password" value="" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm Password">
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
        $('#reset_password').validate({
            rules:{
                old_password:{
                    required:true,
                    minlength:8,
                    maxlength:20,
                },
                new_password:{
                    required:true,
                    minlength:8,
                    maxlength:20,
                },
                confirm_password:{
                    required:true,
                    minlength:8,
                    maxlength:20,
                    equalTo   : "#new_password",
                },
                messages:{
                    confirm_password:{
                        equalTo:"Confirm password is not same. Please enter again"
                    }
                },
            },
          });
</script>
@endsection