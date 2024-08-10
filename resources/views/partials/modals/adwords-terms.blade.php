<!--begin::Modal - Adwords-->
<div class="modal fade" id="adwords-terms-modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-5 d-flex flex-stack">
                <h2>Terms and Conditions</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-5 pt-5">
                <h4>1. Authorization and Access Refresh Token</h4>
                <p>Our application will access your Google Ads account to manage and retrieve advertising data. This involves:</p>
                <ul>
                    <li>Setting up the authorization process with Google Ads API.</li>
                    <li>Creating and refreshing access tokens required for accessing and managing ads.</li>
                </ul>

                <h4>2. List of All AdWords Accounts Under the Manager Account</h4>
                <p>Our application will retrieve information about your Google Ads accounts. This includes:</p>
                <ul>
                    <li>Fetching a list of all accounts associated with your authenticated user ads accounts.</li>
                    <li>Displaying these accounts for you to manage and monitor.</li>
                </ul>

                <h4>3. Campaign Data Retrieval</h4>
                <p>Our application will access and retrieve data related to your advertising campaigns. This involves:</p>
                <ul>
                    <li>Collecting information about your ad campaigns, including performance metrics.</li>
                    <li>Allowing you to view and analyze this data to optimize your advertising strategies.</li>
                </ul>

                <h4>Review Policies and Terms</h4>
                <p>Before granting access, you can review our Privacy Policy and Terms of Service.
                    For details, please visit our
                    <a target="_blank"  href="https://myclientwave.com/privacy-policy/">Policy</a> Page and
                    <a target="_blank" href="https://myclientwave.com/terms-and-conditions/">Terms and Conditions</a> Page.
                </p>

                <h5 class="text-danger">
                    By using our application, you agree to these terms and authorize the necessary access to your Google Ads account.
                </h5>
            </div>
            <!--end::Modal body-->
            <div class="modal-footer pb-5 border-0 justify-content-end">
                <!--begin::Agree-->
                <button class="btn btn-sm btn-primary" id="adwords-submit-modal" data-bs-dismiss="modal">
                    Agree
                </button>
                <!--end::Agree-->
                <!--begin::Close-->
                <button class="btn btn-sm btn-light-dark" data-bs-dismiss="modal">
                    Close
                </button>
                <!--end::Close-->
            </div>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Adwords-->
