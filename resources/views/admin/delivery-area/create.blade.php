@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Delivery Area</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Create Delivery Area</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.delivery-area.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Area Name</label>
                    <input type="text" class="form-control" name="area_name" />
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Minimum Delivery Time</label>
                            <input type="text" class="form-control" name="min_delivery_time" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Maximum Delivery Time</label>
                            <input type="text" class="form-control" name="max_delivery_time" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Delivery Fee</label>
                            <input type="text" class="form-control" name="delivery_fee" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</section>
@endsection