 {{-- Lead Status  --}}
 <br><br>
 <div class="position-relative">
     <div class="position-absolute bottom-0 end-0">
         <button type="button" class="btn-primary rounded f-2 p-1" data-bs-toggle="modal"
             data-bs-target="#addLeadStatusModal">
             <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus"
                 viewBox="0 0 16 16">
                 <path
                     d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
             </svg>
             Add LeadStatus
         </button>
     </div>
 </div>
 {{-- Table start  --}}
 <div class="table-responsive">
     @isset($leadStatus)
         <table id="dataTableExample" class="table">
             <thead>
                 <tr>
                     <th>#</th>
                     <th>Status</th>
                     <th>Default Lead Status</th>
                     <th class="text-center">Action</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($leadStatus->count() > 0)
                     @foreach ($leadStatus as $key => $value)
                         <tr>
                             <td>{{ $leadStatus->firstItem() + $key }}</td>
                             <td><span
                                     style="background-color: {{ $value->color }};width: 15px;height: 15px;border-radius: 50%;display: inline-block;margin-right: 5px;margin-bottom: -2px;"></span>
                                 {{ $value->name }}</td>
                             <td>
                                 <input type="radio" style="cursor: pointer;" name="defaultStatus"
                                     class="defaultStatusRadio" data-id="{{ $value->id }}"
                                     {{ $value->is_default ? 'checked' : '' }}> Default
                             </td>
                             <td class="text-center">
                                 {{-- @if ($isAdmin) --}}
                                 <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                     {{-- For admins --}}
                                     <li class="me-2">
                                         <a class="editLeadStatusBtn" data-id="{{ $value->id }}"
                                             data-name="{{ $value->name }}" data-color="{{ $value->color }}"
                                             data-bs-toggle="modal" data-bs-target="#editLeadStatusModal">
                                             <i class="link-icon" data-feather="edit"></i>
                                         </a>
                                         <a class="deleteLeadStatusLink" data-id="{{ $value->id }}" data-toggle="modal"
                                             data-target="#deleteLeadStatusModal"
                                             style="{{ $value->is_default ? 'display: none;' : '' }}">
                                             <i class="link-icon" data-feather="delete"></i>
                                         </a>
                                     </li>
                                 </ul>
                                 {{-- @endif --}}
                             </td>
                         </tr>
                     @endforeach
                 @else
                     <tr>
                         <td>
                             <p>There are no Lead Status.</p>
                         </td>
                     </tr>
                 @endif
             </tbody>
         </table>
         <br>
         <div class="row">{{ $leadStatus->links() }}</div>
     @endisset
 </div>
 {{-- Table end  --}}
 {{-- End Lead Status  --}}
