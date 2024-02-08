<div class="tab-pane fade show" id="razorpay-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card-body border">
        <form action="{{ route('admin.razorpay-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">Razorpay Status</label>
                <select name="razorpay_status" class="select3 form-control" id="">
                    <option @selected(@$paymentGateway['razorpay_status'] === 1) value="1">Active</option>
                    <option @selected(@$paymentGateway['razorpay_status'] === 0) value="0">Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Razorpay Country Name</label>
                <select name="razorpay_country" class="select3 form-control" id="">
                    <option value="">Select</option>
                    @foreach (config('country_list') as $key => $country)
                        <option @selected(@$paymentGateway['razorpay_country'] === $key) value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Razorpay Currency</label>
                <select name="razorpay_currency" class="select2 form-control" id="">
                    <option value="">Select</option>
                    @foreach (config('currencies.currency_list') as $currency)
                        <option @selected(@$paymentGateway['razorpay_currency'] === $currency) value="{{ $currency }}">{{ $currency }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Currency Rate ( Per {{ config('settings.site_default_currency') }} )</label>
                <input type="text" class="form-control" name="razorpay_rate" value="{{ @$paymentGateway['razorpay_rate'] }}" />
            </div>

            <div class="form-group">
                <label for="">Razorpay Key</label>
                <input type="text" class="form-control" name="razorpay_api_key" value="{{ @$paymentGateway['razorpay_api_key'] }}" />
            </div>

            <div class="form-group">
                <label for="">Razorpay Secret Key</label>
                <input type="text" class="form-control" name="razorpay_secret_key" value="{{ @$paymentGateway['razorpay_secret_key'] }}" />
            </div>

            <div class="form-group">
                <label>Razorpay Logo</label>
                <div id="image-preview-3" class="image-preview razorpay-preview">
                    <label for="image-upload-3" id="image-label-3">Choose File</label>
                    <input type="file" name="razorpay_logo" id="image-upload-3" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.razorpay-preview').css({
                'background-image': 'url({{ @$paymentGateway["razorpay_logo"] }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })

            if(jQuery().select2) {
                $(".select3").select2();
            }

            $.uploadPreview({
                input_field: "#image-upload-3",
                preview_box: "#image-preview-3",
                label_field: "#image-label-3",
                label_default: "Choose File",
                label_selected: "Change File",
                no_label: false,
                success_callback: null
            });
        })
    </script>
@endpush