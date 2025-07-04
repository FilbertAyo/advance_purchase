 @php
                    $user = Auth::user();
                    $isProfileIncomplete = is_null(optional($user->profile)->gender);
                    $hasNoRelatives = optional($user->relatives)->isEmpty();
                @endphp

                @if ($hasNoRelatives)
                    <div class="alert alert-danger d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="alert-heading">Complete Your Profile</h4>
                            <p class="mb-0">
                                Please complete your
                                @if ($isProfileIncomplete && $hasNoRelatives)
                                    <strong>personal</strong> and <strong>relative</strong> details
                                @elseif ($isProfileIncomplete)
                                    <strong>personal</strong> details
                                @elseif ($hasNoRelatives)
                                    <strong>relative</strong> details
                                @endif
                                to be able to apply for loan installments.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('wizard.step1') }}" class="btn btn-danger">Finish Now</a>
                        </div>
                    </div>
                @elseif ($user->status === 'inactive')
                    <div class="alert alert-danger text-center">
                        <h5>Your account is under review</h5>
                        <p class="mb-0">Please wait while our team verifies your information.</p>
                    </div>
                @endif
