<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="row align-items-center mb-4">
                  <div class="col">
                    <h2 class="h5 page-title"><small class="text-muted text-uppercase">Receipt</small><br />#{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</h2>
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-secondary" onclick="printReceipt()">Print</button>
                  </div>
                </div>
                <div class="card shadow receipt">
                  <div class="card-body p-5">
                    <div class="row mb-5">
                      <div class="col-12 text-center mb-4">
                        <img src="{{ asset('images/marslogo.png') }}" class="navbar-brand-img mx-auto mb-4" alt="..." style="height: 80px;">
                        <h2 class="mb-0 text-uppercase">RECEIPT</h2>
                        <p class="text-muted"> MARS COMMUNICATION LTD<br /> Samora J.M Mall , Posta. Dar es salaam </p>
                      </div>
                      <div class="col-md-7">
                        <p class="small text-muted text-uppercase mb-2">Installment Payment from</p>
                        <p class="mb-4">
                          <strong class="text-uppercase"> {{ $application->user->first_name }} {{ $application->user->middle_name }} {{ $application->user->last_name }}</strong><br />ID: {{ $application->user->userId }}<br /> {{ $application->user->profile->street }},{{ $application->user->profile->ward }},{{ $application->user->profile->district }}<br /> {{ $application->user->profile->city }} <br /> {{ $application->user->phone }}<br />
                        </p>
                        <p>
                          <span class="small text-muted text-uppercase">Receipt #</span><br />
                          <strong>{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</strong>
                        </p>
                      </div>
                      <div class="col-md-5">
                        <p class="small text-muted text-uppercase mb-2">Payment to</p>
                        <p class="mb-4">
                          <strong>MARS COMMUNICATION LTD</strong><br /> Samora J.M Mall , Posta<br /> Dar es salaam<br /> marscommmunication@gmail.com<br /> (+255) 74140-0100<br />
                        </p>
                        <p>
                          <small class="small text-muted text-uppercase">Due date</small><br />
                          <strong>  {{ $application->updated_at?->format('F j, Y H:i A') }}</strong>
                        </p>
                      </div>
                    </div>
                    <table class="table table-borderless table-striped">
                      <thead>

                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Date Paid</th>

                          <th scope="col" class="text-right">Ammout (TZS)</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($advances->count() > 0)
                            @foreach ($advances as $index => $advance)
                                @if ($advance->added_amount > 0)
                        <tr>
                          <th scope="row">{{ $loop->index + 1 }}</th>
                          <td> {{ $advance->created_at }}
                          <td class="text-right">{{ number_format($advance->added_amount, 2) }}
                        </td>
                        </tr>
                        @endif
                        @endforeach

                    @endif

                      </tbody>
                    </table>

                    <div class="row mt-5">
                      <div class="col-2 text-center">
                        <img src="{{ asset('images/mars.jpeg') }}" class="navbar-brand-img brand-sm mx-auto my-4" alt="...">
                      </div>
                      <div class="col-md-5">
                        <p class="text-muted small">
                            <strong>Note:</strong> This receipt confirms that the payment has been received successfully. Please keep it for your records. No further action is required.
                          </p>

                      </div>
                      <div class="col-md-5">
                        <div class="text-right mr-2">
                          <p class="mb-2 h6">
                            <span class="text-muted">Total Amount : </span>
                            <strong>{{ number_format($application->paid_amount, 2) }} TZS</strong>
                          </p>

                          <p class="mb-2 h6">
                            <span class="text-muted">Status : </span>
                            <span class="text-danger">Paid</span>
                          </p>
                        </div>
                      </div>


                    </div> <!-- /.row -->
                  </div>
                </div>
              </div>

        </div>
    </div>

    <script>
        function printReceipt() {
          let receiptContent = document.querySelector('.receipt').innerHTML;
          let originalContent = document.body.innerHTML;

          document.body.innerHTML = receiptContent;
          window.print();
          document.body.innerHTML = originalContent;
          location.reload(); // Reload the page to restore original content
        }
      </script>


    @include('elements.spinner')
</x-app-layout>
