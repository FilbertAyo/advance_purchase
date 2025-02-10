<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-3 border-bottom">
                    <div class="col-md-6">
                        <ul class="nav nav-tabs border-0">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                    All Payment Statements
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <label for="start_date" class="mr-2">Start Date:</label>
                        <input type="date" id="start_date" class="form-control form-control-sm mr-3" style="width: 150px;">
                        <label for="end_date" class="mr-2">End Date:</label>
                        <input type="date" id="end_date" class="form-control form-control-sm mr-3" style="width: 150px;">
                        <button class="btn btn-sm btn-primary" onclick="downloadExcel()">
                            <i class="fe fe-16 fe-printer"></i> Download
                        </button>
                    </div>
                </div>

                @include('elements.spinner')
                <div class="row my-2">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table table-bordered table-hover mb-0 table-sm" id="statementsTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Amount (TZS)</th>
                                            <th>Date Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($statements->count())
                                            @foreach ($statements as $statement)
                                                <tr class="paymentRow" data-date="{{ optional($statement->application)->created_at }}">
                                                    <td>{{ optional($statement->application)->user->userId}}</td>
                                                    <td>{{ optional($statement->application)->user->first_name}} {{ optional($statement->application)->user->middle_name}} {{ optional($statement->application)->user->last_name}}</td>
                                                    <td>{{ optional($statement->application)->user->phone}}</td>
                                                    <td>{{ optional($statement->application)->user->email}}</td>
                                                    <td>{{ $statement->added_amount }}</td>
                                                    <td>{{ optional($statement->application)->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="alert alert-danger">
                                                <td colspan="6" class="text-center">No statements found</td>
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
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            // Validate dates
            if (!startDate || !endDate) {
                alert('Please select both start and end dates.');
                return;
            }

            // Convert start and end dates to Date objects for comparison
            const start = new Date(startDate);
            const end = new Date(endDate);

            // Filter rows based on date range
            const rows = document.querySelectorAll('.paymentRow');
            const filteredRows = [];
            rows.forEach(row => {
                const rowDate = new Date(row.getAttribute('data-date'));
                if (rowDate >= start && rowDate <= end) {
                    filteredRows.push(row);
                }
            });

            // If no rows found for the date range
            if (filteredRows.length === 0) {
                alert('No statements found for the selected date range.');
                return;
            }

            // Create CSV data
            let csvContent = 'ID,Customer Name,Phone,Email,Amount (TZS),Date Paid\n';
            filteredRows.forEach(row => {
                const columns = row.querySelectorAll('td');
                const rowData = [
                    columns[0].textContent, // ID
                    columns[1].textContent, // Customer Name
                    columns[2].textContent, // Phone
                    columns[3].textContent, // Email
                    columns[4].textContent, // Amount
                    columns[5].textContent  // Date Paid
                ];
                csvContent += rowData.join(',') + '\n';
            });

            // Create a Blob and trigger the download
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'payment_statements.csv';
            link.click();
        }
    </script>
</x-app-layout>
