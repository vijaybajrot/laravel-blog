@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
				All Pages 
				</div>
                <div class="panel-body">
                <div class="row">
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @stack('panel-actions')
      			    </div>
			    </div>
                @yield("panel-content")
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.multi-select').multiselect({
            maxHeight: 250,
            includeSelectAllOption:true
        });
    });
</script>
@endpush
