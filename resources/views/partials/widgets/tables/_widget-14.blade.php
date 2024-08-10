<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">{{ $data['title'] }}</span>
			<span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $data['dateRange'] }}</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
				<!--begin::Table head-->
				<thead>
					<tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
						<th class="p-0 pb-3 min-w-175px text-start">{{ $data['name'] }}</th>
						<th class="p-0 pb-3 min-w-100px text-end">{{ $data['value'] }}</th>
						<th class="p-0 pb-3 min-w-100px text-end">{{ $data['time'] }}</th>
					</tr>
				</thead>
				<!--end::Table head-->
				<!--begin::Table body-->
				<tbody>
					@foreach($data['tableData'] as $row)
					<tr>
						<td>
							<div class="d-flex align-items-center">
							
								<div class="d-flex justify-content-start flex-column">
									<span class="text-gray-500 fw-semibold d-block fs-7">{{ $row['channel'] }}</span>
								</div>
							</div>
						</td>
						<td class="text-end pe-0">
							<span class="text-gray-600 fw-bold fs-6">{{ $row['value'] }}</span>
						</td>
						<td class="text-end pe-0">
							<!--begin::Label-->
							<span class="badge {{ $row['vs_1m_ago'] >= 0 ? 'badge-light-success' : 'badge-light-danger' }} fs-base">{!! getIcon($row['vs_1m_ago'] >= 0 ? 'arrow-up' : 'arrow-down', 'fs-5 text-' . ($row['vs_1m_ago'] >= 0 ? 'success' : 'danger') . ' ms-n1') !!}{{ $row['vs_1m_ago'] }}</span>
							<!--end::Label-->
						</td>
					</tr>
					@endforeach
				</tbody>
				<!--end::Table body-->
			</table>
		</div>
		<!--end::Table-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
