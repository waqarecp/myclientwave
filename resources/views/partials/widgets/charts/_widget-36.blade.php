<!-- Widget 36 -->

    @foreach($chartDataArray as $index => $chartData)
	<div class="col-xl-6">
        <div class="card card-flush overflow-hidden h-lg-100">
            <!-- Header -->
            <div class="card-header pt-5">
                <!-- Title -->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-900">{{ $chartData['title'] }}</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $chartData['dateRange'] }}</span>
                </h3>
                <!-- Toolbar -->
                <div class="card-toolbar">
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">  {{ format_number((float)$chartData['number']) }}</span>
                </div>
            </div>
            <!-- Card body -->
            <div class="card-body d-flex justify-content-between align-items-center flex-column">
                <span class="badge badge-light-{{ $chartData['percentageChange'] < 1 ? 'danger' : 'success' }}  fs-base">
                    <i class="ki-duotone ki-arrow-{{ $chartData['percentageChange'] < 1 ? 'down' : 'up' }} fs-5 text-{{ $chartData['percentageChange'] < 1 ? 'danger' : 'success' }} ms-n1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>{{ $chartData['percentageChange'] }}
                </span>
                <span class="fw-semibold fs-6 text-gray-500">{{ $chartData['comparisonText'] }}</span>
            </div>
            <!-- Chart -->
            <div class="card-body d-flex align-items-end p-0">
                <div id="kt_charts_widget_36_{{ $index }}" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                
            </div>
             <!-- Slider -->
             <div class="card-body d-flex align-items-end p-0">
                <input type="range" id="chart-slider-{{ $index }}" min="0" step="1" style="width: 100%;">
            </div>
        </div>
	</div>
    @endforeach


<script>

 var chartDataArray = {!! json_encode($chartDataArray) !!};


</script>
