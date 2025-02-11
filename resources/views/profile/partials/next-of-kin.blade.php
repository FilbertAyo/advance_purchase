<div class="col-md-12 my-4">
    <div class="card shadow">

        @if ($relatives->isNotEmpty())
            <!-- Check if collection has data -->
            <table class="table table-bordered">
                <thead>
                    <tr role="row">
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                    id="all">
                                <label class="custom-control-label"
                                    for="all"></label>
                            </div>
                        </th>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relatives as $relationship => $group)
                        <tr role="group" class="bg-light">
                            <td colspan="7">
                                <strong>{{ ucfirst($relationship) }}</strong></td>
                        </tr>

                        @foreach ($group as $index => $relative)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="relative_{{ $relative->id }}">
                                        <label class="custom-control-label"
                                            for="relative_{{ $relative->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ strtoupper($relative->relative_name) }}</td>
                                <td>{{ $relative->phone_number }}</td>
                                <td>{{ $relative->email }}</td>
                                <td>{{ $relative->address }}</td>
                                <td>
                                    <form action="{{ route('relative.destroy', $relative->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this relative?')">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @else
        <div class="text-center">
            <p class="text-danger my-5">No relatives found.</p>
        </div>

        @endif


    </div>
    <div class="col ml-auto py-3">
        <button type="button" class="btn btn-primary float-right"
            data-toggle="modal" data-target="#relativeModal">
            Add Relative +
        </button>
    </div>

</div>



{{-- modal --}}

<div id="relativeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="relativeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relativeModalLabel">Add Next of Kin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('relative.store') }}" method="POST">
                    @csrf

                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="relative_name">Full Name</label>
                            <input type="text" class="form-control" id="relative_name" name="relative_name" required>
                        </div>

                        <div class="form-group">
                            <label for="relationship">Relationship</label>
                            <select class="form-control" id="relationship" name="relationship" required>
                                <option value="">--Select Relationship--</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Guardian">Guardian</option>
                                <option value="Friend">Friend</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (Optional)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="address">Address (Optional)</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Relative</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
