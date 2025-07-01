<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">All Outstanding</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-sm btn-secondary" onclick="downloadExcel()">
                            <i class="fe fe-16 fe-printer"></i> Download
                        </button>
                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>
                    </div>
                </div>

                @include('elements.spinner')
                <div class="row my-2">
                    <div class="col-12">
                        <div class="card ">
                          <div class="card-body">
                            <table class="table table-bordered table-hover mb-0 table-sm" id="outstandingTable">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Customer Name</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Outstanding (TZS)</th>
                                  <th>Last Date issued</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if ($outstanding->count())
                                @foreach ($outstanding as $outstanding)
                                <tr class="paymentRow" data-updated="{{ $outstanding->updated_at }}">
                                    <td>{{ $outstanding->user->userId }}</td>
                                    <td>{{ $outstanding->user->first_name }} {{ $outstanding->user->middle_name }} {{ $outstanding->user->last_name }}</td>
                                    <td>{{ $outstanding->user->phone }}</td>
                                    <td>{{ $outstanding->user->email }}</td>
                                    <td>{{ $outstanding->outstanding }}</td>
                                    <td>{{ $outstanding->updated_at }}</td>
                                </tr>
                                @endforeach
                                @else
                                  <tr class="alert alert-danger">
                                    <td colspan="6" class="text-center">No outstanding found</td>
                                  </tr>
                                @endif
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadExcel() {
            // Select all rows in the table
            const rows = document.querySelectorAll('.paymentRow');

            // Create CSV data
            let csvContent = 'ID,Customer Name,Phone,Email,Outstanding (TZS),Last Date issued\n';
            rows.forEach(row => {
                const columns = row.querySelectorAll('td');
                const rowData = [
                    columns[0].textContent, // ID
                    columns[1].textContent, // Customer Name
                    columns[2].textContent, // Phone
                    columns[3].textContent, // Email
                    columns[4].textContent, // Outstanding
                    columns[5].textContent  // Last Date issued
                ];
                csvContent += rowData.join(',') + '\n';
            });

            // Create a Blob and trigger the download
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'outstanding_records.csv';
            link.click();
        }

        function reloadPage() {
            location.reload();
        }
    </script>
</x-app-layout>
