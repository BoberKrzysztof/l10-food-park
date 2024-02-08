<div class="tab-pane fade show" id="stripe-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card-body border">
        <form action="{{ route('admin.stripe-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">Stripe Status</label>
                <select name="stripe_status" class="select3 form-control" id="">
                    <option @selected(@$paymentGateway['stripe_status'] === 1) value="1">Active</option>
                    <option @selected(@$paymentGateway['stripe_status'] === 0) value="0">Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Stripe Country Name</label>
                <select name="stripe_country" class="select3 form-control" id="">
                    <option value="">Select</option>
                    @foreach (config('country_list') as $key => $country)
                        <option @selected(@$paymentGateway['stripe_country'] === $key) value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Stripe Currency</label>
                <select name="stripe_currency" class="select2 form-control" id="">
                    <option value="">Select</option>
                    @foreach (config('currencies.currency_list') as $currency)
                        <option @selected(@$paymentGateway['stripe_currency'] === $currency) value="{{ $currency }}">{{ $currency }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Currency Rate ( Per {{ config('settings.site_default_currency') }} )</label>
                <input type="text" class="form-control" name="stripe_rate" value="{{ @$paymentGateway['stripe_rate'] }}" />
            </div>

            <div class="form-group">
                <label for="">Stripe Key</label>
                <input type="text" class="form-control" name="stripe_api_key" value="{{ @$paymentGateway['stripe_api_key'] }}" />
            </div>

            <div class="form-group">
                <label for="">Stripe Secret Key</label>
                <input type="text" class="form-control" name="stripe_secret_key" value="{{ @$paymentGateway['stripe_secret_key'] }}" />
            </div>

            <div class="form-group">
                <label>Stripe Logo</label>
                <div id="image-preview-2" class="image-preview stripe-preview">
                    <label for="image-upload-2" id="image-label-2">Choose File</label>
                    <input type="file" name="stripe_logo" id="image-upload-2" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.stripe-preview').css({
                'background-image': 'url({{ @$paymentGateway["stripe_logo"] }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })

            if(jQuery().select2) {
                $(".select3").select2();
            }

            $.uploadPreview({
                input_field: "#image-upload-2",
                preview_box: "#image-preview-2",
                label_field: "#image-label-2",
                label_default: "Choose File",
                label_selected: "Change File",
                no_label: false,
                success_callback: null
            });
        })
    </script>
@endpush