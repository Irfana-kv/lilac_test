@extends('layouts.main')
@section('content')
<div class="content-wrapper">
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



    <section class="blog-listing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                    </div>
                    <input type="text" name="search" id="search" placeholder="Search" class="form-control mb-4 required" autocomplete="off">
                    <div class="blog-listing-contents">
                        <div class="row">
                        
                        @include('include_users')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>








</div>

<script>
    $(document).on('keyup', '#search', function() {
        var search_param = $(this).val();
        if (search_param != '') {
            $('.userDiv').remove();
        }
        var _token = token;
        if (search_param) {
            $.ajax({
                type: 'POST',
                // dataType: 'json',
                data: {
                    search_param: search_param,
                    _token: _token
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  'user-search',
                success: function(response) {
                    if (response) {
                    $('.appendHere').after(response).remove();
                    } else {
                        Toast.fire({
                        title: "Error", text: 'Some error occurred', icon: 'error'
                    });                    }
                }
            });
        } else {
            
        }
    });
</script>



@endsection