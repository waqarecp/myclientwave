<!--begin::utilitycompany details-->
<div class="d-flex flex-column">
    <a href="{{ route('utility-companies.show', $utilitycompany) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ strlen($utilitycompany->utility_company_name) > 30 ? substr($utilitycompany->utility_company_name, 0, 30) . " ..." : $utilitycompany->utility_company_name }}
    </a>
</div>
<!--begin::utilitycompany details-->
