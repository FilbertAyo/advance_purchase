<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-3 border-bottom">
                    <div class="col-md-6">
                        <ul class="nav nav-tabs border-0">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                    Refund Report
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <button class="btn btn-sm btn-secondary" onclick="downloadExcel()">
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

                            <table class="table table-bordered table-hover mb-0 table-sm" id="refundTable">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Customer Name</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Amount (TZS)</th>
                                  <th>Last Date issued</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if ($refunds->count())
                                @foreach ($refunds as $refund)
                                <tr class="paymentRow" data-updated="{{ $refund->updated_at }}">
                                    <td>{{ $refund->user->userId }}</td>
                                    <td>{{ $refund->user->first_name }} {{ $refund->user->middle_name }} {{ $refund->user->last_name }}</td>
                                    <td>{{ $refund->user->phone }}</td>
                                    <td>{{ $refund->user->email }}</td>
                                    <td>{{ $refund->paid_amount }}</td>
                                    <td>{{ $refund->updated_at }}</td>
                                </tr>
                                @endforeach
                                @else
                                  <tr class="alert alert-danger">
                                    <td colspan="7" class="text-center">No Refunds found</td>
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
            let csvContent = 'ID,Customer Name,Phone,Email,Amount (TZS),Last Date issued\n';
            rows.forEach(row => {
                const columns = row.querySelectorAll('td');
                const rowData = [
                    columns[0].textContent, // ID
                    columns[1].textContent, // Customer Name
                    columns[2].textContent, // Phone
                    columns[3].textContent, // Email
                    columns[4].textContent, // Amount
                    columns[5].textContent  // Last Date issued
                ];
                csvContent += rowData.join(',') + '\n';
            });

            // Create a Blob and trigger the download
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'full_payments.csv';
            link.click();
        }
    </script>
</x-app-layout>
