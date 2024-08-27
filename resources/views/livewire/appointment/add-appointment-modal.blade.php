<div class="modal fade" id="kt_modal_add_appointment" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_appointment_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update Appointment' : 'Add New Appointment' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-2">
                <form
                    @if($this->edit_mode)
                    wire:submit.prevent="updateAppointment(Object.fromEntries(new FormData($event.target)))"
                    @else
                    wire:submit="createAppointment"
                    @endif
                    data-edit-mode="{{ $this->edit_mode ? 'edit' : 'add' }}" id="kt_modal_add_appointment_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="appointment_id" name="appointment_id" />
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_appointment_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_appointment_header" data-kt-scroll-wrappers="#kt_modal_add_appointment_scroll" data-kt-scroll-offset="200px">
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label class="required fw-semibold fs-6 mb-2">Lead</label>
                                <select data-dropdown-parent="body" wire:model.lazy="lead_id" id="lead_id" name="lead_id" aria-label="Select Lead" class="form-select form-select-solid border fw-semibold">
                                    <option value="">--- Select a Lead ---</option>
                                    @foreach($leads as $lead)
                                    <option value="{{$lead->id}}" data-street="{{$lead->street}}" data-city="{{$lead->city}}" data-state="{{$lead->state}}" data-zip="{{$lead->zip}}" data-country="{{$lead->country}}" data-address1="{{$lead->address_1}}" data-address2="{{$lead->address_2}}">{{$lead->first_name}} {{$lead->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('lead_id')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label class="required fw-semibold fs-6 mb-2">Call Center Representative</label>
                                <select data-dropdown-parent="body" wire:model.lazy="representative_user" name="representative_user" aria-label="Select Call Center Representative" class="form-select form-select-solid border fw-semibold">
                                    <option value="">--- Select a User ---</option>
                                    @foreach($roles as $role)
                                        <optgroup label="{{ ucwords($role->name) }}">
                                            @foreach($users as $user)
                                                @if($user->roles->contains($role))
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('representative_user')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Appointment Date</label>
                                <input placeholder="Enter Appointment Date" type="date" wire:model="appointment_date" name="appointment_date" class="form-control form-control-solid border mb-3 mb-lg-0" />
                                @error('appointment_date')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Appointment Time</label>
                                <input placeholder="Enter Appointment Time" type="time" wire:model="appointment_time" name="appointment_time" class="form-control form-control-solid border mb-3 mb-lg-0" />
                                @error('appointment_time')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="required fs-6 fw-semibold ">Country</label>
                                <select id="kt_ecommerce_select2_country" wire:model="appointment_country" class="form-select" name="appointment_country" id="appointment_country" data-kt-ecommerce-settings-type="select2_flags" data-placeholder="Select a country">
                                    <option></option>
                                    <option value="AF" data-kt-select2-country="assets/media/flags/afghanistan.svg">Afghanistan</option>
                                    <option value="AX" data-kt-select2-country="assets/media/flags/aland-islands.svg">Aland Islands</option>
                                    <option value="AL" data-kt-select2-country="assets/media/flags/albania.svg">Albania</option>
                                    <option value="DZ" data-kt-select2-country="assets/media/flags/algeria.svg">Algeria</option>
                                    <option value="AS" data-kt-select2-country="assets/media/flags/american-samoa.svg">American Samoa</option>
                                    <option value="AD" data-kt-select2-country="assets/media/flags/andorra.svg">Andorra</option>
                                    <option value="AO" data-kt-select2-country="assets/media/flags/angola.svg">Angola</option>
                                    <option value="AI" data-kt-select2-country="assets/media/flags/anguilla.svg">Anguilla</option>
                                    <option value="AG" data-kt-select2-country="assets/media/flags/antigua-and-barbuda.svg">Antigua and Barbuda</option>
                                    <option value="AR" data-kt-select2-country="assets/media/flags/argentina.svg">Argentina</option>
                                    <option value="AM" data-kt-select2-country="assets/media/flags/armenia.svg">Armenia</option>
                                    <option value="AW" data-kt-select2-country="assets/media/flags/aruba.svg">Aruba</option>
                                    <option value="AU" data-kt-select2-country="assets/media/flags/australia.svg">Australia</option>
                                    <option value="AT" data-kt-select2-country="assets/media/flags/austria.svg">Austria</option>
                                    <option value="AZ" data-kt-select2-country="assets/media/flags/azerbaijan.svg">Azerbaijan</option>
                                    <option value="BS" data-kt-select2-country="assets/media/flags/bahamas.svg">Bahamas</option>
                                    <option value="BH" data-kt-select2-country="assets/media/flags/bahrain.svg">Bahrain</option>
                                    <option value="BD" data-kt-select2-country="assets/media/flags/bangladesh.svg">Bangladesh</option>
                                    <option value="BB" data-kt-select2-country="assets/media/flags/barbados.svg">Barbados</option>
                                    <option value="BY" data-kt-select2-country="assets/media/flags/belarus.svg">Belarus</option>
                                    <option value="BE" data-kt-select2-country="assets/media/flags/belgium.svg">Belgium</option>
                                    <option value="BZ" data-kt-select2-country="assets/media/flags/belize.svg">Belize</option>
                                    <option value="BJ" data-kt-select2-country="assets/media/flags/benin.svg">Benin</option>
                                    <option value="BM" data-kt-select2-country="assets/media/flags/bermuda.svg">Bermuda</option>
                                    <option value="BT" data-kt-select2-country="assets/media/flags/bhutan.svg">Bhutan</option>
                                    <option value="BO" data-kt-select2-country="assets/media/flags/bolivia.svg">Bolivia, Plurinational State of</option>
                                    <option value="BQ" data-kt-select2-country="assets/media/flags/bonaire.svg">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA" data-kt-select2-country="assets/media/flags/bosnia-and-herzegovina.svg">Bosnia and Herzegovina</option>
                                    <option value="BW" data-kt-select2-country="assets/media/flags/botswana.svg">Botswana</option>
                                    <option value="BR" data-kt-select2-country="assets/media/flags/brazil.svg">Brazil</option>
                                    <option value="IO" data-kt-select2-country="assets/media/flags/british-indian-ocean-territory.svg">British Indian Ocean Territory</option>
                                    <option value="BN" data-kt-select2-country="assets/media/flags/brunei.svg">Brunei Darussalam</option>
                                    <option value="BG" data-kt-select2-country="assets/media/flags/bulgaria.svg">Bulgaria</option>
                                    <option value="BF" data-kt-select2-country="assets/media/flags/burkina-faso.svg">Burkina Faso</option>
                                    <option value="BI" data-kt-select2-country="assets/media/flags/burundi.svg">Burundi</option>
                                    <option value="KH" data-kt-select2-country="assets/media/flags/cambodia.svg">Cambodia</option>
                                    <option value="CM" data-kt-select2-country="assets/media/flags/cameroon.svg">Cameroon</option>
                                    <option value="CA" data-kt-select2-country="assets/media/flags/canada.svg">Canada</option>
                                    <option value="CV" data-kt-select2-country="assets/media/flags/cape-verde.svg">Cape Verde</option>
                                    <option value="KY" data-kt-select2-country="assets/media/flags/cayman-islands.svg">Cayman Islands</option>
                                    <option value="CF" data-kt-select2-country="assets/media/flags/central-african-republic.svg">Central African Republic</option>
                                    <option value="TD" data-kt-select2-country="assets/media/flags/chad.svg">Chad</option>
                                    <option value="CL" data-kt-select2-country="assets/media/flags/chile.svg">Chile</option>
                                    <option value="CN" data-kt-select2-country="assets/media/flags/china.svg">China</option>
                                    <option value="CX" data-kt-select2-country="assets/media/flags/christmas-island.svg">Christmas Island</option>
                                    <option value="CC" data-kt-select2-country="assets/media/flags/cocos-island.svg">Cocos (Keeling) Islands</option>
                                    <option value="CO" data-kt-select2-country="assets/media/flags/colombia.svg">Colombia</option>
                                    <option value="KM" data-kt-select2-country="assets/media/flags/comoros.svg">Comoros</option>
                                    <option value="CK" data-kt-select2-country="assets/media/flags/cook-islands.svg">Cook Islands</option>
                                    <option value="CR" data-kt-select2-country="assets/media/flags/costa-rica.svg">Costa Rica</option>
                                    <option value="CI" data-kt-select2-country="assets/media/flags/ivory-coast.svg">Côte d'Ivoire</option>
                                    <option value="HR" data-kt-select2-country="assets/media/flags/croatia.svg">Croatia</option>
                                    <option value="CU" data-kt-select2-country="assets/media/flags/cuba.svg">Cuba</option>
                                    <option value="CW" data-kt-select2-country="assets/media/flags/curacao.svg">Curaçao</option>
                                    <option value="CZ" data-kt-select2-country="assets/media/flags/czech-republic.svg">Czech Republic</option>
                                    <option value="DK" data-kt-select2-country="assets/media/flags/denmark.svg">Denmark</option>
                                    <option value="DJ" data-kt-select2-country="assets/media/flags/djibouti.svg">Djibouti</option>
                                    <option value="DM" data-kt-select2-country="assets/media/flags/dominica.svg">Dominica</option>
                                    <option value="DO" data-kt-select2-country="assets/media/flags/dominican-republic.svg">Dominican Republic</option>
                                    <option value="EC" data-kt-select2-country="assets/media/flags/ecuador.svg">Ecuador</option>
                                    <option value="EG" data-kt-select2-country="assets/media/flags/egypt.svg">Egypt</option>
                                    <option value="SV" data-kt-select2-country="assets/media/flags/el-salvador.svg">El Salvador</option>
                                    <option value="GQ" data-kt-select2-country="assets/media/flags/equatorial-guinea.svg">Equatorial Guinea</option>
                                    <option value="ER" data-kt-select2-country="assets/media/flags/eritrea.svg">Eritrea</option>
                                    <option value="EE" data-kt-select2-country="assets/media/flags/estonia.svg">Estonia</option>
                                    <option value="ET" data-kt-select2-country="assets/media/flags/ethiopia.svg">Ethiopia</option>
                                    <option value="FK" data-kt-select2-country="assets/media/flags/falkland-islands.svg">Falkland Islands (Malvinas)</option>
                                    <option value="FJ" data-kt-select2-country="assets/media/flags/fiji.svg">Fiji</option>
                                    <option value="FI" data-kt-select2-country="assets/media/flags/finland.svg">Finland</option>
                                    <option value="FR" data-kt-select2-country="assets/media/flags/france.svg">France</option>
                                    <option value="PF" data-kt-select2-country="assets/media/flags/french-polynesia.svg">French Polynesia</option>
                                    <option value="GA" data-kt-select2-country="assets/media/flags/gabon.svg">Gabon</option>
                                    <option value="GM" data-kt-select2-country="assets/media/flags/gambia.svg">Gambia</option>
                                    <option value="GE" data-kt-select2-country="assets/media/flags/georgia.svg">Georgia</option>
                                    <option value="DE" data-kt-select2-country="assets/media/flags/germany.svg">Germany</option>
                                    <option value="GH" data-kt-select2-country="assets/media/flags/ghana.svg">Ghana</option>
                                    <option value="GI" data-kt-select2-country="assets/media/flags/gibraltar.svg">Gibraltar</option>
                                    <option value="GR" data-kt-select2-country="assets/media/flags/greece.svg">Greece</option>
                                    <option value="GL" data-kt-select2-country="assets/media/flags/greenland.svg">Greenland</option>
                                    <option value="GD" data-kt-select2-country="assets/media/flags/grenada.svg">Grenada</option>
                                    <option value="GU" data-kt-select2-country="assets/media/flags/guam.svg">Guam</option>
                                    <option value="GT" data-kt-select2-country="assets/media/flags/guatemala.svg">Guatemala</option>
                                    <option value="GG" data-kt-select2-country="assets/media/flags/guernsey.svg">Guernsey</option>
                                    <option value="GN" data-kt-select2-country="assets/media/flags/guinea.svg">Guinea</option>
                                    <option value="GW" data-kt-select2-country="assets/media/flags/guinea-bissau.svg">Guinea-Bissau</option>
                                    <option value="HT" data-kt-select2-country="assets/media/flags/haiti.svg">Haiti</option>
                                    <option value="VA" data-kt-select2-country="assets/media/flags/vatican-city.svg">Holy See (Vatican City State)</option>
                                    <option value="HN" data-kt-select2-country="assets/media/flags/honduras.svg">Honduras</option>
                                    <option value="HK" data-kt-select2-country="assets/media/flags/hong-kong.svg">Hong Kong</option>
                                    <option value="HU" data-kt-select2-country="assets/media/flags/hungary.svg">Hungary</option>
                                    <option value="IS" data-kt-select2-country="assets/media/flags/iceland.svg">Iceland</option>
                                    <option value="IN" data-kt-select2-country="assets/media/flags/india.svg">India</option>
                                    <option value="ID" data-kt-select2-country="assets/media/flags/indonesia.svg">Indonesia</option>
                                    <option value="IR" data-kt-select2-country="assets/media/flags/iran.svg">Iran, Islamic Republic of</option>
                                    <option value="IQ" data-kt-select2-country="assets/media/flags/iraq.svg">Iraq</option>
                                    <option value="IE" data-kt-select2-country="assets/media/flags/ireland.svg">Ireland</option>
                                    <option value="IM" data-kt-select2-country="assets/media/flags/isle-of-man.svg">Isle of Man</option>
                                    <option value="IL" data-kt-select2-country="assets/media/flags/israel.svg">Israel</option>
                                    <option value="IT" data-kt-select2-country="assets/media/flags/italy.svg">Italy</option>
                                    <option value="JM" data-kt-select2-country="assets/media/flags/jamaica.svg">Jamaica</option>
                                    <option value="JP" data-kt-select2-country="assets/media/flags/japan.svg">Japan</option>
                                    <option value="JE" data-kt-select2-country="assets/media/flags/jersey.svg">Jersey</option>
                                    <option value="JO" data-kt-select2-country="assets/media/flags/jordan.svg">Jordan</option>
                                    <option value="KZ" data-kt-select2-country="assets/media/flags/kazakhstan.svg">Kazakhstan</option>
                                    <option value="KE" data-kt-select2-country="assets/media/flags/kenya.svg">Kenya</option>
                                    <option value="KI" data-kt-select2-country="assets/media/flags/kiribati.svg">Kiribati</option>
                                    <option value="KP" data-kt-select2-country="assets/media/flags/north-korea.svg">Korea, Democratic People's Republic of</option>
                                    <option value="KW" data-kt-select2-country="assets/media/flags/kuwait.svg">Kuwait</option>
                                    <option value="KG" data-kt-select2-country="assets/media/flags/kyrgyzstan.svg">Kyrgyzstan</option>
                                    <option value="LA" data-kt-select2-country="assets/media/flags/laos.svg">Lao People's Democratic Republic</option>
                                    <option value="LV" data-kt-select2-country="assets/media/flags/latvia.svg">Latvia</option>
                                    <option value="LB" data-kt-select2-country="assets/media/flags/lebanon.svg">Lebanon</option>
                                    <option value="LS" data-kt-select2-country="assets/media/flags/lesotho.svg">Lesotho</option>
                                    <option value="LR" data-kt-select2-country="assets/media/flags/liberia.svg">Liberia</option>
                                    <option value="LY" data-kt-select2-country="assets/media/flags/libya.svg">Libya</option>
                                    <option value="LI" data-kt-select2-country="assets/media/flags/liechtenstein.svg">Liechtenstein</option>
                                    <option value="LT" data-kt-select2-country="assets/media/flags/lithuania.svg">Lithuania</option>
                                    <option value="LU" data-kt-select2-country="assets/media/flags/luxembourg.svg">Luxembourg</option>
                                    <option value="MO" data-kt-select2-country="assets/media/flags/macao.svg">Macao</option>
                                    <option value="MG" data-kt-select2-country="assets/media/flags/madagascar.svg">Madagascar</option>
                                    <option value="MW" data-kt-select2-country="assets/media/flags/malawi.svg">Malawi</option>
                                    <option value="MY" data-kt-select2-country="assets/media/flags/malaysia.svg">Malaysia</option>
                                    <option value="MV" data-kt-select2-country="assets/media/flags/maldives.svg">Maldives</option>
                                    <option value="ML" data-kt-select2-country="assets/media/flags/mali.svg">Mali</option>
                                    <option value="MT" data-kt-select2-country="assets/media/flags/malta.svg">Malta</option>
                                    <option value="MH" data-kt-select2-country="assets/media/flags/marshall-island.svg">Marshall Islands</option>
                                    <option value="MQ" data-kt-select2-country="assets/media/flags/martinique.svg">Martinique</option>
                                    <option value="MR" data-kt-select2-country="assets/media/flags/mauritania.svg">Mauritania</option>
                                    <option value="MU" data-kt-select2-country="assets/media/flags/mauritius.svg">Mauritius</option>
                                    <option value="MX" data-kt-select2-country="assets/media/flags/mexico.svg">Mexico</option>
                                    <option value="FM" data-kt-select2-country="assets/media/flags/micronesia.svg">Micronesia, Federated States of</option>
                                    <option value="MD" data-kt-select2-country="assets/media/flags/moldova.svg">Moldova, Republic of</option>
                                    <option value="MC" data-kt-select2-country="assets/media/flags/monaco.svg">Monaco</option>
                                    <option value="MN" data-kt-select2-country="assets/media/flags/mongolia.svg">Mongolia</option>
                                    <option value="ME" data-kt-select2-country="assets/media/flags/montenegro.svg">Montenegro</option>
                                    <option value="MS" data-kt-select2-country="assets/media/flags/montserrat.svg">Montserrat</option>
                                    <option value="MA" data-kt-select2-country="assets/media/flags/morocco.svg">Morocco</option>
                                    <option value="MZ" data-kt-select2-country="assets/media/flags/mozambique.svg">Mozambique</option>
                                    <option value="MM" data-kt-select2-country="assets/media/flags/myanmar.svg">Myanmar</option>
                                    <option value="NA" data-kt-select2-country="assets/media/flags/namibia.svg">Namibia</option>
                                    <option value="NR" data-kt-select2-country="assets/media/flags/nauru.svg">Nauru</option>
                                    <option value="NP" data-kt-select2-country="assets/media/flags/nepal.svg">Nepal</option>
                                    <option value="NL" data-kt-select2-country="assets/media/flags/netherlands.svg">Netherlands</option>
                                    <option value="NZ" data-kt-select2-country="assets/media/flags/new-zealand.svg">New Zealand</option>
                                    <option value="NI" data-kt-select2-country="assets/media/flags/nicaragua.svg">Nicaragua</option>
                                    <option value="NE" data-kt-select2-country="assets/media/flags/niger.svg">Niger</option>
                                    <option value="NG" data-kt-select2-country="assets/media/flags/nigeria.svg">Nigeria</option>
                                    <option value="NU" data-kt-select2-country="assets/media/flags/niue.svg">Niue</option>
                                    <option value="NF" data-kt-select2-country="assets/media/flags/norfolk-island.svg">Norfolk Island</option>
                                    <option value="MP" data-kt-select2-country="assets/media/flags/northern-mariana-islands.svg">Northern Mariana Islands</option>
                                    <option value="NO" data-kt-select2-country="assets/media/flags/norway.svg">Norway</option>
                                    <option value="OM" data-kt-select2-country="assets/media/flags/oman.svg">Oman</option>
                                    <option value="PK" data-kt-select2-country="assets/media/flags/pakistan.svg">Pakistan</option>
                                    <option value="PW" data-kt-select2-country="assets/media/flags/palau.svg">Palau</option>
                                    <option value="PS" data-kt-select2-country="assets/media/flags/palestine.svg">Palestinian Territory, Occupied</option>
                                    <option value="PA" data-kt-select2-country="assets/media/flags/panama.svg">Panama</option>
                                    <option value="PG" data-kt-select2-country="assets/media/flags/papua-new-guinea.svg">Papua New Guinea</option>
                                    <option value="PY" data-kt-select2-country="assets/media/flags/paraguay.svg">Paraguay</option>
                                    <option value="PE" data-kt-select2-country="assets/media/flags/peru.svg">Peru</option>
                                    <option value="PH" data-kt-select2-country="assets/media/flags/philippines.svg">Philippines</option>
                                    <option value="PL" data-kt-select2-country="assets/media/flags/poland.svg">Poland</option>
                                    <option value="PT" data-kt-select2-country="assets/media/flags/portugal.svg">Portugal</option>
                                    <option value="PR" data-kt-select2-country="assets/media/flags/puerto-rico.svg">Puerto Rico</option>
                                    <option value="QA" data-kt-select2-country="assets/media/flags/qatar.svg">Qatar</option>
                                    <option value="RO" data-kt-select2-country="assets/media/flags/romania.svg">Romania</option>
                                    <option value="RU" data-kt-select2-country="assets/media/flags/russia.svg">Russian Federation</option>
                                    <option value="RW" data-kt-select2-country="assets/media/flags/rwanda.svg">Rwanda</option>
                                    <option value="BL" data-kt-select2-country="assets/media/flags/st-barts.svg">Saint Barthélemy</option>
                                    <option value="KN" data-kt-select2-country="assets/media/flags/saint-kitts-and-nevis.svg">Saint Kitts and Nevis</option>
                                    <option value="LC" data-kt-select2-country="assets/media/flags/st-lucia.svg">Saint Lucia</option>
                                    <option value="MF" data-kt-select2-country="assets/media/flags/sint-maarten.svg">Saint Martin (French part)</option>
                                    <option value="VC" data-kt-select2-country="assets/media/flags/st-vincent-and-the-grenadines.svg">Saint Vincent and the Grenadines</option>
                                    <option value="WS" data-kt-select2-country="assets/media/flags/samoa.svg">Samoa</option>
                                    <option value="SM" data-kt-select2-country="assets/media/flags/san-marino.svg">San Marino</option>
                                    <option value="ST" data-kt-select2-country="assets/media/flags/sao-tome-and-prince.svg">Sao Tome and Principe</option>
                                    <option value="SA" data-kt-select2-country="assets/media/flags/saudi-arabia.svg">Saudi Arabia</option>
                                    <option value="SN" data-kt-select2-country="assets/media/flags/senegal.svg">Senegal</option>
                                    <option value="RS" data-kt-select2-country="assets/media/flags/serbia.svg">Serbia</option>
                                    <option value="SC" data-kt-select2-country="assets/media/flags/seychelles.svg">Seychelles</option>
                                    <option value="SL" data-kt-select2-country="assets/media/flags/sierra-leone.svg">Sierra Leone</option>
                                    <option value="SG" data-kt-select2-country="assets/media/flags/singapore.svg">Singapore</option>
                                    <option value="SX" data-kt-select2-country="assets/media/flags/sint-maarten.svg">Sint Maarten (Dutch part)</option>
                                    <option value="SK" data-kt-select2-country="assets/media/flags/slovakia.svg">Slovakia</option>
                                    <option value="SI" data-kt-select2-country="assets/media/flags/slovenia.svg">Slovenia</option>
                                    <option value="SB" data-kt-select2-country="assets/media/flags/solomon-islands.svg">Solomon Islands</option>
                                    <option value="SO" data-kt-select2-country="assets/media/flags/somalia.svg">Somalia</option>
                                    <option value="ZA" data-kt-select2-country="assets/media/flags/south-africa.svg">South Africa</option>
                                    <option value="KR" data-kt-select2-country="assets/media/flags/south-korea.svg">South Korea</option>
                                    <option value="SS" data-kt-select2-country="assets/media/flags/south-sudan.svg">South Sudan</option>
                                    <option value="ES" data-kt-select2-country="assets/media/flags/spain.svg">Spain</option>
                                    <option value="LK" data-kt-select2-country="assets/media/flags/sri-lanka.svg">Sri Lanka</option>
                                    <option value="SD" data-kt-select2-country="assets/media/flags/sudan.svg">Sudan</option>
                                    <option value="SR" data-kt-select2-country="assets/media/flags/suriname.svg">Suriname</option>
                                    <option value="SZ" data-kt-select2-country="assets/media/flags/swaziland.svg">Swaziland</option>
                                    <option value="SE" data-kt-select2-country="assets/media/flags/sweden.svg">Sweden</option>
                                    <option value="CH" data-kt-select2-country="assets/media/flags/switzerland.svg">Switzerland</option>
                                    <option value="SY" data-kt-select2-country="assets/media/flags/syria.svg">Syrian Arab Republic</option>
                                    <option value="TW" data-kt-select2-country="assets/media/flags/taiwan.svg">Taiwan, Province of China</option>
                                    <option value="TJ" data-kt-select2-country="assets/media/flags/tajikistan.svg">Tajikistan</option>
                                    <option value="TZ" data-kt-select2-country="assets/media/flags/tanzania.svg">Tanzania, United Republic of</option>
                                    <option value="TH" data-kt-select2-country="assets/media/flags/thailand.svg">Thailand</option>
                                    <option value="TG" data-kt-select2-country="assets/media/flags/togo.svg">Togo</option>
                                    <option value="TK" data-kt-select2-country="assets/media/flags/tokelau.svg">Tokelau</option>
                                    <option value="TO" data-kt-select2-country="assets/media/flags/tonga.svg">Tonga</option>
                                    <option value="TT" data-kt-select2-country="assets/media/flags/trinidad-and-tobago.svg">Trinidad and Tobago</option>
                                    <option value="TN" data-kt-select2-country="assets/media/flags/tunisia.svg">Tunisia</option>
                                    <option value="TR" data-kt-select2-country="assets/media/flags/turkey.svg">Turkey</option>
                                    <option value="TM" data-kt-select2-country="assets/media/flags/turkmenistan.svg">Turkmenistan</option>
                                    <option value="TC" data-kt-select2-country="assets/media/flags/turks-and-caicos.svg">Turks and Caicos Islands</option>
                                    <option value="TV" data-kt-select2-country="assets/media/flags/tuvalu.svg">Tuvalu</option>
                                    <option value="UG" data-kt-select2-country="assets/media/flags/uganda.svg">Uganda</option>
                                    <option value="UA" data-kt-select2-country="assets/media/flags/ukraine.svg">Ukraine</option>
                                    <option value="AE" data-kt-select2-country="assets/media/flags/united-arab-emirates.svg">United Arab Emirates</option>
                                    <option value="GB" data-kt-select2-country="assets/media/flags/united-kingdom.svg">United Kingdom</option>
                                    <option value="US" selected data-kt-select2-country="assets/media/flags/united-states.svg">United States</option>
                                    <option value="UY" data-kt-select2-country="assets/media/flags/uruguay.svg">Uruguay</option>
                                    <option value="UZ" data-kt-select2-country="assets/media/flags/uzbekistan.svg">Uzbekistan</option>
                                    <option value="VU" data-kt-select2-country="assets/media/flags/vanuatu.svg">Vanuatu</option>
                                    <option value="VE" data-kt-select2-country="assets/media/flags/venezuela.svg">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN" data-kt-select2-country="assets/media/flags/vietnam.svg">Vietnam</option>
                                    <option value="VI" data-kt-select2-country="assets/media/flags/virgin-islands.svg">Virgin Islands</option>
                                    <option value="YE" data-kt-select2-country="assets/media/flags/yemen.svg">Yemen</option>
                                    <option value="ZM" data-kt-select2-country="assets/media/flags/zambia.svg">Zambia</option>
                                    <option value="ZW" data-kt-select2-country="assets/media/flags/zimbabwe.svg">Zimbabwe</option>
                                </select>
                                @error('appointment_country')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="fs-6 fw-semibold ">Street</label>
                                <input type="text" class="form-control" wire:model="appointment_street" name="appointment_street" id="appointment_street" />
                                @error('street')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="fs-6 fw-semibold ">City</label>
                                <input type="text" class="form-control" wire:model="appointment_city" name="appointment_city" id="appointment_city" />
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="fs-6 fw-semibold ">State / Province</label>
                                <input type="text" class="form-control" wire:model="appointment_state" name="appointment_state" id="appointment_state" />
                                @error('state')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="fs-6 fw-semibold ">Post Code</label>
                                <input type="text" class="form-control" wire:model="appointment_zip" name="appointment_zip" id="appointment_zip" />
                                @error('zip')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                <input type="text" class="form-control" wire:model="appointment_address_1" name="appointment_address_1" id="appointment_address_1" requried />
                                @error('address1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fs-6 fw-semibold ">Address Line 2</label>
                                <input type="text" class="form-control" wire:model="appointment_address_2" name="appointment_address_2" id="appointment_address_2" />
                                @error('address2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-appointment-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>Submit</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
            $('#lead_id').on('change', function (e) {
                Livewire.dispatch('getLeadAddress', { leadId: $(this).val() });
            });
        });
</script>