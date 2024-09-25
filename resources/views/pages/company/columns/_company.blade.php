<!--begin::company details-->
<div class="d-flex flex-column">
    <b class="text-gray-800 mb-1">
         {{ strlen($company->name) > 30 ? substr($company->name, 0, 30) . " ..." : $company->name }}
    </b>
</div>
<!--begin::company details-->
