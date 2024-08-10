<!--begin::Recently viewed-->
<div class="mb-5" data-kt-search-element="main">
	<!--begin::Heading-->
	<div class="d-flex flex-stack fw-semibold mb-4">
		<!--begin::Label-->
		{{-- <span class="text-muted fs-6 me-2">Recent Searches Dealers:</span> --}}
		<!--end::Label-->
	</div>
	<!--end::Heading-->
	<!--begin::Items-->
	<div class="scroll-y mh-200px mh-lg-325px">
		<!--begin::Item-->
		<div class="d-flex align-items-center mb-5">
			<!--begin::Symbol-->
			<div class="symbol symbol-40px me-4">
				{{-- <span class="symbol-label bg-light">{!! getIcon('laptop', 'fs-2 text-primary') !!}</span> --}}
			</div>
			<!--end::Symbol-->
			<!--begin::Title-->
			<div class="d-flex flex-column">
				<a href="#" id="searchResultsContainer" class=" searchDealer fs-6 text-gray-800 text-hover-primary fw-semibold"></a>

			</div>
			<!--end::Title-->
		</div>
		<!--end::Item-->
		<!--begin::Item-->
		
		
	</div>
	<!--end::Items-->
</div>
<!--end::Recently viewed-->
{{-- <script>
    // Function to handle search input and update URL
    function handleSearchInput() {
        var searchQuery = document.getElementById('searchInput').value.trim();
        var newUrl = window.location.pathname + '?search=' + encodeURIComponent(searchQuery);
        window.history.pushState({path: newUrl}, '', newUrl);
        loadSearchResults(searchQuery);
    }

    // Function to load search results
    async function loadSearchResults(searchQuery) {
        try {
            var analyticsAccounts = await fetchAnalyticsAccounts(searchQuery);
            var searchResultsContainer = document.getElementById('searchResultsContainer');
            searchResultsContainer.innerHTML = '';

            analyticsAccounts.forEach(function(account) {
                var resultItemDiv = document.createElement('div');
                resultItemDiv.classList.add('d-flex', 'align-items-center', 'mb-5');

                var symbolDiv = document.createElement('div');
                symbolDiv.classList.add('symbol', 'symbol-40px', 'me-4');
                var symbolLabelSpan = document.createElement('span');
                symbolLabelSpan.classList.add('symbol-label', 'bg-light');
                symbolLabelSpan.innerHTML = '<i class="bi bi-laptop fs-2 text-primary"></i>';
                symbolDiv.appendChild(symbolLabelSpan);

                var titleDiv = document.createElement('div');
                titleDiv.classList.add('d-flex', 'flex-column');
                var anchor = document.createElement('a');
                anchor.href = '#';
                anchor.classList.add('searchDealer', 'fs-6', 'text-gray-800', 'text-hover-primary', 'fw-semibold');
                anchor.textContent = account;
                titleDiv.appendChild(anchor);

                resultItemDiv.appendChild(symbolDiv);
                resultItemDiv.appendChild(titleDiv);

                searchResultsContainer.appendChild(resultItemDiv);
            });
        } catch (error) {
            console.error('Error processing search:', error);
        }
    }

    // Function to fetch analytics accounts
    function fetchAnalyticsAccounts(searchQuery) {
        return fetch('/analytics-accounts?search=' + encodeURIComponent(searchQuery))
            .then(response => response.json())
            .catch(error => console.error('Error fetching analytics accounts:', error));
    }

    // Initial loading of search results based on URL
    document.addEventListener('DOMContentLoaded', function() {
        var searchQuery = new URLSearchParams(window.location.search).get('search') || '';
        document.getElementById('searchInput').value = searchQuery;
        loadSearchResults(searchQuery);
    });

    // Attach input event listener to the search input field
    document.getElementById('searchInput').addEventListener('input', handleSearchInput);
    
</script> --}}