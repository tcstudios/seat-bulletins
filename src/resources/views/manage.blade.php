@extends('web::layouts.grids.12')

@section('title', 'Manage Bulletins')
@section('page_header', 'Manage Bulletins')
@push('head')
    <link href="{{ asset('web/css/bulletins.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tiny.cloud/1/fyc8q62o1bminsmih5z4hu9zx6rsotqfpar6dczamj4nz8az/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'#text'});</script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush

@section('full')
    <div class="card card-default">
        <div class="card-header highlight">
            <h3 class="card-title">Bulletins</h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-xs btn-tool" id="addBulletin" data-toggle="tooltip" data-placement="top" title="Add a new bulletin">
                    <span class="fas fa-plus-circle"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="bulletins" class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Roles</th>
                        <th>Created</th>
                        <th>Last Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if (count($bulletins) === 0)
                    <tr>
                        <td colspan="6" class="empty-list">There are no bulletins.</td>
                    </tr>
                @endif
                @foreach ($bulletins as $index => $bulletin)
                    <tr>
                        <td>{{ $bulletin->title }}</td>
                        <td>{{ $bulletin->character_name }}</td>
                        <td>
                            @if (count($bulletin->roles) === 0)
                                <span class="secondary">None</span>
                            @endif
                            @foreach ($bulletin->roles as $role)
                                <span class="badge badge-primary padded-badge">{{ $role->title }}</span>
                            @endforeach
                        </td>
                        <td>{{ $bulletin->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $bulletin->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <button type="button" id="edit-bulletin" name="edit-bulletin" data-id="{{ $index }}" class="btn btn-xs pull-right edit-bulletin secondary"><span class="fas fa-edit"></span></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="addBulletinModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title bulletin-header">New Bulletin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="{{ route('bulletins.saveBulletin') }}" method="post">
                    {{ @csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="" />
                        <div class="form-group">
                            <label for="character_name" class="control-label">Author</label>
                            <select id="character_name" name="character_name" class="form-control selectpicker">
                                @foreach ($characters as $character)
                                    <option value="{{ $character['name'] }}" selected="{{ $character['character_id'] == $main_character_id ? 'true' : 'false' }}">{{ $character['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" />
                        </div>
                        <div class="form-group">
                            <label for="text" class="control-label">Bulletin Text</label>
                            <textarea id="text" class="form-control" name="text"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="roles[]" class="control-label">Roles</label>
                            <select id="roles" name="roles[]" multiple class="form-control selectpicker">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" id="{{ 'role-'.$role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btm-group pull-right" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" id="saveBulletin" value="Save Bulletin" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('#addBulletin').on('click', function() {
            $('#addBulletinModal').modal('show');
            $('.modal-body #id').val(0);
            $('.modal-title.bulletin-header').html('Add Bulletin');
        });
        $(document).on('click', '.edit-bulletin', function() {
            var bulletins = {!! $bulletins !!};
            var bulletin = bulletins[$(this).data('id')];

            $('#addBulletinModal').modal('show');

            $('.modal-title.bulletin-header').html('Edit Bulletin');
            $('.modal-body #title').val(bulletin.title);
            $('.modal-body #id').val(bulletin.id);
            $('.modal-body #character_name').prop('disabled', true);
            let role_value = [];
            for (let role of bulletin.roles) {
                let id = role.id;
                let selector =  '.modal-body #role-' + id.toString();
                role_value.push(role.id);
                $(selector).selected = 'selected';
            }
            console.log(role_value);
            $('.modal-body #roles').selectpicker('val', role_value);
            $('.modal-body #roles').selectpicker('refresh');
            tinymce.activeEditor.setContent(bulletin.text);
        });
    </script>
@endpush