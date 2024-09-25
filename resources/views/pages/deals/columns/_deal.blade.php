<!--begin::deal details-->
<div class="d-flex flex-column">
    <b class="text-gray-800 mb-1">
         {{ strlen($deal->deal_name) > 30 ? substr($deal->deal_name, 0, 30) . " ..." : $deal->deal_name }}
    </b>
</div>
<!--begin::deal details-->
