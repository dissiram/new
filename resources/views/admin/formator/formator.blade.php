@include('navbar')
@include('sweetalert::alert')
<x-app-layout>

    <div class=" p-2">
        <div class="container-sm">
            @if ($showForm)
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Modifier</h5>
                        <small class="text-muted float-end">{{$data->name}}</small>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/updateFormator', $data->id)}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" value="{{$data->name}}" name="nom"
                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                            aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input type="text" id="basic-icon-default-email" class="form-control"
                                            name="email" value="{{$data->email}}" placeholder="john.doe"
                                            aria-label="john.doe" aria-describedby="basic-icon-default-email2" />

                                    </div>
                                    <div class="form-text">You can use letters, numbers & periods</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Status</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="bx bx-edit-alt me-1"> </i>
                                        </span>
                                        <select id="basic-icon-default-phone" class="form-control phone-mask"
                                            aria-describedby="basic-icon-default-phone2" name="status">
                                            <option value="active" {{ $data->status == 'active' ? 'selected' : ''
                                                }}>Active</option>
                                            <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : ''
                                                }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message"
                                    name="role">Role</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="bx bx-edit-alt me-1"> </i>
                                        </span>
                                        <select id="basic-icon-default-phone" class="form-control phone-mask"
                                            aria-describedby="basic-icon-default-phone2" name="role">
                                            <option value="formator" {{ $data->role == 'formator' ? 'selected' : ''
                                                }}>Formateur</option>
                                            <option value="customer" {{ $data->role != 'formator' ? 'selected' : ''
                                                }}>Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success">Modifier</button>
                                    <button class="btn btn-danger ms-2"><a href="{{url('admin/formator')}}">Annuler</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @else
            <div class="card">
                <h5 class="card-header">Liste des Formateurs</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Email</th>
                                <th>Noms</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($data as $user)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{$user->email}}</strong>
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    @if($user->status == 'active')
                                    <span class="badge bg-label-success me-1">{{$user->status}}</span>
                                    @else
                                    <span class="badge bg-label-danger me-1">{{$user->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{url('admin/formator',$user->id)}}"><i
                                                    class="bx bx-edit-alt me-1"></i> Modifier</a>
                                            <a class="dropdown-item"
                                                onclick="return confirm('Etês-vous sur de vouloir effacer ce formateur ?')"
                                                href="{{url('admin/deleteFormator',$user->id)}}"><i
                                                    class="bx bx-trash me-1"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

</x-app-layout>