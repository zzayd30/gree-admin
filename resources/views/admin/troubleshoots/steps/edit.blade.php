@extends('admin.layout.app')
@section('title', 'Edit Step')

@section('content')
    <style>
        .content-wrapper {
            background-color: var(--secondary-color) !important;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 800;
        }

        .form-card {
            background: #ffffff;
            border: none;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(36, 58, 127, 0.08);
            border-top: 5px solid #243a7f;
        }

        .form-label {
            font-weight: 700;
            color: #243a7f;
            text-transform: uppercase;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .custom-input {
            border-radius: 12px !important;
            padding: 12px 15px !important;
            border: none !important;
            background-color: #f8fafc !important;
            width: 100%;
        }

        .btn-submit-custom {
            background: linear-gradient(135deg, #243a7f 0%, #1a2a5e 100%);
            color: white;
            padding: 14px 35px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.3s;
            box-shadow: 0 6px 15px rgba(36, 58, 127, 0.3);
        }

        .btn-submit-custom:hover {
            box-shadow: 0 8px 25px rgba(36, 58, 127, 0.5);
            transform: translateY(-2px);
        }

        .tip-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-add-tip {
            background-color: #10b981;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-remove-tip {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
        }
    </style>

    <div class="content-header px-4 pt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-start">
                    <h1 class="page-title"><i class="fas fa-edit me-2"></i> Edit Troubleshoot Step</h1>
                    <p class="text-muted small mb-0 mt-1">Update step for: <strong>{{ $troubleshoot->name }}</strong></p>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="form-card">
                <form action="{{ route('troubleshoots.steps.update', [$troubleshoot->id, $step->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Step Number <span class="text-danger">*</span></label>
                            <input type="number"
                                class="form-control custom-input @error('step_number') is-invalid @enderror"
                                name="step_number" value="{{ old('step_number', $step->step_number) }}" min="1"
                                placeholder="Enter step number" required>
                            @error('step_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4 text-start">
                            <label class="form-label">Sensor Type</label>
                            <input type="text"
                                class="form-control custom-input @error('sensor_type') is-invalid @enderror"
                                name="sensor_type" value="{{ old('sensor_type', $step->sensor_type) }}"
                                placeholder="e.g., Indoor, Outdoor, etc.">
                            @error('sensor_type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4 text-start">
                            <label class="form-label">Action <span class="text-danger">*</span></label>
                            <textarea class="form-control custom-input @error('action') is-invalid @enderror" name="action" rows="3"
                                placeholder="Describe the action to be taken" required>{{ old('action', $step->action) }}</textarea>
                            @error('action')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4 text-start">
                            <label class="form-label">Tips</label>
                            <div id="tips-container">
                                @php
                                    $tips = old('tips', is_array($step->tips) ? $step->tips : []);
                                    if (empty($tips)) {
                                        $tips = [''];
                                    }
                                @endphp
                                @foreach ($tips as $tip)
                                    <div class="tip-item">
                                        <input type="text" class="form-control custom-input" name="tips[]"
                                            value="{{ $tip }}" placeholder="Enter a tip">
                                        <button type="button" class="btn-remove-tip" onclick="removeTip(this)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-add-tip mt-2" onclick="addTip()">
                                <i class="fas fa-plus me-1"></i> Add Another Tip
                            </button>
                        </div>
                    </div>

                    <div class="mt-4 text-start border-top pt-4">
                        <button type="submit" class="btn-submit-custom">
                            <i class="fas fa-save me-1"></i> Update Step
                        </button>
                        <a href="{{ route('troubleshoots.show', $troubleshoot->id) }}"
                            class="ms-3 text-muted fw-bold text-decoration-none">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function addTip() {
            const container = document.getElementById('tips-container');
            const tipItem = document.createElement('div');
            tipItem.className = 'tip-item';
            tipItem.innerHTML = `
                <input type="text" class="form-control custom-input" 
                       name="tips[]" placeholder="Enter a tip">
                <button type="button" class="btn-remove-tip" onclick="removeTip(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(tipItem);
        }

        function removeTip(button) {
            const container = document.getElementById('tips-container');
            if (container.children.length > 1) {
                button.closest('.tip-item').remove();
            } else {
                toastr.warning('At least one tip field is required.');
            }
        }
    </script>
@endsection
